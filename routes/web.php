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
    Route::resource('search-logs', 'SearchLogController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Social Media
    Route::delete('social-media/destroy', 'SocialMediaController@massDestroy')->name('social-media.massDestroy');
    Route::resource('social-media', 'SocialMediaController');

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
    Route::post('user-reviews/media', 'UserReviewController@storeMedia')->name('user-reviews.storeMedia');
    Route::post('user-reviews/ckmedia', 'UserReviewController@storeCKEditorImages')->name('user-reviews.storeCKEditorImages');
    Route::resource('user-reviews', 'UserReviewController');

    // Genders
    Route::delete('genders/destroy', 'GenderController@massDestroy')->name('genders.massDestroy');
    Route::resource('genders', 'GenderController');

    // Order Payments
    Route::delete('order-payments/destroy', 'OrderPaymentController@massDestroy')->name('order-payments.massDestroy');
    Route::resource('order-payments', 'OrderPaymentController', ['except' => ['create', 'store', 'edit', 'update']]);

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
    Route::resource('login-logs', 'LoginLogController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Payment Logs
    Route::post('payment-logs/media', 'PaymentLogController@storeMedia')->name('payment-logs.storeMedia');
    Route::post('payment-logs/ckmedia', 'PaymentLogController@storeCKEditorImages')->name('payment-logs.storeCKEditorImages');
    Route::resource('payment-logs', 'PaymentLogController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);


    // Artist Payment Histories
    Route::delete('artist-payment-histories/destroy', 'ArtistPaymentHistoryController@massDestroy')->name('artist-payment-histories.massDestroy');
    Route::resource('artist-payment-histories', 'ArtistPaymentHistoryController');

    // Agent Payment Histories
    Route::delete('agent-payment-histories/destroy', 'AgentPaymentHistoryController@massDestroy')->name('agent-payment-histories.massDestroy');
    Route::resource('agent-payment-histories', 'AgentPaymentHistoryController');

    // Artist Responses
    Route::delete('artist-responses/destroy', 'ArtistResponseController@massDestroy')->name('artist-responses.massDestroy');
    Route::resource('artist-responses', 'ArtistResponseController');


    // Artist Debited Transaction Lists
    Route::resource('artist-debited-transaction-lists', 'ArtistDebitedTransactionListController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Agent Debited Transaction Lists
    Route::resource('agent-debited-transaction-lists', 'AgentDebitedTransactionListController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Agent Lists
    Route::delete('agent-lists/destroy', 'AgentListController@massDestroy')->name('agent-lists.massDestroy');
    Route::resource('agent-lists', 'AgentListController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Agent Meta
    Route::delete('agent-meta/destroy', 'AgentMetaController@massDestroy')->name('agent-meta.massDestroy');
    Route::resource('agent-meta', 'AgentMetaController');

    // Artist Lists
    Route::delete('artist-lists/destroy', 'ArtistListController@massDestroy')->name('artist-lists.massDestroy');
    Route::resource('artist-lists', 'ArtistListController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Artist Meta
    Route::delete('artist-meta/destroy', 'ArtistMetaController@massDestroy')->name('artist-meta.massDestroy');
    Route::post('artist-meta/media', 'ArtistMetaController@storeMedia')->name('artist-meta.storeMedia');
    Route::post('artist-meta/ckmedia', 'ArtistMetaController@storeCKEditorImages')->name('artist-meta.storeCKEditorImages');
    Route::resource('artist-meta', 'ArtistMetaController');

    // Customers Lists
    Route::delete('customers-lists/destroy', 'CustomersListController@massDestroy')->name('customers-lists.massDestroy');
    Route::resource('customers-lists', 'CustomersListController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Meta
    Route::delete('user-meta/destroy', 'UserMetaController@massDestroy')->name('user-meta.massDestroy');
    Route::post('user-meta/media', 'UserMetaController@storeMedia')->name('user-meta.storeMedia');
    Route::post('user-meta/ckmedia', 'UserMetaController@storeCKEditorImages')->name('user-meta.storeCKEditorImages');
    Route::resource('user-meta', 'UserMetaController');

    // User Wallet Histories
    Route::delete('user-wallet-histories/destroy', 'UserWalletHistoryController@massDestroy')->name('user-wallet-histories.massDestroy');
    Route::resource('user-wallet-histories', 'UserWalletHistoryController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Artist Enquiries
    Route::delete('artist-enquiries/destroy', 'ArtistEnquiryController@massDestroy')->name('artist-enquiries.massDestroy');
    Route::post('artist-enquiries/media', 'ArtistEnquiryController@storeMedia')->name('artist-enquiries.storeMedia');
    Route::post('artist-enquiries/ckmedia', 'ArtistEnquiryController@storeCKEditorImages')->name('artist-enquiries.storeCKEditorImages');
    Route::resource('artist-enquiries', 'ArtistEnquiryController');

    // User Profile Avatar Images
    Route::resource('user-profile-avatar-images', 'UserProfileAvatarImagesController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Talent Profile Images
    Route::resource('talent-profile-images', 'TalentProfileImagesController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Talent Profile Intro Videos
    Route::resource('talent-profile-intro-videos', 'TalentProfileIntroVideosController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Wishlists
    Route::delete('user-wishlists/destroy', 'UserWishlistController@massDestroy')->name('user-wishlists.massDestroy');
    Route::resource('user-wishlists', 'UserWishlistController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth.admin']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
