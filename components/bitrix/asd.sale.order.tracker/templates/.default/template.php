<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<p><?= GetMessage('ASD_TPL_NOTE')?></p>

<form action="<?= POST_FORM_ACTION_URI?>" method="get">
	<input type="text" name="code" value="<?= $arResult['CODE']?>" />
	<input type="submit" value="<?= GetMessage('ASD_TPL_BUTTON')?>" />
</form>
<br/>

<?if (strlen($arResult['ERROR_CODE'])):?>
	<p style="color: <?= (in_array($arResult['ERROR_CODE'], array(303, 403))) ? 'green' : 'red'?>"><?= GetMessage('ASD_TPL_ERROR_'.$arResult['ERROR_CODE'], array('#CUR_PAGE#' => $APPLICATION->GetCurPageParam()))?></p>
<?elseif ($arResult['STATUS'] == 'OK'):?>
	<p>
		<?= GetMessage('ASD_TPL_STATUS')?>: <span style="color: green"><?= $arResult['STATUS_MESSAGE']?></span><br/>
		<?= GetMessage('ASD_TPL_STATUS_DATE')?>: <?= $arResult['STATUS_DATE']?>
	</p>
<?elseif ($arResult['STATUS'] != ''):?>
	<p><?= GetMessage('ASD_TPL_STATUS')?>: <span style="color: green"><?= GetMessage('ASD_TPL_STATUS_'.$arResult['STATUS'])?></span></p>
<?endif;?>