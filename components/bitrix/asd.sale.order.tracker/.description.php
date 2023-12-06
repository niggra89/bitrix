<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("ASD_CMP_NAME"),
	"DESCRIPTION" => GetMessage("ASD_CMP_DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"PATH" => array(
		"ID" => "e-store",
		"CHILD" => array(
			"ID" => "sale_personal",
		),

	),
);

?>