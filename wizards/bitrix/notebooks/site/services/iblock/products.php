<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule("iblock"))
	return;


$iblockXMLFile_iblock = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/01_products-products.xml"; 
$iblockXMLFile_elements = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/02_products-products.xml"; 
$iblockXMLFile_prices = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/03_products-products.xml"; 

$iblockCode = "products-products_".WIZARD_SITE_ID; 
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
		"products-products",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);

	if ($iblockID < 1)
		return;
		
	$arr = CIBlock::GetArrayByID($iblockID);
	CIBlock::Delete($iblockID);
	$ib = new CIBlock;
	$iblockID = $ib->Add(array_merge($arr,Array("SITE_ID"=>WIZARD_SITE_ID, "VERSION" => 2, "EDIT_FILE_BEFORE" => WIZARD_SITE_DIR."user_forms/catalog/iblock_element_save.php" ,"EDIT_FILE_AFTER" => WIZARD_SITE_DIR."user_forms/catalog/iblock_element_edit.php")));
	
	
	WizardServices::ImportIBlockFromXML(
		$iblockXMLFile_iblock,
		"products-products_second_file",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);
	
	WizardServices::ImportIBlockFromXML(
		$iblockXMLFile_elements,
		"products-products_second_file",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);
	WizardServices::ImportIBlockFromXML(
		$iblockXMLFile_prices,
		"products-products_second_file",
		$iblockType,
		WIZARD_SITE_ID,
		$permissions
	);	
	CIBlock::SetPermission($iblockID, $permissions);
	//IBlock fields

	
	$obUserField  = new CUserTypeEntity;
	$obUserField->Add(array(
		"ENTITY_ID" => "IBLOCK_".$iblockID."_SECTION",
		"FIELD_NAME" => "UF_RELATED",
		"USER_TYPE_ID" => "iblock_section",
		"XML_ID" => "products-catalog-related",
		"SORT" => 100,
		"MULTIPLE" => "Y",
		"MANDATORY" => "N",
		"SHOW_FILTER" => "S",
		"SHOW_IN_LIST" => "N",
		"EDIT_IN_LIST" => "Y",
		"IS_SEARCHABLE" => "N",
		"SETTINGS" => Array("IBLOCK_TYPE_ID" => "products","IBLOCK_ID" => $iblockID,"DISPLAY" =>"CHECKBOX", "ACTIVE_FILTER" => "Y"),			
	));		
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
?>
