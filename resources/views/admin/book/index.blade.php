@extends('layouts.admin')
@section('title', '今月の収支一覧')
@section('content')
    <div class="container">
            <div class="row">
                <div class="col-10 mx-auto text-center">
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
                                    <td colspan="2" width="50%">今月の合計</td>
                                    <!--<td> $ammount </td>-->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection