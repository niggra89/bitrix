<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="line">
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<table class="specification" width="100%">
<?foreach($arResult as $prop_section)
{
	?>
	<tr><td class="black" colspan="2"><?=$prop_section["NAME"]?></tr>
	<?
	foreach($prop_section["VALUES"] as $val)
	{
		?>
		<tr><td width="420px"><?=$val["NAME"]?></td><td ><?=$val["VALUE"]?></td></tr>
		<?
	}
}?>
</table>
</div>