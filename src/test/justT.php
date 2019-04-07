<?php
$string = 'Trailer Coleção Brinquedo Assassino (1988-2017) – BluRay 720p ';
$pos = 0;
$posAr = [];
$posAr[0] = (strpos(strtoupper($string),'TORRENT') != null) ? strpos(strtoupper($string),'TORRENT') : 1000 ;
$posAr[1] = (strpos($string,'(') != null) ? strpos($string,'(') : 1000 ;
$posAr[2] = (strpos($string,'/') != null) ? strpos($string,'/') : 1000 ;
$posAr[3] = (strpos($string,'-') != null) ? strpos($string,'-') : 1000 ;
$posAr[4] = (strpos($string,'–') != null) ? strpos($string,'–') : 1000 ;
$posAr[5] = 30;

$pos = min($posAr);

 ?>
