<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yasumi\Yasumi;
use App\Account;
use App\Transaction;
// CalendarViewを追加
use App\Calendar\CalendarView;


class CalendarController extends Controller
{
    public function add(Request $request) {
    // クエリーのdateを受け取る
    $date = $request->input("date");
    // 取得できない時は現在を指定する
    if(!$date)$date = date('Y-m', strtotime('now'));

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
    // 月毎の収支を表示
    $transaction_monthly = Transaction::where('date', 'like', $date . '%')
    ->orderBy('created_at')->get()
    ->pluck('amount')->sum();

    return view('admin.book.create', [
        "calendar" => $calendar, "account" => $account, 'transaction_monthly' => $transaction_monthly
    ]);

    }

}
