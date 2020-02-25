<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tweet;
use App\User;
use Auth;
use Carbon\Carbon;

class TrainingController extends Controller
{
    public function add (Request $request) {
        
        $auth = Auth::user();
        // dd($auth);
        // $tweet = Tweet::find(1);
        $today = substr(Carbon::today(), 0, 10);
        //tweetテーブルのログイン中のユーザの今日の日付を含む投稿をget
        $tweet = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$today}%")->get();
        //なければ新しく作る
        if($tweet == null || strpos($tweet, $today) === false){
            $tweet = new Tweet;
            $tweet->fill(['body' => '未入力','user_id' => $auth->id]);
            $tweet->save();
        }else{
            //あった場合$tweetにレコードごと代入
            foreach($tweet as $x){
            $tweet = $x;
            }
        }
        // セーブするときにその時の日付をcalendarテーブルに保存？
        //calendarからtweetのbodyを呼び出したい
        return view('training.tweet', ['tweet' => $tweet]);
    }
    
    public function tweet (Request $request) {
        
        //request->idでtweetディスクを取得
        //request->bodyがnullなら未入力、それ以外はそのまま
        $form = $request->body;
        if($form == null){
            $form = '未入力';
        }
        
        $auth = Auth::user();
        // $tweet = Tweet::find(1);
        $today = substr(Carbon::today(), 0, 10);
        //tweetテーブルのログイン中のユーザの今日の日付を含む投稿をget
        $tweet = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$today}%")->get();
            //あった場合$xのbodyを更新
            foreach($tweet as $x){
            $x->fill(['body' => $form]);
            $x->save();
            }
        return redirect('/');
        // return view('training.tweet', ['tweet' => $tweet]);
    }
    
    
    
    
}
