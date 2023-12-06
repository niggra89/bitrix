<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// if (!function_exists('__str_slider_inc'))
// {
// 	function __str_slider_inc()
// 	{
// 		static $i = 0;
// 		return ++$i;
// 	}
// }

// if ($arParams['TIME'] <= 0)
// 	$arParams['TIME'] = 5;
// 	$arParams['TIME'] = intval($arParams['TIME']);

if ($this->StartResultCache(false))
{
	if (!CModule::IncludeModule('iblock'))
	{
		$this->AbortResultCache();
		return;
	}

	$arResult = array();

	$arIBlockID = False;

	$iblocks = GetIBlockList("slider");
	while($arIBlock = $iblocks->GetNext()) //цикл по всем блокам
	{
		$arIBlockID = $arIBlock["ID"]; 
		break;
	}

	$n = "0";
	$arFilter = Array('IBLOCK_ID'=>$arIBlockID, 'ACTIVE'=>'Y');  
	$db_list = CIBlockSection::GetList(Array("sort"=>"asc"), $arFilter, true); 
	while($ar_result = $db_list->GetNext())  {
		if($ar_result['ELEMENT_CNT']>0){
			$arResult[$n] = $ar_result;
			$arSelect_el = Array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_LINK", "PROPERTY_PRICE");
			$arFilter_el = Array("IBLOCK_ID"=>$arIBlockID, "ACTIVE"=>"Y", "SECTION_ID" => $ar_result['ID']);
			$res_el = CIBlockElement::GetList(Array(), $arFilter_el, false, false, $arSelect_el);
			while($ob_el = $res_el->GetNextElement())
			{
			  $arFields_el = $ob_el->GetFields();
			  $arResult[$n]["ELEMENTS"][] = $arFields_el;
			}
			$n++;
		}
	}

	$this->IncludeComponentTemplate();
}
?>