<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
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

Route::get('/', function () {
    // $users = User::where('id', 1) -> first();
    // $users = User::all();

    // $user = DB::insert('insert into users (name, email, password) values (?,?,?)', [
    //     'Randika',
    //     'randika0@gmail.com',
    //     'password'
    // ]); 

    // $user = DB::table('users')->insert([
    //     'name' => 'Randika',
    //     'email' => 'randika2@gmail.com',
    //     'password' => '12345678',
    // ]);
    // $user = User::create([
    //     'name' => "Randika",
    //     'email' => 'randika@gmail.com',
    //     'password' => '12345678'
    // ]);
    // $users = User::find(1);
    // $user = User::where('id', 1) ->update([
    //     'email' => 'randikavishwajith97.rv@gmail.com'
    // ]);
    // dd($users);

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
});

require __DIR__.'/auth.php';


 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    dd($user->user  
);
    // $user->token
});