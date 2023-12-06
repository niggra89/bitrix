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
<div id="header" class="line">
	<div class="wrap">
			<div class="logo">
				<a href="<?=SITE_DIR?>">
				<?$APPLICATION->IncludeFile(
						SITE_DIR."include_areas/company_name.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</a>	
			</div>
		<div class="header_menu">
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"top",
				Array(
					"ROOT_MENU_TYPE" => "top", 
					"MAX_LEVEL" => "1", 
					"CHILD_MENU_TYPE" => "left", 
					"USE_EXT" => "N", 
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => Array()
				)
			);?> 
		</div>
		<div class="phone_backet" >	
			<div class="basket">
				<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line","",Array(
						"PATH_TO_BASKET" => SITE_DIR."content/personal/basket.php",
						"SHOW_PERSONAL_LINK" => "N"
					),false
				);?>
			</div>
			<div class="phone">
				<?$APPLICATION->IncludeFile(
					SITE_DIR."include_areas/phone.php",
					Array(),
					Array("MODE"=>"html")
				);?>
			</div>
		</div>
		<div class="address_auth">
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
			<div class="address">
				<?$APPLICATION->IncludeFile(
					SITE_DIR."include_areas/address.php",
					Array(),
					Array("MODE"=>"html")
				);?>
			</div>
		</div>
	</div>
</div>
<div class="wrap">
	<div class="top_menu line">
		<div class="catalog_menu">
		<?$APPLICATION->IncludeFile(
			SITE_DIR."include_areas/catalog_section_list.php",
			Array(),
			Array("MODE"=>"html")
		);?>
		</div>
		<div class="search-form">
		<?$APPLICATION->IncludeComponent("bitrix:search.form","",Array(
				"USE_SUGGEST" => "N",
				"PAGE" => SITE_DIR."content/search/index.php"
			)
		);?>
		</div>
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
		<?$path="";
		if(isset($_SERVER["REAL_FILE_PATH"]))
		{
			$path = $_SERVER["REAL_FILE_PATH"];
		}
		else
		{
			$path = $_SERVER["PHP_SELF"];
		}?>
		<?if($APPLICATION->GetCurPage()!=SITE_DIR && $path!=SITE_DIR."content/catalog/list.php" && $path!=SITE_DIR."content/catalog/index.php"){?>
	  <div class="line">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb",Array(
					"START_FROM" => "0", 
					"PATH" => "", 
					"SITE_ID" => SITE_ID 
				),true
			);?>
		</div>
		<?}?>
		<div class="line">