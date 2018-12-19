<?php
/*Example of read configuration
$globalCss = Configure::read('ads');
*/

$config['ads'][]=array('img' => 'assets/img/right_side_ads/FSIBL.gif', 'link' => '#', 'position' => 1, 'height' => 200, 'active' => 1);
$config['ads'][]=array('img' => 'assets/img/right_side_ads/ifad_autos.gif', 'link' => '#', 'position' => 2, 'height' => 200, 'active' => 1);
$config['ads'][]=array('img' => 'assets/img/right_side_ads/khan_brothers_ltd.gif', 'link' => '#', 'position' => 3, 'height' => 200, 'active' => 1);
$config['ads'][]=array('img' => 'assets/img/right_side_ads/web-small.png', 'link' => '#', 'position' => 4, 'height' => 200, 'active' => 1);
$config['ads'][]=array('img' => 'assets/img/right_side_ads/vat_center.gif', 'link' => '#', 'position' => 5, 'height' => 200, 'active' => 1);







$adsArr=$config['ads'];
$adsArr=Hash::extract($adsArr, "{n}[active=1]");
$adsArr=Hash::sort($adsArr, '{n}.position', 'asc');
$config['ads']=$adsArr;