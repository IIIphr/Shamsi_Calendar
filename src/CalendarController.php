<?php

namespace iiiphr\Shamsi_Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function get_date(){
        setlocale(LC_ALL,'fa');
        $m_date= getdate();
        $day_from_beginning = 0;
        $m_month_days = [ 31 , 29 , 31 , 30 , 31 , 30 , 31 , 31 , 30 , 31 , 30 , 31 ];
        for( $i = 0 ; $i < $m_date['mon']-1 ; $i++ ){
            $day_from_beginning += $m_month_days[$i];
        }
        $m_date['year'] -= 621;
        $day_from_beginning += $m_date['mday'];
        if($day_from_beginning > 79){ // after Farvardin
            $m_date['yday']=$day_from_beginning;
            $day_from_beginning -= 79;
            if($day_from_beginning < 186){ // in the first 6 months
                $day = $day_from_beginning % 31;
                $month = intdiv($day_from_beginning,31);
                if($day == 0){
                    $m_date['mon']=$month;
                    $m_date['mday']=31;
                }
                else{
                    $m_date['mon']=$month+1;
                    $m_date['mday']=$day;
                }
            }
            else{ // in the second half of the year
                $day_from_beginning -= 186;
                $day = $day_from_beginning % 30;
                $month = intdiv($day_from_beginning,30) + 6;
                if($day == 0){
                    $m_date['mon']=$month;
                    $m_date['mday']=30;
                }
                else{
                    $m_date['mon']=$month+1;
                    $m_date['mday']=$day;
                }
            }
        }
        else{ // between Dey and Bahman
            $m_date['year'] -= 1;
            $day_from_beginning += 10 ;
            if( ($m_date['year']%100==0 && $m_date['year']%400==0) || ($m_date['year']%100!=0 && $m_date['year']%4==0) ){ // kabise
                $day_from_beginning +=1 ;
            }
            $day = $day_from_beginning % 30;
            $month = intdiv($day_from_beginning,30);
            $month += 9;
            if($day == 0){
                $m_date['mon']=$month;
                $m_date['mday']=30;
            }
            else{
                $m_date['mon']=$month+1;
                $m_date['mday']=$day;
            }
            $day = 31 * 6;
            for($i=7;$i<$m_date['mon'];$i++){
                $day += 30;
            }
            $day += $m_date['mday'];
            $m_date['yday']=$day;
        }
        $m_date['wday'] = ($m_date['wday']+1)%7;
        switch($m_date['weekday']){
            case "Saturday":{ $m_date['weekday'] = "شنبه"; break;}
            case "Sunday":{ $m_date['weekday'] = "یک‌شنبه"; break;}
            case "Monday":{ $m_date['weekday'] = "دوشنبه"; break;}
            case "Tuesday":{ $m_date['weekday'] = "سه‌شنبه"; break;}
            case "Wednesday":{ $m_date['weekday'] = "چهارشنبه"; break;}
            case "Thursday":{ $m_date['weekday'] = "پنج‌شنبه"; break;}
            case "Friday":{ $m_date['weekday'] = "جمعه"; break;}
        }
        switch($m_date['mon']){
            case 1:{ $m_date['month'] = "فروردین"; break;}
            case 2:{ $m_date['month'] = "اردیبهشت"; break;}
            case 3:{ $m_date['month'] = "خرداد"; break;}
            case 4:{ $m_date['month'] = "تیر"; break;}
            case 5:{ $m_date['month'] = "مرداد"; break;}
            case 6:{ $m_date['month'] = "شهریور"; break;}
            case 7:{ $m_date['month'] = "مهر"; break;}
            case 8:{ $m_date['month'] = "آبان"; break;}
            case 9:{ $m_date['month'] = "آذر"; break;}
            case 10:{ $m_date['month'] = "دی"; break;}
            case 11:{ $m_date['month'] = "بهمن"; break;}
            case 12:{ $m_date['month'] = "اسفند"; break;}
        }
        return $m_date;
    }

    public function get_sec(){
        $date=$this->get_date();
        return $date['seconds'];
    }

    public function get_min(){
        $date=$this->get_date();
        return $date['minutes'];
    }

    public function get_hour(){
        $date=$this->get_date();
        return $date['hours'];
    }

    public function get_mday(){
        $date=$this->get_date();
        return $date['mday'];
    }

    public function get_wday(){
        $date=$this->get_date();
        return $date['wday'];
    }

    public function get_mon(){
        $date=$this->get_date();
        return $date['mon'];
    }

    public function get_year(){
        $date=$this->get_date();
        return $date['year'];
    }

    public function get_weekday(){
        $date=$this->get_date();
        return $date['weekday'];
    }

    public function get_month(){
        $date=$this->get_date();
        return $date['month'];
    }
}
