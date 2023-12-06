<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("CC_BCF_MODULE_NOT_INSTALLED"));
	return;
}
if (!CModule::IncludeModule("catalog")){
	ShowError(GetMessage("CC_BCFC_MODULE_NOT_INSTALLED"));
	return;
}

/*----------------------------------------------------------------------------*/
$arVariables = array();
if($arParams["SEF_MODE"]=="Y"){
	$page = CComponentEngine::ParseComponentPath($arParams["SEF_FOLDER"], $arParams["SEF_URL_TEMPLATES"], $arVariables);

	$section_id = intval($arVariables["SECTION_ID"]);
	$arParams["SECTION_ID"] = intval($arVariables["SECTION_ID"]);
}
/*-----------------------------------------------------------------------------*/
if (!function_exists('arr_in_arr_f')) {
	function arr_in_arr_f($values, $stack)
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
}
if (!function_exists('check_link')) {
	function check_link($id)
	{
		$iblock_configure_id = 0;
		$res = CIBlock::GetList(
			Array(), 
			Array(
				'XML_ID'=>'products-configure_'.SITE_ID
			), true
		);
		while($ar_res = $res->Fetch())
		{
			$iblock_configure_id = $ar_res['ID'];
		}

		$rs=CIBlockElement::GetList(array(), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$iblock_configure_id,"PROPERTY_products"=>$id), false, array("nTopCount"=>1), array("ID","PROPERTY_products","PROPERTY_specification","PROPERTY_required","PROPERTY_filter")); 
		if($ar=$rs->GetNext()) 
		{ 
			return $ar; 
		}
		else
		{
			return false;
		}
	}
}
if (!function_exists('getSpecification')) {
	function getSpecification($section,$selected,$iblock_id,$iblock_specfication_id, $prices_interval,$IBLOCK_PRICE_CODE){
		$sect=$section;
		while(!($link_res = check_link($sect))&&$sect)
		{
			$res1 = CIBlockSection::GetByID($sect);
			if($ar_res1 = $res1->GetNext())
			{
				if($ar_res1['DEPTH_LEVEL']==1)
				{
					$sect=false;
				}
				else
				{
					$sect = $ar_res1['IBLOCK_SECTION_ID'];
				}
			}
			//echo $sect;
		}
		

		$spec = array("ELEM_COUNT"=>0,"SPECIFICATION"=>Array());
		if(!$link_res){		
			return false;
		}
		else
		{
			//-------------------------------- получаем список элементов с набором свойств --------------------------------------//	
			
			$rsElements = CIBlockElement::GetList( 
				array() 
				,array( 
					"IBLOCK_ID" => $iblock_id, 
					"SECTION_ID" => $section,
					"INCLUDE_SUBSECTIONS" => "Y",
					//$filter				
				) 
				,false 
				,false 
				,array("ID","IBLOCK_ID", "PROPERTY_specification", "CATALOG_GROUP_".$IBLOCK_PRICE_CODE) // только нужные поля 
			); 
			$res_prop = array();
			$res_prop_visible = array();
			$res_count = 0;
			$elementsId = array();
			while($arElement = $rsElements->GetNext()) 
			{ 

				$specification = Array();
				if($version == 2)$specification = $arElement["PROPERTY_SPECIFICATION_VALUE"];
				else
				{
					$db_props = CIBlockElement::GetProperty($arElement["IBLOCK_ID"], $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"specification"));
					while($ar_props = $db_props->Fetch()){
						$specification[] = $ar_props["VALUE"];
					}
				}
				if(arr_in_arr_f($selected, $specification)&&(($arElement["CATALOG_PRICE_".$IBLOCK_PRICE_CODE] >= $prices_interval["FROM"]&&$arElement["CATALOG_PRICE_".$IBLOCK_PRICE_CODE] <= $prices_interval["TO"])||(!$prices_interval["FROM"])))
				{
					$res_prop_visible = array_unique(array_merge($res_prop_visible,$specification));
				}
				$res_prop = array_unique(array_merge($res_prop, $specification));
				if( !in_array($arElement["ID"],$elementsId))
				{
					$res_count++;
				}
				$elementsId[$arElement["ID"]] = $arElement["ID"];
			} 
			$spec["COUNT"] = $res_count;
			
			//-------------------------------------------------------------------------------------------------------------------//
			
			$specificId = $link_res["PROPERTY_SPECIFICATION_VALUE"];

			$res2 = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$specificId), false);
			while($ar_res2 = $res2->GetNext())
			{			
				$spec_elem = Array();			
				
				$res3 = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$ar_res2["ID"]), false);
				while($ar_res3 = $res3->GetNext())
				{
					
					$val = Array();
					$res4=CIBlockElement::GetList(Array("SORT"=>"ASC"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$iblock_specfication_id,"SECTION_ID"=>$ar_res3["ID"]), false); 
					$s = "N";		
					while($ar_res4 = $res4->GetNext())
					{
						if(in_array($ar_res4["ID"],$res_prop))
						{
							$v = "N";
							if(in_array($ar_res4["ID"],$res_prop_visible)){
								$v = "Y";
							}
							$val[]=Array("VALUE"=>$ar_res4["NAME"],"ID"=>$ar_res4["ID"],"VISIBLE"=>$v);	
							if(in_array($ar_res4["ID"],$selected)){$s = "Y";}			
						}					
					}
					if(count($val)>0 && in_array($ar_res3["ID"],$link_res["PROPERTY_FILTER_VALUE"]))
						$spec_elem[]=Array("NAME"=>$ar_res3["NAME"],"ID"=>$ar_res3["ID"],"SELECTED"=> $s,"VALUE"=>$val);			
				}
				if(count($spec_elem)>0){
					$spec["SPECIFICATION"][]=Array("NAME"=>$ar_res2["NAME"],"ID"=>$ar_res2["ID"],"VALUES"=>$spec_elem);	
				}				
			}
			
		}

		return $spec;
	}
}
/*************************************************************************
	Processing of received parameters
*************************************************************************/
$arParams["IBLOCK_PRICE_CODE"] = intval($arParams["IBLOCK_PRICE_CODE"]);

$group_prices = Array();
global $USER;
$arGroups = $USER->GetUserGroupArray();
foreach($arGroups as $ag)
{
	$db_res = CCatalogGroup::GetGroupsList(array("BUY"=>"N","CATALOG_GROUP_ID" => $arParams["IBLOCK_PRICE_CODE"],"GROUP_ID" => $ag));
	while ($ar_res = $db_res->Fetch())
	{
	   $group_prices[] = $ar_res;
	}
}
if(count($group_prices)==0)
{
	$arParams["SHOW_PRICE"]="N";
}
else
{
	$arParams["SHOW_PRICE"]="Y";
}
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
if(isset($_SESSION["filter_section"]))
{
	if($_SESSION["filter_section"]!=$arParams["SECTION_ID"])
	{
		$_SESSION["filter_section"]=$arParams["SECTION_ID"];
		unset($_SESSION["filter"]);
		unset($_SESSION["filter_price"]);
	}
}
else
{
	$_SESSION["filter_section"]=$arParams["SECTION_ID"];
}
if(strlen($arParams["FILTER_NAME"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
	$arParams["FILTER_NAME"] = "arrFilter";
$FILTER_NAME = $arParams["FILTER_NAME"];

global $$FILTER_NAME;
$$FILTER_NAME = array();

if(strlen($arParams["FILTER_SPECIFICATION_NAME"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_SPECIFICATION_NAME"]))
	$arParams["FILTER_SPECIFICATION_NAME"] = "arrFilterS";
$FILTER_SPECIFICATION_NAME = $arParams["FILTER_SPECIFICATION_NAME"];

global $$FILTER_SPECIFICATION_NAME;
$$FILTER_SPECIFICATION_NAME = array();

$arResult = Array();

if($arParams["SHOW_PRICE"]=="Y")
{
	$arf = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "INCLUDE_SUBSECTIONS" => "Y");
	$arfs = Array();
	if($arParams["SECTION_ID"]>0){
		$arfs["SECTION_ID"] = $arParams["SECTION_ID"];
	}
	$res = CIBlockElement::GetList(Array("catalog_PRICE_".$arParams["IBLOCK_PRICE_CODE"] => "asc"), array_merge($arf,$arfs), false, Array("nTopCount"=>1), Array("IBLOCK_ID", "ID", "CATALOG_GROUP_".$arParams["IBLOCK_PRICE_CODE"]));
	while($ob = $res->GetNext())
	{
		//print_r($ob);
		$arResult["MIN_PRICE"] = $ob["CATALOG_PRICE_".$arParams["IBLOCK_PRICE_CODE"]];
	}
	$arFilter_ = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$arParams["SECTION_ID"], "ACTIVE"=>"Y","INCLUDE_SUBSECTIONS" => "Y");
	$res = CIBlockElement::GetList(Array("catalog_PRICE_".$arParams["IBLOCK_PRICE_CODE"] => "desc"), array_merge($arf,$arfs), false, Array("nTopCount"=>1), Array("ID", "CATALOG_GROUP_1"));
	while($ob = $res->GetNext())
	{
		$arResult["MAX_PRICE"] = $ob["CATALOG_PRICE_".$arParams["IBLOCK_PRICE_CODE"]];
	}

	$arResult["SELECTED_PRICE"] = Array("FROM" => $arResult["MIN_PRICE"], "TO" => $arResult["MAX_PRICE"]);

	if(isset($_REQUEST["filter_price"]))
	{
		$_SESSION["filter_price"]=$_REQUEST["filter_price"];
	}
	
	$f_price = Array();
	if(isset($_SESSION["filter_price"])){	
		$p = $_SESSION["filter_price"];
		$f_price = Array(">=CATALOG_PRICE_".$arParams["IBLOCK_PRICE_CODE"] => $p["min"],"<=CATALOG_PRICE_".$arParams["IBLOCK_PRICE_CODE"] => $p["max"]);
		
		$arResult["SELECTED_PRICE"]["FROM"] = $p["min"];
		$arResult["SELECTED_PRICE"]["TO"] = $p["max"];
	}
}
/*************************************************************************
	Component
*************************************************************************/
if(isset($_REQUEST["use_filter"]))
{
	$_SESSION["filter"]=$_REQUEST["filter"];
}
	
$props = getSpecification($arParams["SECTION_ID"],$_SESSION["filter"],$arParams["IBLOCK_ID"],$arParams["IBLOCK_SPECIFICATION_ID"],$arResult["SELECTED_PRICE"],$arParams["IBLOCK_PRICE_CODE"]);


if(isset($_SESSION["filter"]))
{
	foreach($props["SPECIFICATION"] as $prop_first_level)
	{
		foreach($prop_first_level["VALUES"] as $prop_name)
		{
			foreach($prop_name["VALUE"] as $prop_value)
			{
				if(in_array($prop_value["ID"],$_SESSION["filter"]))
				{					
					$arResult["SELECTED_VALUE"][]=Array("NAME"=>$prop_name["NAME"],"ID"=>$prop_value["ID"],"VALUE"=>$prop_value["VALUE"]);
				}
			}
		}
	}
}
$arResult["ELEMENTS_COUNT"] = $props["COUNT"];
$arResult["ITEMS"] = $props["SPECIFICATION"];




$$FILTER_NAME=$f_price;

$$FILTER_SPECIFICATION_NAME=$_SESSION["filter"];
$this->IncludeComponentTemplate();

$APPLICATION->AddHeadString('<script>var IBLOCK_ID = '.$arParams["IBLOCK_ID"].';var SECTION_ID = '.$arParams["SECTION_ID"].';</script>',true);
$template =& $this->GetTemplate();
$APPLICATION->AddHeadScript($template->GetFolder().'/spec.js');

?>
