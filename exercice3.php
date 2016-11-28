<?php
/**
 * Created by PhpStorm.
 * User: meg4r0m
 * Date: 28/11/16
 * Time: 00:11
 */
echo date("l d F Y")."<br /><br />";
echo "En français:<br />";
setlocale(LC_TIME, 'fr_FR.utf8','fra');
echo strftime("%A %d %B %Y");