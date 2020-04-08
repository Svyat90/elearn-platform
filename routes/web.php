<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
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

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Languages
    Route::delete('languages/destroy', 'LanguageController@massDestroy')->name('languages.massDestroy');
    Route::resource('languages', 'LanguageController');

    // Tags
    Route::delete('tags/destroy', 'TagController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagController');

    // Pages
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::resource('pages', 'PageController');

    // Search Logs
    Route::delete('search-logs/destroy', 'SearchLogController@massDestroy')->name('search-logs.massDestroy');
    Route::resource('search-logs', 'SearchLogController');

    // Social Media
    Route::delete('social-media/destroy', 'SocialMediaController@massDestroy')->name('social-media.massDestroy');
    Route::resource('social-media', 'SocialMediaController');

    // Referral Commissions
    Route::delete('referral-commissions/destroy', 'ReferralCommissionController@massDestroy')->name('referral-commissions.massDestroy');
    Route::resource('referral-commissions', 'ReferralCommissionController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Orders
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    // Videos
    Route::delete('videos/destroy', 'VideoController@massDestroy')->name('videos.massDestroy');
    Route::post('videos/media', 'VideoController@storeMedia')->name('videos.storeMedia');
    Route::post('videos/ckmedia', 'VideoController@storeCKEditorImages')->name('videos.storeCKEditorImages');
    Route::resource('videos', 'VideoController');

    // User Reviews
    Route::delete('user-reviews/destroy', 'UserReviewController@massDestroy')->name('user-reviews.massDestroy');
    Route::resource('user-reviews', 'UserReviewController');

    // Genders
    Route::delete('genders/destroy', 'GenderController@massDestroy')->name('genders.massDestroy');
    Route::resource('genders', 'GenderController');

    // Order Histories
    Route::delete('order-histories/destroy', 'OrderHistoryController@massDestroy')->name('order-histories.massDestroy');
    Route::resource('order-histories', 'OrderHistoryController');

    // Order Payments
    Route::delete('order-payments/destroy', 'OrderPaymentController@massDestroy')->name('order-payments.massDestroy');
    Route::resource('order-payments', 'OrderPaymentController');

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

    // Occasions
    Route::delete('occasions/destroy', 'OccasionController@massDestroy')->name('occasions.massDestroy');
    Route::resource('occasions', 'OccasionController');

    // Email Subscriptions
    Route::delete('email-subscriptions/destroy', 'EmailSubscriptionController@massDestroy')->name('email-subscriptions.massDestroy');
    Route::resource('email-subscriptions', 'EmailSubscriptionController');

    // Promo Codes
    Route::delete('promo-codes/destroy', 'PromoCodeController@massDestroy')->name('promo-codes.massDestroy');
    Route::post('promo-codes/media', 'PromoCodeController@storeMedia')->name('promo-codes.storeMedia');
    Route::post('promo-codes/ckmedia', 'PromoCodeController@storeCKEditorImages')->name('promo-codes.storeCKEditorImages');
    Route::resource('promo-codes', 'PromoCodeController');

    // Login Logs
    Route::delete('login-logs/destroy', 'LoginLogController@massDestroy')->name('login-logs.massDestroy');
    Route::resource('login-logs', 'LoginLogController');

    // Payment Logs
    Route::post('payment-logs/media', 'PaymentLogController@storeMedia')->name('payment-logs.storeMedia');
    Route::post('payment-logs/ckmedia', 'PaymentLogController@storeCKEditorImages')->name('payment-logs.storeCKEditorImages');
    Route::resource('payment-logs', 'PaymentLogController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
