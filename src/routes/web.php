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


Route::get('/welcome', function(){
    return view('welcome');
});
Route::get('/test/{roundId}/{datapointId}', function(){
    return view('createNextDatapoint');
});
Route::get('/', function () {
    return view('StoryTourist');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/rounds/create', 'RoundController@store')->name('createRound');
Route::get('/round/{round}', 'RoundController@show')->name('showRound');
Route::get('/rounds', 'RoundController@index')->name('showRound');
Route::patch('/round/{id}/update/v2', 'RoundController@updateV2')->name('updateRound');

Route::get('/createuser', function () {
    return view('createUser');
});

Route::get('/start', function () {
    return view('startpage');
});

Route::get('/swimlanes', function () { 
    $user = Auth::user();

    if (empty($user)) {
        return response([
            'message' => 'Not authenticated'
        ]);
    }

    $rounds = $user->rounds;

    return view('swimlanes', compact('rounds'));
});


Route::get('/front_index', function () {
    return view('posts.front_index');
});



Auth::routes();

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| Users
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

Route::get('/username', 'UserController@getUserName')->name('getUserName');

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| Pages
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

Route::get('/', 'PagesController@home')->name('home');
Route::get('/apply', 'PagesController@apply')->name('apply');
Route::get('/login', 'PagesController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/mail', 'PagesController@mail')->name('sendMail');


/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| Rounds
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

Route::post('/round/create', 'RoundController@store')->name('createRound');
Route::patch('round/update/{roundId}', 'RoundController@update')->name('updateRound');
Route::get('/rounds', 'RoundController@index')->name('getRounds');
Route::get('/round/{roundId}/show/', 'RoundController@show')->name('getRound');
Route::delete('/round/{roundId}/delete/', 'RoundController@delete')->name('deleteRound');
Route::patch('round/finish/{roundId}', 'RoundController@finish')->name('finishRound');

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| Datapoints
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

Route::post('/datapoint/{roundId}/create', 'DatapointController@store')->name('createDatapoint');
Route::get('/datapoints/{roundId}', 'DatapointController@index')->name('getDatapoints');
Route::get('/datapoint/{roundId}/datapoint/{datapointId}', 'DatapointController@show')->name('getDatapoint');
Route::patch('/datapoint/{roundId}/update/{datapointId}', 'DatapointController@update')->name('updateDatapoint');
Route::delete('/datapoint/{roundId}/delete/{datapointId}', 'DatapointController@delete')->name('deleteDatapoint');

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| NextDatapoints
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

Route::post('nextDatapoint/{roundId}/create/{datapointId}', 'NextDatapointController@store')->name('createNextpoint');
Route::get('nextDatapoint/{roundId}/get/{datapointId}', 'NextDatapointController@index')->name('getNextpoints');
Route::patch('nextDatapoint/{roundId}/update/{datapointId}/link/{nextDatapointId}', 'NextDatapointController@update')->name('updateNextpoint');
Route::delete('nextDatapoint/{roundId}/delete/{datapointId}/link/{nextDatapointId}', 'NextDatapointController@delete')->name('deleteNextpoint');

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| Media
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

// || Image
Route::get('image/{imageId}/', 'ImageController@getImage')->name('getImage');
Route::post('image/{roundId}/{datapointId}/upload/{imageId}/', 'DatapointController@uploadImage')->name('uploadImage');
Route::post('image/{roundId}/{datapointId}/detach/{imageId}/', 'DatapointController@detachImage')->name('detachImage');
Route::post('image/{roundId}/{datapointId}/attach/{imageId}/', 'DatapointController@attachImage')->name('attachImage');

// || Audio
Route::get('audio/{audioId}', 'AudioController@getAudio')->name('getAudio');
Route::post('audio/{roundId}/{datapointId}/upload/{audioId}/', 'DatapointController@uploadAudio')->name('uploadAudio');
Route::post('audio/{roundId}/{datapointId}/detach/{audioId}/', 'DatapointController@detachAudio')->name('detachAudio');
Route::post('audio/{roundId}/{datapointId}/attach/{audioId}/', 'DatapointController@attachAudio')->name('attachAudio');

// || Video
Route::get('video/{videoId}', 'VideoController@getVideo')->name('getVideo');
Route::post('video/{roundId}/{datapointId}/upload/{videoId}/', 'DatapointController@uploadVideo')->name('uploadVideo');
Route::post('video/{roundId}/{datapointId}/detach/{videoId}/', 'DatapointController@detachVideo')->name('detachVideo');
Route::post('video/{roundId}/{datapointId}/attach/{videoId}/', 'DatapointController@attachVideo')->name('attachVideo');

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| Testforms
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/

Route::get('testform', 'RoundController@testForm')->name('testform');
Route::get('datapointform/{roundId}', 'DatapointController@datapointForm')->name('datapointForm');

/*
| -------------------------------------------------------------------------------------------------------------------------------------------------------
| SomethingElse
| -------------------------------------------------------------------------------------------------------------------------------------------------------
*/
