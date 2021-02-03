<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function add() {
        return view('admin.book.create');
    }
    
    public function create() {
        return redirect('admin/book/create');
    }
    
    public function edit() {
        return view('admin.book.edit');
    }
    
    public function update() {
        return redirect('admin/book/edit');
    }
    
    public function index() {
        return view('admin.book.index');
    }
}