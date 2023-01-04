<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\TodosController;

//Auth
Route::middleware('isGuest')->group(function(){
    Route::get('/', [TodosController::class, 'login'])->name('login');

    Route::get('/register', [TodosController::class, 'register']);
    Route::post('/register', [TodosController::class, 'inputRegister'])->name('register.post');
    Route::post('/login',[TodosController::class, 'auth'])->name('login.auth');
  
});

Route::get('/logout', [TodosController::class, 'logout'])->name('logout');
Route::get('/error', [TodosController::class, 'error'])->name('error');

//halaman untuk admin
Route::middleware(['isLogin', 'CekRole:admin'])->group(function(){
    Route::get('/todo/users', [TodosController::class, 'userData'])->name('todo.users');
});

//halaman user dan admin
Route::middleware(['isLogin', 'CekRole:admin,user'])->group(function(){
    Route::get('/todo', [TodosController::class, 'index'])->name('todo.index');
    Route::get('/todo/data', [TodosController::class, 'data'])->name('todo.data');
    Route::get('/todo/detail', [TodosController::class, 'detail'])->name('todo.detail');
    Route::get('/todo/detail/upload', [TodosController::class, 'detailUpload'])->name('todo.detail.upload');
    Route::patch('/todo/detail/change', [TodosController::class, 'detailChange'])->name('todo.detail.change');
});

//halaman untuk user
Route::middleware('isLogin', 'CekRole:user')->prefix('/todo')->name('todo.')->group(function (){
    // Route::get('/', [TodosController::class, 'index'])->name('index');
    Route::get('/complated', [TodosController::class, 'complated'])->name('complated');
    Route::get('/create', [TodosController::class, 'create'])->name('create');
    Route::post('/store', [TodosController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TodosController::class, 'edit'])->name('edit'); //{id} untuk memamnggil data id mana yang akan ditampilkan karena sifatnya dinamis menggunakan {}
    Route::patch('/update/{id}', [TodosController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TodosController::class, 'destroy'])->name('delete');
    Route::patch('/complated/{id}', [TodosController::class, 'updateComplated'])->name('update-complated');
   
    // Route::get('/data', [TodosController::class, 'data'])->name('data');
}); 