<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
 if(CModule::IncludeModule("iblock")){ } 
$section_id = intval($arParams["SECTION_ID"]);
$iblock_id = intval($arParams["IBLOCK_ID"]);
	$arVariables = array();
if($arParams["SEF_MODE"]=="Y")
{

	$page = CComponentEngine::ParseComponentPath($arParams["SEF_FOLDER"], $arParams["SEF_URL_TEMPLATES"], $arVariables);

	$section_id = intval($arVariables["SECTION_ID"]);
	$arParams["SECTION_ID"] = intval($arVariables["SECTION_ID"]);
}
$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock_id, "SECTION_ID"=>$section_id),false); 
if($res=$ar_result->GetNext()){
	$filters = false;
	if(count($_SESSION["filter"])>0||count($_SESSION["filter_price"])>0)
	{
		$filters = true;
	}
	if(isset($arVariables["params"])||$filters){
		$this->IncludeComponentTemplate("list");
	}
	else
	{
		$this->IncludeComponentTemplate("sections");
	}
}
else
{
	$this->IncludeComponentTemplate("list");
}

?>