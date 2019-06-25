<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2019/06/20
 *
 */

namespace DebugTimer;


class DebugTimerLog {
    private static $start_timer;
    private static $timer_title;
    private static $loop_timer;

    static function start($timer_title = 'タイマー') {
        \Log::info($timer_title . ' 計測開始');
        DebugTimerLog::$timer_title = $timer_title;
        $start = microtime(TRUE);
        DebugTimerLog::$start_timer = $start;
        DebugTimerLog::$loop_timer = $start;
    }

    static function time($title = '') {
        $now = microtime(TRUE);
        $before_run_time = round($now - DebugTimerLog::$loop_timer, 3);
        $total_run_time = round($now - DebugTimerLog::$start_timer, 3);
        \Log::info(DebugTimerLog::$timer_title . ' ' . $title
            . ' RUN:' . $before_run_time . '秒'
            . ' TOTAL:' . $total_run_time . '秒'
        );

        //loopタイマーをリセット
        DebugTimerLog::$loop_timer = $now;
    }

    static function end() {
        \Log::info(DebugTimerLog::$timer_title . ' 計測終了　' . round(microtime(TRUE) - DebugTimerLog::$start_timer, 3) . '秒');
    }
}