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
    public function add () {
        
        $Tweet = new Tweet;
        $posts = $Tweet->all();
        // dd($Tweet);
        $auth = Auth::user();
        
        return view('training.tweet', ['posts' => $posts, 'auth' => $auth]);
    }
    
    public function tweet (Request $request) {
        
        $tweet = new Tweet;
        $form = $request->all();
        
        if (isset($form['body'])){
            $tweet->body = $form['body'];
            
        }else{
            $tweet->body = '未入力';
        }
        unset($form['_token']);
        unset($form['body']);
         //user_idの設置
        $auth = Auth::user();
        // dd($auth->id);
        $tweet->user_id = $auth->id;
        
        $tweet->fill($form);
        $tweet->save();
        
        if($auth->id == $tweet->user_id){
            $posts = $tweet->all();
        }
        
        $today = substr(Carbon::today(), 0, 10);
        $yesterday = substr(Carbon::yesterday(), 0, 10);
        $twodays_ago = substr(new Carbon('-2 day'), 0, 10);
        $threedays_ago = substr(new Carbon('-3 day'), 0, 10);
        // $twodays_ago = new Carbon('-2 day');
        $update_days = array(
            'today' => '', 
            'yesterday' => '',
            'twodays_ago' => '',
            'threedays_ago' => ''
            );
       
        // dd($update_days);
        foreach ($tweet->all() as $tweet_all){
            // $update_ymd = $update_time->updated_at;
            $update_at = $tweet_all->updated_at;
            //$now_ymdに$updateが含まれているか確認する
            if(strpos($update_at,$today) !== false){
                $update_days['today'] = $tweet_all->body;
               
            }elseif(strpos($update_at,$yesterday) !== false){
                $update_days['yesterday'] = $tweet_all->body;
                
            }elseif(strpos($update_at,$twodays_ago) !== false){
                $update_days['twodays_ago'] = $tweet_all->body;
                
            }elseif(strpos($update_at,$twodays_ago) !== false){
                $update_days['threedays_ago'] = $tweet_all->body;
            }
        }
        // dd($update_days);
        
        return view('training.tweet', compact('update_days'),['posts' => $posts, 'auth' => $auth]);
    }
    
    
    
    
}
