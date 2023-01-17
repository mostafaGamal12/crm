<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$router->group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->post('/login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
    $router->get('/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout'])->middleware('auth:api');
    $router->post('/reset-password', ['as' => 'auth.reset-password', 'uses' => 'AuthController@resetPassword']);
    $router->post('/change-password', ['as' => 'auth.change-password', 'uses' => 'AuthController@changePassword']);
});

$router->group(['prefix' => 'users', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/', ['as' => 'users.index', 'uses' => 'UserController@index', 'middleware' => ['permission:users-index']]);
    $router->get('/{id}', ['as' => 'users.show', 'uses' => 'UserController@show', 'middleware' => ['permission:users-show']]);
    $router->patch('/{id}', ['as' => 'users.update', 'uses' => 'UserController@update', 'middleware' => ['permission:users-update']]);
    $router->post('/{id}/change-profle-image', ['as' => 'users.change-profle-image', 'uses' => 'UserController@updateProfilePhoto', 'middleware' => ['permission:users-update']]);
    $router->post('/{id}/change-password', ['as' => 'users.change-password', 'uses' => 'UserController@updatePassword', 'middleware' => ['permission:users-update']]);
    $router->post('/', ['as' => 'users.store', 'uses' => 'UserController@store', 'middleware' => ['permission:users-store']]);
});

$router->group(['prefix' => 'roles', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:roles-index']]);
    $router->post('/', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:roles-store']]);
    $router->get('/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show', 'middleware' => ['permission:roles-show']]);
    $router->patch('/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:roles-update']]);
});



$router->group(['prefix' => 'info', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/me', ['as' => 'users.my.index', 'uses' => 'AuthController@me']);
    $router->post('/me/change-password', ['as' => 'users.my.change-password', 'uses' => 'UserController@updateMyPassword']);
    $router->post('/me/change-profle-image', ['as' => 'users.my.update-profle-image', 'uses' => 'UserController@updateMyProfilePhoto']);
    $router->patch('/me/update-profle', ['as' => 'users.my.change-profile', 'uses' => 'UserController@updateMyProfile']);
});
$router->group(['prefix' => 'permissions', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/', ['as' => 'permissions.index', 'uses' => 'PermissionController@index', 'middleware' => ['permission:status-index']]);
});
$router->group(['prefix' => 'settings', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    //unit status
    $router->group(['prefix' => 'status', 'middleware' => 'auth:api', 'namespace' => 'Settings'], function () use ($router) {
        $router->get('/', ['as' => 'status.index', 'uses' => 'StatusController@index', 'middleware' => ['permission:status-index']]);
        $router->post('/', ['as' => 'status.store', 'uses' => 'StatusController@store', 'middleware' => ['permission:status-store']]);
        $router->get('/{id}', ['as' => 'status.show', 'uses' => 'StatusController@show', 'middleware' => ['permission:status-show']]);
        $router->patch('/{id}', ['as' => 'status.update', 'uses' => 'StatusController@update', 'middleware' => ['permission:status-update']]);
    });
    //unit actions
    $router->group(['prefix' => 'actions', 'middleware' => 'auth:api', 'namespace' => 'Settings'], function () use ($router) {
        $router->get('/', ['as' => 'actions.index', 'uses' => 'ActionController@index', 'middleware' => ['permission:actions-index']]);
        $router->post('/', ['as' => 'actions.store', 'uses' => 'ActionController@store', 'middleware' => ['permission:actions-store']]);
        $router->get('/{id}', ['as' => 'actions.show', 'uses' => 'ActionController@show', 'middleware' => ['permission:actions-show']]);
        $router->patch('/{id}', ['as' => 'actions.update', 'uses' => 'ActionController@update', 'middleware' => ['permission:actions-update']]);
    });
    $router->group(['prefix' => 'unit-types', 'middleware' => 'auth:api', 'namespace' => 'Settings'], function () use ($router) {
        $router->get('/', ['as' => 'unit-types.index', 'uses' => 'UnitTypeController@index', 'middleware' => ['permission:unit-types-index']]);
        $router->post('/', ['as' => 'unit-types.store', 'uses' => 'UnitTypeController@store', 'middleware' => ['permission:unit-types-store']]);
        $router->get('/{id}', ['as' => 'unit-types.show', 'uses' => 'UnitTypeController@show', 'middleware' => ['permission:unit-types-show']]);
        $router->patch('/{id}', ['as' => 'unit-types.update', 'uses' => 'UnitTypeController@update', 'middleware' => ['permission:unit-types-update']]);
    });
    $router->group(['prefix' => 'cahnnels', 'middleware' => 'auth:api', 'namespace' => 'Settings'], function () use ($router) {
        $router->get('/', ['as' => 'cahnnels.index', 'uses' => 'ChannelController@index', 'middleware' => ['permission:cahnnels-index']]);
        $router->post('/', ['as' => 'cahnnels.store', 'uses' => 'ChannelController@store', 'middleware' => ['permission:cahnnels-store']]);
        $router->get('/{id}', ['as' => 'cahnnels.show', 'uses' => 'ChannelController@show', 'middleware' => ['permission:cahnnels-show']]);
        $router->patch('/{id}', ['as' => 'cahnnels.update', 'uses' => 'ChannelController@update', 'middleware' => ['permission:cahnnels-update']]);
    });
    $router->group(['prefix' => 'company', 'middleware' => 'auth:api', 'namespace' => 'Settings'], function () use ($router) {
        $router->get('/', ['as' => 'company.index', 'uses' => 'CompanyController@index', 'middleware' => ['permission:company-index']]);
        $router->post('/', ['as' => 'company.store', 'uses' => 'CompanyController@store', 'middleware' => ['permission:company-store']]);
        $router->get('/{id}', ['as' => 'company.show', 'uses' => 'CompanyController@show', 'middleware' => ['permission:company-show']]);
        $router->patch('/{id}', ['as' => 'company.update', 'uses' => 'CompanyController@update', 'middleware' => ['permission:company-update']]);
    });
});

$router->group(['prefix' => 'ambassadors', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/', ['as' => 'ambassadors.index', 'uses' => 'AmbassadorController@index', 'middleware' => ['permission:ambassadors-index']]);
    $router->post('/', ['as' => 'ambassadors.store', 'uses' => 'AmbassadorController@store', 'middleware' => ['permission:ambassadors-store']]);
    $router->get('/{id}', ['as' => 'ambassadors.show', 'uses' => 'AmbassadorController@show', 'middleware' => ['permission:ambassadors-show']]);
    $router->patch('/{id}', ['as' => 'ambassadors.update', 'uses' => 'AmbassadorController@update', 'middleware' => ['permission:ambassadors-update']]);
    $router->post('/{id}/change-id-photo', ['as' => 'ambassadors.update-id-photo', 'uses' => 'AmbassadorController@updateIdPhoto', 'middleware' => ['permission:ambassadors-update']]);
});


$router->group(['prefix' => 'settings', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/', ['as' => 'settings.index', 'uses' => 'SettingController@index', 'middleware' => ['permission:settings-index']]);
    $router->patch('/{id}', ['as' => 'settings.update', 'uses' => 'SettingController@update', 'middleware' => ['permission:settings-update']]);
});

$router->group(['prefix' => 'countries', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'countries.index', 'uses' => 'CountryController@index', 'middleware' => ['permission:countries-index']]);
    $router->post('/', ['as' => 'countries.store', 'uses' => 'CountryController@store', 'middleware' => ['permission:countries-store']]);
    $router->get('/{id}', ['as' => 'countries.show', 'uses' => 'CountryController@show', 'middleware' => ['permission:countries-show']]);
    $router->patch('/{id}', ['as' => 'countries.update', 'uses' => 'CountryController@update', 'middleware' => ['permission:countries-update']]);
    $router->delete('/{id}', ['as' => 'countries.delete', 'uses' => 'CountryController@delete', 'middleware' => ['permission:countries-delete']]);
});
$router->group(['prefix' => 'governorates', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'governorates.index', 'uses' => 'GovernorateController@index', 'middleware' => ['permission:governorates-index']]);
    $router->post('/', ['as' => 'governorates.store', 'uses' => 'GovernorateController@store', 'middleware' => ['permission:governorates-store']]);
    $router->get('/{id}', ['as' => 'governorates.show', 'uses' => 'GovernorateController@show', 'middleware' => ['permission:governorates-show']]);
    $router->patch('/{id}', ['as' => 'governorates.update', 'uses' => 'GovernorateController@update', 'middleware' => ['permission:governorates-update']]);
    $router->delete('/{id}', ['as' => 'governorates.delete', 'uses' => 'GovernorateController@delete', 'middleware' => ['permission:governorates-delete']]);
});
$router->group(['prefix' => 'cities', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'cities.index', 'uses' => 'CityController@index', 'middleware' => ['permission:cities-index']]);
    $router->post('/', ['as' => 'cities.store', 'uses' => 'CityController@store', 'middleware' => ['permission:cities-store']]);
    $router->get('/{id}', ['as' => 'cities.show', 'uses' => 'CityController@show', 'middleware' => ['permission:cities-show']]);
    $router->patch('/{id}', ['as' => 'cities.update', 'uses' => 'CityController@update', 'middleware' => ['permission:cities-update']]);
    $router->delete('/{id}', ['as' => 'cities.delete', 'uses' => 'CityController@delete', 'middleware' => ['permission:cities-delete']]);
});
$router->group(['prefix' => 'districts', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'districts.index', 'uses' => 'DistrictController@index', 'middleware' => ['permission:districts-update']]);
    $router->post('/', ['as' => 'districts.store', 'uses' => 'DistrictController@store', 'middleware' => ['permission:districts-update']]);
    $router->get('/{id}', ['as' => 'districts.show', 'uses' => 'DistrictController@show', 'middleware' => ['permission:districts-update']]);
    $router->patch('/{id}', ['as' => 'districts.update', 'uses' => 'DistrictController@update', 'middleware' => ['permission:districts-update']]);
    $router->delete('/{id}', ['as' => 'districts.delete', 'uses' => 'DistrictController@delete', 'middleware' => ['permission:districts-update']]);
});
$router->group(['prefix' => 'projectTypes', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'projectTypes.index', 'uses' => 'ProjectTypeController@index', 'middleware' => ['permission:project-types-update']]);
    $router->post('/', ['as' => 'projectTypes.store', 'uses' => 'ProjectTypeController@store', 'middleware' => ['permission:project-types-update']]);
    $router->get('/{id}', ['as' => 'projectTypes.show', 'uses' => 'ProjectTypeController@show', 'middleware' => ['permission:project-types-update']]);
    $router->patch('/{id}', ['as' => 'projectTypes.update', 'uses' => 'ProjectTypeController@update', 'middleware' => ['permission:project-types-update']]);
    $router->delete('/{id}', ['as' => 'projectTypes.delete', 'uses' => 'ProjectTypeController@delete', 'middleware' => ['permission:project-types-update']]);
});
$router->group(['prefix' => 'projectFeatures', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'projectFeatures.index', 'uses' => 'ProjectFeatureController@index', 'middleware' => ['permission:project-features-index']]);
    $router->post('/', ['as' => 'projectFeatures.store', 'uses' => 'ProjectFeatureController@store', 'middleware' => ['permission:project-features-store']]);
    $router->get('/{id}', ['as' => 'projectFeatures.show', 'uses' => 'ProjectFeatureController@show', 'middleware' => ['permission:project-features-show']]);
    $router->patch('/{id}', ['as' => 'projectFeatures.update', 'uses' => 'ProjectFeatureController@update', 'middleware' => ['permission:project-features-update']]);
    $router->delete('/{id}', ['as' => 'projectFeatures.delete', 'uses' => 'ProjectFeatureController@delete', 'middleware' => ['permission:project-features-delete']]);
});
$router->group(['prefix' => 'projects', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Inventory'], function () use ($router) {
    $router->get('/', ['as' => 'projects.index', 'uses' => 'ProjectController@index', 'middleware' => ['permission:projects-index']]);
    $router->post('/', ['as' => 'projects.store', 'uses' => 'ProjectController@store', 'middleware' => ['permission:projects-store']]);
    $router->get('/{id}', ['as' => 'projects.show', 'uses' => 'ProjectController@show', 'middleware' => ['permission:projects-show']]);
    $router->patch('/{id}', ['as' => 'projects.update', 'uses' => 'ProjectController@update', 'middleware' => ['permission:projects-update']]);
    $router->delete('/{id}', ['as' => 'projects.delete', 'uses' => 'ProjectController@delete', 'middleware' => ['permission:projects-delete']]);
});

$router->group(['prefix' => 'brokers', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {
    $router->get('/', ['as' => 'brokers.index', 'uses' => 'BrokerController@index', 'middleware' => ['permission:brokers-index']]);
    $router->post('/', ['as' => 'brokers.store', 'uses' => 'BrokerController@store', 'middleware' => ['permission:brokers-store']]);
    $router->get('/{id}', ['as' => 'brokers.show', 'uses' => 'BrokerController@show', 'middleware' => ['permission:brokers-show']]);
    $router->patch('/{id}', ['as' => 'brokers.update', 'uses' => 'BrokerController@update', 'middleware' => ['permission:brokers-update']]);
    $router->post('/{id}/update-files', ['as' => 'brokers.update-id-photo', 'uses' => 'BrokerController@updateFiles', 'middleware' => ['permission:brokers-update']]);

    $router->delete('/{id}', ['as' => 'brokers.delete', 'uses' => 'BrokerController@delete', 'middleware' => ['permission:brokers-delete']]);
});
$router->group(['prefix' => 'images', 'middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () use ($router) {

    $router->delete('{id}', ['as' => 'images.delete', 'uses' => 'ImageController@delete', 'middleware' => ['permission:images-delete']]);
});