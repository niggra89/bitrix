<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arProperty = array();
$arProperty_N = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	if($arr["PROPERTY_TYPE"] != "F")
		$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];

	if($arr["PROPERTY_TYPE"] == "N")
		$arProperty_N[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
}
$arProperty_LNS = $arProperty;

$arIBlock_LINK = array();
$rsIblock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["LINK_IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIblock->Fetch())
	$arIBlock_LINK[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arProperty_LINK = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["LINK_IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	if (in_array($arr["PROPERTY_TYPE"], array("E")))
	{
		$arProperty_LINK[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arUserFields_S = array("-"=>" ");
$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION");
foreach($arUserFields as $FIELD_NAME=>$arUserField)
	if($arUserField["USER_TYPE"]["BASE_TYPE"]=="string")
		$arUserFields_S[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"]? $arUserField["LIST_COLUMN_LABEL"]: $FIELD_NAME;

$arOffers = CIBlockPriceTools::GetOffersIBlock($arCurrentValues["IBLOCK_ID"]);
$OFFERS_IBLOCK_ID = is_array($arOffers)? $arOffers["OFFERS_IBLOCK_ID"]: 0;
$arProperty_Offers = array();
if($OFFERS_IBLOCK_ID)
{
	$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$OFFERS_IBLOCK_ID));
	while($arr=$rsProp->Fetch())
	{
		if($arr["PROPERTY_TYPE"] != "F")
			$arProperty_Offers[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arPrice = array();
if(CModule::IncludeModule("catalog"))
{
	$rsPrice=CCatalogGroup::GetList($v1="sort", $v2="asc");
	while($arr=$rsPrice->Fetch()) $arPrice[$arr["NAME"]] = "[".$arr["NAME"]."] ".$arr["NAME_LANG"];
}
else
{
	$arPrice = $arProperty_N;
}

$arAscDesc = array(
	"asc" => GetMessage("IBLOCK_SORT_ASC"),
	"desc" => GetMessage("IBLOCK_SORT_DESC"),
);

$arComponentParameters = array(
	"GROUPS" => array(
		"FILTER_SETTINGS" => array(
			"NAME" => GetMessage("T_IBLOCK_DESC_FILTER_SETTINGS"),
		),		
		"PRICES" => array(
			"NAME" => GetMessage("IBLOCK_PRICES"),
		),
	),
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => Array("NAME" => GetMessage("SECTION_ID_DESC")),
			"ELEMENT_ID" => Array("NAME" => GetMessage("ELEMENT_ID_DESC")),
		),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SECTION_ID"),
			"TYPE" => "STRING",	
			"DEFAULT" => "",			
		),
		"FILTER_NAME" => array(
			"PARENT" => "FILTER_SETTINGS",
			"NAME" => GetMessage("FILTER_NAME"),
			"TYPE" => "STRING",	
			"DEFAULT" => "arrFilter",			
		),
		"FILTER_SPECIFICATION_NAME" => array(
			"PARENT" => "FILTER_SETTINGS",
			"NAME" => GetMessage("FILTER_SPECIFICATION_NAME"),
			"TYPE" => "STRING",	
			"DEFAULT" => "arrFilterS",			
		),
		"SHOW_ALL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SHOW_ALL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SHOW_NEW" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SHOW_NEW"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
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
		"PAGE_ELEMENT_COUNT" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_PAGE_ELEMENT_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "30",
		),
		"TOP_LINE_ELEMENT_COUNT" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_TOP_LINE_ELEMENT_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "2",
		),
		"ELEMENT_SORT_FIELD" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"shows" => GetMessage("IBLOCK_SORT_SHOWS"),
				"sort" => GetMessage("IBLOCK_SORT_SORT"),
				"timestamp_x" => GetMessage("IBLOCK_SORT_TIMESTAMP"),
				"name" => GetMessage("IBLOCK_SORT_NAME"),
				"id" => GetMessage("IBLOCK_SORT_ID"),
				"active_from" => GetMessage("IBLOCK_SORT_ACTIVE_FROM"),
				"active_to" => GetMessage("IBLOCK_SORT_ACTIVE_TO"),
			),
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "sort",
		),
		"ELEMENT_SORT_ORDER" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"DEFAULT" => "asc",
		),
		"LIST_PROPERTY_CODE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),
		"LIST_META_KEYWORDS" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_LIST_META_KEYWORDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arUserFields_S,
		),
		"LIST_META_DESCRIPTION" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_LIST_META_DESCRIPTION"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arUserFields_S,
		),
		"LIST_BROWSER_TITLE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_LIST_BROWSER_TITLE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "-",
			"VALUES" => array_merge(Array("-"=>" ", "NAME" => GetMessage("IBLOCK_FIELD_NAME")), $arUserFields_S),
		),
		"BASKET_URL" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME" => GetMessage("IBLOCK_BASKET_URL"),
			"TYPE" => "STRING",
			"DEFAULT" => "/personal/basket.php",
		),
		"ACTION_VARIABLE" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME"		=> GetMessage("IBLOCK_ACTION_VARIABLE"),
			"TYPE"		=> "STRING",
			"DEFAULT"	=> "action"
		),
		"PRODUCT_ID_VARIABLE" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME"		=> GetMessage("IBLOCK_PRODUCT_ID_VARIABLE"),
			"TYPE"		=> "STRING",
			"DEFAULT"	=> "id"
		),
		"SECTION_ID_VARIABLE" => array(
			"PARENT" => "URL_TEMPLATES",
			"NAME"		=> GetMessage("IBLOCK_SECTION_ID_VARIABLE"),
			"TYPE"		=> "STRING",
			"DEFAULT"	=> "SECTION_ID"
		),

		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BC_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SET_TITLE" => Array(),
		"SET_STATUS_404" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BC_SET_STATUS_404"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"PRICE_CODE" => array(
			"PARENT" => "PRICES",
			"NAME" => GetMessage("IBLOCK_PRICE_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arPrice,
		),
		"USE_PRICE_COUNT" => array(
			"PARENT" => "PRICES",
			"NAME" => GetMessage("IBLOCK_USE_PRICE_COUNT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			),
		"SHOW_PRICE_COUNT" => array(
			"PARENT" => "PRICES",
			"NAME" => GetMessage("IBLOCK_SHOW_PRICE_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "1"
		),
		"PRICE_VAT_INCLUDE" => array(
			"PARENT" => "PRICES",
			"NAME" => GetMessage("IBLOCK_VAT_INCLUDE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"PRICE_VAT_SHOW_VALUE" => array(
			"PARENT" => "PRICES",
			"NAME" => GetMessage("IBLOCK_VAT_SHOW_VALUE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

	),
);
CIBlockParameters::AddPagerSettings($arComponentParameters, GetMessage("T_IBLOCK_DESC_PAGER_CATALOG"), true, true);

if($OFFERS_IBLOCK_ID)
{
	$arComponentParameters["PARAMETERS"]["LIST_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_LIST_OFFERS_FIELD_CODE"), "LIST_SETTINGS");
	$arComponentParameters["PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"] = array(
		"PARENT" => "LIST_SETTINGS",
		"NAME" => GetMessage("CP_BC_LIST_OFFERS_PROPERTY_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_Offers,
		"ADDITIONAL_VALUES" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["LIST_OFFERS_LIMIT"] = array(
		"PARENT" => "LIST_SETTINGS",
		"NAME" => GetMessage("CP_BC_LIST_OFFERS_LIMIT"),
		"TYPE" => "STRING",
		"DEFAULT" => 5,
	);
}

if($OFFERS_IBLOCK_ID)
{
	$arComponentParameters["PARAMETERS"]["DETAIL_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_DETAIL_OFFERS_FIELD_CODE"), "DETAIL_SETTINGS");
	$arComponentParameters["PARAMETERS"]["DETAIL_OFFERS_PROPERTY_CODE"] = array(
		"PARENT" => "DETAIL_SETTINGS",
		"NAME" => GetMessage("CP_BC_DETAIL_OFFERS_PROPERTY_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_Offers,
		"ADDITIONAL_VALUES" => "Y",
	);
}

if($arCurrentValues["SHOW_TOP_ELEMENTS"]!="N")
{
	$arComponentParameters["PARAMETERS"]["TOP_ELEMENT_SORT_FIELD"] = array(
		"PARENT" => "TOP_SETTINGS",
		"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"shows" => GetMessage("IBLOCK_SORT_SHOWS"),
			"sort" => GetMessage("IBLOCK_SORT_SORT"),
			"timestamp_x" => GetMessage("IBLOCK_SORT_TIMESTAMP"),
			"name" => GetMessage("IBLOCK_SORT_NAME"),
			"id" => GetMessage("IBLOCK_SORT_ID"),
			"active_from" => GetMessage("IBLOCK_SORT_ACTIVE_FROM"),
			"active_to" => GetMessage("IBLOCK_SORT_ACTIVE_TO"),
		),
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT" => "sort",
	);
	$arComponentParameters["PARAMETERS"]["TOP_ELEMENT_SORT_ORDER"] = array(
		"PARENT" => "TOP_SETTINGS",
		"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER"),
		"TYPE" => "LIST",
		"VALUES" => $arAscDesc,
		"DEFAULT" => "asc",
	);
	$arComponentParameters["PARAMETERS"]["TOP_PROPERTY_CODE"] = array(
		"PARENT" => "TOP_SETTINGS",
		"NAME" => GetMessage("BC_P_TOP_PROPERTY_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arProperty,
		"ADDITIONAL_VALUES" => "Y",
	);
	if($OFFERS_IBLOCK_ID)
	{
		$arComponentParameters["PARAMETERS"]["TOP_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_TOP_OFFERS_FIELD_CODE"), "TOP_SETTINGS");
		$arComponentParameters["PARAMETERS"]["TOP_OFFERS_PROPERTY_CODE"] = array(
			"PARENT" => "TOP_SETTINGS",
			"NAME" => GetMessage("CP_BC_TOP_OFFERS_PROPERTY_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_Offers,
			"ADDITIONAL_VALUES" => "Y",
		);
		$arComponentParameters["PARAMETERS"]["TOP_OFFERS_LIMIT"] = array(
			"PARENT" => "TOP_SETTINGS",
			"NAME" => GetMessage("CP_BC_TOP_OFFERS_LIMIT"),
			"TYPE" => "STRING",
			"DEFAULT" => 5,
		);
	}
}

if(!IsModuleInstalled("sale"))
{
	unset($arComponentParameters["PARAMETERS"]["USE_ALSO_BUY"]);
	unset($arComponentParameters["GROUPS"]["ALSO_BUY_SETTINGS"]);
}
elseif($arCurrentValues["USE_ALSO_BUY"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["ALSO_BUY_ELEMENT_COUNT"] = array(
			"PARENT" => "ALSO_BUY_SETTINGS",
			"NAME"		=> GetMessage("T_IBLOCK_DESC_ALSO_BUY_ELEMENT_COUNT"),
			"TYPE"		=> "STRING",
			"DEFAULT"	=> 5
		);
	$arComponentParameters["PARAMETERS"]["ALSO_BUY_MIN_BUYES"] = array(
			"PARENT" => "ALSO_BUY_SETTINGS",
			"NAME"		=> GetMessage("T_IBLOCK_DESC_ALSO_BUY_MIN_BUYES"),
			"TYPE"		=> "STRING",
			"DEFAULT"	=> 2
		);
}

if(!$OFFERS_IBLOCK_ID)
{
	unset($arComponentParameters["GROUPS"]["OFFERS_SETTINGS"]);
}
else
{
	$arComponentParameters["PARAMETERS"]["OFFERS_CART_PROPERTIES"] = array(
		"PARENT" => "PRICES",
		"NAME" => GetMessage("CP_BC_OFFERS_CART_PROPERTIES"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_Offers,
	);

	$arComponentParameters["PARAMETERS"]["OFFERS_SORT_FIELD"] = array(
		"PARENT" => "OFFERS_SETTINGS",
		"NAME" => GetMessage("CP_BC_OFFERS_SORT_FIELD"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"shows" => GetMessage("IBLOCK_SORT_SHOWS"),
			"sort" => GetMessage("IBLOCK_SORT_SORT"),
			"timestamp_x" => GetMessage("IBLOCK_SORT_TIMESTAMP"),
			"name" => GetMessage("IBLOCK_SORT_NAME"),
			"id" => GetMessage("IBLOCK_SORT_ID"),
			"active_from" => GetMessage("IBLOCK_SORT_ACTIVE_FROM"),
			"active_to" => GetMessage("IBLOCK_SORT_ACTIVE_TO"),
		),
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT" => "sort",
	);
	$arComponentParameters["PARAMETERS"]["OFFERS_SORT_ORDER"] = array(
		"PARENT" => "OFFERS_SETTINGS",
		"NAME" => GetMessage("CP_BC_OFFERS_SORT_ORDER"),
		"TYPE" => "LIST",
		"VALUES" => $arAscDesc,
		"DEFAULT" => "asc",
	);
}
?>
