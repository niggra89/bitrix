<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
	return;

$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	
	
$arComponentParameters = array(
	"PARAMETERS" => array(
	
		"ELEMENT_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_ELEMENT"),
			"TYPE" => "STRING",			
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		
	),
);

?>