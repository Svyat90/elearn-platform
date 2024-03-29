<?php

namespace App\Services\Document;

use App\Category;
use App\Course;
use App\Document;
use App\Helpers\DocxConversion;
use App\Http\Requests\Front\Category\IndexCategoryRequest;
use App\Role;
use App\Services\AbstractAccessService;
use App\Services\ImageService;
use App\SubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DocumentService extends AbstractAccessService
{
    public const DOCUMENT_TYPE_DOCX = 'docx';
    public const DOCUMENT_TYPE_PDF = 'pdf';

    /**
     * @param Document $document
     * @param string $newImagePath
     */
    public function handleImage(Document $document, string $newImagePath) : void
    {
        if ($document->image_path && $document->image_path !== $newImagePath) {
            $imagePathDelete = fileStoragePath($document->image_path);
            File::delete($imagePathDelete);

            $imageService = app(ImageService::class);
            $imageService->deleteThumbs($document->image_path);
            $imageService->saveThumbs(
                ImageService::IMAGE_TYPE_DOCUMENT,
                $newImagePath
            );
        }
    }

    /**
     * @param Document $document
     * @param string $filePath
     */
    public function handleFile(Document $document, string $filePath) : void
    {
        if ($document->file_path && $document->file_path !== $filePath) {
            $filePath = fileStoragePath($document->file_path);
            File::delete($filePath);
        }
    }

    /**
     * @param Document $document
     * @param Request $request
     */
    public function handleRelationships(Document $document, Request $request) : void
    {
        $document->roles()->sync($request->role_ids);
        $document->users()->sync($request->user_ids);
        $document->categories()->sync($request->category_ids);
        $document->subCategories()->sync($request->sub_category_ids);
        $document->relatedDocuments()->sync($request->related_document_ids);
    }

    /**
     * @param string $filePath
     * @return string
     */
    public static function getDocumentContent(string $filePath) : string
    {
        [, $exp] = explode(".", $filePath);

        $fullPath = fileStoragePath($filePath);

        switch (true) {
            case $exp === self::DOCUMENT_TYPE_DOCX:
                $converter = new DocxConversion($fullPath);
                return $converter->convertToText();

            case $exp === self::DOCUMENT_TYPE_PDF:
                return getContentPdf($fullPath);

            default:
                return "";
        }
    }

    /**
     * @return Builder|BelongsToMany
     */
    public function getAvailableDocuments()
    {
        if ( ! $this->getUser()) {
            return $this->getPublicDocuments();
        }

        return Document::query()
            ->where('access', self::ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) {
                $query
                    ->where('documents.access', self::ACCESS_TYPE_PROTECTED)
                    ->whereIn('documents.id', $this->getProtectedDocumentIds());
            });
    }

    /**
     * @return Builder
     */
    public function getPublicDocuments() : Builder
    {
        return Document::query()->where('access', self::ACCESS_TYPE_PUBLIC);
    }

    /**
     * @return Collection
     */
    public function getProtectedDocuments() : Collection
    {
        return $this->getUser()->documents()
            ->where('access', self::ACCESS_TYPE_PROTECTED)
            ->whereIn('id', $this->getProtectedDocumentIds())
            ->get();
    }

    /**
     * @param Course $course
     * @return Builder|BelongsToMany
     */
    public function getAvailableCourseDocuments(Course $course)
    {
        $queryBuilder = $course->documents()
            ->where('access', self::ACCESS_TYPE_PUBLIC);

        return $queryBuilder->orWhere(function (Builder $query) use ($course) {
            $query
                ->where('course_id', $course->id)
                ->where('access', self::ACCESS_TYPE_PROTECTED)
                ->whereIn('id', $this->getProtectedDocumentIds());
        });
    }

    /**
     * @param Model|Category|SubCategory $category
     * @param IndexCategoryRequest $request
     * @param string $pivotColumnName
     * @return mixed
     */
    public function getAvailableCategoryDocuments(Model $category, IndexCategoryRequest $request, string $pivotColumnName)
    {
        $queryBuilder = $category->documents()
            ->where('access', self::ACCESS_TYPE_PUBLIC);

        $this->setFilters($queryBuilder, $request);

        return $queryBuilder->orWhere(function (Builder $query) use ($category, $request, $pivotColumnName) {
            $this->setFilters($query, $request);

            $query->where($pivotColumnName, $category->id)
                ->where('access', self::ACCESS_TYPE_PROTECTED)
                ->whereIn('id', $this->getProtectedDocumentIds());
        });
    }

    /**
     * @param $queryBuilder
     * @param IndexCategoryRequest $request
     */
    private function setFilters(&$queryBuilder, IndexCategoryRequest $request) : void
    {
        /** @var $queryBuilder Builder */
        if ($request->has('filter_type') && !empty($request->filter_type)) {
            $queryBuilder->where(localeAppColumn('type'), $request->filter_type);
        }

        if ($request->has('filter_issuer') && !empty($request->filter_issuer)) {
            $queryBuilder->where(localeAppColumn('name_issuer'), $request->filter_issuer);
        }

        if ($request->has('filter_topic') && !empty($request->filter_topic)) {
            $queryBuilder->where(localeAppColumn('topic'), $request->filter_topic);
        }
    }

    /**
     * @return array
     */
    protected function getProtectedDocumentIds() : array
    {
        if ( ! $this->getUser())
            return [];

        $roleDocuments = $this->getRolesDocuments();
        $userDocuments = $this->getUserDocuments();
        $categoryDocuments = $this->getCategoriesDocuments();

        return $roleDocuments
            ->merge($userDocuments)
            ->merge($categoryDocuments)
            ->unique()
            ->toArray();
    }

    /**
     * @return Collection
     */
    private function getRolesDocuments() : Collection
    {
        return $this->getUser()->roles->map(function (Role $role) {
            return $role->documents->map(function (Document $document) {
                return $document->id;
            });
        })->collapse();
    }

    /**
     * @return Collection
     */
    private function getUserDocuments() : Collection
    {
        return $this->getUser()->documents->map(function (Document $document) {
            return $document->id;
        });
    }

    /**
     * @return Collection
     */
    private function getCategoriesDocuments() : Collection
    {
        return $this->getUser()->categories->map(function (Category $category) {
            return $category->documents->map(function (Document $document) {
                return $document->id;
            });
        })->collapse();
    }

}
