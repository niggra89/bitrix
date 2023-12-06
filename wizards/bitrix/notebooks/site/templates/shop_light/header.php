<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<html>
<head>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.4.3.min.js"></script>	
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" media="screen" />
	<script>
	$(document).ready(function() {	
		$("a.fancy").fancybox();
	});
	</script>
	<?$APPLICATION->ShowHead()?>
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div class="wrap">
		<div id="header" class="line">
			<div class="logo">
				<a href="<?=SITE_DIR?>">
				<?$APPLICATION->IncludeFile(
						SITE_DIR."include_areas/logo.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</a>
			</div>
			<div class="company_name">
				<?$APPLICATION->IncludeFile(
						SITE_DIR."include_areas/company_slogan.php",
						Array(),
						Array("MODE"=>"html")
					);?>
			</div>
			<div class="backet_auth" >	
				<div class="basket">
					<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line","",Array(
							"PATH_TO_BASKET" => SITE_DIR."content/personal/basket.php",
							"SHOW_PERSONAL_LINK" => "N"
						),false
					);?>
				</div>
				<div class="auth">
				<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","header",Array(
						"REGISTER_URL" => "auth",
						"FORGOT_PASSWORD_URL" => "",
						"PROFILE_URL" => SITE_DIR."content/personal/",
						"SHOW_ERRORS" => "Y",
						"AUTH_SERVICES"=>"Y",					 
					 )
				);?>
				</div>
			</div>
			<div class="phone_address">
				<div class="phones">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include_areas/phone.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="address">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include_areas/address.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
			</div>
		</div>
		<div class="top_menu line">
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"top",
				Array(
					"ROOT_MENU_TYPE" => "top", 
					"MAX_LEVEL" => "1", 
					"USE_EXT" => "N", 
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => Array()
				)
			);?> 
		</div>
	<div id="content"> 
		<div class="banner">
			 <?if($APPLICATION->GetCurPage()==SITE_DIR){?>
			 <?$APPLICATION->IncludeFile(
					SITE_DIR."include_areas/banner.php",
					Array(),
					Array("MODE"=>"html")
				);?>
			<?}?>				
		</div>
		<div class="left_column">
			<div class="left_menu">
			<?$APPLICATION->IncludeFile(
				SITE_DIR."include_areas/catalog_section_list.php",
				Array(),
				Array("MODE"=>"html")
			);?>
			</div>
			<?if(substr_compare(SITE_DIR."content/catalog/",$_SERVER["REAL_FILE_PATH"], 0,17)!=0|| substr_compare(SITE_DIR."content/catalog/detail.php",$_SERVER["REAL_FILE_PATH"], 0,27)==0){?>
			<div class="line">
			<?$APPLICATION->IncludeFile(
				SITE_DIR."include_areas/voting.php",
				Array(),
				Array("MODE"=>"html")
			);?>
			</div>
			<div class="line with_line" style="margin-top:5px;"></div>			
			<div class="subscribe line">
				<h4><?=GetMessage('SUBSCRIBE_TITLE')?></h4>			
				<?$APPLICATION->IncludeComponent("bitrix:subscribe.form","main_page",Array(
						"USE_PERSONALIZATION" => "Y", 
						"PAGE" => SITE_DIR."content/personal/subscribe/", 
						"SHOW_HIDDEN" => "Y", 
						"CACHE_TYPE" => "A", 
						"CACHE_TIME" => "3600" 
					),false
				);?>
			</div>
			<?}
			else
			{?>
				<div class="line with_line" style="margin: -20px 0 20px;"></div>	
				<div class="line">
				<?$APPLICATION->IncludeFile(
					SITE_DIR."include_areas/catalog_compare_list.php",
					Array(),
					Array("MODE"=>"html")
				);?>
				</div>
				<div class="line">
				<?$APPLICATION->IncludeFile(
					SITE_DIR."include_areas/catalog_filter_specification.php",
					Array(),
					Array("MODE"=>"html")
				);?>	
				</div>
			<?}?>
		</div>
		<?$path="";
		if(isset($_SERVER["REAL_FILE_PATH"]))
		{
			$path = $_SERVER["REAL_FILE_PATH"];
		}
		else
		{
			$path = $_SERVER["PHP_SELF"];
		}?>
		<div class="right_column <?if($APPLICATION->GetCurPage()!=SITE_DIR &&(substr_compare(SITE_DIR."content/catalog/",$path, 0,16+strlen(SITE_DIR))!=0) && (substr_compare(SITE_DIR."content/personal/",$path, 0,17+strlen(SITE_DIR))!=0)){?>r_c_inner<?}?>">
		<?if($APPLICATION->GetCurPage()!=SITE_DIR &&(substr_compare(SITE_DIR."content/catalog/",$path, 0,16+strlen(SITE_DIR))==0)){?>
			<div class="breadcrumb_line">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb",Array(
						"START_FROM" => "0", 
						"PATH" => "", 
						"SITE_ID" => SITE_ID 
					),false
				);?>
			</div>	
			<?if(substr_compare(SITE_DIR."content/catalog/",$path, 0,16+strlen(SITE_DIR))==0){?>		
				<h1><?$APPLICATION->ShowTitle();?></h1>
			<?}?>
		<?}?>
		<div class="line">