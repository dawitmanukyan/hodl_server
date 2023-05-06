<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Airdrop;
use App\Models\Coin;
use App\Models\Nft;
use App\Models\Subscriber;
use TCG\Voyager\Models\Post;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
// use App\Mail\SendMail;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/posts',function(){
    $posts = Post::all();
    return response()->json($posts);
});
Route::get('/post/{id}',function(Request $request){
    $id = $request->id;
//    $post = Post::all()->where('id',$id);
    $post= Post::find($id);
    return response()->json($post);
});
Route::get('/users',function(){
    $users = User::all();
    return response()->json($users);
});
Route::get('/coins',function(){
    $coin = Coin::all();
    return response()->json($coin);
});
Route::get('/coin/{id}',function(Request $request){
    $id = $request->id;
    $coin = Coin::find($id);
    return response()->json($coin);
});

Route::get('/airdrops',function(){
    $airdrop = Airdrop::all();
    return response()->json($airdrop);
});
Route::get('/airdrop/{id}',function(Request $request){
    $id = $request->id;
    $airdrop = Airdrop::find($id);
    return response()->json($airdrop);
});
Route::get('/nfts',function(){
    $nfts = Nft::all();
    return response()->json($nfts);
});
Route::get('/nft/{id}',function(Request $request){
    $id = $request->id;
    $nft = Nft::find($id);
    return response()->json($nft);
});
Route::get('/subscribers',function(){
    $subscribers = Subscriber::all();
    return response()->json($subscribers);
});
Route::get('/general_posts',[UserController::class, 'general_posts']);
Route::get('/most_coins',[UserController::class, 'most_coins']);
Route::get('/most_airdrops',[UserController::class, 'most_airdrops']);
Route::get('/most_nfts',[UserController::class, 'most_nfts']);

Route::post('/coin/create',[UserController::class, 'coin_create']);
Route::post('/airdrop/create',[UserController::class, 'airdrop_create']);
Route::post('/nft/create',[UserController::class, 'nft_create']);

// Route::get('send-mail',function(){
    // Mail::to('smnvegas2@gmail.com')->send(new SendMail());

    // return "Mail Sent";
// });

Route::post('/send-mail',[UserController::class, 'mail_send']);
Route::post('/coin/like',[UserController::class, 'like_coin']);
Route::post('/airdrop/like',[UserController::class, 'like_airdrop']);
Route::post('/nft/like',[UserController::class, 'like_nft']);

Route::post('/coin/unlike',[UserController::class, 'unlike_coin']);
Route::post('/airdrop/unlike',[UserController::class, 'unlike_airdrop']);
Route::post('/nft/unlike',[UserController::class, 'unlike_nft']);


