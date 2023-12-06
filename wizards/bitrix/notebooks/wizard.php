<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/wizard.php");

class SelectSiteStep extends CSelectSiteWizardStep
{
	function InitStep()
	{
		parent::InitStep();

		$wizard =& $this->GetWizard();
		$wizard->solutionName = "notebooks";
	}
}


class SelectTemplateStep extends CSelectTemplateWizardStep
{
}

class SelectThemeStep extends CSelectThemeWizardStep
{

}

class SiteSettingsStep extends CSiteSettingsWizardStep
{
	function InitStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->solutionName = "notebooks";
		parent::InitStep();

		$templateID = $wizard->GetVar("templateID");
		$themeID = $wizard->GetVar($templateID."_themeID");

		$siteLogo = $this->GetFileContentImgSrc(WIZARD_SITE_PATH."include/company_name.php", "/bitrix/wizards/bitrix/notebooks/site/templates/".$templateID."/themes/".$themeID."/lang/".LANGUAGE_ID."/logo.gif");
		if (!file_exists(WIZARD_SITE_PATH."include/logo.gif"))
			$siteLogo = "/images/logo.png";
			
		//$siteBanner = $this->GetFileContentImgSrc(WIZARD_SITE_PATH."include/banner.php", "/bitrix/wizards/bitrix/notebooks/site/templates/".$templateID."/images/banner.png");
		
		$wizard->SetDefaultVars(
			Array(
				"siteLogo" => $siteLogo,
				"siteName" => GetMessage("WIZ_COMPANY_NAME"), 
				"siteBannerText" => $this->GetFileContent(WIZARD_SITE_PATH."include/banner_text.php", GetMessage("WIZ_BANNER_TEXT_DEFAULT")),
				"siteSlogan" => $this->GetFileContent(WIZARD_SITE_PATH."include/company_slogan.php", GetMessage("WIZ_COMPANY_SLOGAN_DEF")),
				"siteCopy" => $this->GetFileContent(WIZARD_SITE_PATH."include/copyright.php", GetMessage("WIZ_COMPANY_COPY_DEF")),
				"siteMetaDescription" => GetMessage("wiz_site_desc"),
				"siteMetaKeywords" => GetMessage("wiz_keywords"),  
			)
		);
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
				
		$siteLogo = $wizard->GetVar("siteLogo", true);

		$this->content .= '<table width="100%" cellspacing="0" cellpadding="0">';
		$this->content .= '<tr><td>';
		$this->content .= '<label for="site-logo">'.GetMessage("WIZ_COMPANY_LOGO").'</label><br />';
		$this->content .= CFile::ShowImage($siteLogo, 190, 70, "border=0 vspace=15");
		$this->content .= "<br />".$this->ShowFileField("siteLogo", Array("show_file_info" => "N", "id" => "site-logo"));
		$this->content .= '</tr></td>';

		$this->content .= '<tr><td><br /><br /><br /></td></tr>';
		$this->content .= '<tr><td>';
		$this->content .= '<label for="site-slogan">'.GetMessage("WIZ_COMPANY_SLOGAN").'</label><br />';
		$this->content .= $this->ShowInputField("textarea", "siteSlogan", Array("id" => "site-slogan", "style" => "width:100%", "rows"=>"3"));
		$this->content .= '</tr></td>';

		$this->content .= '<tr><td><br /></td></tr>';

		$this->content .= '<tr><td>';
		$this->content .= '<label for="site-copy">'.GetMessage("WIZ_COMPANY_COPY").'</label><br />';
		$this->content .= $this->ShowInputField("textarea", "siteCopy", Array("id" => "site-copy", "style" => "width:100%", "rows"=>"3"));
		$this->content .= '</tr></td>';

		$this->content .= '<tr><td><br /></td></tr>';

		$firstStep = COption::GetOptionString("main", "wizard_first" . substr($wizard->GetID(), 7)  . "_" . $wizard->GetVar("siteID"), false, $wizard->GetVar("siteID")); 
		$this->content .= '
		<div class="wizard-input-form-block">
			<label for="siteName">'.GetMessage("siteName").'</label><br>
			<div class="wizard-input-form-block-content" style="margin-top:7px;">
				<div class="wizard-input-form-field wizard-input-form-field-text">'.
					$this->ShowInputField('text', 'siteName', array("id" => "siteName", "style" => "background-color:#fff;width:100% !important")).'</div>
			</div>
		</div>';

		if($firstStep == "Y")
		{
			$this->content .= '<tr><td style="padding-bottom:3px;">';
			$this->content .= $this->ShowCheckboxField("installDemoData", "Y", 
				(array("id" => "install-demo-data", "onClick" => "if(this.checked == true){document.getElementById('bx_metadata').style.display='block';}else{document.getElementById('bx_metadata').style.display='none';}")));
			$this->content .= '<label for="install-demo-data">'.GetMessage("wiz_structure_data").'</label><br />';
			$this->content .= '</td></tr>';
			
			$this->content .= '<tr><td>&nbsp;</td></tr>';
		}
		else
		{
			$this->content .= $this->ShowHiddenField("installDemoData","Y");
		}
		
		$this->content .= '</table>';

		$formName = $wizard->GetFormName();
		$installCaption = $this->GetNextCaption();
		$nextCaption = GetMessage("NEXT_BUTTON");
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		$res = $this->SaveFile("siteLogo", Array("extensions" => "gif,jpg,jpeg,png", "max_height" => 70, "max_width" => 190, "make_preview" => "Y"));
		$res = $this->SaveFile("siteBanner", Array("extensions" => "gif,jpg,jpeg,png", "max_height" => 600, "max_width" => 600, "make_preview" => "Y"));
	}
}

class DataInstallStep extends CDataInstallWizardStep
{
	function CorrectServices(&$arServices)
	{
		$wizard =& $this->GetWizard();
		if($wizard->GetVar("installDemoData") != "Y")
		{
			
		}
	}
}

class FinishStep extends CFinishWizardStep
{
	function CreateNewIndex()
	{
		$wizard =& $this->GetWizard();
		
		$wizard_path = $wizard->GetPath();
		$templateID = WIZARD_TEMPLATE_ID;
		$pos = substr_count($templateID, "shop_light");
		if ($pos == 0) {
			if(substr_count($templateID, "shop")>0){
				$templateID = "shop";
			}
			else
			{
				$templateID = $wizard->GetVar("templateID");
                if (substr_count($templateID, "shop_light") == 0){
					if(substr_count($templateID, "shop")>0){
                        $templateID = "shop";
					}
					else $templateID = "test";
				}
                else
                    $templateID = "shop_light";
			}
		}
		else
		{
			$templateID = "shop_light";
		}
		$siteID = WizardServices::GetCurrentSiteID($wizard->GetVar("siteID"));

		define("WIZARD_SITE_ID", $siteID);
		define("WIZARD_SITE_ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);

		$rsSites = CSite::GetByID($siteID);
		if ($arSite = $rsSites->Fetch())
			define("WIZARD_SITE_DIR", $arSite["DIR"]);
		else
			define("WIZARD_SITE_DIR", "/");

		define("WIZARD_SITE_PATH", str_replace("//", "/", WIZARD_SITE_ROOT_PATH."/".WIZARD_SITE_DIR."/"));

		//Copy index page
		CopyDirFiles(
			WIZARD_SITE_ROOT_PATH."/".$wizard_path."/site/indexes/ru/".$templateID."/index.php",
			WIZARD_SITE_PATH."/index.php",
			$rewrite = true,
			$recursive = true,
			$delete_after_copy = false
		);
		
		if (!CModule::IncludeModule("iblock"))
			return false;
			
		$arReplace = Array();
		$arReplace["IBLOCK_CATALOG_ID"] = CIBlockCMLImport::GetIBlockByXML_ID("products-products_".WIZARD_SITE_ID);
		$arReplace["IBLOCK_SPECIFICATION_ID"] = CIBlockCMLImport::GetIBlockByXML_ID("products-characteristics_".WIZARD_SITE_ID);						
		$arReplace["IBLOCK_NEWS_ID"] = CIBlockCMLImport::GetIBlockByXML_ID("news_".WIZARD_SITE_ID);			
		$arReplace["IBLOCK_ARTICLES_ID"] = CIBlockCMLImport::GetIBlockByXML_ID("articles_".WIZARD_SITE_ID);			
		if(CModule::IncludeModule('vote')){
			$vote = '--><'.'?'.'$'.'APPLICATION->IncludeComponent("bitrix:voting.current", "main", array(
				"CHANNEL_SID" => "ANKETA_'.WIZARD_SITE_ID.'",
				"VOTE_ALL_RESULTS" => "Y",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_SHADOW" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"AJAX_OPTION_ADDITIONAL" => ""
				),
				false
			);?><!--';
			$arReplace["VOTE"] = $vote;
		}
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/index.php", $arReplace);
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/catalog_section_list.php", $arReplace);
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/catalog_section_list_footer.php", $arReplace);
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/catalog_compare_list.php", $arReplace);
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/catalog_filter_specification.php", $arReplace);
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include_areas/voting.php", $arReplace);
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/user_forms/catalog/iblock_element_edit.php", Array("SITE_ID"=>WIZARD_SITE_ID));
		CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/user_forms/catalog/iblock_element_save.php", Array("SITE_ID"=>WIZARD_SITE_ID));
		bx_accelerator_reset();
	}
}
?>