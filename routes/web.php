<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Team auth
Route::prefix('/team')->name('teams.')->namespace('Team')->group(function () {
    Route::namespace('Auth')->group(function () {
        // Register
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');

        //Login
        // Route::get('/login', 'LoginController@showLoginForm')->name('login');
        // Route::post('/login', 'LoginController@login');
        // Route::post('/logout', 'LoginController@logout')->name('logout');

        // //Forgot Password
        // Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        // //Reset Password
        // Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        // Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    });
});

// Team > candidates
Route::group(['prefix' => '/candidates', 'namespace' => 'Team', 'middleware' => ['auth', 'team']], function () {
    Route::namespace('Candidate')->name('candidates.')->group(function () {
        Route::get('/', 'CandidateController@index')->name('index');
        Route::post('/{candidate}', 'CandidateController@store');
    });
});

// Candidate
Route::group(['prefix' => '/candidate/requests', 'namespace' => 'User', 'middleware' => 'auth'], function () {
    Route::get('/', 'CandidateRequestsController@index')->name('candidate.requests.index');
    Route::post('/{team}/{notificationId}/accept', 'CandidateRequestsController@accept')->name('candidate.requests.accept');
});

Route::get('/home', 'HomeController@index')->name('home');
