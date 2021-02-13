<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// CalendarViewを追加
use App\Calendar\CalendarView;


class CalendarController extends Controller
{
    public function add(Request $request) {
    // CalendarViewを追加
    // クエリーのdateを受け取る
    $date = $request->input("date");
    
    //dateがYYY-MMの型式かどうか判定する
    if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
        $date = strtotime($date . "-01");
    }else{
        $date = null;
    }
    // 取得できない時は現在を指定する
    if(!$date)$date = time();
    
    // カレンダーに渡す
    $calendar = new CalendarView($date);
    
    return view('admin.book.create', [
        "calendar" => $calendar
    ]);

    }

}
