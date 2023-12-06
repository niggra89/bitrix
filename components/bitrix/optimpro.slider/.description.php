<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("STR_CMP_NAME"),
	"DESCRIPTION" => GetMessage("STR_CMP_DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"SORT" => 100,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "utility",
		"NAME" => GetMessage("STR_CMP_GLOBAL_DIR_NAME"),
		"CHILD" => array(
			"ID" => "asd_other",
			"NAME" => GetMessage("STR_CMP_DIR_NAME")
		),

	),
);

?>