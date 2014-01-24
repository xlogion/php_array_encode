#php_array_encode
----
- ### 说明
    
    ```
    php_array_encode
    
    是一个方便将PHP数组转换成任意格式的类
    ```
    
- ### 使用
	
	`require_once('lib/php.arrayencode.class.php');`
	
- ### header


    `header('Content-type: text/html; charset=UTF-8');`
    
    `header('Content-type: application/json; charset=UTF-8');`
    
    `header('Content-type: text/xml; charset=UTF-8');`
	
- ### JSON
	
	```
	$a = new array_encode('json'); 
	$result=$a->encode($array);
	echo $result;
	```
	
	```
	{"Name":"\u94b0\u54f2","Age":{"Name":"\u94b0\u54f2","\u94b0\u54f2":{"Name":"\u94b0\u54f2","Age":30}}}
	```
	
- ### Read_JSON

	```
	$a = new array_encode('pjson'); 
	$result=$a->encode($array);
	echo $result;
	```
	
	```
	{{"Name":"钰哲","Age":{"Name":"钰哲","钰哲":{"Name":"钰哲","Age":"30"}}}
	```
	
- ### xml
	
	```
	$a = new array_encode('xml');
	$result=$a->rootNodeName('xlogion');
	$result=$a->encode($array);
	echo $result;
	```
	
	```
	<xlogion>
		<Name>钰哲</Name>
		<Age>
			<Name>钰哲</Name>
			<钰哲>
				<Name>钰哲</Name>
				<Age>30</Age>
			</钰哲>
		</Age>
	</xlogion>
	```
	
- ### object
	
	```
	$a = new array_encode('object'); 
	$result=$a->encode($array);
	print_r($result);
	```
	
	```
	stdClass Object ( [Name] => 钰哲 [Age] => stdClass Object ( [Name] => 钰哲 [钰哲] => stdClass Object ( [Name] => 钰哲 [Age] => 30 ) ) )
	```
- ### serialize
	
	```
	$a = new array_encode('serialize');
	$result=$a->encode($array);
	echo $result;
	```
	
	```
	a:2:{s:4:"Name";s:6:"钰哲";s:3:"Age";a:2:{s:4:"Name";s:6:"钰哲";s:6:"钰哲";a:2:{s:4:"Name";s:6:"钰哲";s:3:"Age";i:30;}}}
	```