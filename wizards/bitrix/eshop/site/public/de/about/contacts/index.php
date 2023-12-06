<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Fragen");
?>
<p>Sehr geehrte Kunden,</p>
 
<p>bevor Sie Ihre Frage stellen, beachten Sie bitte unseren Bereich <a href="../faq/">Häufig gestellte Fragen</a>. Vielleicht finden Sie dort bereits die Antwort auf Ihre Frage.</p> <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"",
	Array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Wir danken Ihnen für Ihre Frage. In der nächsten Zeit werden wir mit Ihnen Kontakt aufnehmen.",
		"EMAIL_TO" => "#SALE_EMAIL#",
		"REQUIRED_FIELDS" => array(),
		"EVENT_MESSAGE_ID" => array()
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>