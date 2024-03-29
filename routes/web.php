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

//login
Route::post('/login', 'App\Http\Controllers\AppUserController@find');

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

//certificat root
Route::get('certificat-generate',[App\Http\Controllers\PdfGenerateController::class, 'CertificatGenerate'])->middleware(['auth','confirme']);