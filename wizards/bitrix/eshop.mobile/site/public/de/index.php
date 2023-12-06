<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("#SITE_NAME#");
?>
<div class="logo"><a href="<?=SITE_DIR?>" rel="external"><img src="#SITE_DIR#images/logo.jpg"  /></a></div>
<div class="telephone"><a href="callto:#SALE_PHONE#">#SALE_PHONE#</a></div>
<br clear="all" />
<ul data-role="listview" data-inset="true" data-theme="c"> 
	<li><a href="catalog/">Katalog</a></li> 
	<li><a href="howto/">Wie kaufe ich online ein</a></li> 
	<li><a href="delivery/">Lieferung</a></li> 
	<li><a href="news/">News</a></li> 
	<li><a href="about/">Über den Shop</a></li> 
	<li><a href="about/contacts/">Kontakte</a></li> 
	<li><a href="personal/">Persönlicher Bereich</a></li> 
</ul> 
<div data-role="controlgroup" data-type="horizontal">
	<a href="<?=SITE_DIR?>" data-role="button" data-icon="forward" data-iconpos="top" data-theme="c" rel="external">zu Website<br>wechseln</a>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>