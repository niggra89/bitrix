<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"PROP_NAME" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ASD_CMP_PARAM_PROP_NAME"),
			"TYPE" => "TEXT",
		),
		"API_KEY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ASD_CMP_PARAM_API_KEY"),
			"TYPE" => "TEXT",
		),
		"DESCR_TPL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ASD_CMP_PARAM_DESCR_TPL"),
			"TYPE" => "TEXT",
			"DEFAULT" => "#F_NAME# #F_LAST_NAME# (N #ORDER_ID#)",
		),
	),
);
?>