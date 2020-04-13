<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TalentProfileIntroVideosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('talent_profile_intro_video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::ByRole(3)->with(['roles', 'country', 'gender','artistArtistMeta'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');


            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });

            $table->editColumn('name', function ($row) {
                return !$row->artistArtistMeta->isEmpty() ? $row->artistArtistMeta[0]->display_name : $row->first_name.' '.$row->last_name;
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });

            $table->editColumn('avatar', function ($row) {
                if(!$row->artistArtistMeta->isEmpty()) {

                    if ($photo = $row->artistArtistMeta[0]->intro_video_url) {
                        return sprintf(
                            '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                            env('APP_URL').$photo->url,
                            env('APP_URL').$photo->getUrl('thumb')
                        );
                    }
                }
                return '';

            });
            $table->editColumn('intro_video_url', function ($row) {
                if(!$row->artistArtistMeta->isEmpty()) {
                    return  '<a href="' . env('APP_URL').$row->artistArtistMeta[0]->intro_video_url->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }
            });

            $table->rawColumns(['placeholder', 'roles', 'country','intro_video_url', 'gender', 'avatar']);

            return $table->make(true);
        }

        return view('admin.talentProfileIntroVideos.index');
    }
}
