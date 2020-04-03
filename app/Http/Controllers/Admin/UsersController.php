<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Language;
use App\Role;
use App\SocialMedium;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles', 'languages', 'country', 'social_meidias', 'categories'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

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
                return $row->first_name ? $row->first_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });

            $table->editColumn('position_occupation', function ($row) {
                return $row->position_occupation ? $row->position_occupation : "";
            });
            $table->editColumn('subscribers', function ($row) {
                return $row->subscribers ? $row->subscribers : "";
            });
            $table->editColumn('bio', function ($row) {
                return $row->bio ? $row->bio : "";
            });
            $table->editColumn('language', function ($row) {
                $labels = [];

                foreach ($row->languages as $language) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $language->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('social_meidia', function ($row) {
                $labels = [];

                foreach ($row->social_meidias as $social_meidium) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $social_meidium->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('category', function ($row) {
                $labels = [];

                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'roles', 'language', 'country', 'social_meidia', 'category']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $languages = Language::all()->pluck('name', 'id');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $social_meidias = SocialMedium::all()->pluck('name', 'id');

        $categories = Category::all()->pluck('name', 'id');

        return view('admin.users.create', compact('roles', 'languages', 'countries', 'social_meidias', 'categories'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->languages()->sync($request->input('languages', []));
        $user->social_meidias()->sync($request->input('social_meidias', []));
        $user->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.users.index');

    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $languages = Language::all()->pluck('name', 'id');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $social_meidias = SocialMedium::all()->pluck('name', 'id');

        $categories = Category::all()->pluck('name', 'id');

        $user->load('roles', 'languages', 'country', 'social_meidias', 'categories');

        return view('admin.users.edit', compact('roles', 'languages', 'countries', 'social_meidias', 'categories', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->languages()->sync($request->input('languages', []));
        $user->social_meidias()->sync($request->input('social_meidias', []));
        $user->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.users.index');

    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'languages', 'country', 'social_meidias', 'categories', 'userUserReviews');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
