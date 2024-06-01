<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web', 'as' => 'admins.'], function () {
    Route::get('login', 'AuthController@checkLogin')->name('login');
    Route::post('login', 'AuthController@login')->middleware('throttle:6,1');

    Route::middleware('privilege:super')->group(function () {
        Route::get('/', 'DashboardController')->name('home');
        /**
         * Admin Module Routes
         */
        Route::resource('admin', 'AdminController')->except(['show']);
        Route::prefix('admins')->group(function () {
            Route::as('admin.')->group(function () {
                Route::get('data', 'AdminController@data')->name('data');
                Route::post('reset/password', 'AdminController@resetPassword')->name('reset.password');
                Route::post('trash', 'AdminController@trash')->name('trash');
                Route::post('restore', 'AdminController@restore')->name('restore');
                Route::get('export', 'AdminController@export')->name('export');
            });

        });
        /**
         * Notification Module Routes
         */
        Route::resource('notification', 'Notification\NotificationController');
        Route::prefix('notifications')->group(function () {
            Route::as('notification.')->group(function () {
                Route::get('data', 'Notification\NotificationController@data')->name('data');
                Route::post('unsend', 'Notification\NotificationController@unsend')->name('unsend');
                Route::get('export', 'Notification\NotificationController@export')->name('export');
                Route::get('specific/user/type', 'Notification\NotificationController@getSpecificUserType')->name('specific.users.type');
                Route::get('specific/user/list', 'Notification\NotificationController@getSpecificUserList')->name('specific.users.list');
            });
        });

        /**
         * City Module Routes
         */
        Route::resource('city', 'CityController')->except(['show']);
        Route::prefix('cities')->group(function () {
            Route::as('city.')->group(function () {
                Route::get('data', 'CityController@data')->name('data');
                Route::post('trash', 'CityController@trash')->name('trash');
                Route::post('restore', 'CityController@restore')->name('restore');
                Route::get('export', 'CityController@export')->name('export');
            });
        });

        /**
         * Area Module Routes
         */
        Route::resource('area', 'AreaController')->except(['show']);
        Route::prefix('areas')->group(function () {
            Route::as('area.')->group(function () {
                Route::get('data', 'AreaController@data')->name('data');
                Route::post('trash', 'AreaController@trash')->name('trash');
                Route::post('restore', 'AreaController@restore')->name('restore');
                Route::get('export', 'AreaController@export')->name('export');
            });
        });

        /**
         * Individuals Module Routes
         */
        Route::resource('individual', 'User\IndividualController');
        Route::prefix('individuals')->group(function () {
            Route::as('individual.')->group(function () {
                Route::get('data', 'User\IndividualController@data')->name('data');
                Route::post('trash', 'User\IndividualController@trash')->name('trash');
                Route::post('block', 'User\IndividualController@block')->name('block');
                Route::post('reset/password', 'User\IndividualController@resetPassword')->name('reset.password');
                Route::post('restore', 'User\IndividualController@restore')->name('restore');
                Route::get('export', 'User\IndividualController@export')->name('export');
            });
        });

        /**
         * Brokers Module Routes
         */
        Route::resource('broker', 'User\BrokerController');
        Route::prefix('brokers')->group(function () {
            Route::as('broker.')->group(function () {
                Route::get('data', 'User\BrokerController@data')->name('data');
                Route::post('block', 'User\BrokerController@block')->name('block');
                Route::post('reset/password', 'User\BrokerController@resetPassword')->name('reset.password');
                Route::post('trash', 'User\BrokerController@trash')->name('trash');
                Route::post('restore', 'User\BrokerController@restore')->name('restore');
                Route::get('export', 'User\BrokerController@export')->name('export');
            });
        });
        /**
         * Developer Module Routes
         */
        Route::resource('developer', 'User\DeveloperController');
        Route::prefix('developers')->group(function () {
            Route::as('developer.')->group(function () {
                Route::get('data', 'User\DeveloperController@data')->name('data');
                Route::post('block', 'User\DeveloperController@block')->name('block');
                Route::post('reset/password', 'User\DeveloperController@resetPassword')->name('reset.password');
                Route::post('trash', 'User\DeveloperController@trash')->name('trash');
                Route::post('restore', 'User\DeveloperController@restore')->name('restore');
                Route::get('export', 'User\DeveloperController@export')->name('export');
            });
        });

        /**
         * Profile Colour Module Routes
         */
        Route::resource('profile_colour', 'ProfileColourController')->only(['index','edit','update']);
        Route::prefix('profile_colours')->group(function () {
            Route::as('profile_colour.')->group(function () {
                Route::get('data', 'ProfileColourController@data')->name('data');
                Route::get('export', 'ProfileColourController@export')->name('export');
            });
        });
        /**
         * Post Module Routes
         */
        Route::resource('post', 'PostController')->only(['index','destroy','show','update','edit']);
        Route::prefix('posts')->group(function () {
            Route::as('post.')->group(function () {
                Route::get('data', 'PostController@data')->name('data');
                Route::post('trash', 'PostController@trash')->name('trash');
                Route::post('restore', 'PostController@restore')->name('restore');
                Route::get('append/areas', 'PostController@appendAreas')->name('append.areas');
                Route::post('toggle/approve/{action}', 'PostController@toggleApprove')->name('toggle.approve');
                Route::get('export', 'PostController@export')->name('export');
            });
        });
        /**
         * Comment Module Routes
         */
        Route::resource('comment', 'CommentController')->only(['index','destroy','show','update','edit']);
        Route::prefix('comments')->group(function () {
            Route::as('comment.')->group(function () {
                Route::get('data', 'CommentController@data')->name('data');
                Route::post('trash', 'CommentController@trash')->name('trash');
                Route::post('restore', 'CommentController@restore')->name('restore');
                Route::get('export', 'CommentController@export')->name('export');
            });
        });

        /**
         * Listing Module Routes
         */
        Route::resource('listing', 'ListingController')->only(['index','destroy','show','update','edit']);
        Route::prefix('listings')->group(function () {
            Route::as('listing.')->group(function () {
                Route::get('data', 'ListingController@data')->name('data');
                Route::get('append/areas', 'ListingController@appendAreas')->name('append.areas');
                Route::post('toggle/approve/{action}', 'ListingController@toggleApprove')->name('toggle.approve');
                Route::post('trash', 'ListingController@trash')->name('trash');
                Route::post('restore', 'ListingController@restore')->name('restore');
                Route::get('export', 'ListingController@export')->name('export');
            });
        });
        /**
         * Reports Posts Module Routes
         */
        Route::resource('postReport', 'PostReportController')->only(['index','destroy','show']);
        Route::prefix('postReports')->group(function () {
            Route::as('postReport.')->group(function () {
                Route::get('data', 'PostReportController@data')->name('data');
                Route::post('dismiss', 'PostReportController@dismiss')->name('dismiss');
                Route::post('toggle/approve/{action}', 'PostReportController@toggleApprove')->name('toggle.approve');
                Route::post('trash', 'PostReportController@trash')->name('trash');
                Route::post('restore', 'PostReportController@restore')->name('restore');
                Route::get('export', 'PostReportController@export')->name('export');
            });
        });
        /**
         * Reports Accounts Module Routes
         */
        Route::resource('accountReport', 'AccountReportController')->only(['index','destroy','show']);
        Route::prefix('accountReports')->group(function () {
            Route::as('accountReport.')->group(function () {
                Route::get('data', 'AccountReportController@data')->name('data');
                Route::post('dismiss', 'AccountReportController@dismiss')->name('dismiss');
                Route::post('trash', 'AccountReportController@trash')->name('trash');
                Route::post('restore', 'AccountReportController@restore')->name('restore');
                Route::get('export', 'AccountReportController@export')->name('export');
            });
        });

        /**
         * Logout..
         */
        Route::get('logout', 'AuthController@logout')->name('logout');


    });
});

