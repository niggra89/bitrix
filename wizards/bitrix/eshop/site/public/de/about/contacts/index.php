<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Fragen");
?>
<p>Sehr geehrte Kunden,</p>
 
<p>bevor Sie Ihre Frage stellen, beachten Sie bitte unseren Bereich <a href="../faq/">H�ufig gestellte Fragen</a>. Vielleicht finden Sie dort bereits die Antwort auf Ihre Frage.</p> <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"",
	Array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Wir danken Ihnen f�r Ihre Frage. In der n�chsten Zeit werden wir mit Ihnen Kontakt aufnehmen.",
		"EMAIL_TO" => "#SALE_EMAIL#",
		"REQUIRED_FIELDS" => array(),
		"EVENT_MESSAGE_ID" => array()
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>