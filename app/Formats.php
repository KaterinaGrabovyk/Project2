<?php
namespace App;
class Formats{
function Amount(float $amount):string{
     $formatted = number_format(abs($amount), 2, '.', ' ');
        if ($amount < 0) {
            return "<span style='color:red'>-{$formatted}</span>";
        } elseif ($amount > 0) {
            return "<span style='color:green'>{$formatted}</span>";
        }
        return $formatted;
}
function DateN(string $date):string{
    return date('M j, Y',strtotime($date));
}
}
