<?php
/**
 * Created by PhpStorm.
 * User: meg4r0m
 * Date: 28/11/16
 * Time: 00:29
 */
$datejour = time();
$date = strtotime('16-05-2016');
$diffDate = $datejour - $date;

echo floor($diffDate/86400);