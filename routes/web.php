<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

$router->post('/checklists', ['as' => 'checklist', 'uses' => 'ChecklistsController@create']);
$router->get('/checklists', 'ChecklistsController@show');
$router->get('/checklists/{checklistId}', 'ChecklistsController@getChecklist');
$router->patch('/checklists/{checklistId}', 'ChecklistsController@update');
$router->delete('/checklists/{checklistId}', 'ChecklistsController@destroy');