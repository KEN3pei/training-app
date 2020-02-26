<?php

namespace App\Http\Controllers;

use App\Facades\Calendar;
use App\Services\CalendarService;
use Illuminate\Http\Request;

use App\Tweet;
use App\User;
use Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    
    private $service;
    
    public function __construct(CalendarService $service)
    {
        $this->service = $service;
        // dd($this->service);
    }
    
    public function index (){
        
        if(!isset($body)){
            $body = "未入力";   
        }
        
        return view('training.calendar', [ 
            'prev' => Calendar::getPrev(),
            'next' => Calendar::getnext(),
            'month' => Calendar::getMonth(),
            'weeks' => Calendar::getweeks(),
            'body' => $body
            ]);
    }
    
    public function calendar (Request $request){
        
        $auth = Auth::user();
        $date = $request->date;
        $d = Carbon::parse($date)->format('Y-m-d');
        $body = Tweet::where('updated_at', 'LIKE', "%{$d}%")->where('user_id', $auth->id)->get();
        if(strpos($body, $d) === false){
            $body = "未入力";
        }else{
            foreach($body as $x){
                $body = $x->body;
            }
        }    
        // dd($body);
        // $dと一致するtweetのbodyを取得する
        //もしなかったときは未入力を出力
        
        return redirect('/calendar')->with('status', $body);
    }
}
