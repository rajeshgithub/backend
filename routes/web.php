<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\password;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvtarController;

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
    return view('welcome');
    //Query Builder
    //$user = DB::table('users')->first();
    //$user = DB::table('users')->find(1);
    //$user = DB::table('users')->get();
    //dd($user[1]);
    // $user = DB::table('users')->insert([
    //     'name'=>'vismay',
    //     'email'=>'vismay@vinod.com',
    //     'password'=>'1234678'
    // ]);
    //$user = DB::table('users')->where('id',2)->update(['password'=>'87654321']);
    //$user = DB::table('users')->where('id',3)->delete();
    
    //Eloquent Query
    //$user = User::get();
    //$user = User::all();
    //$user = User::find(1);
    // $user = User::create([
    //     'name'=>'mohit',
    //      'email'=>'mohit@test.com',
    //      'password'=>'1234678'
    // ]);
    
    //$user = User::find(4)->delete();
    //dd($user->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avtar', [AvtarController::class, 'update'])->name('profile.avtar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
