<?php

include("consts.php");
include("valuesFromInputs.php");

//1 кубометр = 1000 литров ; 1 час = 3600 секунд
$FuelConsumption_ThousandM3_Year = $first_quarter + $second_quarter + $third_quarter + $fourth_quarter;
#print_r('Тыс. М3/год: ' . $FuelConsumption_ThousandM3_Year . '<br>');

// max из 4-х кварталов, переводим из тыс.м3 в м3
$unknown = 2160;
$FuelConsumption_M3_Hour = round(((max($first_quarter, $second_quarter, $third_quarter, $fourth_quarter) * 1000) / (double)$unknown), 3);
#print_r('М3/час: ' . $FuelConsumption_M3_Hour . '<br>');

// Переводим из м3/час на литры в секунду
$FuelConsumption_Litrs_Second = round(($FuelConsumption_M3_Hour * 1000 / 3600), 3);
#print_r('Литры/секунду: ' . $FuelConsumption_Litrs_Second . '<br>');

//В 1 калории = 4.18 Дж
$HeatOfCombustion_MDj_M3 = round(((Q_KKAL * 1000 * 4.18) / 1000000), 3);
#print_r('МегаДжоули/метр кубический (М3): ' . $HeatOfCombustion_MDj_M3 . '<br>');

?>