// <?php

// namespace App\Http\Controllers\Ajax;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Transaction;

// class ChartController extends Controller
// {
//     public function index(Request $request) {
//         // 月毎のデータを取り出す
//         $transaction_list = Transaction::where("date", "like", date("Ym") . "%")->get();
        
//         return view("admin.book.index", ["transaction_list" => $transaction_list]);
//     }
// }
