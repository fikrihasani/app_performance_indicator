<?php
 /*
 penulis: AhmadRofiul
 WA		: 08980025672
 */

 //Mendefinisikan Konstanta
 define('HOST','localhost');
 define('USER','u1068586_admin');
 define('PASS','bandara30');
 define('DB','u1068586_cleaningperfomance');
 
 date_default_timezone_set('Asia/Jakarta');

 //membuat koneksi dengan database
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
 ?>
