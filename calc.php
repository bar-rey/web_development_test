<?php
    $depo_date = strtotime($_POST["depoDate"]);
    $depo_sum = (int)$_POST["depoSum"];
    $depo_term = (int)$_POST["depoTerm"];
    $depo_addition = $_POST["depoAddition"] == "yes";
    $depo_addition_sum = (int)$_POST["depoAdditionSum"];

    $summadd = $depo_addition ? $depo_addition_sum : 0;
    $percent = 0.1;
    $summn = 0;
    $summ_prev = $depo_sum;
    $daysn = cal_days_in_month(CAL_GREGORIAN, date("m", $depo_date), date("Y", $depo_date));
    $daysy = date('L', $depo_date) ? 366 : 365;

    $current_year = date('Y', $depo_date);
    $current_month = date('m', $depo_date);
    $current_month = date("$current_year-$current_month-01");

    $year_counter = 1;
    while ($year_counter <= $depo_term) {
        $month_counter = 1;
        while ($month_counter <= 12) {
            if ($year_counter == 1 && $month_counter == 1) {
                $daysn = cal_days_in_month(CAL_GREGORIAN, date('m', $depo_date), date('Y', $depo_date)) - date('j', $depo_date);
            } elseif ($year_counter == $depo_term && $month_counter == 12) {
                $daysn = cal_days_in_month(CAL_GREGORIAN, date('m', $depo_date), strtotime($current_month)) - date('j', $depo_date);
            } else {
                $daysn = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($current_month)), date('Y', strtotime($current_month))); 
            }
            $summn = $summ_prev + ($summ_prev + $summadd) * $daysn * ($percent / $daysy);
            $summ_prev = $summn;
            $current_month = date('Y-m-d', strtotime("+1 month", strtotime($current_month)));

            $month_counter++;
        }

        $year_counter++;
    }

    echo round($summn - $depo_sum, 2);
?>