<?php
/*
powered by:xlogion
email:xlogion@gmail.com
web:http://www.xlogion.com
*/

class array_encode{
	public $type;
	public $rootNodeName='root';
	public $type_fnc=array(
					'json'=>'a_json',
					'pjson'=>'a_pjson',
					'xml'=>'a_xml',
					'serialize'=>'a_serialize',
					);

	function __construct($type='json') {
		$this->type = $type;
	}
	
	function rootNodeName($rootNodeName) {
		$this->rootNodeName = $rootNodeName;
	}

	function encode($array) {
		if(method_exists($this, $this->type_fnc[$this->type])) { 
           return call_user_func(array($this,$this->type_fnc[$this->type]), $array); 
         }
		 else{ 
           throw new Exception(sprintf('The required method "'.$this->type_fnc[$this->type].'" does not exist for!', $this->type_fnc[$this->type], get_class($this))); 
         } 
	}

	private function a_json($array) {
		return json_encode($array);
	}

	private function a_pjson($array) {
		return $this->JSON($array);
	}

	private function a_xml($array) {
		if (ini_get('zend.ze1_compatibility_mode') == 1)
		{
			ini_set ('zend.ze1_compatibility_mode', 0);
		}
		return $this->toXml($array,$this->rootNodeName);
	}
	
	private function a_object($array) {
		$array = json_encode($array);
		$array = json_decode($array);
		return $array;
	}

	private function a_serialize($array) {
		$array = serialize($array);
		return $array;
	}

	private function JSON($array) {
    $this->arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
	}

	private function arrayRecursive(&$array, $function, $apply_to_keys_also = false) {
		static $recursive_counter = 0;
		if (++$recursive_counter > 1000) {
			die('possible deep recursion attack');
		}
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				 $this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
			} else {
				$array[$key] = $function($value);
			}
			if ($apply_to_keys_also && is_string($key)) {
				$new_key = $function($key);
				if ($new_key != $key) {
					$array[$new_key] = $array[$key];
					unset($array[$key]);
				}
			}
		}
		$recursive_counter--;
	}

	private function toXml($data, $rootNodeName = 'root', $xml=null) {
		if ($xml == null)
		{
			$xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
		}
		foreach($data as $key => $value)
		{
			if (is_numeric($key))
			{
				$key = "unknownNode_". (string) $key;
			}
			
			if (is_array($value))
			{
				$node = $xml->addChild($key);
				$this->toXml($value, $rootNodeName, $node);
			}
			else 
			{
                $value =htmlentities($value,ENT_QUOTES,'UTF-8');
				$xml->addChild($key,$value);
			}
			
		}

		return $xml->asXML();
	}
	
	
}