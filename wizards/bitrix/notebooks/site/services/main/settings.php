<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

	COption::SetOptionString("fileman", "propstypes", serialize(array("description"=>GetMessage("MAIN_OPT_DESCRIPTION"), "keywords"=>GetMessage("MAIN_OPT_KEYWORDS"), "title"=>GetMessage("MAIN_OPT_TITLE"), "keywords_inner"=>GetMessage("MAIN_OPT_KEYWORDS_INNER"))), false, $siteID);
	
	COption::SetOptionInt("search", "suggest_save_days", 250);
	COption::SetOptionInt("search", "use_tf_cache", "Y");
	
	COption::SetOptionString("iblock", "use_htmledit", "Y");
	COption::SetOptionString("iblock", "combined_list_mode", "Y");

	
	COption::SetOptionString("main", "upload_dir", "upload");
	COption::SetOptionString("main", "component_cache_on","Y");

	COption::SetOptionString("main", "save_original_file_name", "Y");
	COption::SetOptionString("main", "templates_visual_editor", "Y");
	COption::SetOptionString("main", "captcha_registration", "Y");
	COption::SetOptionString("main", "use_secure_password_cookies", "Y");
	COption::SetOptionString("main", "new_user_registration", "Y");
	COption::SetOptionString("main", "auth_comp2", "Y");
	COption::SetOptionString("main", "update_autocheck", "7");


	//socialservices
	$bRu = (LANGUAGE_ID == 'ru');
	$arServices = array(
		"VKontakte" => "N",  
		"MyMailRu" => "N",
		"Twitter" => "N",
		"Facebook" => "N",
		"Livejournal" => "Y",
		"YandexOpenID" => ($bRu? "Y":"N"),
		"Rambler" => ($bRu? "Y":"N"),
		"MailRuOpenID" => ($bRu? "Y":"N"),
		"Liveinternet" => ($bRu? "Y":"N"),
		"Blogger" => "Y",
		"OpenID" => "Y",
		"LiveID" => "N",
	);
	COption::SetOptionString("socialservices", "auth_services", serialize($arServices));

?>