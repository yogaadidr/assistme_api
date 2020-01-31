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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('hello', function ()    {
        // Matches The "/admin/users" URL
    });

    //REKENING
    $router->post('saldo', 'RekeningController@getSaldo');
    $router->get('rekening', 'RekeningController@list');
    $router->post('rekening/tambah', 'RekeningController@tambah');
    $router->post('rekening/saldo', 'RekeningController@getSaldo');
    //KATEGORI
    
    $router->get('kategori', 'KategoriController@list');
    $router->get('kategori/{jenis}', 'KategoriController@listJenis');
    $router->post('kategori/tambah', 'KategoriController@tambah');

    //USER
    $router->post('login', 'UserController@login');

    //TRANSAKSI
    $router->post('transaksi/list', 'TransaksiController@list');
    $router->post('transaksi/tambah', 'TransaksiController@tambah');

/*
    $group->post('/saldo', RekeningController::class . ':getSaldo');
        //REKENING
        $group->get('/rekening', RekeningController::class . ':list');
        $group->post('/rekening/tambah', RekeningController::class . ':tambah');
        $group->post('/rekening/saldo', RekeningController::class . ':getSaldo');
        //KATEGORI
        $group->get('/kategori', KategoriController::class . ':list');
        $group->get('/kategori/{jenis}', KategoriController::class . ':listJenis');
        $group->post('/kategori/tambah', KategoriController::class . ':tambah');
        //TRANSAKSI
        $group->post('/transaksi/list', TransaksiController::class . ':list');
        $group->post('/transaksi/tambah', TransaksiController::class . ':tambah');

        $group->get('/user', UserController::class . ':home');
        $group->post('/login', UserController::class . ':login');
*/        
});