<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Categories
    Route::post('categories/media', 'CategoryApiController@storeMedia')->name('categories.storeMedia');
    Route::apiResource('categories', 'CategoryApiController');

    // Pages
    Route::post('pages/media', 'PageApiController@storeMedia')->name('pages.storeMedia');
    Route::apiResource('pages', 'PageApiController');

    // Videos
    Route::post('videos/media', 'VideoApiController@storeMedia')->name('videos.storeMedia');
    Route::apiResource('videos', 'VideoApiController');

    // Admin Users
    Route::apiResource('admin-users', 'AdminUserApiController');

    // Sub Categories
    Route::post('sub-categories/media', 'SubCategoryApiController@storeMedia')->name('sub-categories.storeMedia');
    Route::apiResource('sub-categories', 'SubCategoryApiController');

    // Admin Settings
    Route::apiResource('admin-settings', 'AdminSettingsApiController', ['except' => ['store', 'destroy']]);

    // Occasions
    Route::apiResource('occasions', 'OccasionApiController');

    // Email Subscriptions
    Route::apiResource('email-subscriptions', 'EmailSubscriptionApiController');

    // Promo Codes
    Route::post('promo-codes/media', 'PromoCodeApiController@storeMedia')->name('promo-codes.storeMedia');
    Route::apiResource('promo-codes', 'PromoCodeApiController');

    // Login Logs
    Route::apiResource('login-logs', 'LoginLogApiController', ['except' => ['store', 'update']]);

    // Artist Responses
    Route::apiResource('artist-responses', 'ArtistResponseApiController');

    // Agent Meta
    Route::apiResource('agent-meta', 'AgentMetaApiController');

    // User Meta
    Route::post('user-meta/media', 'UserMetaApiController@storeMedia')->name('user-meta.storeMedia');
    Route::apiResource('user-meta', 'UserMetaApiController');

    // User Wallet Histories
    Route::apiResource('user-wallet-histories', 'UserWalletHistoryApiController', ['except' => ['store', 'update']]);

    // Artist Enquiries
    Route::post('artist-enquiries/media', 'ArtistEnquiryApiController@storeMedia')->name('artist-enquiries.storeMedia');
    Route::apiResource('artist-enquiries', 'ArtistEnquiryApiController');

    // User Wishlists
    Route::apiResource('user-wishlists', 'UserWishlistApiController');

});
