<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (!defined("WIZARD_SITE_ID"))
	return;

if (!defined("WIZARD_SITE_DIR"))
	return;
 
if (WIZARD_INSTALL_DEMO_DATA)
{
	$path = str_replace("//", "/", WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/"); 
	
	$handle = @opendir($path);
	if ($handle)
	{
		while ($file = readdir($handle))
		{
			if (in_array($file, array(".", "..")))
				continue; 
			CopyDirFiles(
				$path.$file,
				WIZARD_SITE_PATH."/".$file,
				$rewrite = true, 
				$recursive = true,
				$delete_after_copy = false
			);
		}
		//CModule::IncludeModule("search");
		//CSearch::ReIndexAll(Array(WIZARD_SITE_ID, WIZARD_SITE_DIR));
	}
		
	
	WizardServices::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("SITE_DIR" => WIZARD_SITE_DIR));

	$arUrlRewrite = array(); 
	if (file_exists(WIZARD_SITE_ROOT_PATH."/urlrewrite.php"))
	{
		include(WIZARD_SITE_ROOT_PATH."/urlrewrite.php");
	}

	CUrlRewriter::Add(array(
			"CONDITION"	=>	"#^".WIZARD_SITE_DIR."catalog-section/#",
			"RULE"	=>	"",
			"ID"	=>	"shop:catalog.filter.specification",
			"PATH"	=>	WIZARD_SITE_DIR."content/catalog/list.php",
		));
	CUrlRewriter::Add(array(
			"CONDITION"	=>	"#^".WIZARD_SITE_DIR."catalog-section/#",
			"RULE"	=>	"",
			"ID"	=>	"shop:catalog.sections.or.list",
			"PATH"	=>	WIZARD_SITE_DIR."content/catalog/list.php",
		));
	CUrlRewriter::Add(array(
			"CONDITION"	=>	"#^".WIZARD_SITE_DIR."catalog-item/#",
			"RULE"	=>	"",
			"ID"	=>	"shop:catalog.element",
			"PATH"	=>	WIZARD_SITE_DIR."content/catalog/detail.php",
		));
}

function ___writeToAreasFile($fn, $text)
{
	if(file_exists($fn) && !is_writable($abs_path) && defined("BX_FILE_PERMISSIONS"))
		@chmod($abs_path, BX_FILE_PERMISSIONS);

	$fd = @fopen($fn, "wb");
	if(!$fd)
		return false;

	if(false === fwrite($fd, $text))
	{
		fclose($fd);
		return false;
	}

	fclose($fd);

	if(defined("BX_FILE_PERMISSIONS"))
		@chmod($fn, BX_FILE_PERMISSIONS);
}

$wizard =& $this->GetWizard();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	$path = str_replace("//", "/", WIZARD_ABSOLUTE_PATH."/site/components/"); 
	
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
	//copy stars component-template
	$path = str_replace("//", "/", WIZARD_ABSOLUTE_PATH."/site/templates/shop/components/bitrix/iblock.vote/"); 
	
	$handle = @opendir($path);
	if ($handle)
	{
		while ($file = readdir($handle))
		{
			if (in_array($file, array(".", "..")))
				continue; 
			CopyDirFiles(
				$path.$file,
				$_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/.default/components/bitrix/iblock.vote/".$file,
				$rewrite = true, 
				$recursive = true,
				$delete_after_copy = false
			);
		}
	}
			
$templateID = $wizard->GetSiteTemplateID();
$templatePath = BX_PERSONAL_ROOT."/templates/".$templateID;

$logo_path = WIZARD_SITE_PATH."/images/logo.png";
if(intval($wizard->GetVar("siteLogo"))>0){
	$logo_path = CFile::GetPath($wizard->GetVar("siteLogo"));
}
else
{
	$logo_path = WIZARD_SITE_DIR."images/logo.png";
}

$arReplace = Array(
	"COMPANY_NAME" => $wizard->GetVar("siteName"),
	"COMPANY_SLOGAN" => $wizard->GetVar("siteSlogan"),
	"COMPANY_LOGO" => $logo_path,
	"COPYRIGHT" => $wizard->GetVar("siteCopy")
);

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/company_name.php", $arReplace);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/logo.php", $arReplace);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/company_slogan.php", $arReplace);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/copyright.php", $arReplace);

if(!CModule::IncludeModule('advertising'))
{
	__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));			
	$topBanner = '--><a href="'.GetMessage("DEMO_ADV_BANNER_URL").'"><img alt="'.GetMessage("DEMO_ADV_NAME").'" title="'.GetMessage("DEMO_ADV_NAME").'" src="'.WIZARD_SITE_DIR.'images/banner.png" width="1001" height="301" border="0"></a><!--';
	$arReplace = Array("BANNER_TOP" => $topBanner);
	CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/banner.php", $arReplace);
}

?>