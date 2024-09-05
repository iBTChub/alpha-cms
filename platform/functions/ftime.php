<?php

# Функция отображения времени
function ftime($time) {
    $time = $time ?? TM;
    $timed = "j M Y, H:i";
    $timep = date($timed, $time);
    $time_p = [date("j n Y", $time), date("H:i", $time)];

    // Сегодня
    if ($time_p[0] == date("j n Y")) {
        return date("H:i", $time);
    }

    // Вчера
    if ($time_p[0] == date("j n Y", TM - 60 * 60 * 24)) {
        return lg('Вчера в') . " " . $time_p[1];
    }

    // Замена месяцев
    $month_map = [
        "Jan" => 'Янв', "Feb" => 'Фев', "Mar" => 'Мар', "Apr" => 'Апр',
        "May" => 'Мая', "Jun" => 'Июн', "Jul" => 'Июл', "Aug" => 'Авг',
        "Sep" => 'Сен', "Oct" => 'Окт', "Nov" => 'Ноя', "Dec" => 'Дек'
    ];

    return str_replace(array_keys($month_map), array_values($month_map), $timep);
}

# Функция, показывающая время, прошедшее с момента $times
function stime($times) {
    // Приводим к числу, чтобы избежать ошибки
    $times = (int)$times;
    $lama = round((TM - $times) / 60);

    if ($lama < 1) {
        return lg("только что");
    } elseif ($lama < 60) {
        return $lama . " " . lg('м. назад');
    } elseif ($lama < 1440) {
        return round($lama / 60) . " " . lg('ч. назад');
    } else {
        return round($lama / 60 / 24) . " " . lg('д. назад') . " (" . ftime($times) . ")";
    }
}

# Функция обратного отсчета времени
function otime($timediff) {
    $dayfield = floor($timediff / (60 * 60 * 24));
    $hourfield = floor(($timediff % (60 * 60 * 24)) / (60 * 60));
    $minutefield = floor(($timediff % (60 * 60)) / 60);
    $secondfield = $timediff % 60;

    $time = '';
    if ($hourfield > 0) { $time .= $hourfield . " " . lg('ч.') . " "; }
    if ($minutefield > 0) { $time .= $minutefield . " " . lg('м.') . " "; }
    if ($secondfield > 0) { $time .= $secondfield . " " . lg('с.') . " "; }

    return $time;
}
