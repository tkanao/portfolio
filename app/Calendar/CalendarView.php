<?php
namespace App\Calendar;

use Carbon\Carbon;
// Yasumiを使う
use Yasumi\Yasumi;
use App\Transaction;

class CalendarView {
    private $carbon;
    
    function __construct($date){
        $this->carbon = new Carbon($date);
    }
    
    // タイトル
    public function getTitle(){
        return $this->carbon->format('Y年 n月');
    }
            
    // 次の月
    public function getNextMonth(){
        return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
    }
    
    // 前の月
    public function getPreviousMonth(){
        return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
    }
    
    // カレンダーを出力
    function render(){
        // カレンダーのテーブル
        $html = [];
        $html[] = '<div class="calendar">';
        $html[] = '<table class="table">';
        $html[] = '<thead>';
        $html[] = '<tr>';
        $html[] = '<th>日</th>';
        $html[] = '<th>月</th>';
        $html[] = '<th>火</th>';
        $html[] = '<th>水</th>';
        $html[] = '<th>木</th>';
        $html[] = '<th>金</th>';
        $html[] = '<th>土</th>';
        $html[] = '</tr>';
        $html[] = '</thead>';
        
        $html[] = '<tbody>';
        
        $weeks = $this->getWeeks();
        
        foreach($weeks as $week){
            $html[] = '<tr class="'.$week->getClassName().'">';
            $days = $week->getDays();
            
            foreach($days as $day){
                $html[] = '<td class="'.$day->getClassName().'">';
                
                $html[] = $day->render();
            
                    if(is_a($day, 'CalendarWeekDay')){
                        // 収支のデータを取得
                        $transactions = Transaction::where('date', 'LIKE', "%{$day}%")->get();
                        // 収支のデータをカレンダーに表示する
                        foreach($transactions as $transaction) {
                            if ($transaction->date == $day) {
                                $html[] = $transaction->amount;
                            }
                        }
                    }
                $html[] = '</td>';}
            $html[] = '</tr>';
        }
        
        $html[] = '</tbody>';
        
        $html[] = '</table>';
        $html[] = '</div>';
        
        return implode("", $html);
    }    
    
    // 週の情報を取得する関数を作成
    protected function getWeeks(){
        $weeks = [];
        
        // 初日
        $firstDay = $this->carbon->copy()->firstOfMonth();
        
        // 月末日
        $lastDay = $this->carbon->copy()->lastOfMonth();
        
        // １週目
        $week = new CalendarWeek($firstDay->copy());
        $weeks[] = $week;

        // 週の始めを日曜日に設定
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        // 作業用の日
        $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
        
        // 月末までループさせる
        while($tmpDay->lte($lastDay)){
            // 週カレンダーViewを作成する
            $week = new CalendarWeek($tmpDay, count($weeks));
            $weeks[] = $week;
            
            // 次の週=+7日する
            $tmpDay->addDay(7);
        }
        
        return $weeks;
    }
    
	

}