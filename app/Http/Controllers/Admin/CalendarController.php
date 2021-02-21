<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Account;
use App\Transaction;
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
    
    // accountにaccount_idを作成
    $account = Account::where('user_id', Auth::User()->id)->first();
    if ($account === null) {
       $account = new Account();
       $account->user_id =  Auth::User()->id;
       $account->balance = 0;
       $account->save();}
       
    // 総資産を計算
    $transaction = new Transaction;
    $account->balance = Transaction::sum("amount");
    $account->save();
    
    return view('admin.book.create', [
        "calendar" => $calendar, "account" => $account
    ]);

    }

}
