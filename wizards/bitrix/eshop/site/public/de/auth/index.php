<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Autorisierung");
?>
<p>Sie haben sich erfolgreich registriert und angemeldet.</p>
 
<p>Benutzen Sie die  administrative Toolbar im oberen Teil des Bildschirms f�r einen schnellen Zugriff auf die Funktionen der Strukturverwaltung  und Content Management der Website. Die Tasten der oberen Toolbar unterscheiden sich in Abh�ngigkeit von den Websitebereichen.  Vorgesehen sind bestimmte Aktivit�ten zur Verwaltung von statischen Inhalten der Seite, dynamischen Ver�ffentlichungen (Nachrichten, Katalog, Fotogalerie) usw.</p>
 
<p><a href="<?=SITE_DIR?>">Zur�ck zur Homepage</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>