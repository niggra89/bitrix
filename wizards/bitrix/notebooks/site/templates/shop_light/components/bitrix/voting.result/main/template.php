<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"])):
	return true;
endif;

/********************************************************************
				Input params
********************************************************************/
$arThemes = array();
$dir = preg_replace("'[\\\\/]+'", "/", dirname(realpath(__FILE__))."/themes/");
if (is_dir($dir) && $directory = opendir($dir)):
	while (($file = readdir($directory)) !== false)
	{
		if ($file == "." || $file == ".." || is_dir($dir.$file)):
			continue;
		endif;
		if (substr($file, -4, 4) == ".css")
			$arThemes[] = substr($file, 0, strlen($file) - 4);
	}
	closedir($directory);
endif;
$sTemplateDir = preg_replace("'[\\\\/]+'", "/", $this->__component->__template->__folder."/");

$arParams["THEME"] = trim($arParams["THEME"]);
$arParams["THEME"] = (in_array($arParams["THEME"], $arThemes) ? $arParams["THEME"] : "");
if (in_array($arParams["THEME"], $arThemes)):
	$date = @filemtime($dir.$arParams["THEME"].".css");
	$GLOBALS['APPLICATION']->SetAdditionalCSS($sTemplateDir.'themes/'.$arParams["THEME"].'.css?'.$date);
elseif (!empty($arParams["THEME"])):
	$date = @filemtime($_SERVER['DOCUMENT_ROOT'].$arParams["THEME"]."/style.css");
	if ($date):
		$GLOBALS['APPLICATION']->SetAdditionalCSS($arParams["THEME"].'/style.css?'.$date);
	endif;
endif;

/********************************************************************
				/Input params
********************************************************************/
?>
<ol class="vote-items-list vote-question-list vote-question-list-main-page">
<?

$iCount = 0;
foreach ($arResult["QUESTIONS"] as $arQuestion):
	$iCount++;
?>
	<li class="vote-question-item <?=($iCount == 1 ? "vote-item-vote-first " : "")?><?
				?><?=($iCount == count($arResult["QUESTIONS"]) ? "vote-item-vote-last " : "")?><?
				?><?=($iCount%2 == 1 ? "vote-item-vote-odd " : "vote-item-vote-even ")?><?
				?>">
		<h4 class="with_line"><?=$arQuestion["QUESTION"]?></h4>
		
		<ol class="vote-items-list vote-answers-list">
<?
	foreach ($arQuestion["ANSWERS"] as $arAnswer):
?>
			<li class="vote-answer-item">
<?
		if ($arParams["THEME"] == ""):
?>
                <?=$arAnswer["MESSAGE"]?>
                <? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): 
                        if (trim($arAnswer["MESSAGE"]) != '') 
                            echo '&nbsp';
                        echo '('.GetMessage('VOTE_GROUP_TOTAL') .')';
                    endif; ?>
                 - <?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)<br />
				<div class="graph-bar" style="width: <?=$arAnswer["BAR_PERCENT"]?>%;background-color:#<?=$arAnswer["COLOR"]?>">&nbsp;</div>
                <? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): ?>
                    <? $arGroupAnswers = $arResult['GROUP_ANSWERS'][$arAnswer['ID']]; ?> 
                    <?foreach ($arGroupAnswers as $arGroupAnswer):?>
                        </li>
                        <li class="vote-answer-item">
                            <? if (trim($arAnswer["MESSAGE"]) != '') { ?>
                                <span class='vote-answer-lolight'><?=$arAnswer["MESSAGE"]?>:&nbsp;</span>
                            <? } ?>
                            <?=$arGroupAnswer["MESSAGE"]?> - <?=($arGroupAnswer["COUNTER"] > 0?'&nbsp;':'')?><?=$arGroupAnswer["COUNTER"]?> (<?=$arGroupAnswer["PERCENT"]?>%)<br />
                            <div class="graph-bar" style="width: <?=$arGroupAnswer["PERCENT"]?>%;background-color:#<?=$arAnswer["COLOR"]?>">&nbsp;</div>
                    <?endforeach?>
                <? endif; // GROUP_ANSWERS ?>
<?
		else:
?>
				<?=$arAnswer["MESSAGE"]?>
                <? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): 
                        if (trim($arAnswer["MESSAGE"]) != '') 
                            echo '&nbsp';
                        echo '('.GetMessage('VOTE_GROUP_TOTAL') .')';
                    endif; ?>
				<div class="graph">
					<nobr class="bar" style="width: <?=(round($arAnswer["BAR_PERCENT"]))?>%;">
						<span><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</span>
					</nobr>
				</div>
                <? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): ?>
                    <? $arGroupAnswers = $arResult['GROUP_ANSWERS'][$arAnswer['ID']]; ?> 
                    <?foreach ($arGroupAnswers as $arGroupAnswer):?>
                        </li>
                        <li class="vote-answer-item">
                            <? if (trim($arAnswer["MESSAGE"]) != '') { ?>
                                <span class='vote-answer-lolight'><?=$arAnswer["MESSAGE"]?>:&nbsp;</span>
                            <? } ?>
                            <?=$arGroupAnswer["MESSAGE"]?>
                            <div class="graph">
                                <nobr class="bar" style="width: <?=(round($arGroupAnswer["PERCENT"]))?>%;">
                                    <span><?=$arGroupAnswer["COUNTER"]?> (<?=$arGroupAnswer["PERCENT"]?>%)</span>
                                </nobr>
                            </div>
                    <?endforeach?>
                <? endif; // GROUP_ANSWERS ?>

<?
		endif;
?>
			</li>
<?
	endforeach; 
?>
		</ol>
	</li>
<?
endforeach; 
?>
</ol>