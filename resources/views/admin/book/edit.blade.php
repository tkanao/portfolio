@extends('layouts.admin')
@section('title', '収支の入力')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto mt-5">
                    <input type="text" class="form-control" name="date">
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
                                            <label><input type="radio" name="balance" value="income">収入</input></label>
                                        </div>
                                        <div>
                                            <label><input type="radio" name="balance" value="outcome">支出</label>
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
        </div>
@endsection