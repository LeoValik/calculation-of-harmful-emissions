<?php

// Характеристика топлива Табл.2
const Q_KKAL = 8710; # Теплота сгорания Q, Ккал/м^3
const AIR_V = 11.3; # Удел.расх.воздуха V, м^3/м^3

// Значения некоторых коэффициентов Табл.3
const ALPHA = 1.2;
const Q4 = 0.5;
const K_CO = 0.25;
const K_NO2 = 0.075;
const BETA = 0;

// Значения коефициэнта А
const F = 1; /* Для газообразных вредных веществ и мелкодисперсных аэрозолей, 
               подчиняющихся закону Стокса F = 1
               */ 
const A = 200; # южнее 50 градусов с.ш.

?>