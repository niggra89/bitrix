<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arParams['API_KEY'] = trim($arParams['API_KEY']);

$arResult = array();
$arResult['ERROR_CODE'] = '';
$arResult['STATUS'] = '';
if (!isset($arParams['PROP_NAME'])) {
	$arParams['PROP_NAME'] = 'F_EMS_CODE';
} elseif (!strlen($arParams['PROP_NAME'])) {
	$arParams['PROP_NAME'] = 'DELIVERY_DOC_NUM';
}
$arParams['PROP_NAME'] = trim($arParams['PROP_NAME']);

if (strlen(trim($_REQUEST['code']))) {

	$_REQUEST['code'] = trim($_REQUEST['code']);
	list($_REQUEST['code']) = explode(';', $_REQUEST['code']);
	$arResult['CODE'] = htmlspecialchars($_REQUEST['code']);
	$arResult['~CODE'] = $_REQUEST['code'];

	require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/xml.php');
	$http = new CHTTP();
	$xml = new CDataXML();
	$http->Query('GET', 'ws.gdeposylka.ru', 80, '/x1/track.status/xml/?apikey=' . $arParams['API_KEY'] . '&id=' . $arResult['~CODE']);
	if ($http->errno == 0 && $xml->LoadString($http->result)) {
		$arData = $xml->GetArray();
		if ($arData['result']['#']['response'][0]['#']['code'][0]['#'] == 200) {
			if ($arData['result']['#']['tracks'][0]['#']['track'][0]['#']['code'][0]['#'] == '200') {
				if ($arData['result']['#']['tracks'][0]['#']['track'][0]['#']['status'][0]['#'] == 'NORMAL') {
					$message = $arData['result']['#']['tracks'][0]['#']['track'][0]['#']['info'][0]['#']['status'][0]['#']['message'][0]['#'];
					$date = $arData['result']['#']['tracks'][0]['#']['track'][0]['#']['info'][0]['#']['status'][0]['#']['date'][0]['#'];
					if (!defined('BX_UTF') || BX_UTF !== true) {
						$message = $APPLICATION->ConvertCharset($message, 'UTF-8', SITE_CHARSET);
						$date = $APPLICATION->ConvertCharset($date, 'UTF-8', SITE_CHARSET);
					}
					$arResult['STATUS'] = 'OK';
					$arResult['STATUS_MESSAGE'] = $message;
					$arResult['STATUS_DATE'] = $date;
				}
				else {
					$arResult['STATUS'] = $arData['result']['#']['tracks'][0]['#']['track'][0]['#']['status'][0]['#'];
				}
			} else {
				$arParams['DESCR_TPL'] = trim($arParams['DESCR_TPL']);
				if (strlen($arParams['DESCR_TPL']) && CModule::IncludeModule('sale')) {
					if ($arParams['PROP_NAME']=='DELIVERY_DOC_NUM') {
						$arFilter = array('DELIVERY_DOC_NUM' => $arResult['~CODE']);
					} else {
						array('PROPERTY_VAL_BY_CODE_'.$arParams['PROP_NAME'] => $arResult['~CODE']);
					}
					if ($arOrder = CSaleOrder::GetList(array('ID' => 'DESC'), $arFilter)->Fetch()) {
						$arParams['DESCR_TPL'] = str_replace('#ORDER_ID#', $arOrder['ID'], $arParams['DESCR_TPL']);

						$rsProp = CSaleOrderPropsValue::GetList(array(), array('ORDER_ID' => $arOrder['ID']));
						while ($arProp = $rsProp->Fetch()) {
							$arParams['DESCR_TPL'] = str_replace('#' . $arProp['CODE'] . '#', $arProp['VALUE'], $arParams['DESCR_TPL']);
						}
					} else {
						$arParams['DESCR_TPL'] = '';
					}
				}
				$arParams['DESCR_TPL'] = urlencode($APPLICATION->ConvertCharset($arParams['DESCR_TPL'], SITE_CHARSET, 'UTF-8'));
				$http->Query('GET', 'ws.gdeposylka.ru', 80, '/x1/track.add/xml/?apikey=' . $arParams['API_KEY'] . '&id=' . $arResult['~CODE'] . '&country=RU&descr=' . $arParams['DESCR_TPL']);
				$arResult['ERROR_CODE'] = $arData['result']['#']['tracks'][0]['#']['track'][0]['#']['code'][0]['#'];
			}
		}
		else {
			$arResult['ERROR_CODE'] = $arData['result']['#']['response'][0]['#']['code'][0]['#'];
		}
	}
}

$this->IncludeComponentTemplate();