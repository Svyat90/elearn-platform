<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AccessCategories;
use App\Http\Controllers\Traits\FavouritesTrait;
use App\Http\Controllers\Traits\SettingTrait;
use App\Http\Controllers\Traits\WatchLaterTrait;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    use AccessCategories,
        SettingTrait,
        FavouritesTrait,
        WatchLaterTrait;

    /**
     * @var User|null
     */
    protected ? User $user = null;

    /**
     * @var int
     */
    protected int $pageLimit = 24;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            /** @var User $user */
            $user = Auth::user();
            $this->user = $user;
            $this->shareCategories($this->user);
            $this->shareFavourites($this->user);
            $this->shareWatchLater($this->user);
            $this->shareSettings();
            return $next($request);
        });
    }

    /**
     * GetSuccessResponse
     *
     * @param JsonResource $object ""
     *
     * @return JsonResponse
     */
    public function getSuccessResponse(JsonResource $object) : JsonResponse
    {
        return $object->response()->setStatusCode(Response::HTTP_OK);
    }

}
