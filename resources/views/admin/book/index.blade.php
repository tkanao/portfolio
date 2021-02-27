@extends('layouts.admin')
@section('title', '今月の収支一覧')
@section('content')
    <div class="container">
        <!--検索画面-->
        <form action="{{ action('Admin\AccountController@index') }}" method="get">
        <div class="row">
            <div class="col-md-5 mt-5 ml-5"><h4>月</h4></div>
                <div class="col-md-8 mt-1 mx-auto">
                    <input type="month" class="form-control" name="cond_date" value="{{ $cond_date }}">
                </div>
                <div class="col-md-2 mt-1">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="検索">
                </div>
        </div>
        </form>
        <!--表示画面-->
            <div class="row">
                <div class="col-10 mt-3 mx-auto text-center">
                    <div class="row">
                        <table border="1" width="100%">
                            <thead>
                                <tr>
                                    <th width="20%">日付</th>
                                    <th width="20%">項目</th>
                                    <th width="20%">収支</th>
                                    <th width="20%">金額</th>
                                    <th width="20%">取引後の残高</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $transaction)
                                    <tr>
                                        <td>{{ $transaction->date }}</td>
                                        <td>{{ $transaction->memo }}</td>
                                        <td>{{ $transaction->transaction_type }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->balance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" width="50%">今月の合計</td>
                                    <td colspan="2">{{ $monthly_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection