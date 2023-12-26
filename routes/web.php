<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/usuarios', 'UsuarioController@mostrarTodosUsuarios');


$router->group(['prefix' => 'usuario'], function () use ($router) {
    
    $router->post('/login', 'UsuarioController@login');

    $router->post('/cadastrar', 'UsuarioController@cadastrarUsuario');

    $router->get('/{id}', 'UsuarioController@mostrarUmUsuario');

    $router->put('/{id}/atualizar', 'UsuarioController@atualizarUsuario');

    $router->delete('/{id}/deletar', 'UsuarioController@deletarUsuario');

    

});

$router->get('/post', 'PostController@mostrarTodosPost');

$router->group(['prefix' => 'post'], function () use ($router) {

    $router->get('/search', 'PostController@search'); 

    $router->post('/cadastrar', 'PostController@cadastrarPost');

    $router->get('/{id}', 'PostController@mostrarUmPost');

    $router->put('/{id}/atualizar', 'PostController@atualizarPost');

    $router->delete('/{id}/deletar', 'PostController@deletarPost');

   

});