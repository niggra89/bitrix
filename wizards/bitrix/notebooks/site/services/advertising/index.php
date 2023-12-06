<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(CModule::IncludeModule('advertising')){


__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

$dbResult = CAdvContract::GetByID(1);
$bres = $dbResult->Fetch();
if (!$bres)
	return;
	
$as = Array();
$rsSites = CSite::GetList($by="sort", $order="desc", Array());
while ($arSite = $rsSites->Fetch())
{
  $as[] = $arSite["ID"];
}

$ID = CAdvContract::Set(Array("arrSITE" => $as),1);


//Types
$arTypes = Array(
	Array(
		"SID" => "TOP",
		"ACTIVE" => "Y",
		"SORT" => 1,
		"NAME" => GetMessage("DEMO_ADV_TOP_TYPE"),
		"DESCRIPTION" => ""
	),
);

foreach ($arTypes as $arFields)
{
	$dbResult = CAdvType::GetByID($arTypes["SID"], $CHECK_RIGHTS="N");
	if ($dbResult && $dbResult->Fetch())
		continue;

	CAdvType::Set($arFields, "", $CHECK_RIGHTS="N");
}

//Matrix
$arWeekday = Array(
	"SUNDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"MONDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"TUESDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"WEDNESDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"THURSDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"FRIDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
	"SATURDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23)
);

$pathToBanner = str_replace("\\", "/", dirname(__FILE__));
$pathToBanner = $pathToBanner."/banners/".LANGUAGE_ID;

$arBanners = Array(
	Array(
		"CONTRACT_ID" => $ID,
		"TYPE_SID" => "TOP",
		"STATUS_SID"		=> "PUBLISHED",
		"NAME" => GetMessage("DEMO_ADV_NAME"),
		"ACTIVE" => "Y",
		"arrSITE" => Array(WIZARD_SITE_ID),
		"arrSHOW_PAGE" => Array(WIZARD_SITE_DIR."index.php"),
		"arrNOT_SHOW_PAGE" => Array(WIZARD_SITE_DIR."content/"),
		"WEIGHT"=> 100,
		"FIX_SHOW" => "Y",
		"FIX_CLICK" => "Y",
		"AD_TYPE" => "image",
		"arrIMAGE_ID" => Array(
			"name" => "banner.png",
			"type" => "image/png",
			"tmp_name" => $pathToBanner."/banner.png",
			"error" => "0",
			"size" => @filesize($pathToBanner."/banner.png"),
			"MODULE_ID" => "advertising"
		),
		"IMAGE_ALT" => GetMessage("DEMO_ADV_NAME"),
		"URL" => GetMessage("DEMO_ADV_BANNER_URL"),
		"URL_TARGET" => "_blank",
		"STAT_EVENT_1" => "banner",
		"STAT_EVENT_2" => "click",
		"arrWEEKDAY" => $arWeekday,
		"COMMENTS" => "banner.png",
	),
);

foreach ($arBanners as $arFields)
{
	$dbResult = CAdvBanner::GetList($by, $order, Array("COMMENTS" => $arFields["COMMENTS"], "SITE" => WIZARD_SITE_ID, "COMMENTS_EXACT_MATCH" => "Y"), $is_filtered, "N");
	if ($dbResult && $dbResult->Fetch())
		continue;

	CAdvBanner::Set($arFields, "", $CHECK_RIGHTS="N");
}
				
$topBanner = '--><'.'?'.'$'.'APPLICATION->IncludeComponent("bitrix:advertising.banner",".default",Array("TYPE" => "TOP"));?><!--';
$arReplace = Array("BANNER_TOP" => $topBanner);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/banner.php", $arReplace);
}

?>