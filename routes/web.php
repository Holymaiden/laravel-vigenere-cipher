<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController as Auths;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route Auth
Route::get('/auth/login', [Auths::class, 'index']);
Route::post('/auth/login', [Auths::class, 'login'])->name('login');
Route::get('/auth/logout', [Auths::class, 'logout'])->name('logout');

// Route Web
Route::group(['prefix' => '',  'namespace' => 'App\Http\Controllers\Apps',  'middleware' => ['web']], function () {
    Route::get('', 'HomeController@login');
    Route::post('', 'HomeController@userLogin')->name('userLogin');
    Route::get('pendaftaran', 'HomeController@pendaftaran')->name('pendaftaran');
});

Route::group(['prefix' => '',  'namespace' => 'App\Http\Controllers\Apps',  'middleware' => ['web']], function () {
    Route::get('/pengumuman', 'PengumumanController@index')->name('pengumuman');
    Route::get('/logout', 'HomeController@logout')->name('userLogout');
    Route::get('/pemilihan', 'HomeController@index')->name('home');
});

Route::group(['prefix' => '',  'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => '/students'], function () {
            Route::get('/class/{id}', 'StudentController@whereClass')->name('students.whereClass');
        });

        Route::group(['prefix' => '/candidates'], function () {
            Route::post('/storeUser', 'CandidateController@storeUser')->name('candidates.storeUser');
        });
    });
});

// Route Admin
Route::group(['prefix' => '',  'namespace' => 'App\Http\Controllers\Admin',  'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::group(['prefix' => '/candidates'], function () {
            Route::get('/', 'CandidateController@index')->name('candidates');
            Route::get('/data', 'CandidateController@data')->name('candidates.data');
            Route::post('/store', 'CandidateController@store')->name('candidates.store');
            Route::get('/{id}/edit', 'CandidateController@edit')->name('candidates.edit');
            Route::put('/{id}', 'CandidateController@update')->name('candidates.update');
            Route::delete('/{id}', 'CandidateController@destroy')->name('candidates.delete');
        });

        Route::group(['prefix' => '/students'], function () {
            Route::get('/', 'StudentController@index')->name('students');
            Route::get('/data', 'StudentController@data')->name('students.data');
            Route::post('/store', 'StudentController@store')->name('students.store');
            Route::get('/{id}/edit', 'StudentController@edit')->name('students.edit');
            Route::put('/{id}', 'StudentController@update')->name('students.update');
            Route::delete('/{id}', 'StudentController@destroy')->name('students.delete');
        });

        Route::group(['prefix' => '/classs'], function () {
            Route::get('/', 'ClassStudentController@index')->name('classs');
            Route::get('/data', 'ClassStudentController@data')->name('classs.data');
            Route::post('/store', 'ClassStudentController@store')->name('classs.store');
            Route::get('/{id}/edit', 'ClassStudentController@edit')->name('classs.edit');
            Route::put('/{id}', 'ClassStudentController@update')->name('classs.update');
            Route::delete('/{id}', 'ClassStudentController@destroy')->name('classs.delete');
        });

        Route::group(['prefix' => '/users'], function () {
            Route::get('/', 'UserController@index')->name('users');
            Route::get('/data', 'UserController@data')->name('users.data');
            Route::post('/store', 'UserController@store')->name('users.store');
            Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
            Route::put('/{id}', 'UserController@update')->name('users.update');
            Route::delete('/{id}', 'UserController@destroy')->name('users.delete');
        });

        Route::group(['prefix' => '/roles'], function () {
            Route::get('/', 'RoleController@index')->name('roles');
            Route::get('/data', 'RoleController@data')->name('roles.data');
            Route::post('/store', 'RoleController@store')->name('roles.store');
            Route::get('/{id}/edit', 'RoleController@edit')->name('roles.edit');
            Route::put('/{id}', 'RoleController@update')->name('roles.update');
            Route::delete('/{id}', 'RoleController@destroy')->name('roles.delete');
        });

        Route::group(['prefix' => '/votes'], function () {
            Route::get('/', 'VoteController@index')->name('votes');
            Route::get('/data', 'VoteController@data')->name('votes.data');
            Route::post('/store', 'VoteController@store')->name('votes.store');
            Route::get('/{id}/edit', 'VoteController@edit')->name('votes.edit');
            Route::put('/{id}', 'VoteController@update')->name('votes.update');
            Route::delete('/{id}', 'VoteController@destroy')->name('votes.delete');
            Route::delete('/', 'VoteController@reset')->name('votes.reset');
        });

        Route::group(['prefix' => '/settings'], function () {
            Route::get('/', 'SettingController@index')->name('settings');
            Route::get('/data', 'SettingController@data')->name('settings.data');
            Route::post('/store', 'SettingController@store')->name('settings.store');
            Route::get('/{id}/edit', 'SettingController@edit')->name('settings.edit');
            Route::put('/{id}', 'SettingController@update')->name('settings.update');
            Route::delete('/{id}', 'SettingController@destroy')->name('settings.delete');
        });
    });
});

// Route Error Handling
Route::get('unauthorized', function ($title = null) {
    $this->response['code'] = "401";
    $this->response['message'] = "unauthorized access permission";
    return view('errors.message', ['message' => $this->response]);
})->name('unauthorized');

// Route Artisan
Route::get('/cc', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
});
