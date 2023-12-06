<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>


<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}
/*************************************************************************
	Processing of received parameters
*************************************************************************/

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["ELEMENT_ID"] = intval($arParams["ELEMENT_ID"]);

$arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);
$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);
$arParams["BASKET_URL"]=trim($arParams["BASKET_URL"]);
if(strlen($arParams["BASKET_URL"])<=0)
	$arParams["BASKET_URL"] = "/personal/basket.php";

$arParams["ACTION_VARIABLE"]=trim($arParams["ACTION_VARIABLE"]);
if(strlen($arParams["ACTION_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["ACTION_VARIABLE"]))
	$arParams["ACTION_VARIABLE"] = "action";

$arParams["PRODUCT_ID_VARIABLE"]=trim($arParams["PRODUCT_ID_VARIABLE"]);
if(strlen($arParams["PRODUCT_ID_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_ID_VARIABLE"]))
	$arParams["PRODUCT_ID_VARIABLE"] = "id";

$arParams["PRODUCT_QUANTITY_VARIABLE"]=trim($arParams["PRODUCT_QUANTITY_VARIABLE"]);
if(strlen($arParams["PRODUCT_QUANTITY_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_QUANTITY_VARIABLE"]))
	$arParams["PRODUCT_QUANTITY_VARIABLE"] = "quantity";

$arParams["PRODUCT_PROPS_VARIABLE"]=trim($arParams["PRODUCT_PROPS_VARIABLE"]);
if(strlen($arParams["PRODUCT_PROPS_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_PROPS_VARIABLE"]))
	$arParams["PRODUCT_PROPS_VARIABLE"] = "prop";

$arParams["ELEMENT_COUNT"] = intval($arParams["ELEMENT_COUNT"]);
if($arParams["ELEMENT_COUNT"]<=0)
	$arParams["ELEMENT_COUNT"]=5;

if(!is_array($arParams["PRICE_CODE"]))
	$arParams["PRICE_CODE"] = array();

$arParams["USE_PRICE_COUNT"] = $arParams["USE_PRICE_COUNT"]=="Y";
$arParams["SHOW_PRICE_COUNT"] = intval($arParams["SHOW_PRICE_COUNT"]);
if($arParams["SHOW_PRICE_COUNT"]<=0)
	$arParams["SHOW_PRICE_COUNT"]=1;
$arParams["USE_PRODUCT_QUANTITY"] = $arParams["USE_PRODUCT_QUANTITY"]==="Y";

if(!is_array($arParams["PRODUCT_PROPERTIES"]))
	$arParams["PRODUCT_PROPERTIES"] = array();
foreach($arParams["PRODUCT_PROPERTIES"] as $k=>$v)
	if($v==="")
		unset($arParams["PRODUCT_PROPERTIES"][$k]);

$arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";


/*************************************************************************
			Processing of the Buy link
*************************************************************************/
$strError = "";
if (array_key_exists($arParams["ACTION_VARIABLE"], $_REQUEST) && array_key_exists($arParams["PRODUCT_ID_VARIABLE"], $_REQUEST))
{
	if(array_key_exists($arParams["ACTION_VARIABLE"]."BUY", $_REQUEST))
		$action = "BUY";
	elseif(array_key_exists($arParams["ACTION_VARIABLE"]."ADD2BASKET", $_REQUEST))
		$action = "ADD2BASKET";
	else
		$action = strtoupper($_REQUEST[$arParams["ACTION_VARIABLE"]]);

	$productID = intval($_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]]);
	if (($action == "ADD2BASKET" || $action == "BUY") && $productID > 0)
	{
		if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
		{
			if($arParams["USE_PRODUCT_QUANTITY"])
				$QUANTITY = intval($_POST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]);
			if($QUANTITY <= 1)
				$QUANTITY = 1;

			$product_properties = array();
			if(count($arParams["PRODUCT_PROPERTIES"]))
			{
				if(is_array($_POST[$arParams["PRODUCT_PROPS_VARIABLE"]]))
				{
					$product_properties = CIBlockPriceTools::CheckProductProperties(
						$arParams["IBLOCK_ID"],
						$productID,
						$arParams["PRODUCT_PROPERTIES"],
						$_POST[$arParams["PRODUCT_PROPS_VARIABLE"]]
					);
					if(!is_array($product_properties))
						$strError = GetMessage("CATALOG_ERROR2BASKET").".";
				}
				else
				{
					$strError = GetMessage("CATALOG_ERROR2BASKET").".";
				}
			}

			if(!$strError && Add2BasketByProductID($productID, $QUANTITY, $product_properties))
			{
				if ($action == "BUY")
					LocalRedirect($arParams["BASKET_URL"]);
				else
					LocalRedirect($APPLICATION->GetCurPageParam("", array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"])));
			}
			else
			{
				if ($ex = $GLOBALS["APPLICATION"]->GetException())
					$strError = $ex->GetString();
				else
					$strError = GetMessage("CATALOG_ERROR2BASKET").".";
			}
		}
	}
}
if(strlen($strError)>0)
{
	ShowError($strError);
	return;
}



/*************************************************************************
			Work with cache
*************************************************************************/
//This function returns array with prices description and access rights
//in case catalog module n/a prices get values from element properties
$arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);
	
	
// id 
$element_r = CIBlockElement::GetByID($arParams["ELEMENT_ID"]);
if($element_arr_res = $element_r->GetNext())
{
	$sid = $element_arr_res['IBLOCK_SECTION_ID'];
}

//   
$related = Array();
$db_s_list = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $sid), false, Array("UF_RELATED"));
if($sect_arr_res = $db_s_list->GetNext())
{
	$related = $sect_arr_res["UF_RELATED"];
}
$related = array_slice($related, 0, $arParams["ELEMENT_COUNT"]);

//print_r($related);
foreach($related as $rel_sect)
{
	$arrFilter = Array("SECTION_ID" => $rel_sect, "IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE" => "Y","INCLUDE_SUBSECTIONS" => "Y");

		if(!$arParams["USE_PRICE_COUNT"])
		{
			foreach($arResult["PRICES"] as $key => $value)
			{
				$arSelect[] = $value["SELECT"];
				$arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = $arParams["SHOW_PRICE_COUNT"];
			}
		}
		$arSort = array(
			$arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"],
			"ID" => "DESC",
		);
		//EXECUTE
		$rsElements = CIBlockElement::GetList(Array("rand" => "desc"), $arrFilter, false, false, array_merge($arSelect,Array("ID","NAME","DETAIL_PAGE_URL","PREVIEW_PICTURE")));
		$rsElements->SetUrlTemplates($arParams["DETAIL_URL"]);

$index = 0;
		while($index==0&&$obElement = $rsElements->GetNextElement())
		{
			$index++;
			$arItem = $obElement->GetFields();

			$arButtons = CIBlock::GetPanelButtons(
				$arItem["IBLOCK_ID"],
				$arItem["ID"],
				$arSection["ID"],
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

			$arItem["PREVIEW_PICTURE"] = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
			$arItem["DETAIL_PICTURE"] = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
			
			if(count($arParams["PROPERTY_CODE"]))
				$arItem["PROPERTIES"] = $obElement->GetProperties();
			elseif(count($arParams["PRODUCT_PROPERTIES"]))
				$arItem["PROPERTIES"] = $obElement->GetProperties();

			$arItem["DISPLAY_PROPERTIES"] = array();
			foreach($arParams["PROPERTY_CODE"] as $pid)
			{
				$prop = &$arItem["PROPERTIES"][$pid];
				if(
					(is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
					|| (!is_array($prop["VALUE"]) && strlen($prop["VALUE"]) > 0)
				)
				{
					$arItem["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arItem, $prop, "catalog_out");
				}
			}
		
			if($arParams["USE_PRICE_COUNT"])
			{
				if(CModule::IncludeModule("catalog"))
				{
					$arItem["PRICE_MATRIX"] = CatalogGetPriceTableEx($arItem["ID"]);
					foreach($arItem["PRICE_MATRIX"]["COLS"] as $keyColumn=>$arColumn)
						$arItem["PRICE_MATRIX"]["COLS"][$keyColumn]["NAME_LANG"] = htmlspecialchars($arColumn["NAME_LANG"]);
				}
				else
				{
					$arItem["PRICE_MATRIX"] = false;
				}
				$arItem["PRICES"] = array();
			}
			else
			{
				$arItem["PRICE_MATRIX"] = false;
				$arItem["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["PRICES"], $arItem, $arParams['PRICE_VAT_INCLUDE']);
			}
			/*$ar_catalog_q = CCatalogProduct::GetList(array(), array("ID"=>$arItem["ID"]), false, array()); 
			if($result_catalog_q = $ar_catalog_q->Fetch()) 
			{ 
				$arItem["CATALOG_QUANTITY"] = intval($result_catalog_q['QUANTITY']); 
			} 
			*/
			$arItem["CAN_BUY"] = CIBlockPriceTools::CanBuy($arParams["IBLOCK_ID"], $arResult["PRICES"], $arItem);

			$arItem["BUY_URL"] = htmlspecialchars($APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=BUY&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arItem["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"])));
			$arItem["ADD_URL"] = htmlspecialchars($APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=ADD2BASKET&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arItem["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"])));
			$arItem["COMPARE_URL"] = htmlspecialchars($APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arItem["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"])));

			$ar_catalog_q = CCatalogProduct::GetByID($arItem["ID"]); 
		$arItem["CATALOG_QUANTITY"] = intval($ar_catalog_q['QUANTITY']); 	
		
			$arResult["ITEMS"][]=$arItem;
		}
		
	}
	
	$this->IncludeComponentTemplate();
?>
