<?php
namespace App\Calendar;

use Carbon\Carbon;

class CalendarView {
    private $carbon;
    
    function __construct($date){
        $this->carbon = new Carbon($date);
    }
    
    // タイトル
    public function getTitle(){
        return $this->carbon->format('Y年 n月');
    }
    
    // カレンダーを出力
    function render(){
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