<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

	CModule::IncludeModule('fileman');
	$arMenuTypes = GetMenuTypes(WIZARD_SITE_ID);
	if($arMenuTypes['left'] && $arMenuTypes['left'] == GetMessage("WIZ_MENU_LEFT_DEFAULT"))
		$arMenuTypes['left'] =  GetMessage("WIZ_MENU_LEFT");
	if(!$arMenuTypes['leftfirst'])
		$arMenuTypes['leftfirst'] = GetMessage("WIZ_MENU_LEFT_FIRST");
		
	SetMenuTypes($arMenuTypes, WIZARD_SITE_ID);
	COption::SetOptionInt("fileman", "num_menu_param", 2, false ,WIZARD_SITE_ID);
	
	WizardServices::AddMenuItem(WIZARD_SITE_DIR."/.top.menu.php", Array(
	GetMessage("DEMO_CONTENT_MENU1"),
	WIZARD_SITE_DIR."content/about/",
	Array(),
	Array(),
	""),WIZARD_SITE_ID);
	WizardServices::AddMenuItem(WIZARD_SITE_DIR."/.top.menu.php", Array(
		GetMessage("DEMO_CONTENT_MENU2"),
	WIZARD_SITE_DIR."content/delivery/", 
	Array(),
	Array(),
	""),WIZARD_SITE_ID);
	WizardServices::AddMenuItem(WIZARD_SITE_DIR."/.top.menu.php", Array(
		GetMessage("DEMO_CONTENT_MENU3"),
	WIZARD_SITE_DIR."content/how/",
	Array(),
	Array(),
	""),WIZARD_SITE_ID);
	WizardServices::AddMenuItem(WIZARD_SITE_DIR."/.top.menu.php", Array(
		GetMessage("DEMO_CONTENT_MENU4"),
	WIZARD_SITE_DIR."content/help/", 
	Array(),
	Array(),
	""),WIZARD_SITE_ID);
	WizardServices::AddMenuItem(WIZARD_SITE_DIR."/.top.menu.php", Array(
	GetMessage("DEMO_CONTENT_MENU5"),
	WIZARD_SITE_DIR."content/payment/", 
	Array(),
	Array(),
	""),WIZARD_SITE_ID);
	WizardServices::AddMenuItem(WIZARD_SITE_DIR."/.top.menu.php", Array(
	GetMessage("DEMO_CONTENT_MENU6"),
	WIZARD_SITE_DIR."content/contacts/", 
	Array(),
	Array(),
	""),WIZARD_SITE_ID);

?>