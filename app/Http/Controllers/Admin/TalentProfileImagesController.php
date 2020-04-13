<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TalentProfileImagesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('talent_profile_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::ByRole(3)->with(['roles', 'country', 'gender','artistArtistMeta'])->get();
        foreach ($users as $row) {
//            dd($row->artistArtistMeta[0]->display_name);
        }
//        dd($users->toArray());

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

                   if ($photo = $row->artistArtistMeta[0]->profile_photo_url) {
                       return sprintf(
                           '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                           env('APP_URL').$photo->url,
                           env('APP_URL').$photo->thumbnail
                       );
                   }
               }
                return '';

            });

            $table->rawColumns(['placeholder', 'roles', 'country', 'gender', 'avatar']);

            return $table->make(true);
        }

        return view('admin.talentProfileImages.index');
    }
}
