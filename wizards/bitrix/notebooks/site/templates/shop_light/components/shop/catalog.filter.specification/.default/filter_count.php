<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
function arr_in_arr($values, $stack)
{
	$result=false;
	foreach($values as $val)
	{
		if(!in_array($val,$stack))
		{
			return false;
		}
	}
	return true;
}

if (!function_exists('json_encode')) {  
    function json_encode($value) 
    {
        if (is_int($value)) {
            return (string)$value;   
        } elseif (is_string($value)) {
	        $value = str_replace(array('\\', '/', '"', "\r", "\n", "\b", "\f", "\t"), 
	                             array('\\\\', '\/', '\"', '\r', '\n', '\b', '\f', '\t'), $value);
	        $convmap = array(0x80, 0xFFFF, 0, 0xFFFF);
	        $result = "";
	        for ($i = mb_strlen($value) - 1; $i >= 0; $i--) {
	            $mb_char = mb_substr($value, $i, 1);
	            if (mb_ereg("&#(\\d+);", mb_encode_numericentity($mb_char, $convmap, "UTF-8"), $match)) {
	                $result = sprintf("\\u%04x", $match[1]) . $result;
	            } else {
	                $result = $mb_char . $result;
	            }
	        }
	        return '"' . $result . '"';                
        } elseif (is_float($value)) {
            return str_replace(",", ".", $value);         
        } elseif (is_null($value)) {
            return 'null';
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_array($value)) {
            $with_keys = false;
            $n = count($value);
            for ($i = 0, reset($value); $i < $n; $i++, next($value)) {
                        if (key($value) !== $i) {
			      $with_keys = true;
			      break;
                        }
            }
        } elseif (is_object($value)) {
            $with_keys = true;
        } else {
            return '';
        }
        $result = array();
        if ($with_keys) {
            foreach ($value as $key => $v) {
                $result[] = json_encode((string)$key) . ':' . json_encode($v);    
            }
            return '{' . implode(',', $result) . '}';                
        } else {
            foreach ($value as $key => $v) {
                $result[] = json_encode($v);    
            }
            return '[' . implode(',', $result) . ']';
        }
    } 
}

if(CModule::IncludeModule('iblock')) 
{ 


$filter_value=$_REQUEST["filter_prop"];
$filter_price = $_REQUEST["filter_price"];

//print_r($filter_price);


$filter=Array("LOGIC"=>"OR");
foreach($filter_value as $fv)
{
	$filter[]= array("PROPERTY_specification" => $fv);
}

$arfs = Array();
if($_REQUEST["SECTION_ID"]>0)
{
	$arfs["SECTION_ID"] = $_REQUEST["SECTION_ID"];
}

	$rsElements = CIBlockElement::GetList( 
		array() //порядок следования элементов не важен 
		,array_merge($arfs,array( 
			"IBLOCK_ID" => $_REQUEST["IBLOCK_ID"], 			
			"INCLUDE_SUBSECTIONS" => "Y",
			$filter,
			">=CATALOG_PRICE_1"=>$filter_price[0],
			"<=CATALOG_PRICE_1"=>$filter_price[1]
		) )
		,false 
		,false 
		,array("ID","IBLOCK_ID","NAME", "PROPERTY_specification","CATALOG_GROUP_1") // только нужные поля 
	); 
	$arList = array(); //результат 
	$res_prop = array();
	while($arElement = $rsElements->GetNext()) 
	{ 
		if(arr_in_arr($filter_value,$arElement["PROPERTY_SPECIFICATION_VALUE"]))
		{
			$arList[$arElement["ID"]] = $arElement; 
			$res_prop = array_unique(array_merge($res_prop,$arElement["PROPERTY_SPECIFICATION_VALUE"]));
		}		
	} 
	echo json_encode(Array("count"=>count($arList),"props"=>$res_prop));
}
?>

