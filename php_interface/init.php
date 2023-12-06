<?
CModule::AddAutoloadClasses(
	"", 
	array(
		'CTUSOMAIN' => '/bitrix/php_interface/class.php',
		'CYandexMarketReviews' => '/bitrix/php_interface/yamarketreviews.php',
		'CSeo' => '/bitrix/php_interface/CSeo.php',
		'CInstagramApi' => '/bitrix/php_interface/CInstagramApi.php',
		'CInstagramApi2' => '/bitrix/php_interface/CInstagramApi2.php',
		'CUserOrder' => '/bitrix/php_interface/CUserOrder.php',
	)
);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/handlers.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/functions.php');
//include dirname(__FILE__).'/include/classes/Autoload.php';//TODO
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/user_props.php');
//trigger
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/php_interface/sender/handlers.php");