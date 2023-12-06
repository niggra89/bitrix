<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Autorisierung");
?>
<p class="notetext"Sie haben sich erfolgreich registriert und angemeldet.</p>

<p><a href="#SITE_DIR#">Zurück zur Homepage</a></p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>