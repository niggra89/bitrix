<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($_SESSION);echo "</pre>";?>
<div class="catalog-compare-list">
<a name="compare_list"></a>
<?if(count($arResult)>0):?>
	<form action="<?=$arParams["COMPARE_URL"]?>" method="post">
		<p style="font-size: 13px;color:#000000;"><?=GetMessage("CATALOG_COMPARE_ELEMENTS")?></p>

		<?foreach($arResult as $arElement):?>
			<div class="line">
			<input type="hidden" name="ID[]" value="<?=$arElement["ID"]?>" />
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="compare_item"><?=$arElement["NAME"]?></a>&nbsp;<a href="<?=$arElement["DELETE_URL"]?>" class="clear_item"><div>&nbsp;</div></a>

			</div>
		<?endforeach?>
		
	<div class="line action_compare" >
		<?/*<input type="submit"  value="<?=GetMessage("CATALOG_COMPARE")?>" />
		<input type="hidden" name="action" value="COMPARE" />
		<input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" />
		*/?>
		<a href="<?=$arParams["COMPARE_URL"]?>" class="action_compare blue">&nbsp;<?/*=GetMessage("CATALOG_COMPARE")*/?></a>
		<?/*<a href="#" class="clear_compare blue">Очистить</a>
		<script>
			$(document).ready(function(){
				$('.clear_compare').bind('click',function()
				{
					
				});
			});
		</script>
		*/?>
	</div>
	</form>
<?endif;?>

</div>