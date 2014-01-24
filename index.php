<?php
header('Content-type: text/html; charset=UTF-8');
require_once('lib/php.arrayencode.class.php');
$array = array
       (
          'Name'=>'钰哲',
          'Age'=>array
				   (
					  'Name'=>'钰哲',
					  '钰哲'=>array
						   (
							  'Name'=>'钰哲',
							  'Age'=>30
						   )
				   )
       );

$a = new array_encode('serialize');
$result=$a->encode($array);
echo $result;