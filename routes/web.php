<?php

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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);
Route::resource('users', 'UserController');
Route::resource('players', 'PlayerController');
Route::get('/player-from-user', 'PlayerController@createFromUser')->name('player.create.user');
Route::post('/player-from-user', 'PlayerController@storeFromUser')->name('player.store.user');

Route::group(['prefix' => 'user'], function() {
    Route::get('{user}/profile', 'ProfileController@info')->name('profile.info');
    Route::get('{user}/security', 'ProfileController@password')->name('profile.password');
    Route::post('{user}/profile', 'ProfileController@updateInfo')->name('profile.info.update');
    Route::post('{user}/security', 'ProfileController@updatePassword')->name('profile.password.update');
});

Route::get('complete-registration/{token}', 'CompleteRegistrationController@registration')->name('registration.form');
Route::post('complete-registration/{user}', 'CompleteRegistrationController@update')->name('registration.update');

Route::get('players/get/{team}', 'PlayerController@getPlayers');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/medical', 'MedicalController@index')->name('medical.index');
Route::get('/medical/{user}', 'MedicalController@show')->name('medical.show');
Route::get('/medical/search/{param}', 'MedicalController@search')->name('medical.search');

//Route::resource('medical/reports', 'MedicalReportController');
Route::group(['prefix' => 'medical/reports'], function() {
    Route::get('create/{user}', 'MedicalReportController@create')->name('reports.create');
    Route::post('store', 'MedicalReportController@store')->name('reports.store');
    Route::get('edit/{report}', 'MedicalReportController@edit')->name('reports.edit');
    Route::put('update/{report}', 'MedicalReportController@update')->name('reports.update');
    Route::get('show/{report}', 'MedicalReportController@show')->name('reports.show');
});

Route::group(['prefix' => 'medical/record'], function() {
    Route::get('create/{user}', 'MedicalRecordController@create')->name('record.create')
        ->middleware(\App\Http\Middleware\UserHasMedicalRecord::class);
    Route::post('create/{user}', 'MedicalRecordController@store')->name('record.store')
        ->middleware(\App\Http\Middleware\UserHasMedicalRecord::class);
    Route::get('edit/{user}', 'MedicalRecordController@edit')->name('record.edit');
    Route::post('edit/{user}', 'MedicalRecordController@update')->name('record.update');
});

Route::group(['prefix' => 'notifications'], function() {
    Route::get('/', 'EmailNotificationController@index')->name('notification.index');
    Route::get('/create', 'EmailNotificationController@create')->name('notification.create');
    Route::post('/store', 'EmailNotificationController@store')->name('notification.store');
});

Route::resource('rookies','RookieController')->parameter('rookies', 'rookie');
//Route::post('/rookies/user', 'RookieController@storeWithUser')->name('rookies.store.user');

Route::resource('positions','PositionController');
Route::resource('seasons','SeasonController');
Route::resource('teams','TeamController');


Route::resource('events','EventController');
Route::resource('events-category/category','EventCategoryController');

//Route::resource('event-category', 'EventCategoryController');

Route::get('/events/all-events/{event}','EventController@allEvents')->name('events.ajax');
Route::get('/events/assistance/{event}','EventAssistanceController@create')->name('assistance.create');
Route::post('/events/assistance/{event}','EventAssistanceController@update')->name('assistance.update');

Route::delete('/play/{play}', 'PlaysController@deletePlay')->name('plays.delete');

Route::get('/plays/{match}', 'PlaysController@index')->name('plays.index');
Route::get('/kickoff/{match}', 'PlaysController@kickoff')->name('plays.kickoff');
Route::post('/kick/{match}', 'PlaysController@kick')->name('plays.kick');
Route::get('/penalty/{match}', 'PlaysController@penaltyForm')->name('plays.penalty');
Route::get('/penalty-bs/{match}', 'PlaysController@penaltyBsForm')->name('plays.penalty-bs');
Route::post('/penalty/{match}', 'PlaysController@penalty')->name('plays.penalty.create');
Route::get('/return/{match}', 'PlaysController@returnForm')->name('plays.return');
Route::post('/return/{match}', 'PlaysController@return')->name('plays.return.create');
Route::get('/tackle/{match}', 'PlaysController@tackleForm')->name('plays.tackle');
Route::post('/tackle/{match}', 'PlaysController@tackle')->name('plays.tackle.create');
Route::get('/point-after/{match}', 'PlaysController@pointAfterForm')->name('plays.point-after');
Route::post('/point-after/{match}', 'PlaysController@pointAfter')->name('plays.point-after.create');
Route::get('/fumble/{match}', 'PlaysController@fumbleForm')->name('plays.fumble');
Route::post('/fumble/{match}', 'PlaysController@fumble')->name('plays.fumble.create');
Route::get('/recovery/{match}', 'PlaysController@recoveryForm')->name('plays.recovery');
Route::post('/recovery/{match}', 'PlaysController@recovery')->name('plays.recovery.create');
Route::get('/punt/{match}', 'PlaysController@puntForm')->name('plays.punt');
Route::post('/punt/{match}', 'PlaysController@punt')->name('plays.punt.create');
Route::get('/field-goal/{match}', 'PlaysController@fieldGoalForm')->name('plays.field-goal');
Route::post('/field-goal/{match}', 'PlaysController@fieldGoal')->name('plays.field-goal.create');
Route::get('/pass/{match}', 'PlaysController@passForm')->name('plays.pass');
Route::post('/pass/{match}', 'PlaysController@pass')->name('plays.pass.create');
Route::get('/interception/{match}', 'PlaysController@interceptionForm')->name('plays.interception');
Route::post('/interception/{match}', 'PlaysController@interception')->name('plays.interception.create');
Route::get('/run/{match}', 'PlaysController@runForm')->name('plays.run');
Route::post('/run/{match}', 'PlaysController@run')->name('plays.run.create');

Route::get('/kickoff-yardline/{team}', 'PlaysController@getKickOffYardLine')->name('plays.kickoff-yardline');

Route::get('/swap', 'PlaysController@swap')->name('plays.swap');
Route::post('/end-quarter/{match}', 'PlaysController@endQuarter')->name('plays.end-quarter');

Route::get('/matches', 'MatchController@index')->name('match.index');
Route::post('/matches', 'MatchController@season')->name('match.season');
Route::get('/matches/{season}', 'MatchController@matches')->name('match.matches');
Route::get('/matches/{season}/create', 'MatchController@create')->name('match.create');
Route::post('/matches/{season}/create', 'MatchController@store')->name('match.store');

Route::get('/testing/{match}', 'PlaysController@playsTesting');

Route::get('stats-test', 'StatsController@test');

