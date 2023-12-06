<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arPrice = array();
if(CModule::IncludeModule("catalog"))
{
	$rsPrice=CCatalogGroup::GetList($v1="sort", $v2="asc");
	while($arr=$rsPrice->Fetch())
		$arPrice[$arr["ID"]] = "[".$arr["NAME"]."] ".$arr["NAME_LANG"];
}
else
{
	$arPrice = $arProperty_N;
}

$arComponentParameters = array(

	"PARAMETERS" => array(
		"IBLOCK_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"IBLOCK_SPECIFICATION_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_SPECIFICATION_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"SEF_MODE" => Array(
			"sections" => array(
				"NAME" => GetMessage("SECTIONS_TOP_PAGE"),
				"DEFAULT" => "#SECTION_ID#/",
				"VARIABLES" => array(),
			),
			"list" => array(
				"NAME" => GetMessage("SECTION_LIST_PAGE"),
				"DEFAULT" => "#SECTION_ID#/#params#",
				"VARIABLES" => array(),
			),			
		),
		"SECTION_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_SECTION"),
			"TYPE" => "STRING",
		),
		"FILTER_NAME" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_FILTER_NAME_OUT"),
			"TYPE" => "STRING",
			"DEFAULT" => "arrFilterS",
		),
		"RESULT_URL" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_FILTER_RESULT_URL"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"IBLOCK_PRICE_CODE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_PRICE_CODE"),
			"TYPE" => "LIST",
			"VALUES" => $arPrice,
		),
	),
);
?>