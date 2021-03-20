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
        
        // 支出ならマイナスにする
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
            $posts = Transaction::where('date', 'like', $cond_date . '%')->orderBy('created_at')->get();
            unset($posts['_token']);
            
            $all_outcome = Transaction::where('date', 'like', $cond_date . '%')
                  ->where('transaction_type', 'outcome')->orderBy('created_at')->select('memo', 'amount')->get();

            $all_memos = Transaction::where('date', 'like', $cond_date . '%')
                   ->where('transaction_type', 'outcome')->orderBy('created_at')->get()->pluck('memo');
            $memos = array();
                foreach($all_memos as $str){
                    if(!in_array($str, $memos)){
                        $memos[] = $str;
                    }
                }
                    foreach($memos as $value){
                    	$num = 0;
                    	foreach($all_outcome as $row){
                    		if($row['memo']==$value){
                    			$num = $num+$row['amount'];
                    		}
                    	}
                    	$amounts[$value] = $num;
                    }
                    
                    $amount = array();
                    $memo = array();
                    
                    foreach($amounts as $key => $value){
                        $amount[] = $value;
                        $memo[] = $key;
                    }
                    
            $monthly_income = Transaction::where('date', 'like', $cond_date . '%')
                            ->where('transaction_type', 'income')
                            ->orderBy('created_at')->get()
                            ->pluck('amount')->sum();
                            
            $monthly_outcome = Transaction::where('date', 'like', $cond_date . '%')
                            ->where('transaction_type', 'outcome')
                            ->orderBy('created_at')->get()
                            ->pluck('amount')->sum();
                            
            $monthly_total = Transaction::where('date', 'like', $cond_date . '%')
                            ->orderBy('created_at')->get()
                            ->pluck('amount')->sum();
                           
        } else {
        // それ以外は表示しない
            $posts = null;
            $monthly_total = null;
            $monthly_income = null;
            $monthly_outcome = null;
            $memos = null;
            $amounts = null;
        }

        // 月毎のデータを取り出す
        // $memos = $posts->memo;
        // $amounts = - $posts->amount;
        return view('admin.book.index', ['posts' => $posts, 'cond_date' => $cond_date, 'monthly_total' => $monthly_total, 'monthly_income' => $monthly_income, 
        'monthly_outcome' => $monthly_outcome, 'memo' => $memo, 'amounts' => $amounts, 'amount' => $amount,]);
    }
    

}
