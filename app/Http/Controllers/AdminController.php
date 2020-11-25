<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TranslationTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    use TranslationTrait;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->shareTranslations();
    }

    /**
     * @param Model $row
     * @param string $entityName
     * @return Application|Factory|View
     */
    protected function renderActionsRow(Model $row, string $entityName)
    {
        $viewGate      = $entityName . '_show';
        $editGate      = $entityName . '_edit';
        $deleteGate    = $entityName . '_delete';

        $crudRoutePart = Str::plural($entityName);

        return view('admin.partials.datatablesActions', compact(
            'viewGate',
            'editGate',
            'deleteGate',
            'crudRoutePart',
            'row'
        ));
    }

}
