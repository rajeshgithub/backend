<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\password;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvtarController;
use App\Http\Controllers\TestingController;
use App\Models\Ticket;

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

Route::get('/setdata',[TestingController::class,'setData']);
Route::get('/getdata',[TestingController::class,'getData']);
Route::get('/redisdata',[TestingController::class,'redisData']);
Route::get('/savefile',[TestingController::class,'saveFile']);
Route::get('/httptest',[TestingController::class,'httpTest']);

Route::get('/testque',[TestingController::class,'testQue']);

Route::get("/sendmail",function()  {
    $usermail  = "vismay.poonam@gmail.com";
    dispatch(new \App\Jobs\sendMailJob($usermail));
    dd("Mail sent successfully !!");
});

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

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('/ticket',TestingController::class);
    //Route::get('/ticket/create', [TestingController::class,'create'])->name('ticket.create');
    //Route::post('/ticket/create', [TestingController::class,'store'])->name('ticket.store');
});

Route::get('/auth/callback', [GithubController::class, 'gitcallback'])->name('github.callback');

Route::post('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('/join',function()
{
    //$user = User::with('tickets')->get()->toArray();
    // foreach(User::with('tickets')->get() as $user) //with join result
    // {
    //     $tc = $user->tickets->all();
    //     foreach($tc as $t)
    //     {
    //         echo $t->title."<br>";
    //     }
    // }
    
    /*DB::enableQueryLog(); // enable query log
    $user = User::query()->where(['name'=>'rajesh','avtar'=>'2'])->get();
    dd(DB::getQueryLog());*/

    //ToSQL to show query
    // $user = User::where(['name'=>'rajesh','avtar'=>'2']);
    // dd($user->toSql());

});

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();
//     if ($user->email) {
//         $user = User::firstOrCreate(['email' => $user->email], [
//             'name' => $user->name,
//             'password' => 'password',
//         ]);

//         Auth::login($user);
//         return redirect('/dashboard');
//     }
//     else
//     {
//         return redirect('/dashboard');
//     }
// });
