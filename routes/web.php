<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::prefix("user")->name("user.")->group(function () {
  Route::middleware(["guest:web", "prevent-back-history"])->group(function () {
    Route::get("/login", [UserController::class, "login"])->name("login");
    Route::get("/register", [UserController::class, "register"])->name("register");
    Route::post("/register", [UserController::class, "postRegister"]);
    Route::post("/login", [UserController::class, "postLogin"]);
  });

  Route::middleware(["auth:web", "prevent-back-history"])->group(function () {
    Route::get("/home", [UserController::class, "home"])->name("home");
    Route::post("/logout", [UserController::class, "logout"])->name("logout");
  });
});

Route::prefix("admin")->name("admin.")->group(function () {
  Route::middleware(["guest:admin", "prevent-back-history"])->group(function () {
    Route::get("/login", [AdminController::class, "login"])->name("login");
    Route::post("/login", [AdminController::class, "postLogin"]);
  });

  Route::middleware(["auth:admin", "prevent-back-history"])->group(function () {
    Route::get("/table", [AdminController::class, "table"])->name("home");
    Route::get("/create", [AdminController::class, "create"])->name("create");
    Route::post("/create", [ProductController::class, "store"]);
    Route::post("/logout", [AdminController::class, "logout"])->name("logout");
  });
});
