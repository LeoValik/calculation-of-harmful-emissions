<?php 

include("consts.php");

$first_quarter = $_GET['first'];
$second_quarter = $_GET['second'];
$third_quarter = $_GET['third'];
$fourth_quarter = $_GET['fourth'];

$D = $_GET['D'];
$H = $_GET['H'];
$delta_T = $_GET['T'];
$PDK_CO = $_GET['PDK_CO'];
$PDK_NO2 = $_GET['PDK_NO2'];

print_r($first_quarter . '<br>');
print_r($second_quarter . '<br>');
print_r($third_quarter . '<br>');
print_r($fourth_quarter . '<br>');
print_r($D . '<br>');
print_r($H . '<br>');
print_r($delta_T . '<br>');
print_r($PDK_CO . '<br>');
print_r($PDK_NO2 . '<br>');

?>