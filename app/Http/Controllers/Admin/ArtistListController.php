<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArtistListController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('artist_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::ByRole(3)->with(['roles', 'country', 'gender','artistArtistMeta'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');


            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];

                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('first_name', function ($row) {
                if(!$row->artistArtistMeta->isEmpty()) {
                    $fullName = $row->artistArtistMeta[0]->display_name;
                    list($firstName, $lastName) = array_pad(explode(' ', trim($fullName)), 2, null);
                    return $firstName;
                } else {
                    return $row->first_name ? $row->first_name : "";
                }
            });
            $table->editColumn('last_name', function ($row) {
                if(!$row->artistArtistMeta->isEmpty()) {
                    $fullName = $row->artistArtistMeta[0]->display_name;
                    list($firstName, $lastName) = array_pad(explode(' ', trim($fullName)), 2, null);
                    return $lastName;
                } else {
                    return $row->last_name ? $row->last_name : "";
                }

            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });

            $table->editColumn('mobile_no', function ($row) {
                return $row->mobile_no ? $row->mobile_no : "";
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->addColumn('gender_name', function ($row) {
                return $row->gender ? $row->gender->name : '';
            });

            $table->editColumn('referral_code', function ($row) {
                return $row->referral_code ? $row->referral_code : "";
            });
            $table->editColumn('referred_by', function ($row) {
                return $row->referred_by ? $row->referred_by : "";
            });
            $table->editColumn('registration_platform', function ($row) {
                return $row->registration_platform ? User::REGISTRATION_PLATFORM_SELECT[$row->registration_platform] : '';
            });
            $table->editColumn('ig_token', function ($row) {
                return $row->ig_token ? $row->ig_token : "";
            });
            $table->editColumn('ig_username', function ($row) {
                return $row->ig_username ? $row->ig_username : "";
            });
            $table->editColumn('user_status', function ($row) {
                return $row->user_status ? User::USER_STATUS_SELECT[$row->user_status] : '';
            });

            $table->editColumn('avatar', function ($row) {
//                if(!$row->artistArtistMeta->isEmpty()) {
//
//                    if ($photo = $row->artistArtistMeta[0]->profile_photo_url) {
//                        return sprintf(
//                            '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
//                            $photo->url,
//                            $photo->thumbnail
//                        );
//                    }
//
//                } else {
//                    if ($photo = $row->avatar) {
//                        return sprintf(
//                            '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
//                            $photo->url,
//                            $photo->thumbnail
//                        );
//
//                    }
//                }
                if ($photo = $row->avatar) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        env('APP_URL').$photo->url,
                        env('APP_URL').$photo->thumbnail
                    );

                }
                return '';

            });
            $table->editColumn('registration_source', function ($row) {
                return $row->registration_source ? User::REGISTRATION_SOURCE_SELECT[$row->registration_source] : '';
            });

            $table->rawColumns(['placeholder', 'roles', 'country', 'gender', 'avatar']);

            return $table->make(true);
        }

        return view('admin.artistLists.index');
    }


    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
