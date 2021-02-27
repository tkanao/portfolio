<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Account;


class AccountController extends Controller
{
    public function edit() {
        return view('admin.book.edit');
    }
    
    public function update(Request $request) {
        $this->validate($request, Transaction::$rules);
        // アカウントを作成
        $account = Account::where('user_id', Auth::User()->id)->first();
        
        
        $transaction = new Transaction;
        $form = $request->all();
        unset($form['_token']);
        $transaction->fill($form);
        $transaction->account_id = $account->id;
        
        // 収支を表示
        if($transaction->transaction_type == 'outcome'){
            $transaction->amount = - $transaction->amount;}
        
        // 取引後の残高を計算
        $transaction->balance = Transaction::sum("amount") + $transaction->amount; 

        $transaction->save();
        
        
        return redirect('admin/book/edit');
    }
    
    public function index(Request $request) {
        $cond_date = $request->cond_date;
        if($cond_date != '') {
        //検索されたら検索結果を表示する
            $posts = Transaction::where('date', 'like', $cond_date . '%')->get();
            $monthly_total = Transaction::where('date', 'like', $cond_date . '%')
                            ->orderBy('created_at')->get()
                            ->pluck('amount')->sum();
        } else {
        // それ以外は全てを表示
            $posts = Transaction::all();
            $monthly_total = Transaction::all()->pluck('amount')->sum();
        }
        return view('admin.book.index', ['posts' => $posts, 'cond_date' => $cond_date, 'monthly_total' => $monthly_total]);
    }
    

}
