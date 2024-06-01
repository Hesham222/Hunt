<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Http\Controllers')->prefix('api')->middleware('api')->group(function () {

    /**
     * Authentication Apis for all users
     */
    //Registeration
    Route::post('brokers/register', 'BrokerRegisterController')->middleware('throttle:6,1');
    Route::post('developers/register', 'DeveloperRegisterController')->middleware('throttle:6,1');
    Route::post('individuals/register', 'IndividualRegisterController')->middleware('throttle:6,1');
    //Verificatons
    Route::post('/verify/account', 'Auth\VerificationController@verifyAccount')->middleware('throttle:6,1');
    Route::post('/resend/code', 'Auth\VerificationController@resendCode')->middleware('throttle:6,1');
    Route::get('/verification/codes', 'Auth\VerificationController@listCodes');
    //Forgot Password
    Route::post('forgot/password', 'Auth\ForgotPasswordController@forgotPassword')->middleware('throttle:6,1');
    Route::post('reset/password', 'Auth\ForgotPasswordController@resetPassword')->middleware('throttle:6,1');
    //Login
    Route::post('/login', 'Auth\LoginController@login')->middleware('throttle:6,1');
    Route::post('login/provider', 'Auth\SocialiteController@loginProvider');

    Route::post('view/profile/locked', 'Individual\Profile\LockedProfileController@index');
    Route::get('view/profile', 'BrokerDeveloper\BrokerDeveloperProfileController@index');
    Route::post('call', 'BrokerDeveloper\BrokerDeveloperProfileController@call');
    Route::post('email', 'BrokerDeveloper\BrokerDeveloperProfileController@email');
    Route::get('/search/property', 'PostListController@search');
    Route::get('/search/user','PostListController@searchUser');

    Route::prefix('home')->group(function () {
        Route::post('/show', 'PostListController@indexGuest');
        Route::get('/show/search/property', 'PostListController@searchGuest');
        Route::get('/show/search/user','PostListController@searchUser');
    });
    /**
     * General Apis for all users (Authorized)
     */
    Route::middleware(['api', 'authorized'])->group(function () {
        Route::post('/logout', 'Auth\LogoutController')->middleware('throttle:6,1');

        Route::prefix('home')->group(function () {
            Route::post('/show/posts/listings', 'PostListController@index');
            Route::get('/search/property', 'PostListController@search');
            Route::get('/search/user','PostListController@searchUser');
        });

        Route::prefix('profile')->group(function () {
            Route::post('/change/password', 'ChangePasswordController');
            Route::get('notifications', 'NotificationController@index');
            Route::post('messages', 'MessageController@Message');
            Route::post('message/detail', 'MessageController@MessageDetail');
            Route::post('replay/messages', 'MessageController@replayMessage');
            Route::post('data', 'ProfileController@index');
            Route::post('posts', 'ProfileController@posts');
            Route::post('post/details', 'ProfileController@PostDetails');

        });

        Route::prefix('individual')->group(function () {
            Route::post('view/profile/locked', 'Individual\Profile\LockedProfileController@index');
            Route::post('view/profile/unlocked', 'Individual\Profile\UnlockedProfileController@index');
            Route::post('/toggle/unlock/request', 'UnlockRequestController@sendRequest');
            Route::post('/rate', 'RateController@rateIndividual');
        });

        Route::prefix('broker')->group(function () {
            Route::post('/rate', 'RateController@rateBroker');
        });

        Route::prefix('developer')->group(function () {
            Route::post('/rate', 'RateController@rateDeveloper');
        });

        Route::prefix('developer/broker')->group(function () {
            Route::get('filter', 'BrokerDeveloper\BrokerDeveloperProfileController@filter');
            Route::post('call', 'BrokerDeveloper\BrokerDeveloperProfileController@call');
            Route::post('view/profile', 'BrokerDeveloper\BrokerDeveloperProfileController@viewProfile');
            Route::post('email', 'BrokerDeveloper\BrokerDeveloperProfileController@email');

        });
        Route::get('posts', 'PostController@index');
        Route::prefix('post')->group(function () {
            Route::post('/send/message', 'MessageController@messagePost');
            Route::post('/send/comment', 'CommentController@commentPost');
            Route::post('/send/comment/interested', 'CommentController@InterestedComment');

        });

        Route::get('listings', 'ListingController@index');
        Route::prefix('listing')->group(function () {
            Route::post('/send/message', 'MessageController@messageListing');
        });

        Route::prefix('report')->group(function () {
            Route::get('/post/data', 'ReportController@postData');
            Route::get('/account/data', 'ReportController@individualData');
            Route::post('/post', 'ReportController@reportPost');
            Route::post('/individual', 'ReportController@reportIndividual');
        });
        Route::post('update/firebaseToken', 'FirebaseTokenController');

    });
    /**
     * Individual User apis
     */
    Route::prefix('individual')->group(function () {
        Route::middleware(['api', 'individualApi'])->group(function () {

            Route::prefix('profile')->group(function () {
                    Route::post('/update', 'Individual\ProfileController@update');
                    Route::post('/unlock', 'Individual\ProfileController@unlockProfile');
                    Route::get('list/unlock/requests', 'Individual\ProfileController@myRequests');
                    Route::post('/toggle/approve/request', 'Individual\ProfileController@toggleApproveRequest');
                    Route::get('connections', 'Individual\ProfileController@connections');
                    Route::get('blocked/list', 'Individual\ProfileController@blockedList');
                    Route::post('remove/connection', 'Individual\ProfileController@removeConnection');
            });

            Route::prefix('post')->group(function () {
                Route::get('/create', 'PostController@create');
                Route::post('/store', 'PostController@store');
                Route::post('/update', 'PostController@update');
                Route::post('/destroy', 'PostController@destroy');
                Route::post('/toggle/favourite', 'PostFavouriteController@favourite');
                Route::get('/view/favourites', 'PostFavouriteController@savedPosts');
                Route::post('/mark/unavailable', 'PostController@markUnavailable');
                Route::post('/temporary/unlock', 'PostController@temporaryUnlock');

            });
            Route::prefix('listing')->group(function () {
                Route::post('/toggle/favourite', 'ListingFavouriteController@favourite');
                Route::get('/view/favourites', 'ListingFavouriteController@savedPosts');
            });


        });
    });
    /**
     * Broker User apis
     */
    Route::prefix('broker')->group(function () {
        Route::middleware(['api', 'brokerApi'])->group(function () {
            Route::prefix('profile')->group(function () {
                Route::post('/update', 'Broker\ProfileController@update');

            });
        });
    });
    /**
     * Developer User apis
     */
    Route::prefix('developer')->group(function () {
        Route::middleware(['api', 'developerApi'])->group(function () {
            Route::prefix('profile')->group(function () {
                Route::post('/update', 'Developer\ProfileController@update');

            });
        });
    });
    /**
     * Developer & Broker only User apis
     */
    Route::middleware(['api', 'BrokerDeveloperAuthorized'])->group(function () {


        Route::prefix('listing')->group(function () {
            Route::get('/create', 'ListingController@create');
            Route::post('/store', 'ListingController@store');
            Route::post('/update', 'ListingController@update');
            Route::post('/destroy/', 'ListingController@destroy');
            Route::post('/toggle/availability', 'ListingController@toggleAvailability');
        });
    });

});
