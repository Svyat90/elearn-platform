<?php

namespace App\Services;

use App\Document;
use App\Traits\FilterConstantsTrait;
use Illuminate\Support\Facades\File;

class DocumentService
{
    use FilterConstantsTrait;

    public const DOCUMENT_STATUS_INITIAL = 'initial';
    public const DOCUMENT_STATUS_UPDATED = 'updated';
    public const DOCUMENT_STATUS_CANCELED = 'canceled';

    public const DOCUMENT_ACCESS_TYPE_PUBLIC = 'public';
    public const DOCUMENT_ACCESS_TYPE_PROTECTED = 'protected';
    public const DOCUMENT_ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        return static::filterConstants("DOCUMENT_ACCESS_TYPE");
    }

    /**
     * @return array
     */
    public static function getStatuses() : array
    {
        return self::filterConstants("DOCUMENT_STATUS");
    }

    /**
     * @param Document $document
     * @param string $imagePath
     */
    public function handleImage(Document $document, string $imagePath) : void
    {
        if ($document->image_path && $document->image_path !== $imagePath) {
            $imagePath = storage_path('app/public/' . $document->image_path);
            File::delete($imagePath);
        }
    }

    /**
     * @param Document $document
     * @param string $filePath
     */
    public function handleFile(Document $document, string $filePath) : void
    {
        if ($document->file_path && $document->file_path !== $filePath) {
            $filePath = storage_path('app/public/' . $document->file_path);
            File::delete($filePath);
        }
    }

}
