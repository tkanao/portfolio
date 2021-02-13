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
                    <div class="col-md-5 mt-5 ml-5"><h4>日付</h4></div>
                    <div class="col-md-10 mx-auto">
                        <input type="date" class="form-control" name="date">
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <div class="col-8 mx-auto">
                        <div class="row">
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
                                            <input type="text" class="form-control" name="memo">
                                        </td>
                                        <td>
                                            <div>
                                                <label><input type="radio" name="transaction_id" value="income">収入</label>
                                            </div>
                                            <div>
                                                <label><input type="radio" name="transaction_id" value="outcome">支出</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="amount">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <!--{{ csrf_field() }}-->
                <input type="submit" class="btn btn-primary float-right" value="更新">
            </form>
        </div>
@endsection