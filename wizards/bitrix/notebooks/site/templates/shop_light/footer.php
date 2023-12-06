<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
			</div>
		</div>
	</div>
<div id="footer" class="line">
	<div class="bottom_menu">
		<?$APPLICATION->IncludeFile(
			SITE_DIR."include_areas/catalog_section_list_footer.php",
			Array(),
			Array("MODE"=>"html")
		);?>
	</div>
	<div class="cards">
		<?$APPLICATION->IncludeFile(
			SITE_DIR."include_areas/payment.php",
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
		<?$APPLICATION->IncludeComponent("bitrix:search.form","",Array(
				"USE_SUGGEST" => "N",
				"PAGE" => SITE_DIR."content/search/index.php"
			)
		);?>
	</div>
<div class="line" style="margin:15px 0 0 0;">
	<div class="menu_footer"><?$APPLICATION->IncludeComponent(
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
	);?> </div>
	<div class="copyright"><?$APPLICATION->IncludeFile(
		SITE_DIR."include_areas/copyright.php",
		Array(),
		Array("MODE"=>"html")
	);?></div>
</div>

</div>
</div>
</body>
</html>