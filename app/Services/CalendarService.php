<?php

namespace App\Services;

use Carbon\Carbon;
use App\Http\Controllers\CalendarController;

class CalendarService{
    
    public function getweeks(){
        
        $week = "";
        $weeks = [];
      
        $dt = new Carbon(self::getYm_firstday());
        $dt_week = $dt->dayOfWeek;
          
        $week .= str_repeat('<td></td>', $dt_week);
        
        $dt_month = $dt->daysInMonth;
        for ($day = 1; $day <= $dt_month; $day++, $dt_week++){
            
            $date = self::getYm(). '-'. $day;
            // dd(action("CalendarController@calendar", ["date" => $date]) );
            $week .= '<td><a href="'. action("CalendarController@calendar", ["date" => $date]) . '">'. $day .'</a></td>';
            
            if (($dt_week % 7 === 6) || ($day === $dt_month)){
                if ($day === $dt_month){
                    $week .= str_repeat('<td></td>', 6 - ($dt_week % 7));
                }
                $weeks[] = '<tr>'. $week .'</tr>';
                $week = '';
            }
        }
        return $weeks;
    }
    
    public function getMonth(){
        return Carbon::parse(self::getYm_firstday())->format('Y年-n月');
    }
    
    public function getPrev(){
        return Carbon::parse(self::getYm_firstday())->subMonthNoOverflow()->format('Y-m');
    }
    
    public function getnext(){
        return Carbon::parse(self::getYm_firstday())->addMonthNoOverflow()->format('Y-m');
    }
    
    public function getYm(){
        
        if(isset($_GET['ym'])){
            return $_GET['ym'];
        }
        // 現在年月を返す//
        return Carbon::now()->format('Y-m');
        
    }
    
    public function getYm_firstday(){
        // 現在年月日を返す
        return self::getYm() . '-01';
        
    }
}