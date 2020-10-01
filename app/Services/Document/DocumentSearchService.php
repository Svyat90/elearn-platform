<?php

namespace App\Services\Document;

use App\Document;
use App\Http\Requests\Front\Search\SearchRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DocumentSearchService extends DocumentService
{
    /**
     * @var array|string[]
     */
    private array $allowFilters = [
        'filter_all', 'filter_name',
        'filter_issuer', 'filter_description'
    ];

    /**
     * @param SearchRequest $request
     * @return bool
     */
    public function isEmptyFilters(SearchRequest $request) : bool
    {
        foreach ($this->allowFilters as $filter) {
            if ($request->has($filter) && $request->input($filter)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param SearchRequest $request
     * @return Builder|BelongsToMany
     */
    public function getSearchAvailableDocuments(SearchRequest $request)
    {
        $queryBuilder = Document::query()
            ->where('access', self::ACCESS_TYPE_PUBLIC);

        $this->setSearchFilters($queryBuilder, $request);

        $queryBuilder->orWhere(function (Builder $query) use ($request){
            $this->setSearchFilters($query, $request);

            $query
                ->where('documents.access', self::ACCESS_TYPE_PROTECTED)
                ->whereIn('documents.id', $this->getProtectedDocumentIds());
        });

        return $queryBuilder;
    }

    /**
     * @param $queryBuilder
     * @param SearchRequest $request
     */
    private function setSearchFilters(&$queryBuilder, SearchRequest $request) : void
    {
        if (empty($query = $request->input('query'))) {
            return;
        }

        if ($request->has('filter_all') && $request->input('filter_all')) {
            $queryBuilder
                ->where(localeAppColumn('name_issuer'), 'LIKE', '%' . DB::raw($query) . '%')
                ->orWhere(localeAppColumn('name'), 'LIKE', '%' . DB::raw($query) . '%')
                ->orWhere(localeAppColumn('description'), 'LIKE', '%' . DB::raw($query) . '%');

        } else {
            $orWhere = false;
            if ($request->has('filter_name') && $request->input('filter_name')) {
                $queryBuilder->where(localeAppColumn('name'), 'LIKE', '%' . DB::raw($query) . '%');
                $orWhere = true;
            }

            if ($request->has('filter_issuer') && $request->input('filter_issuer')) {
                if ($orWhere) {
                    $queryBuilder->orWhere(localeAppColumn('name_issuer'), 'LIKE', '%' . DB::raw($query) . '%');
                } else {
                    $queryBuilder->where(localeAppColumn('name_issuer'), 'LIKE', '%' . DB::raw($query) . '%');
                    $orWhere = true;
                }
            }

            if ($request->has('filter_description') && $request->input('filter_description')) {
                if ($orWhere) {
                    $queryBuilder->orWhere(localeAppColumn('description'), 'LIKE', '%' . DB::raw($query) . '%');
                } else {
                    $queryBuilder->where(localeAppColumn('description'), 'LIKE', '%' . DB::raw($query) . '%');
                }
            }
        }
    }

}
