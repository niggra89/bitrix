<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
				
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
	
<?foreach($res as $id=>$arSection){
?>
<div class="col">
<p class="title"><?=$arSection["NAME"]?></p>
	
			<ul>
			<?
if(strtolower($arSection["NAME"])==GetMessage("notebooks")){
?>
<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>all/" ><?=GetMessage("notebooks_all")?></a></li>
<?
}			
				foreach($arSection["SUBSECTION"] as $subSection){
				?>
					<li><a href="<?=$subSection["SECTION_PAGE_URL"]?>" ><?=$subSection["NAME"]?></a></li>
				<?
				}
				if(strtolower($arSection["NAME"])=="ноутбуки"){
				?>
					<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>new/" ><?=GetMessage("notebooks_new")?></a></li>
				<?
				}
			?>
			</ul>
	</div>		
<?}?>

				


