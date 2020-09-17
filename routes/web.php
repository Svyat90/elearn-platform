<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth.admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::resource('categories', 'CategoryController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Admin Users
    Route::delete('admin-users/destroy', 'AdminUserController@massDestroy')->name('admin-users.massDestroy');
    Route::resource('admin-users', 'AdminUserController');

    // Sub Categories
    Route::delete('sub-categories/destroy', 'SubCategoryController@massDestroy')->name('sub-categories.massDestroy');
    Route::post('sub-categories/media', 'SubCategoryController@storeMedia')->name('sub-categories.storeMedia');
    Route::post('sub-categories/ckmedia', 'SubCategoryController@storeCKEditorImages')->name('sub-categories.storeCKEditorImages');
    Route::resource('sub-categories', 'SubCategoryController');

    // Admin Settings
    Route::delete('admin-settings/destroy', 'AdminSettingsController@massDestroy')->name('admin-settings.massDestroy');
    Route::resource('admin-settings', 'AdminSettingsController');

    // User Profile Avatar Images
    Route::resource('user-profile-avatar-images', 'UserProfileAvatarImagesController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth.admin']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
