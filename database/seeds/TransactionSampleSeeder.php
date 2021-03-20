<?php
use Illuminate\Database\Seeder;
use App\Transaction;

class TransactionSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 開始日を２ヶ月前にする
        $start = strtotime("-2 month");
        // 作成する日数
        $days = 60;
        // 項目の設定
        $memos = [
            "食費",
            "交際費",
            "交通費",
            "衣料品",
            "日用品",
            ];
            
            for($i = 0 ; $i < $days; $i++){
                // 作成する日
                $date = $start + $i * 24 * 60 * 60;
                $transaction = new Transaction();
                $transaction->memo = Arr::random($memos);
                $transaction->date = date("Y-m-d", $date);
                $transaction->amount = rand(10, 100) * 100;
                $transaction->save();
            }
            
    }
}
