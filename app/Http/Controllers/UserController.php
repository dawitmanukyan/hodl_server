<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coin;
use App\Models\Airdrop;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Nft;
use TCG\Voyager\Models\Post;

class UserController extends Controller
{
    public function coin_create(Request $request){
        $coin = new Coin;
        $coin->logo = $request->input('logo');
        $coin->name = $request->input('name');
        $coin->symbol = $request->input('symbol');
        $coin->description = $request->input('description');
        $coin->mcap_usd = $request->input('mcap_usd');
        $coin->price_usd = $request->input('price_usd');
        $coin->launch_date = $request->date('launch_date');
        $coin->chain = $request->input('chain');
        $coin->address = $request->input('address');
        $coin->website = $request->input('website');
        $coin->telegram = $request->input('telegram');
        $coin->twitter = $request->input('twitter');
        $coin->discord = $request->input('discord');
        $coin->reddit = $request->input('reddit');
        $coin->audit = $request->input('audit');
        $coin->other_info = $request->input('other_info');
        $coin->save();
        return response()->json([
            'success' => true
        ]);
    }


    public function airdrop_create(Request $request){
        $airdrop = new Airdrop;
        $airdrop->logo = $request->input('logo');
        $airdrop->name = $request->input('name');
        $airdrop->symbol = $request->input('symbol');
        $airdrop->description = $request->input('description');
        $airdrop->link = $request->input('link');
        $airdrop->reward = $request->input('reward');
        $airdrop->end_date = $request->date('end_date');
        $airdrop->website = $request->input('website');
        $airdrop->telegram = $request->input('telegram');
        $airdrop->twitter = $request->input('twitter');
        $airdrop->discord = $request->input('discord');
        $airdrop->reddit = $request->input('reddit');
        $airdrop->audit = $request->input('audit');
        $airdrop->save();
        return response()->json([
            'sucssess' => true
        ]);
    }

    public function mail_send(Request $request){
        $mail = $request->input('mail');
        $checkmail = Subscriber::all()->where('mail',$mail);
        $nummail = count($checkmail);

        if($nummail > 0){

            return response()->json([
                'success' => false
            ]);

        }else{
            Mail::to($mail)->send(new SendMail());

            $subscribers = new Subscriber;
            $subscribers->mail = $request->input('mail');
            $subscribers->save();

            return response()->json([
                'success' => true
            ]);
        }

    }


    public function nft_create(Request $request){
        $nft = new Nft;
        $nft->logo = $request->input('logo');
        $nft->name = $request->input('name');
        $nft->symbol = $request->input('symbol');
        $nft->description = $request->input('description');
        $nft->link = $request->input('link');
        $nft->reward = $request->input('reward');
        $nft->end_date = $request->date('end_date');
        $nft->website = $request->input('website');
        $nft->telegram = $request->input('telegram');
        $nft->twitter = $request->input('twitter');
        $nft->discord = $request->input('discord');
        $nft->reddit = $request->input('reddit');
        $nft->price = $request->input('price');
        $nft->save();
        return response()->json([
            'sucssess' => true
        ]);
    }


    public function like_coin(Request $request){
        $id = $request->input('id');
        $coin = Coin::all()->where('id',$id);
        foreach($coin as $coinval);
        $likesnum = $coinval['likes'];
        $newlikesnum = $likesnum + 1;
        $updatecoin = Coin::find($id);
        $updatecoin->update([
            'likes' => $newlikesnum
        ]);
        return response()->json($newlikesnum);
    }



    public function like_airdrop(Request $request){
        $id = $request->input('id');
        $coin = Airdrop::all()->where('id',$id);
        foreach($coin as $coinval);
        $likesnum = $coinval['likes'];
        $newlikesnum = $likesnum + 1;
        $updatecoin = Airdrop::find($id);
        $updatecoin->update([
            'likes' => $newlikesnum
        ]);
        return response()->json($newlikesnum);
    }


    public function like_nft(Request $request){
        $id = $request->input('id');
        $coin = Nft::all()->where('id',$id);
        $coinval2 = array();
        foreach($coin as $coinval2);
        $likesnum = $coinval2['likes'];
        $newlikesnum = $likesnum + 1;
        $updatecoin = Nft::find($id);
        $updatecoin->update([
            'likes' => $newlikesnum
        ]);
        return response()->json($newlikesnum);
    }




    public function unlike_coin(Request $request){
        $id = $request->input('id');
        $coin = Coin::all()->where('id',$id);
        foreach($coin as $coinval);
        $likesnum = $coinval['likes'];
        $newlikesnum = $likesnum - 1;
        $updatecoin = Coin::find($id);
        $updatecoin->update([
            'likes' => $newlikesnum
        ]);
        return response()->json($newlikesnum);
    }



    public function unlike_airdrop(Request $request){
        $id = $request->input('id');
        $coin = Airdrop::all()->where('id',$id);
        foreach($coin as $coinval);
        $likesnum = $coinval['likes'];
        $newlikesnum = $likesnum - 1;
        $updatecoin = Airdrop::find($id);
        $updatecoin->update([
            'likes' => $newlikesnum
        ]);
        return response()->json([
            'success'=>true
        ]);
    }


    public function unlike_nft(Request $request){
        $id = $request->input('id');
        $coin = Nft::all()->where('id',$id);
        $coinval2 = array();
        foreach($coin as $coinval2);
        $likesnum = $coinval2['likes'];
        $newlikesnum = $likesnum - 1;
        $updatecoin = Nft::find($id);
        $updatecoin->update([
            'likes' => $newlikesnum
        ]);
        return response()->json($newlikesnum);
    }

    public function general_posts(){
        $posts = Post::latest()->take(3)->get();
        return response()->json($posts);
    }

    public function most_coins(){
        $coins = Coin::orderBy('likes', 'desc')->get();
        return response()->json($coins);

    }

    
    public function most_airdrops(){
        $airdrops = Airdrop::orderBy('likes', 'desc')->get();
        return response()->json($airdrops);
    }

    public function most_nfts(){
        $nfts = Nft::orderBy('likes', 'desc')->get();
        return response()->json($nfts);
    }
    

    

}
