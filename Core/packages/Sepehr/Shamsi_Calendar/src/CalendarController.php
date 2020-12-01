<?php

namespace Sepehr\Shamsi_Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function get_date(){
        return getdate();
    }
}
