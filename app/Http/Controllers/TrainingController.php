<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tweet;
use App\User;
use App\Groupemembar;
use Auth;
use Carbon\Carbon;
use Storage;

class TrainingController extends Controller
{
    public function Login()
    {
        return view('auth.new_login');
    }
    //ログインしたらデフォルトでその日の投稿を表示する
    //なければ作成して未入力を表示
    public function add(Request $request)
    {
        $auth = Auth::user();
        $today = substr(Carbon::today(), 0, 10);
        $yesterday = substr(Carbon::yesterday(), 0, 10);
        $two_days_ago = substr(Carbon::today()->subDay(2), 0, 10);
        $three_days_ago = substr(Carbon::today()->subDay(3), 0, 10);
        
        $four_days = array($today, $yesterday, $two_days_ago, $three_days_ago);
        
        foreach ($four_days as $day) {
            $tweet_days = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$day}%")->get();
            foreach ($tweet_days as $tweet) {
                $tweets[] = $tweet;
            }
        }
        if (!isset($tweet[3])) {
            $three_day = "３日前の投稿はありません";
        } else {
            $three_day = $tweets[3]->body;
        }
        if (!isset($tweet[2])) {
            $two_day = "おとといの投稿はありません";
        } else {
            $two_day = $tweets[2]->body;
        }
        if (!isset($tweet[1])) {
            $y_day = "昨日の投稿はありません";
        } else {
            $y_day = $tweets[1]->body;
        }
        //なければ新しく作る
        if (!isset($tweet[0])) {
            $tweet = new Tweet;
            $tweet->fill(['body' => '未入力','user_id' => $auth->id]);
            $tweet->save();
        } else {
            //あった場合$tweetにレコードごと代入
            $tweet = $tweets[0];
        }
        //imageを取得
        //$authを再利用
        $user_table = User::where('id', $auth->id)->get();
        foreach ($user_table as $colum) {
            $image = $colum->image;
        }
        //$image=nullなら特定の画像パスを埋め込む
        if ($image == null) {
            $user_table = User::where('id', $auth->id)->get();
            $url = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
            foreach ($user_table as $colum) {
                $colum->image = $url;
                $colum->save();
                $image = $url;
            }
        }
        // dd($image);
        // 全員のbodyを表示する
        //Userテーブルからtweetテーブル
        // $x = User::find(4)->tweet_get;
        // $v = Tweet::find(71);
        // dd($v);
        
        
        $tweet_all = Tweet::all();
        $sorted = $tweet_all->sortByDesc('updated_at');
        // dd($sorted->user_id->image);
        foreach ($sorted as $x) {
            // dd($x->user->image);
            // $user_id[] = $x->user_id;
        }
        
        return view('training.tweet', [
            // 'user_all' => $user_all,
            'sorted' => $sorted,
            'image' => $image,
            'auth' => $auth,
            'tweet' => $tweet,
            'y_day' => $y_day,
            'two_day' => $two_day,
            'three_day' => $three_day,
            ]);
    }
    
    public function tweet(Request $request)
    {
        
        //request->bodyがnullなら未入力、それ以外はそのまま
        // dd($request->id);
        $form = $request->body;
        if ($form == null) {
            $form = '未入力';
        }
        
        $auth = Auth::user();
        // $tweet = Tweet::find(1);
        $today = substr(Carbon::today(), 0, 10);
        //tweetテーブルのログイン中のユーザの今日の日付を含む投稿をget
        $tweet = Tweet::where('user_id', $auth->id)->where('updated_at', 'LIKE', "%{$today}%")->get();
        //あった場合$xのbodyを更新
        foreach ($tweet as $x) {
            $x->fill(['body' => $form]);
            $x->save();
        }
        return redirect('/')->with('status', 'Tweet updated!');
    }
    
    
    public function myprofile(Request $request)
    {
        $auth = Auth::user();
        $user_table = User::where('id', $auth->id)->get();
        // dd($user_table);
        foreach ($user_table as $colum) {
            $image = $colum->image;
            // dd($image);
        }
        if ($image == null) {
            $image = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
        }
        
        return view('training.edit', ['image' => $image, 'auth' => $auth]);
    }
    
    //アカウント編集画面の表示
    public function edit(Request $request)
    {
        // 送信fileにvalidateする
        $this->validate($request, User::$rules);
        
        $auth = Auth::user();
        $form = $request->all();
        dd($form);
        if (($form == [])) {
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

        foreach ($user_table as $colum) {
            $url = $colum->image;
        }
        return view('training.edit', ['url' => $url, 'auth' => $auth]);
    }
    
    //更新処理
    public function img_update(Request $request)
    {
        $this->validate($request, User::$rules);
        $auth = Auth::user();
        $user_table = User::where('id', $auth->id)->get();
        
        // dd($request->image);
        if (($request->image) === null) {
            $url = "https://ken3pei.s3.us-east-2.amazonaws.com/qDnoxXh3VSzTMlmhOmKROT1Ei5AoPYA8GwU0hI0V.jpeg";
            
            foreach ($user_table as $colum) {
                $colum->image = $url;
                $colum->save();
            }
        } else {
            $form = $request->all();
            $image = $request->file('image');
            
            $path = Storage::disk('s3')->put('/', $image, 'public');
            $url = Storage::disk('s3')->url($path);
            
            foreach ($user_table as $colum) {
                $colum->image = $url;
                $colum->save();
            }
        }
        // dd($url)
        
        return redirect('/profile');
    }
    
    // アカウント削除
    public function delete(Request $request)
    {
        $auth_id = $request->user_id;
        //アカウントの削除
        $user = User::find($auth_id)->delete();
        //グループメンバーから同アカウントの削除
        $groupemembar = Groupemembar::where('groupe_id', $auth_id)->delete();
        // dd($groupemembar);
        Auth::logout();
        // dd($user);
        
        return redirect('/logout');
    }
    
    // 名前の更新
    public function name_update(Request $request)
    {
        
        //変更したい値の取得
        $postname = $request->name;
        // 変更前のnameを取得
        $username = Auth::user()->name;
        //今のUserモデルからログイン名で検索
        $users = User::where('name', $username)->get();
        foreach ($users as $user) {
            $user->name = $postname;
            $user->save();
        }
        
        return redirect('/profile');
    }
}
