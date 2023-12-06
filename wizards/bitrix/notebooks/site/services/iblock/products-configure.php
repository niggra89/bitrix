<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule("iblock"))
	return;


$iblockXMLFile_iblock = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/01_products-configure.xml"; 
$iblockXMLFile_elements = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/02_products-configure.xml"; 

$iblockCode = "products-configure_".WIZARD_SITE_ID; 
$iblockType = "products"; 

$rsIBlock = CIBlock::GetList(array(), array("CODE" => $iblockCode, "TYPE" => $iblockType));
$iblockID = false; 
if ($arIBlock = $rsIBlock->Fetch())
{
	$iblockID = $arIBlock["ID"]; 
	if (WIZARD_INSTALL_DEMO_DATA)
	{
		CIBlock::Delete($arIBlock["ID"]); 
		$iblockID = false; 
	}
}

if($iblockID == false)
{
	$permissions = Array(
			"1" => "X",
			"2" => "R"
		);
	$dbGroup = CGroup::GetList($by = "", $order = "", Array("STRING_ID" => "content_editor"));
	if($arGroup = $dbGroup -> Fetch())
	{
		$permissions[$arGroup["ID"]] = 'W';
	};
	$iblockID = WizardServices::ImportIBlockFromXML(
		$iblockXMLFile_iblock,
		"products-configure",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);

	if ($iblockID < 1)
		return;

	$arr = CIBlock::GetArrayByID($iblockID);
	CIBlock::Delete($iblockID);
	$ib = new CIBlock;
	$iblockID = $ib->Add(array_merge($arr,Array("SITE_ID"=>WIZARD_SITE_ID,"VERSION"=>2, "EDIT_FILE_BEFORE" => WIZARD_SITE_DIR."user_forms/iblock_element_save.php" ,"EDIT_FILE_AFTER" => WIZARD_SITE_DIR."user_forms/iblock_element_edit.php")));
	
	
	WizardServices::ImportIBlockFromXML(
		$iblockXMLFile_iblock,
		"products-configure_",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);
	WizardServices::ImportIBlockFromXML(
		$iblockXMLFile_elements,
		"products-configure_",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);
	CIBlock::SetPermission($iblockID, $permissions);
	$iblock = new CIBlock;
	$arFields = Array(
		"ACTIVE" => "Y",
		"FIELDS" => array ( 'IBLOCK_SECTION' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'ACTIVE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'Y', ), 'ACTIVE_FROM' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '=today', ), 'ACTIVE_TO' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SORT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'NAME' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => '', ), 'PREVIEW_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'FROM_DETAIL' => 'N', 'SCALE' => 'Y', 'WIDTH' => '160', 'HEIGHT' => '160', 'IGNORE_ERRORS' => 'N', ), ), 'PREVIEW_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'PREVIEW_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'DETAIL_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'SCALE' => 'N', 'WIDTH' => '300', 'HEIGHT' => '300', 'IGNORE_ERRORS' => 'N', ), ), 'DETAIL_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'DETAIL_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'XML_ID' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'CODE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'TAGS' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), ), 
		"CODE" => $iblockCode, 
		"XML_ID" => $iblockCode,
		"NAME" => "[".WIZARD_SITE_ID."] ".$iblock->GetArrayByID($iblockID, "NAME")
	);
	
	$iblock->Update($iblockID, $arFields);
	


}
else
{
	$arSites = array(); 
	$db_res = CIBlock::GetSite($iblockID);
	while ($res = $db_res->Fetch())
		$arSites[] = $res["LID"]; 
	if (!in_array(WIZARD_SITE_ID, $arSites))
	{
		$arSites[] = WIZARD_SITE_ID;
		$iblock = new CIBlock;
		$iblock->Update($iblockID, array("LID" => $arSites));
	}
}

/*------------------------------------------------------------------------------------------------------------------------------*/
	$iblock = new CIBlock;
	$iblock_catalog_id = 0;
	$catalog_res = CIBlock::GetList(
		Array(), 
		Array(
			'XML_ID'=>'products-products'
		), true
	);
	while($ar_res = $catalog_res->Fetch())
	{
		$iblock_catalog_id = $ar_res['ID'];
	}

	$arFields_catalog = Array(
		"ACTIVE" => "Y",
		"FIELDS" => array ( 'IBLOCK_SECTION' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'ACTIVE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'Y', ), 'ACTIVE_FROM' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '=today', ), 'ACTIVE_TO' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SORT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'NAME' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => '', ), 'PREVIEW_PICTURE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => array ( 'FROM_DETAIL' => 'Y', 'SCALE' => 'Y', 'WIDTH' => '160', 'HEIGHT' => '160', 'IGNORE_ERRORS' => 'N', 'METHOD' => 'resample', 'COMPRESSION' => '90', ), ), 'PREVIEW_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'PREVIEW_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'DETAIL_PICTURE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => array ( 'SCALE' => 'Y', 'WIDTH' => '300', 'HEIGHT' => '300', 'IGNORE_ERRORS' => 'N', 'METHOD' => 'resample', 'COMPRESSION' => '90',), ), 'DETAIL_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'DETAIL_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'XML_ID' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'CODE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'TAGS' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), ), 
		"CODE" => "products-products_".WIZARD_SITE_ID, 
		"XML_ID" => "products-products_".WIZARD_SITE_ID,
		"NAME" => "[".WIZARD_SITE_ID."] ".$iblock->GetArrayByID($iblock_catalog_id, "NAME")
	);
	
	$iblock->Update($iblock_catalog_id, $arFields_catalog);
	
	$iblock_spec_id = 0;
	$catalog_spec_res = CIBlock::GetList(
		Array(), 
		Array(
			'XML_ID'=>'products-characteristics'
		), true
	);
	while($ar_res = $catalog_spec_res->Fetch())
	{
		$iblock_spec_id = $ar_res['ID'];
	}
	$arFields_config = Array(
		"ACTIVE" => "Y",
		"FIELDS" => array ( 'IBLOCK_SECTION' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'ACTIVE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'Y', ), 'ACTIVE_FROM' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '=today', ), 'ACTIVE_TO' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SORT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'NAME' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => '', ), 'PREVIEW_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'FROM_DETAIL' => 'N', 'SCALE' => 'N', 'WIDTH' => '', 'HEIGHT' => '', 'IGNORE_ERRORS' => 'N', ), ), 'PREVIEW_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'PREVIEW_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'DETAIL_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'SCALE' => 'N', 'WIDTH' => '', 'HEIGHT' => '', 'IGNORE_ERRORS' => 'N', ), ), 'DETAIL_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'DETAIL_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'XML_ID' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'CODE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'TAGS' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), ), 
		"CODE" => "products-characteristics_".WIZARD_SITE_ID, 
		"XML_ID" => "products-characteristics_".WIZARD_SITE_ID, 
		"NAME" => "[".WIZARD_SITE_ID."] ".$iblock->GetArrayByID($iblock_spec_id, "NAME")
	);
	
	$iblock->Update($iblock_spec_id, $arFields_config);
	
/*------------------------------------------------------------------------------------------------------------------------------*/
$arForum = Array();
if(CModule::IncludeModule('forum'))
{
	$rsForums = CForumNew::GetList();
	while($arForum = $rsForums->Fetch())
	{
		if($arForum["NAME"] == "product_reviews")
			break;
	}
	if(!$arForum)
	{
		$rsForumGroups = CForumGroup::GetList();
		while($arForumGroup = $rsForumGroups->Fetch())
		{
			$arForumGroup = CForumGroup::GetLangByID($arForumGroup["ID"], LANGUAGE_ID);
			if($arForumGroup["NAME"] === "reviews")
				break;
		}
		$arForumGroup["FORUM_GROUP_ID"]=0;
		$arFields = Array(
			"NAME" => "product_reviews",
			"DESCRIPTION" => "",
			"SORT" => 150,
			"ACTIVE" => "Y",
			"ALLOW_HTML" => "N",
			"ALLOW_ANCHOR" => "Y",
			"ALLOW_BIU" => "Y",
			"ALLOW_IMG" => "Y",
			"ALLOW_LIST" => "Y",
			"ALLOW_QUOTE" => "Y",
			"ALLOW_CODE" => "Y",
			"ALLOW_FONT" => "Y",
			"ALLOW_SMILES" => "Y",
			"ALLOW_UPLOAD" => "N",
			"ALLOW_UPLOAD_EXT" => "",
			"ALLOW_NL2BR" => "N",
			"MODERATION" => "N",
			"ALLOW_MOVE_TOPIC" => "N",
			"ORDER_BY" => "P",
			"ORDER_DIRECTION" => "DESC",
			"PATH2FORUM_MESSAGE" => "",
			"FORUM_GROUP_ID" => 0,
			"ASK_GUEST_EMAIL" => "N",
			"USE_CAPTCHA" => "N",				
			"SITES" => array(
				WIZARD_SITE_ID => WIZARD_SITE_PATH,
			),				
		);
		$arFields["GROUP_ID"] = array(
			2 => "E",
			5 => "M",
		);
		if (CModule::IncludeModule("statistic"))
		{
			$arFields["EVENT1"] = "forum";
			$arFields["EVENT2"] = "message";
			$arFields["EVENT3"] = "";
		}
		$arForum = array("ID" => CForumNew::Add($arFields));
	}
}
else
{
	$arForum = array("ID" => "");
}

$wizard =& $this->GetWizard();
$wizard_path = $wizard->GetPath();
		
$arReplace = array(
	"IBLOCK.ID(XML_ID=products-catalog)" => CIBlockCMLImport::GetIBlockByXML_ID("products-products_".WIZARD_SITE_ID),
	"IBLOCK.ID(XML_ID=products-characteristics)" => CIBlockCMLImport::GetIBlockByXML_ID("products-characteristics_".WIZARD_SITE_ID),
	"IBLOCK.ID(XML_ID=products-configure)" => CIBlockCMLImport::GetIBlockByXML_ID("products-configure_".WIZARD_SITE_ID),
	"FORUM_ID" => $arForum["ID"]
);

$templateID = SITE_TEMPLATE_ID;
$pos = substr_count($templateID, "shop_light");
if ($pos == 0) {
	$templateID = "shop";
}
else
{
	$templateID = "shop_light";
}
$path = str_replace("//", "/", WIZARD_ABSOLUTE_PATH."/site/public_files/ru/catalog/".$templateID."/"); 

CopyDirFiles($path,WIZARD_SITE_PATH."/content/catalog/",true,true,false);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/content/catalog/index.php", $arReplace);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/content/catalog/list.php", $arReplace);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/content/catalog/compare.php", $arReplace);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/content/catalog/detail.php", $arReplace);
	WizardServices::ReplaceMacrosRecursive(WIZARD_SITE_PATH."/content/catalog/", Array("SITE_DIR" => WIZARD_SITE_DIR));	
?>
