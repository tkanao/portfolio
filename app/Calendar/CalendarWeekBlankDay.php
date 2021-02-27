<?php
namespace App\Calendar;
use Yasumi\Yasumi;
use App\Transaction;

class CalendarWeekBlankDay extends CalendarWeekDay {
    
    function getClassName(){
        return "day-blank";
    }
    
    function render(){
        return '';
    }
}