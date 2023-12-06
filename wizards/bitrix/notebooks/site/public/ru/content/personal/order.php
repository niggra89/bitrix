<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>

<?$APPLICATION->IncludeComponent("bitrix:sale.order.full","make_order",Array(
	"PATH_TO_BASKET" => "basket.php",
	"PATH_TO_PERSONAL" => "index.php",
	"PATH_TO_AUTH" => "#SITE_DIR#auth.php",
	"PATH_TO_PAYMENT" => "payment.php",
	"ALLOW_PAY_FROM_ACCOUNT" => "Y",
	"SHOW_MENU" => "Y",
	"USE_AJAX_LOCATIONS" => "Y",
	"SHOW_AJAX_DELIVERY_LINK" => "Y",
	"CITY_OUT_LOCATION" => "Y",
	"COUNT_DELIVERY_TAX" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"SET_TITLE" => "Y",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "Y",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
	"SEND_NEW_USER_NOTIFY" => "Y",
	"PROP_1" => Array(),
	"PROP_2" => Array()
	),true
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>