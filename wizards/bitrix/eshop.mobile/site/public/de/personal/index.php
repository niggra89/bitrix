<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Persönlicher Bereich");
?><p>Im persönlichen Bereich können Sie den aktuellen Warenkorb und den Status Ihrer Bestellungen prüfen sowie Ihre persönlichen Informationen einsehen oder ändern.</p>
<h2>Bestellungen</h2>
<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
	<li><a href="order/">Bestellstatus anzeigen</a></li>
	<li><a href="cart/">Warenkorb anzeigen</a></li>
	<li><a href="order/?filter_history=Y">Historie der Bestellungen anzeigen</a></li>
</ul>
							
<h2>Persönliche Informationen</h2>
<ul data-role="listview" data-inset="true" data-theme="c">
	<li><a href="profile/">Registrierungsdaten ändern</a></li>
	<li><a href="profile/?change_password=yes">Passwort ändern</a></li>
	<li><a href="profile/?forgot_password=yes">Passwort vergessen?</a></li>
</ul>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>