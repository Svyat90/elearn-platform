<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LocaleMiddleware;

Auth::routes();

Route::get('/', 'Front\HomeController@redirectToHome');
Route::get('set-locale/{lang}', 'Front\LocaleController@setLocale')->name('setLocate');

// Front
Route::group(['prefix' => LocaleMiddleware::getLocale(), 'namespace' => 'Front'], function () {
    Route::get('home', 'HomeController@index')->name('front.home');
    // Categories
    Route::resource('categories', 'CategoryController')->only('show');
    Route::resource('sub-categories', 'SubCategoryController')->only('show');

    // Documents
    Route::resource('documents', 'DocumentController')->only('index', 'show');
    Route::post('documents/favorite', 'DocumentController@favorite')->name('documents.favourite');
    Route::post('documents/watch-later', 'DocumentController@watchLater')->name('documents.watch_later');

    // Courses
    Route::resource('courses', 'CourseController')->only('index', 'show');
    Route::post('courses/favorite', 'CourseController@favorite')->name('courses.favourite');
    Route::post('courses/watch-later', 'CourseController@watchLater')->name('courses.watch_later');

    // Contacts
    Route::resource('contacts', 'ContactController')->only('index');
    Route::post('contacts/send', 'ContactController@send')->name('contacts.send');

    // User Profile
    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile/my-account', 'ProfileController@myAccount')->name('profile.my_account');
        Route::post('profile/update-data', 'ProfileController@updateData')->name('profile.update_data');
        Route::post('profile/update-password', 'ProfileController@updatePassword')->name('profile.update_password');
        Route::get('profile/favourites', 'ProfileController@favourites')->name('profile.favourites');
        Route::get('profile/watch-later', 'ProfileController@watchLater')->name('profile.watch_later');
        Route::get('profile/my-courses', 'ProfileController@myCourses')->name('profile.my_courses');
        Route::get('profile/my-documents', 'ProfileController@myDocuments')->name('profile.my_documents');
    });

    // Search
    Route::post('search', 'SearchController@search')->name('search');
});

// Admin
Route::group(['prefix' => LocaleMiddleware::getLocale()], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth.admin']], function () {
        Route::redirect('/admin', '/login');
        Route::get('/', 'HomeController@index')->name('home');

        // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');

        // Roles
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');

        // Users
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::resource('users', 'UsersController');

        // Categories
        Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
        Route::resource('categories', 'CategoryController');

        // Sub Categories
        Route::delete('sub-categories/destroy', 'SubCategoryController@massDestroy')->name('sub_categories.massDestroy');
        Route::resource('sub_categories', 'SubCategoryController');

        // Documents
        Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
        Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');
        Route::resource('documents', 'DocumentController');

        // Courses
        Route::delete('courses/destroy', 'CourseController@massDestroy')->name('courses.massDestroy');
        Route::post('courses/media', 'CourseController@storeMedia')->name('courses.storeMedia');
        Route::resource('courses', 'CourseController');

        // Audit Logs
        Route::resource('audit_logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

        // Settings
        Route::resource('settings', 'SettingController')->only('index', 'edit', 'update');

        // Translations
        Route::get('translations', 'TranslationController@edit')->name('translations.edit');
        Route::put('translations', 'TranslationController@update')->name('translations.update');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth.admin']], function () {
        // Change password
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    });
});
