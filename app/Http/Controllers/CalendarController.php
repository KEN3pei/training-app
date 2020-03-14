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
    
    public function index()
    {
        if (!isset($body)) {
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
    
    public function calendar(Request $request)
    {
        $auth = Auth::user();
        $date = $request->date;
        // dd($date);
        $d = Carbon::parse($date)->format('Y-m-d');
        $body = Tweet::where('updated_at', 'LIKE', "%{$d}%")->where('user_id', $auth->id)->get();
        // dd($body);
        if (strpos($body, $d) === false) {
            $body = "未入力";
        } else {
            foreach ($body as $x) {
                // dd($x->body);
                $body = $x->body;
            }
        }
        // dd($body);
        $d_y_m = substr("$d", 0, 7);
        // dd($d_y_m);
        // $dと一致するtweetのbodyを取得する
        //もしなかったときは未入力を出力
        // return view('training.calendar', ['status' => $body]);
        return redirect('/calendar?ym='. $d_y_m)->with('status', $body);
    }
}
