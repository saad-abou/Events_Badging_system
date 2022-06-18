<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/','App\Http\Controllers\ViewController@landing')->name('landing');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','admin']);
//Stats
Route::get('/stats','App\Http\Controllers\ViewController@stats')->middleware(['auth','admin']);
//add new excel liste
Route::get('/newcomptes','App\Http\Controllers\ViewController@landing')->middleware(['auth','admin']);
//comptes to print
Route::get('/comptesToPrint','App\Http\Controllers\ViewController@landing')->middleware(['auth','admin']);
//liste preinscrit 
Route::get('/usersPreinscrit','App\Http\Controllers\ViewController@usersPreinscrit')->middleware(['auth','admin']);
//liste seances
Route::get('/allSeances','App\Http\Controllers\ViewController@landing')->middleware(['auth','admin']);
//liste seance track
Route::get('/seanceTrack/{id}','App\Http\Controllers\ViewController@landing')->middleware(['auth','admin']);
//Reserver

Route::get('/admin', 'App\Http\Controllers\ViewController@admin')->middleware('auth');

Route::get('/admin/question', 'App\Http\Controllers\ViewController@question');

Route::get('/admin/tracker', 'App\Http\Controllers\ViewController@tracker');

Route::get('/admin/link', 'App\Http\Controllers\ViewController@link');

Route::get('/getquestions', 'App\Http\Controllers\QuestionController@index');

Route::get('/getarchive', 'App\Http\Controllers\QuestionController@archive');

Route::post('/clear', 'App\Http\Controllers\QuestionController@clear');

Route::get('/moderateur','App\Http\Controllers\ViewController@moderateur');

Route::post('/sharescreen/{id}','App\Http\Controllers\QuestionController@share');

Route::get('/getlatestshares','App\Http\Controllers\QuestionController@latestshare');

Route::get('/share', 'App\Http\Controllers\ViewController@share');

//Add Question
Route::post('addquestion','App\Http\Controllers\QuestionController@create');

//polls
Route::get('/getpolls', 'App\Http\Controllers\PollController@index');

//delete polls
Route::post('/deletepolls/{id}', 'App\Http\Controllers\PollController@destroy');

//Add polls
Route::post('/addpolls', 'App\Http\Controllers\PollController@create');

//Update Polls
Route::post('/updatepolls', 'App\Http\Controllers\PollController@update');

//Show Polls
Route::post('/showpolls/{id}', 'App\Http\Controllers\PollController@show');

//Hide Polls
Route::post('/hidepolls/{id}', 'App\Http\Controllers\PollController@hide');

//Add Link
Route::post('/addlink', 'App\Http\Controllers\LienController@create');

//Themes
Route::get('/getthemes', 'App\Http\Controllers\ThemeController@index');

//Add Theme
Route::post('/addtheme', 'App\Http\Controllers\ThemeController@create');

//Add Color
Route::post('/addcolor', 'App\Http\Controllers\ColorController@create');

Route::post('/addimages','App\Http\Controllers\ImageController@create');

//add resume
Route::post('/addresume','App\Http\Controllers\CvController@create');

//get themes
Route::get('/getthemes', 'App\Http\Controllers\ThemeController@getThemes');

//get image
Route::get('/getimages', 'App\Http\Controllers\ThemeController@getImages');

//get resume
Route::get('/getresumes', 'App\Http\Controllers\ThemeController@getResume');

//get color
Route::get('/getcolor', 'App\Http\Controllers\ThemeController@getColor');

//get color
Route::get('/getlink', 'App\Http\Controllers\ThemeController@getLink');

//Show themes
Route::post('/showtheme/{id}', 'App\Http\Controllers\ThemeController@ShowTheme');

//Hide themes
Route::post('/hidetheme/{id}', 'App\Http\Controllers\ThemeController@HideTheme');

//login
Route::post('/login', 'App\Http\Controllers\AppUserController@find');

//get tracker
// Route::get('/gettracker','App\Http\Controllers\AppUserController@index');

//get Unique
Route::get('/getunique','App\Http\Controllers\AppUserController@getUnique');

Auth::routes();

//Add tracker
Route::post('/addtracker','App\Http\Controllers\TrackerController@create');

//update tracker
Route::post('updatetracker/{id}','App\Http\Controllers\TrackerController@edit');

//get total users
Route::get('/gettotalusers','App\Http\Controllers\Stats@index');

//get total visted users
Route::get('/getvisited','App\Http\Controllers\Stats@visited');

//get user
Route::get('/getuser',[App\Http\Controllers\Stats::class, 'getuser']);
//confirme user
Route::post('/confirmUser',[App\Http\Controllers\Stats::class, 'confirmUser']);
//export users
Route::get('users/export/', [App\Http\Controllers\AppUserController::class, 'export'])->middleware(['auth','admin']);

// get all users confirme
Route::get('/getallusersconfirme',[App\Http\Controllers\Stats::class, 'getallusersconfirme']);

Route::get('/barcode',[App\Http\Controllers\AppUserController::class, 'getBareCode']);

//get all accounts email
Route::get('getAccountsEmails',[App\Http\Controllers\Stats::class,'index']);


//get users to print 
Route::get('getUsersPrint',[App\Http\Controllers\Stats::class,'getUsersPrint']);
Route::get('getUsersAttents',[App\Http\Controllers\Stats::class,'getUsersAttents']);
//add new comptes
Route::post('addNewComptes',[App\Http\Controllers\Stats::class,'addNewComptes']);
Route::post('addNewCompte',[App\Http\Controllers\Stats::class,'addNewCompte']);
//add new badge
Route::post('addBadge',[App\Http\Controllers\Stats::class,'addBadge']);
Route::post('addBadgeAdmin',[App\Http\Controllers\Stats::class,'addBadgeAdmin']);

//track users
Route::get('/getAllSeances',[App\Http\Controllers\SeanceController::class, 'index']);

//get seance data
Route::post('/getSeancesData',[App\Http\Controllers\ReservationController::class, 'getSeancesData']);
//add reservation to track
Route::post('/addReservation',[App\Http\Controllers\ReservationController::class, 'addReservation']);
//end reservation to track
Route::post('/addReservationEnd',[App\Http\Controllers\ReservationController::class, 'addReservationEnd']);