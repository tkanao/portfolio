@extends('layouts.admin')
@section('title', '今月の収支一覧')
@section('content')
    <div class="container">
        <!--検索画面-->
        <form action="{{ action('Admin\AccountController@index') }}" method="get">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h4>明細一覧</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mt-3 mx-auto">
                    <input type="month" class="form-control" name="cond_date" value="{{ $cond_date }}">
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="col-4 float-right">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary float-right" value="検索">
                    </div>
                </div>
            </div>
        </form>
        <!--表示画面-->
        <div class="row">
        <div class="col-md-6 mx-auto">
        <canvas id="myChart" width="200" height="200"></canvas>
            <script>
                // ラベル
                var labels = @json($memo);
                var amount = @json($amount);
                
            	var ctx = document.getElementById('myChart').getContext('2d');
            	var chart = new Chart(ctx, {
            		type: 'pie',
            		data: {
            			labels: labels,
            			datasets: [{
            				label: 'マイグラフ',
            				data: amount,
            			}]
            		},
            		options: {
            	        plugins: {
                            colorschemes: {
                                scheme: 'tableau.Tableau20'
                            }
                        }
                            		}
            	});	
           </script>        
            
        </div>
        </div>
        <div class="total mt-3">
            <div class="col-lg-10 col-md-6 mt-4 mx-auto text-center">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th colspan="3">今月の収支</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="income" width="33%"><div class="font">収入</div>{{ $monthly_income }}円</td>
                            <td class="outcome" width="34%"><div class="font">支出</div>{{ $monthly_outcome }}円</td>
                            @if($monthly_total > 0)
                                <td class="income" width="33%"><div class="font">合計</div>{{ $monthly_total }}円</td>
                            @else
                                <td class="outcome" width="33%"><div class="font">合計</div>{{ $monthly_total }}円</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-10 mt-4 mx-auto text-center">
                <div class="row index">
                    <table border="2" width="100%">
                        <thead rules="box">
                            <tr>
                                <th width="10%">登録順</th>
                                <th width="90%" colspan="2">明細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cond_date != '')
                                @foreach($posts as $transaction)
                                    <tr>
                                        <td rowspan="2" class="id">{{ $transaction->id}}</td>
                                        <td class="date" colspan="2">{{ $transaction->date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $transaction->memo }}</td>
                                        <td>
                                            <div>残高{{ $transaction->balance }}円</div>
                                            @if($transaction->amount > 0)
                                                <div class="income">{{ $transaction->amount }}円</div>
                                            @else
                                                <div class="outcome">{{ $transaction->amount }}円</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection