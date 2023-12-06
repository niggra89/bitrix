<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("CC_BCF_MODULE_NOT_INSTALLED"));
	return;
}

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
if(intval($arParams["ELEMENT_ID"])==0)
{
	$arVariables = array();
	$page = CComponentEngine::ParseComponentPath($arParams["SEF_FOLDER"], $arParams["SEF_URL_TEMPLATES"], $arVariables);
	
	$arParams["ELEMENT_ID"] = $arVariables["ELEMENT_ID"];
}
$this->IncludeComponentTemplate("element");
?>