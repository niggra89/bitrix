<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<script>
$(document).ready(function(){
	$('.top_menu li.root').bind('mouseover',function(){
		$(this).addClass('jsHover');		
	})
	.bind('mouseout',function(){
		$(this).removeClass('jsHover');		
	});
	
});
</script>			
				
			<?
$res = Array();
foreach($arResult["SECTIONS"] as $arSection){
	if(!$arSection["IBLOCK_SECTION_ID"]){
		$res[$arSection["ID"]] = $arSection;
	}
	else
	{
		$res[$arSection["IBLOCK_SECTION_ID"]]["SUBSECTION"][$arSection["ID"]] = $arSection;
	}
}?>	

<?//echo "<pre>";print_r($res);echo "</pre>";?>
<ul>	
<?foreach($res as $id=>$arSection){
?><li class="root">	<?
	if(count($arSection["SUBSECTION"])>0){?><div class="left"></div><?}
	?><a href="<?=$arSection["LIST_PAGE_URL"]?>" class="root"><?=$arSection["NAME"]?></a><?
	
	if(count($arSection["SUBSECTION"])>0){?>
		<div class="right"></div>
		<div class="sub">
			<div class="top_border"></div>
			<div class="top_border_right"></div>
			<ul>
			<?
if(strtolower($arSection["NAME"])==GetMessage("notebooks")){
?>
<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>all/" ><?=GetMessage("all")?></a></li>
<?
}			
				foreach($arSection["SUBSECTION"] as $subSection){
				?>
					<li><a href="<?=$subSection["SECTION_PAGE_URL"]?>" ><?=$subSection["NAME"]?></a></li>
				<?
				}
				if(strtolower($arSection["NAME"])==GetMessage("notebooks")){
				?>
					<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>new/" ><?=GetMessage("new")?></a></li>
				<?
				}
			?>
			</ul>
			<div class="bottom_border_left"></div>
			<div class="bottom_border"></div>
			<div class="bottom_border_right"></div>
		</div>
	<?}?>
	</li>
<?}?>
</ul>
				


