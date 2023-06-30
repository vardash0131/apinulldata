<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmployesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->post('register_employe', [EmployesController::class, 'register']);
    $router->get('get_employe/email/{email}', [EmployesController::class, 'get']);
});