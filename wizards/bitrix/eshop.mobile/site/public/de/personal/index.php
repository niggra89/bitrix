<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Pers�nlicher Bereich");
?><p>Im pers�nlichen Bereich k�nnen Sie den aktuellen Warenkorb und den Status Ihrer Bestellungen pr�fen sowie Ihre pers�nlichen Informationen einsehen oder �ndern.</p>
<h2>Bestellungen</h2>
<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
	<li><a href="order/">Bestellstatus anzeigen</a></li>
	<li><a href="cart/">Warenkorb anzeigen</a></li>
	<li><a href="order/?filter_history=Y">Historie der Bestellungen anzeigen</a></li>
</ul>
							
<h2>Pers�nliche Informationen</h2>
<ul data-role="listview" data-inset="true" data-theme="c">
	<li><a href="profile/">Registrierungsdaten �ndern</a></li>
	<li><a href="profile/?change_password=yes">Passwort �ndern</a></li>
	<li><a href="profile/?forgot_password=yes">Passwort vergessen?</a></li>
</ul>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>