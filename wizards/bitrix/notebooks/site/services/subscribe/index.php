<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
if(!CModule::IncludeModule('subscribe'))
	return;

//Library
include_once(dirname(__FILE__)."/../iblock/iblock_tools.php");
__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));

//Set options which will overwrite defaults
COption::SetOptionString("subscribe", "subscribe_section", "#SITE_DIR#content/personal/subscribe/");
COption::SetOptionString("subscribe", "posting_use_editor", "Y");
COption::SetOptionString("subscribe", "attach_images", "Y");

//Copy template
CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/subscribe/install/php_interface", $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/php_interface", false, true);

$fname = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/php_interface/subscribe/templates/news/template.php";
if(file_exists($fname) && is_file($fname) && ($fh = fopen($fname, "rb")))
{
	$php_source = fread($fh, filesize($fname));
	$php_source = preg_replace("#([\"'])(SITE_ID)(\\1)(\\s*=>\s*)([\"'])(.*?)(\\5)#", "\\1\\2\\3\\4\\5".WIZARD_SITE_ID."\\7", $php_source);
	fclose($fh);
	$fh = fopen($fname, "wb");
	if($fh)
	{
		fwrite($fh, $php_source);
		fclose($fh);
	}
}
$r_name =  GetMessage("DEMO_SUBSCR_RIBRIC2_NAME");
//$r_name.= "[".WIZARD_SITE_ID."]";
$rsRubric = CRubric::GetList(array(), array("LID"=>WIZARD_SITE_ID,"NAME" =>$r_name));
if(!$rsRubric->Fetch())
{
	$arFields = Array(
		"ACTIVE"	=> "Y",
		"NAME"		=> $r_name,
		"SORT"		=> 200,
		"DESCRIPTION"	=> GetMessage("DEMO_SUBSCR_RIBRIC2_DESCRIPTION"),
		"LID"		=> WIZARD_SITE_ID,
		"AUTO"		=> "N",
	);
	$obRubric = new CRubric;
	$ID = $obRubric->Add($arFields);	
}

?>