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
                                    <th width="30%">日付</th>
                                    <th width="30%">項目</th>
                                    <th width="30%">金額</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" width="50%">今月の合計</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection