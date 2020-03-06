<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tweet;
use App\User;
use Auth;
use Carbon\Carbon;
use Storage;

class TrainingController extends Controller
{
    //ログインしたらデフォルトでその日の投稿を表示する
    //なければ作成して未入力を表示
    public function add (Request $request) {
        
        // dd('v');
        $auth = Auth::user();
        $today = substr(Carbon::today(), 0, 10);
        $yesterday = substr(Carbon::yesterday(), 0, 10);
        $two_days_ago = substr(Carbon::today()->subDay(2), 0, 10);
        $three_days_ago = substr(Carbon::today()->subDay(3), 0, 10);
        // dd($yesterday);
        //tweetテーブルのログイン中のユーザの今日の日付を含む投稿をget
        $tweet = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$today}%")->get();
        $tweet_y = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$yesterday}%")->get();
        $tweet_two_ago = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$two_days_ago}%")->get();
        $tweet_three_ago = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$three_days_ago}%")->get();
        
        if($tweet_three_ago == null || strpos($tweet_three_ago, $three_days_ago) === false){
            $three_day = "３日前の投稿はありません";
        }else{
            foreach($tweet_three_ago as $x){
                $three_day = $x->body;
            }
        }
        
        if($tweet_two_ago == null || strpos($tweet_two_ago, $two_days_ago) === false){
            $two_day = "おとといの投稿はありません";
        }else{
            foreach($tweet_two_ago as $x){
                $two_day = $x->body;
            }
        }
        
        if($tweet_y == null || strpos($tweet_y, $yesterday) === false){
            $y_day = "昨日の投稿はありません";
        }else{
            foreach($tweet_y as $x){
                $y_day = $x->body;
            }
        }
        //なければ新しく作る
        if($tweet == null || strpos($tweet, $today) === false){
            $tweet = new Tweet;
            $tweet->fill(['body' => '未入力','user_id' => $auth->id]);
            $tweet->save();
        }
        else{
            //あった場合$tweetにレコードごと代入
            foreach($tweet as $x){
            $tweet = $x;
            }
        }
        
        //imageを取得
        $auth = Auth::user();
        $user_table = User::where('id', $auth->id)->get();
        foreach($user_table as $colum){
            $image = $colum->image;
        }
        //$image=nullならS3から特定の画像パスを埋め込む
        if($image == null){
            $user_table = User::where('id', $auth->id)->get();
            $url = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
            foreach($user_table as $colum){
                $colum->image = $url;
                $colum->save();
                $image = $url;
            }
        }
        // dd($image);
        return view('training.tweet', [
            'image' => $image,
            'auth' => $auth,
            'tweet' => $tweet,
            'y_day' => $y_day,
            'two_day' => $two_day,
            'three_day' => $three_day,
            ]);
    }
    
    public function tweet (Request $request) {
        
        //request->bodyがnullなら未入力、それ以外はそのまま
        // dd($request->id);
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
        return redirect('/')->with('status', 'Profile updated!');
    }
    
    public function myprofile (Request $request){
        
        $auth = Auth::user();
        $user_table = User::where('id', $auth->id)->get();
        // dd($user_table);
        foreach($user_table as $colum){
            $image = $colum->image;
            // dd($image);
        }
        if($image == null){
            $image = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
        }
        // dd($image);
            //nullの場合をまだ指定していない
        // dd($path);
        
        return view('training.edit', ['image' => $image, 'auth' => $auth]);
    }
    
    //edit画面の表示
    public function edit (Request $request){
        // 送信fileにvalidateする
        $this->validate($request, User::$rules);
        
        $auth = Auth::user();
        $form = $request->all();
        dd($form);
        if(($form == [])){
            // dd($form); 
            $image = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
            $url = Storage::disk('s3')->url($image);
            return view('training.edit', ['url' => $url, 'auth' => $auth]);
        }
        // $image = $request->file('image');
        // $path = $request->file('image')->store('public/image');//laravelではこの場所に画像自体を保存する//
        // $path = Storage::disk('s3')->put('/', $image, 'public');
        // $image_path = basename($path);//DBにはパスのみを保存//
        // $image_path = Storage::disk('s3')->url($path);
        // dd($image_path);
        $user_table = User::where('id', $auth->id)->get();

        foreach($user_table as $colum){
            $url = $colum->image; 
        }
        return view('training.edit', ['url' => $url, 'auth' => $auth]);
    }
    
    //更新処理
    public function img_update (Request $request){
        
        $this->validate($request, User::$rules);
        $auth = Auth::user();
        $user_table = User::where('id', $auth->id)->get();
        
        // dd($request->image);
        if(($request->image) === null){
            
            $url = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
            
            foreach($user_table as $colum){
            $colum->image = $url;
            $colum->save();
            }
        }else{
            $form = $request->all();
            $image = $request->file('image');
            
            $path = Storage::disk('s3')->put('/', $image, 'public');
            $url = Storage::disk('s3')->url($path);  
            
            foreach($user_table as $colum){
            $colum->image = $url;
            $colum->save();
        }
        }
        // dd($url)
        
        return redirect('/profile');
    }
    
    public function delete (Request $request){
        
        $user = User::find($request->user_id);
        $user->delete();
        
        Auth::logout();
        // dd($user);
        
        return redirect('/logout');
    }
    
    
    
}
