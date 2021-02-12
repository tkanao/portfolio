@extends('layouts.admin')

@section('title', '家計簿')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="float-right border p-2 col-4">今月は10000円です</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="float-right border p-2 col-4">現在の資産残高は167800円です</div>
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