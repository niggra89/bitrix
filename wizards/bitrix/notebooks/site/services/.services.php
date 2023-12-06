<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServices = Array(
	"main" => Array(
		"NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
		"STAGES" => Array(
			"files.php", // Copy bitrix files
			"template.php", // Install template
			"theme.php", // Install theme
			"group.php", // Install group
			"menu.php", // Install menu
			"settings.php",
		),
	),
	"iblock" => Array(
		"NAME" => GetMessage("SERVICE_IBLOCK"),
		"STAGES" => Array(
			"types.php", //IBlock types
			"news.php",
			"articles.php",
			"products-characteristics.php",
			"products.php",
			"products-configure.php",
		),
	),
	'vote' => array(
		'NAME' => GetMessage("SERVICE_VOTE"),
	),
	"subscribe" => Array(
		"NAME" => GetMessage("SERVICE_SUBSCRIBE"),
	),
	"advertising" => Array(
		"NAME" => GetMessage("SERVICE_ADVERTISING"),
	),
	"sale" => array(
		"NAME" => GetMessage("SERVICE_SALE"),
		"STAGES" => Array("step1.php", "step2.php", "step3.php", "step4.php", "step5.php", "step6.php", "step7.php", "step8.php", "step9.php", "step10.php", "step11.php", "step12.php", "step13.php", "step14.php", "step15.php", "step16.php", "step17.php", "step18.php", "step19.php", "step20.php", "step21.php", "step22.php", "step23.php", "step24.php", "step25.php"),
	),
);
?>