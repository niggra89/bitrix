<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($_SESSION);echo "</pre>";?>
<div class="catalog-compare-list">
<a name="compare_list"></a>
<?if(count($arResult)>0):?>
	<form action="<?=$arParams["COMPARE_URL"]?>" method="post" class="line with_line" style="margin-bottom:10px;">
		<p style="font-size: 13px;color:#000000;"><?=GetMessage("CATALOG_COMPARE_ELEMENTS")?></p>
		<?foreach($arResult as $arElement):?>
			<div class="line" style="margin:0 0 5px 0;">
				<input type="hidden" name="ID[]" value="<?=$arElement["ID"]?>" />
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="compare_item"><?=$arElement["NAME"]?></a>&nbsp;<a href="<?=$arElement["DELETE_URL"]?>" class="clear_item"><div>&nbsp;</div></a>
			</div>
		<?endforeach?>		
	<div class="line action_compare" >
		<a href="<?=$arParams["COMPARE_URL"]?>" class="action_compare blue"><?=GetMessage("CATALOG_COMPARE")?></a>
	</div>
	</form>
<?endif;?>

</div>