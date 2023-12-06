<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("CC_BCF_MODULE_NOT_INSTALLED"));
	return;
}

/*************************************************************************
	Processing of received parameters
*************************************************************************/


$arParams["ELEMENT_ID"] = intval($arParams["ELEMENT_ID"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arResult = Array();
/*************************************************************************
	Component
*************************************************************************/

$section_id;$block_id;
	$res = CIBlockElement::GetByID($arParams["ELEMENT_ID"]);
	if($ar_res = $res->GetNext()){
		$section_id = $ar_res["IBLOCK_SECTION_ID"];
		$block_id = $ar_res["IBLOCK_ID"];
	}
	$sect = $section_id;
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
	}
	

	if($link_res)
	{
		//-------------------------------- получаем список элементов с набором свойств --------------------------------------//	
		
		$res_prop = array();
		$result = Array();
		$db_props = CIBlockElement::GetProperty($block_id, $arParams["ELEMENT_ID"], array("sort" => "asc"), Array("CODE"=>"specification"));
		while($ar_props = $db_props->GetNext()){
			$res_prop[] = IntVal($ar_props["VALUE"]);
		}
		//-------------------------------------------------------------------------------------------------------------------//
		
		$specificId = $link_res["PROPERTY_SPECIFICATION_VALUE"];
		
		$res2 = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$specificId), false);
		while($ar_res2 = $res2->GetNext())
		{
			$val = Array();
			$res3 = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$ar_res2["ID"]), false);
			while($ar_res3 = $res3->GetNext())
			{
				
				$res4=CIBlockElement::GetList(Array("SORT"=>"ASC"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_SPECIFICATION_ID"],"SECTION_ID"=>$ar_res3["ID"]), false); 
					
				while($ar_res4 = $res4->GetNext())
				{
					if(in_array($ar_res4["ID"],$res_prop))
					{
						$val[] = Array("NAME"=>$ar_res3["NAME"],"VALUE"=>$ar_res4["NAME"]);	
					}					
				}
						
			}
			
			if(count($val)>0)
				$result[]=Array("NAME"=>$ar_res2["NAME"],"VALUES"=>$val);		
		}
		$arResult = $result;
	}
	
$this->IncludeComponentTemplate();
?>
