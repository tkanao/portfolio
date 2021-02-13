<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transactions;

class AccountController extends Controller
{
    public function edit() {
        return view('admin.book.edit');
    }
    
    public function update(Request $request) {
        $this->validate($request, Transactions::$rules);
        
        $transactions = new Transactions;
        $form = $request->all();
        unset($form['_token']);
        
        $transactions->fill($form);
        $transactions->save();
        
        return redirect('admin/book/edit');
    }
    
    public function index() {
        return view('admin.book.index');
    }

}
