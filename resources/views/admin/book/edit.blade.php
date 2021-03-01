@extends('layouts.admin')
@section('title', '収支の入力')
@section('content')
        <div class="container">
            <form action="{{ action('Admin\AccountController@update') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-12 text-center mt-5"><h4>収支の入力</h4></div><br>
                    <div class="col-md-10 mx-auto mt-3">
                        <input type="date" class="form-control" name="date">
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <div class="col-md-10 mx-auto">
                            <table border="1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40%">項目</th>
                                        <th width="20%">収支</th>
                                        <th width="40%">金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" style="border:none" class="form-control" name="memo">
                                        </td>
                                        <td>
                                            <div class="pt-2">
                                                <label><input type="radio" name="transaction_type" value="income">収入</label>
                                            </div>
                                            <div class="p-1">
                                                <label><input type="radio" name="transaction_type" value="outcome">支出</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" style="border:none" class="form-control" name="amount"　width="80%"><span>円</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
                <br>
                <!--{{ csrf_field() }}-->
                <input type="submit" class="btn btn-primary float-right" value="入力">
            </form>
        </div>
@endsection