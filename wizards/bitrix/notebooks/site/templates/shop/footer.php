<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?></div>
		</div>
	</div>
</div>
<div id="footer" class="line">
	<div class="wrap">
	<div class="bottom_menu">
			<div class="col">
				<p class="title"><?=GetMessage('nav')?></p>
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
		<?$APPLICATION->IncludeFile(
			SITE_DIR."include_areas/catalog_section_list_footer.php",
			Array(),
			Array("MODE"=>"html")
		);?>
	</div>
	<div class="contacts">
		<?$APPLICATION->IncludeFile(
		SITE_DIR."include_areas/contacts.php",
		Array(),
		Array("MODE"=>"html")
	);?>
<div class="auth_bottom">
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","footer",Array(
					 "REGISTER_URL" => "register.php",
					  "FORGOT_PASSWORD_URL" => "",
					 "PROFILE_URL" => "profile.php",
					 "SHOW_ERRORS" => "Y",
"AUTH_SERVICES"=>"Y",					 
					 )
				);?>
</div></div>
<div class="line">
	<div class="copyright"><?$APPLICATION->IncludeFile(
		SITE_DIR."include_areas/copyright.php",
		Array(),
		Array("MODE"=>"html")
	);?></div>
	<?/*
	<img src="<?=SITE_TEMPLATE_PATH?>/images/1c-bitrix.jpg" alt="1c-Битрикс" class="bitrix_logo" />
	*/?>
</div>
	</div>
</div>

</body>
</html>