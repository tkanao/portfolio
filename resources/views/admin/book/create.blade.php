@extends('layouts.admin')

@section('title', '家計簿')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-4 float-right">
                        <div class="balance">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="40%">貯蓄額</td>
                                        <td width="60%">{{ $account->balance }}円</td>
                                    </tr>
                                    <tr>
                                        <td>今月の収支</td>
                                        <td>{{ $transaction_monthly }}円</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <a class="btn btn-outline-secondary float-left" href="{{ url('admin/book/create/?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
                            <span>{{ $calendar->getTitle() }}</span>
                            <a class="btn btn-outline-secondary float-right" href="{{ url('admin/book/create/?date=' . $calendar->getNextMonth()) }}">次の月</a>
                        </div>
                        <div class="card-body">
                            {!! $calendar->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection