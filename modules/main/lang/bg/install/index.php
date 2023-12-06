<?
$MESS["MAIN_ADMIN_GROUP_NAME"] = "Администратори";
$MESS["MAIN_ADMIN_GROUP_DESC"] = "Пълен достъп към управлението на сайта.";
$MESS["MAIN_EVERYONE_GROUP_NAME"] = "Не оторизирани потребители";
$MESS["MAIN_EVERYONE_GROUP_DESC"] = "Всички не оторизирани на сайта потребители.";
$MESS["MAIN_VOTE_RATING_GROUP_NAME"] = "Ползващи имащи право да гласуват за рейтинг";
$MESS["MAIN_VOTE_RATING_GROUP_DESC"] = "В тази група ползващите се добавят автоматично.";
$MESS["MAIN_VOTE_AUTHORITY_GROUP_NAME"] = "Ползващи имащи право да гласуват за авторитет";
$MESS["MAIN_VOTE_AUTHORITY_GROUP_DESC"] = "В тази група ползващите се добавят автоматично.";
$MESS["MAIN_RULE_ADD_GROUP_AUTHORITY_NAME"] = "Добавяне в група на ползващи, имащи право да гласуват за авторитет";
$MESS["MAIN_RULE_ADD_GROUP_RATING_NAME"] = "Добавяне в група на ползващи, имащи право да гласуват за рейтинг";
$MESS["MAIN_RULE_REM_GROUP_AUTHORITY_NAME"] = "Премахване от група на ползващи, нямащи право да гласуват за авторитет";
$MESS["MAIN_RULE_REM_GROUP_RATING_NAME"] = "Премахване от група на ползващи, нямащи право да гласуват за рейтинг";
$MESS["MAIN_RATING_NAME"] = "Рейтинг";
$MESS["MAIN_RATING_AUTHORITY_NAME"] = "Авторитет";
$MESS["MAIN_RATING_TEXT_LIKE_Y"] = "Харесва ми";
$MESS["MAIN_RATING_TEXT_LIKE_N"] = "Не ми харесва";
$MESS["MAIN_RATING_TEXT_LIKE_D"] = "Харесва ми";
$MESS["MAIN_DEFAULT_SITE_NAME"] = "Сайт по подразбиране";
$MESS["MAIN_DEFAULT_LANGUAGE_NAME"] = "Bulgarian";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_DATE"] = "DD.MM.YYYY ";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_DATETIME"] = " DD.MM.YYYY HH:MI:SS ";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_CHARSET"] = " UTF-8 ";
$MESS["MAIN_DEFAULT_SITE_FORMAT_DATE"] = "DD.MM.YYYY";
$MESS["MAIN_DEFAULT_SITE_FORMAT_DATETIME"] = "DD.MM.YYYY HH:MI:SS";
$MESS["MAIN_DEFAULT_SITE_FORMAT_CHARSET"] = " UTF-8 ";
$MESS["MAIN_MODULE_NAME"] = "Главен модул";
$MESS["MAIN_MODULE_DESC"] = "Ядро на системата";
$MESS["MAIN_INSTALL_DB_ERROR"] = "Не мога да се свържа с базата данни. Проверете дали параметрите са правилно въведени";
$MESS["MAIN_NEW_USER_TYPE_NAME"] = "Регистрирал се е нов потребител";
$MESS["MAIN_NEW_USER_TYPE_DESC"] = "






#USER_ID# - ID на потребителя






#LOGIN# - Потребителско име






#EMAIL# - EMail






#NAME# - Име






#LAST_NAME# - Фамилия






#USER_IP# - IP потребителя






#USER_HOST# - Хост на потребителя";
$MESS["MAIN_USER_INFO_TYPE_NAME"] = "Информация за потребителя";
$MESS["MAIN_USER_INFO_TYPE_DESC"] = "






#USER_ID# - ID на потребителя






#STATUS# - Статус на потребителското име 






#MESSAGE# - Съобщение на потребителя






#LOGIN# - Потребителско име






#CHECKWORD# - Контролна дума за смяна на паролата






#NAME# - Име






#LAST_NAME# - Фамилия






#EMAIL# - E-Mail на потребителя";
$MESS["MAIN_NEW_USER_CONFIRM_TYPE_NAME"] = "Потвърждаване на регистрацията за нов потребител";
$MESS["MAIN_NEW_USER_CONFIRM_TYPE_DESC"] = "#LOGIN# - Потребителско име






#EMAIL# - EMail






#NAME# - Име






#LAST_NAME# - Фамилия






#USER_IP# - IP на потребителя






#USER_HOST# - Хост на потребителя






#CONFIRM_CODE# - Код на потвърждаване";
$MESS["MAIN_USER_INVITE_TYPE_NAME"] = "Покана на сайта за нов потребител";
$MESS["MAIN_USER_INVITE_TYPE_DESC"] = "#ID# - ID на потребителя






#LOGIN# - Потребителско име






#URL_LOGIN# - Потребителско име, закодирано за използване в URL






#EMAIL# - EMail";
$MESS["MAIN_NEW_USER_EVENT_NAME"] = "#SITE_NAME#: Регистрирал се е нов потребител";
$MESS["MAIN_NEW_USER_EVENT_DESC"] = "Информационно съобщение от сайта #SITE_NAME#






------------------------------------------













На сайта #SERVER_NAME# успешно се е регистрирал нов потребител.













Данните на потребителя:






ID на потребителя: #USER_ID#













Име: #NAME#






Фамилия: #LAST_NAME#






E-Mail: #EMAIL#













Login: #LOGIN#













Писмото е генерирано автоматично.";
$MESS["MAIN_USER_INFO_EVENT_NAME"] = "#SITE_NAME#: Регистрационна информация";
$MESS["MAIN_USER_INFO_EVENT_DESC"] = "Информационно съобщение от сайта #SITE_NAME#






------------------------------------------






#NAME# #LAST_NAME#,













#MESSAGE#













Вашата регистрационна информация:













ID на потребителя: #USER_ID#






Статус на бюджета: #STATUS#






Login: #LOGIN#













За смяна на паролата преминете по следващият линк:






http://#SERVER_NAME#/bitrix/admin/index.php?change_password=yes&lang=ru&USER_CHECKWORD=#CHECKWORD#













Съобщението е генерирано автоматично.";
$MESS["MAIN_USER_PASS_REQUEST_EVENT_DESC"] = "Информационно съобщение от сайта #SITE_NAME#
------------------------------------------
#NAME# #LAST_NAME#,

#MESSAGE#

За смяна на паролата натиснете следния линк:
http://#SERVER_NAME#/auth/index.php?change_password=yes&lang=ru&USER_CHECKWORD=#CHECKWORD#

Вашата регистрационна информация:

ID на ползващия: #USER_ID#
Статус на бюджета: #STATUS#
Login: #LOGIN#

Съобщението е генерирано автоматично.";
$MESS["MAIN_USER_PASS_CHANGED_EVENT_DESC"] = "Информационно съобщение от сайта #SITE_NAME#
------------------------------------------
#NAME# #LAST_NAME#,

#MESSAGE#

Вашата регистрационна информация:

ID на ползващия: #USER_ID#
Статус на бюджета: #STATUS#
Login: #LOGIN#

Съобщението е генерирано автоматично.";
$MESS["MAIN_NEW_USER_CONFIRM_EVENT_NAME"] = "#SITE_NAME#: Потвърждаване регистрацията на нов потребител";
$MESS["MAIN_NEW_USER_CONFIRM_EVENT_DESC"] = "Информационно съобщение от сайта #SITE_NAME#






------------------------------------------













Здравейте,













Вие получихте това съобщение, тъй като вашият адрес е бил даден при регистрация на нов потребител на сървъра #SERVER_NAME#.













Вашият код за потвърждаване на регистрацията: #CONFIRM_CODE#













За потвърждаване на регистрацията преминете по следващият линк:






http://#SERVER_NAME#/auth/index.php?confirm_registration=yes&confirm_user_id=#USER_ID#&confirm_code=#CONFIRM_CODE#













Вие също така можете да въведете кода за потвърждаване на регистрацията на страницата:






http://#SERVER_NAME#/auth/index.php?confirm_registration=yes&confirm_user_id=#USER_ID#













Внимание! Вие няма да бъдете активиран, докато не потвърдите своята регистрация.













---------------------------------------------------------------------













Съобщението е генерирано автоматично.";
$MESS["MAIN_USER_INVITE_EVENT_NAME"] = "#SITE_NAME#: Покана за сайта";
$MESS["MAIN_USER_INVITE_EVENT_DESC"] = "Информационно съобщение от сайта #SITE_NAME#;






------------------------------------------






Здравейте, #NAME# #LAST_NAME#!";
$MESS["MF_EVENT_NAME"] = "Изпращане на съобщение чрез формата за обратна връзка";
$MESS["MF_EVENT_DESCRIPTION"] = "#AUTHOR# - Автор на съобщението






#AUTHOR_EMAIL# - Email на автора на съобщението






#TEXT# - Текст на съобщението






#EMAIL_FROM# - Email на подателя






#EMAIL_TO# - Email на получателя ";
$MESS["MF_EVENT_SUBJECT"] = "#SITE_NAME#: Съобщение от формата за обратна връзка";
$MESS["MF_EVENT_MESSAGE"] = "Информационно съобщение от сайта #SITE_NAME#






------------------------------------------













Изпратено Ви е съобщение чрез формата за обратна връзка













Автор: #AUTHOR#






E-mail на автора: #AUTHOR_EMAIL#













Текст на съобщението:






#TEXT#













Съобщението е генерирано автоматично.";
$MESS["MAIN_USER_PASS_REQUEST_TYPE_NAME"] = "Заявка за промяна на парола";
$MESS["MAIN_USER_PASS_CHANGED_TYPE_NAME"] = "Потвърждаване на смяна на парола";
$MESS["MAIN_USER_PASS_REQUEST_EVENT_NAME"] = "#SITE_NAME#: Заявка за промяна на парола";
$MESS["MAIN_USER_PASS_CHANGED_EVENT_NAME"] = "#SITE_NAME#: Потвърждаване на смяна на парола";
$MESS["MAIN_DESKTOP_CREATEDBY_KEY"] = "Създадено от";
$MESS["MAIN_DESKTOP_CREATEDBY_VALUE"] = "Bitrix, Inc. ";
$MESS["MAIN_DESKTOP_URL_KEY"] = "Адрес на сайта";
$MESS["MAIN_DESKTOP_URL_VALUE"] = "<a href=\"http://www.bitrixsoft.com\">www.bitrixsoft.com</a>";
$MESS["MAIN_DESKTOP_PRODUCTION_KEY"] = "Сайта е предаден на";
$MESS["MAIN_DESKTOP_PRODUCTION_VALUE"] = "12 декември 2011 г.";
$MESS["MAIN_DESKTOP_RESPONSIBLE_KEY"] = "Отговорно лице";
$MESS["MAIN_DESKTOP_RESPONSIBLE_VALUE"] = "Иван Иванов";
$MESS["MAIN_DESKTOP_EMAIL_KEY"] = "E-mail";
$MESS["MAIN_DESKTOP_EMAIL_VALUE"] = "<a href=\"mailto:info@bitrixsoft.com\">info@bitrixsoft.com</a>";
$MESS["MAIN_DESKTOP_INFO_TITLE"] = "Информация за сайтя";
$MESS["MAIN_DESKTOP_RSS_TITLE"] = "Bitrix News";
$MESS["MAIN_RULE_AUTO_AUTHORITY_VOTE_NAME"] = "Автоматично гласуване за авторитет на ползващия";
?>