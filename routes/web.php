<?php

use App\Http\Controllers\Crud4Controller;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group(['prefix'=>'/user'], function(){
// Route::get('/create', function(){
// return view('crud5.index');
// });
// });
Route::get('/user/create', [CrudController::class, 'index'])->name('user.create');
Route::post('/user/create', [CrudController::class, 'create']);
Route::get('/user/login', [CrudController::class, 'login'])->name('user.login');
Route::post('/user/login', [CrudController::class, 'loginstore']);
Route::post('/logout', [CrudController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/', [MessageController::class, 'chat']);
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
    Route::get('/fetch-messages/{receiverId}', [MessageController::class, 'fetchMessages'])->name('fetch.messages');
    Route::post('/mark-read', [MessageController::class, 'markAsRead'])->name('markAsRead');

    Route::post('/mark-message-read', [MessageController::class, 'markMessageRead'])->name('mark.message.read');


    
    Route::get('/show', [CrudController::class, 'show']);
    Route::get('/edit/{id}', [CrudController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CrudController::class, 'update']);
    Route::get('/delete/{id}', [CrudController::class, 'delete'])->name('delete');
});



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Crud2 
// Route::get('/form', [FormController::class, 'index']);
// Route::get('/form/store', [FormController::class, 'store'])->name('customer.store');
// Route::get('/show', [FormController::class, 'show']);
// Route::get('/edit/{id}', [FormController::class, 'edit'])->name('edit');

//Crud3
// Route::get('/crud', [UserController::class, 'view']);
// Route::get('/crud/show', function(){
//     return view('crud3.index');
// });
// Route::get('/crud/show', [UserController::class, 'getstudents'])->name('getstudents');
// Route::get('/crud/store', [UserController::class, 'store'])->name('crud.store');
// Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
// Route::get('/delete/{id}', [UserController::class, 'delete'])->name('crud.delete');


//crud4                 
// Route::get('/', [Crud4Controller::class, 'index']);
// Route::get('/show', [Crud4Controller::class, 'show']);
// Route::post('/', [Crud4Controller::class, 'store'])->name('crud4.store');
// Route::get('/edit/{id}', [Crud4Controller::class, 'edit'])->name('edit');
// Route::put('/update/{id}', [Crud4Controller::class, 'update']);
// Route::get('/delete/{id}', [Crud4Controller::class, 'delete']);