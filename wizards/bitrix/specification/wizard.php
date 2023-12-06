<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/utils.php");
function __WGetPROPSHiddens($PROPS, $p = '')
{
	$s = '';
	if(trim($_REQUEST['site_id'])!='')
		$s .= '<input type="hidden" name="site_id" value="'.htmlspecialchars($_REQUEST['site_id']).'">';

	if(!is_array($PROPS))
		return $s;

	foreach($PROPS as $k=>$v)
	{
		if(is_array($v))
			$s .= __WGetPROPSHiddens($v, $p.'['.htmlspecialchars($k).']');
		else
			$s .= '<input type="hidden" name="PROPS'.$p.'['.htmlspecialchars($k).']" value="'.htmlspecialchars($v).'">';
	}

	return $s;
}

class StepDescription extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage('CATWIZ_STEP_DESCRIPTION_TITLE'));
		$this->SetNextStep("step_settings");
		$this->SetStepID("step_description");
		//$this->SetCancelStep("cancel");
		if(!CModule::IncludeModule('catalog'))
			$this->SetError(GetMessage('CATWIZ_NO_MODULE_ERROR'));
	}

	function OnPostForm()
	{
		$wizard = &$this->GetWizard();

		$PARAM = $wizard->GetVar("PARAM");
		if($PARAM['catalogId'] != $PARAM['oldcatalogId'])
			unset($_POST['PROPS']);
		$wizard->SetVar("siteID", $_REQUEST['site_id']);

		$rsSites = CSite::GetByID($_REQUEST['site_id']);
		$arSite = $rsSites->Fetch();
		$wizard->SetVar("siteDir", $arSite["DIR"]);
	}

	function ShowStep()
	{
		$wizard = &$this->GetWizard();
		$this->content = GetMessage('CATWIZ_STEP_DESCRIPTION_CONTENT');
		
		if(trim($_REQUEST['site_id'])=='')
		{
			$dbsite = CSite::GetList($by="SORT", $order="ASC", Array("ACTIVE"=>"Y"));
			$arSites = Array();
			while($arsite = $dbsite->GetNext())
			{
				$arSites[] = $arsite;
			}
			
			if(count($arSites)==1)
				$this->content .= '<input type="hidden" name="site_id" value="'.$arSites[0]['ID'].'">';
			else
			{
				$this->content .= '<br><br>'.GetMessage("CATWIZ_STEP_SITE_SELECT").' ';
				$this->content .= '<select name="site_id">';
				foreach($arSites as $arSite)
					$this->content .= '<option value="'.$arSite['ID'].'">'.$arSite['NAME'].'</option>';
				$this->content .= '</select>';
			}
		}

	}
}

class StepSettings extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage('CATWIZ_STEP_SETTINGS_TITLE'));
		$this->SetNextStep("step_run");
		$this->SetPrevStep("step_description");
		$this->SetStepID("step_settings");
		//$this->SetCancelStep("cancel");
	}
	
	function OnPostForm()
	{
		$wizard = &$this->GetWizard();
		
		$PARAM = $wizard->SetVar("iblock_products",$_REQUEST["iblock"]);
	}
	
	function ShowStep()
	{

		//$this->content = CUtil::InitJSCore(array('translit'), true);
	
		$wizard =& $this->GetWizard();
		$iblocklist_select = "<select name='iblock' >";
		
		if(CModule::IncludeModule("iblock")){} 
		$res = CIBlock::GetList(
			Array(), 
			Array('SITE_ID'=>$wizard->GetVar("siteID"))
		);
		$iblocklist_select .= "<option value='new'>".GetMessage("CATWIZ_CAT_NEW")."</option>";
		while($ar_res = $res->Fetch())
		{
			$iblocklist_select .= "<option value=".$ar_res["ID"].">".$ar_res["NAME"]."</option>";
		}
		
			$iblocklist_select .= "</select>";
		$this->content .= '<div class="wizard-input-form">
		<div class="wizard-input-form-block">
			<p>'.GetMessage("CATWIZ_CAT_NAME").'</p>
			<div class="wizard-input-form-block-content">
				<div class="wizard-input-form-field wizard-input-form-field-text">'.$iblocklist_select.'</div>
			</div>
		</div>';
		$this->content .= '</div>';
		$this->content .= __WGetPROPSHiddens($_POST["PROPS"]);
	}
}

class StepRun extends CWizardStep
{
	function InitStep()
	{
		$wizard =& $this->GetWizard();

		$this->SetTitle(GetMessage('CATWIZ_STEP_RUN_TITLE_EDIT'));
		$this->SetNextStep("final");
		$this->SetStepID("step_run");
		//$this->SetCancelStep("cancel");

	}
	
	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$iblock_products = $wizard->GetVar('iblock_products');
		$site_id = $wizard->GetVar('siteID');
if (!CModule::IncludeModule("iblock")){}
		
		
	$path = str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/public/".LANGUAGE_ID."/"); 
	
	$handle = @opendir($path);
	if ($handle)
	{
		while ($file = readdir($handle))
		{
			if (in_array($file, array(".", "..")))
				continue; 
			CopyDirFiles(
				$path.$file,
				$_SERVER["DOCUMENT_ROOT"].$wizard->GetVar("siteDir")."/".$file,
				$rewrite = true, 
				$recursive = true,
				$delete_after_copy = false
			);
		}
	}
		
	
	WizardServices::ReplaceMacrosRecursive($_SERVER["DOCUMENT_ROOT"].$wizard->GetVar("siteDir"), Array("SITE_DIR" => $wizard->GetVar("siteDir"),"SITE_ID" => $wizard->GetVar("siteID")));
	
//------------------------------------------------ components ------------------------------------------------		

$path = str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/components/"); 
	
	$handle = @opendir($path);
	if ($handle)
	{
		while ($file = readdir($handle))
		{
			if (in_array($file, array(".", "..")))
				continue; 
			CopyDirFiles(
				$path.$file,
				$_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/components/".$file,
				$rewrite = true, 
				$recursive = true,
				$delete_after_copy = false
			);
		}
	}
//---------------------------------------------------  types  ----------------------------------------------------------------
$arTypes = Array(
	Array(
		"ID" => "products",
		"SECTIONS" => "Y",
		"IN_RSS" => "N",
		"SORT" => 150,
		"LANG" => Array(),
	),
);

$arLanguages = Array();
$rsLanguage = CLanguage::GetList($by, $order, array());
while($arLanguage = $rsLanguage->Fetch())
	$arLanguages[] = $arLanguage["LID"];

$iblockType = new CIBlockType;
foreach($arTypes as $arType)
{
	$dbType = CIBlockType::GetList(Array(),Array("=ID" => $arType["ID"]));
	if($dbType->Fetch())
		continue;

	foreach($arLanguages as $languageID)
	{
		$code = strtoupper($arType["ID"]);
		$arType["LANG"][$languageID]["NAME"] = GetMessage($code."_TYPE_NAME");
		$arType["LANG"][$languageID]["ELEMENT_NAME"] = GetMessage($code."_ELEMENT_NAME");

		if ($arType["SECTIONS"] == "Y")
			$arType["LANG"][$languageID]["SECTION_NAME"] = GetMessage($code."_SECTION_NAME");
	}

	$iblockType->Add($arType);
}
//----------------------------------------------- characteristics ------------------------------------------------------------	

	$iblockXMLFile = $wizard->GetPath()."/products/xml/".LANGUAGE_ID."/products-characteristics.xml"; 
	$iblockCode = "products-characteristics"; 
	$iblockType = "products"; 

	$rsIBlock = CIBlock::GetList(array(), array("CODE" => $iblockCode."_".$site_id, "TYPE" => $iblockType));
	$iblockID = false; 
	if ($arIBlock = $rsIBlock->Fetch())
	{
		CIBlock::Delete($arIBlock["ID"]); 
	}

	$permissions = Array(
			"1" => "X",
			"2" => "R"
		);
	$dbGroup = CGroup::GetList($by = "", $order = "", Array("STRING_ID" => "content_editor"));
	if($arGroup = $dbGroup -> Fetch())
	{
		$permissions[$arGroup["ID"]] = 'W';
	}
	
	$iblockcharacteristicsID = WizardServices::ImportIBlockFromXML(
		$iblockXMLFile,
		$iblockCode,
		$iblockType,
		$site_id,
		$permissions
	);
	

//---------------------------------------------------------------------------------------------------------------------
	$iblockXMLFile = $wizard->GetPath()."/products/xml/".LANGUAGE_ID."/products-configure.xml";

$iblockCode = "products-configure"; 
$iblockType = "products"; 

$rsIBlock = CIBlock::GetList(array(), array("CODE" => $iblockCode."_".$site_id, "TYPE" => $iblockType));
$iblockID = false; 
if ($arIBlock = $rsIBlock->Fetch())
{
	CIBlock::Delete($arIBlock["ID"]); 
}


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
		$iblockXMLFile,
		"products-configure",
		$iblockType,
		$site_id,
		$permissions
	);

	if ($iblockID < 1)
		return;

	$arr = CIBlock::GetArrayByID($iblockID);
	CIBlock::Delete($iblockID);
	$ib = new CIBlock;
	$iblockID = $ib->Add(array_merge($arr,Array("SITE_ID"=>$site_id, "VERSION"=>2, "EDIT_FILE_BEFORE" => $wizard->GetVar("siteDir")."user_forms/iblock_element_save.php" ,"EDIT_FILE_AFTER" => $wizard->GetVar("siteDir")."user_forms/iblock_element_edit.php")));
	
	WizardServices::ImportIBlockFromXML(
		$iblockXMLFile,
		"products-configure_",
		$iblockType,
		$site_id,
		$permissions
	);
	
	$iblock = new CIBlock;
	$arFields = Array(
		"CODE" => $iblockCode."_".$site_id, 
		"XML_ID" => $iblockCode."_".$site_id	
	);	
	$iblock->Update($iblockID, $arFields);
	
	$iblockCh = new CIBlock;
	$arFieldsCh = Array(
		"CODE" => "products-characteristics_".$site_id, 
		"XML_ID" => "products-characteristics_".$site_id	
	);	
	$iblockCh->Update($iblockcharacteristicsID, $arFieldsCh);
	
	
	
	
	$iblock_products_id = $wizard->GetVar("iblock_products");
	if($iblock_products_id=="new")
	{
		$ibp = new CIBlock;
		$iblock_products_id = $ibp->Add(array(
			'ACTIVE' => 'Y',
			'NAME' => GetMessage("iblock_products_name"),
			'CODE' => "products",
			"XML_ID" => "products-products_".$site_id,
			'LIST_PAGE_URL' => '#SITE_DIR#/catalog-section/#ID#/',
			'SECTION_PAGE_URL' => '#SITE_DIR#/catalog-section/#ID#/',
			'DETAIL_PAGE_URL' => '#SITE_DIR#/catalog-item/#ID#/',
			'SITE_ID' => array($site_id), 
			"WORKFLOW" => "N",
			'INDEX_SECTION' => 'Y',
			"EDIT_FILE_BEFORE" => $wizard->GetVar("siteDir")."user_forms/catalog/iblock_element_save.php" ,
			"EDIT_FILE_AFTER" => $wizard->GetVar("siteDir")."user_forms/catalog/iblock_element_edit.php",
			'ELEMENTS_NAME' => GetMessage("WZD_ELEMENTS_NAME"),
			'ELEMENT_NAME' => GetMessage("WZD_ELEMENT_NAME"),
			'ELEMENT_ADD' => GetMessage("WZD_ELEMENT_ADD"),
			'ELEMENT_EDIT' => GetMessage("WZD_ELEMENT_EDIT"),
			'ELEMENT_DELETE' => GetMessage("WZD_ELEMENT_DELETE"),
			'SECTIONS_NAME' => GetMessage("WZD_SECTIONS_NAME"),
			'SECTION_NAME' => GetMessage("WZD_SECTION_NAME"),
			'SECTION_ADD' => GetMessage("WZD_SECTION_ADD"),
			'SECTION_EDIT' => GetMessage("WZD_SECTION_EDIT"),
			'SECTION_DELETE' => GetMessage("WZD_SECTION_DELETE"),
			'GROUP_ID' => Array('2' => 'R', '1' => 'X'),
			'FIELDS' => array ( 'IBLOCK_SECTION' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'ACTIVE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'Y', ), 'ACTIVE_FROM' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '=today', ), 'ACTIVE_TO' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SORT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'NAME' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => '', ), 'PREVIEW_PICTURE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => array ( 'FROM_DETAIL' => 'Y', 'SCALE' => 'Y', 'WIDTH' => '160', 'HEIGHT' => '160', 'IGNORE_ERRORS' => 'N', ), ), 'PREVIEW_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'PREVIEW_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'DETAIL_PICTURE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => array ( 'SCALE' => 'N', 'WIDTH' => '300', 'HEIGHT' => '300', 'IGNORE_ERRORS' => 'N', ), ), 'DETAIL_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => 'text', ), 'DETAIL_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'XML_ID' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'CODE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'TAGS' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), ), 
			'IBLOCK_TYPE_ID' => 'products',
			'DESCRIPTION_TYPE' => 'text',
			'VERSION' => 2,
		));
	}
	else
	{
		$res = CIBlock::GetByID($iblock_products_id);
		if($ar_res = $res->GetNext()){
			$arFields = array_merge(Array("EDIT_FILE_BEFORE" => $wizard->GetVar("siteDir")."user_forms/catalog/iblock_element_save.php",
												   "EDIT_FILE_AFTER" => $wizard->GetVar("siteDir")."user_forms/catalog/iblock_element_edit.php",
												   "XML_ID" => "products-products_".$site_id,
												   "SITE_ID" => array($site_id)));
			$ib1 = new CIBlock;
			$ib1->Update($iblock_products_id, $arFields);
		}
	}
	$prop = new CIBlockProperty;
	
	$res = CIBlockProperty::GetByID("specification", $iblock_products_id);
	if(!$ar_res = $res->GetNext()){
		$arFields = Array(
			"NAME" => GetMessage("characteristics"),
			"MULTIPLE" => "Y",
			"IS_REQUIRED" => "N",
			"ROW_COUNT" => 1,
			"COL_COUNT" => 30,
			"LIST_TYPE" => "L",
			"ACTIVE" => "Y",
			"SORT" => "500",
			"CODE" => "specification",
			"PROPERTY_TYPE" => "E",
			"LINK_IBLOCK_ID" => $iblockcharacteristicsID,
			"IBLOCK_ID" => $iblock_products_id
		);		
		$prop->Add($arFields);
	}
	if (CModule::IncludeModule("catalog"))
	{
		$cat = CCatalog::GetByID($iblock_products_id);
		if(!$cat)
		{
			CCatalog::Add(array("IBLOCK_ID" => $iblock_products_id, "YANDEX_EXPORT" => "N", "SUBSCRIPTION" => "N"));
		}
	}
	
	$arFields1 = Array(
		"NAME" => GetMessage("products_group"),
		"MULTIPLE" => "Y",
		"IS_REQUIRED" => "Y",
		"ROW_COUNT" => 1,
		"COL_COUNT" => 30,
		"LIST_TYPE" => "L",
		"ACTIVE" => "Y",
		"SORT" => "10",
		"CODE" => "products",
		"PROPERTY_TYPE" => "G",
		"LINK_IBLOCK_ID" => $iblock_products_id,
		"IBLOCK_ID" => $iblockID
	);

	$prop->Add($arFields1);
	
	$this->content .= GetMessage("CATWIZ_OK");

	}
	
}


class FinalStep extends CWizardStep
{
	function InitStep()
	{
		$this->SetTitle(GetMessage('WSL_FINALSTEP_TITLE'));
		$this->SetStepID("final");
		$this->SetNextStep("final");
		$this->SetNextCaption(GetMessage('WSL_FINALSTEP_BUTTONTITLE'));
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$siteID = WizardServices::GetCurrentSiteID($wizard->GetVar("siteID"));
		$rsSites = CSite::GetByID($siteID);
		$siteDir = "/"; 
		if ($arSite = $rsSites->Fetch())
			$siteDir = $arSite["DIR"]; 

		$siteFolder = $wizard->GetVar("siteFolder");
		$wizard->SetFormActionScript(str_replace("//", "/", $siteDir.$siteFolder."/?finish"));
		
		COption::SetOptionString("main", "wizard_solution", $wizard->solutionName, false, $siteID); 
		
		$this->content .= GetMessage("FINISH_STEP_CONTENT");
		
		if ($wizard->GetVar("installDemoData") == "Y")
			$this->content .= GetMessage("FINISH_STEP_REINDEX");
	}
}
?>