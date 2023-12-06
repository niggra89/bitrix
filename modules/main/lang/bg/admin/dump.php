<?
$MESS["MAIN_DUMP_FILE_CNT"] = "Компресирани файлове:";
$MESS["MAIN_DUMP_FILE_SIZE"] = "Размер на файловете:";
$MESS["MAIN_DUMP_FILE_FINISH"] = "Създаването на резервно копие е завършено";
$MESS["MAIN_DUMP_FILE_MAX_SIZE"] = "Да не се включват файлове с размер, който надхвърля:";
$MESS["MAIN_DUMP_FILE_STEP"] = "Стъпка:";
$MESS["MAIN_DUMP_FILE_STEP_SLEEP"] = "интервал:";
$MESS["MAIN_DUMP_FILE_STEP_sec"] = "секунди";
$MESS["MAIN_DUMP_FILE_MAX_SIZE_b"] = "б";
$MESS["MAIN_DUMP_FILE_MAX_SIZE_kb"] = "кб";
$MESS["MAIN_DUMP_FILE_MAX_SIZE_mb"] = "Мб ";
$MESS["MAIN_DUMP_FILE_MAX_SIZE_gb"] = "Гб ";
$MESS["MAIN_DUMP_FILE_DUMP_BUTTON"] = "Архивирай";
$MESS["MAIN_DUMP_FILE_STOP_BUTTON"] = "Стоп";
$MESS["MAIN_DUMP_FILE_KERNEL"] = "Архивирай ядрото:";
$MESS["MAIN_DUMP_FILE_NAME"] = "Име";
$MESS["FILE_SIZE"] = "Размер на файла";
$MESS["MAIN_DUMP_FILE_TIMESTAMP"] = "Променен";
$MESS["MAIN_DUMP_FILE_PUBLIC"] = "Архивирай публичната част:";
$MESS["MAIN_DUMP_FILE_TITLE"] = "Файлове";
$MESS["MAIN_DUMP_BASE_STAT"] = "статистика";
$MESS["MAIN_DUMP_BASE_SINDEX"] = "индекса за търсене";
$MESS["MAIN_DUMP_BASE_IGNORE"] = "Изключи от архива:";
$MESS["MAIN_DUMP_BASE_TRUE"] = "Архивирай базата данни:";
$MESS["MAIN_DUMP_BASE_TITLE"] = "База данни";
$MESS["MAIN_DUMP_BASE_SIZE"] = "МБ";
$MESS["MAIN_DUMP_PAGE_TITLE"] = "Резервно копиране";
$MESS["MAIN_DUMP_TAB"] = "Копиране";
$MESS["MAIN_DUMP_SITE_PROC"] = "Компресиране ...";
$MESS["MAIN_DUMP_ARC_SIZE"] = "Размер на архива:";
$MESS["MAIN_DUMP_TABLE_FINISH"] = "Обработено таблици:";
$MESS["MAIN_DUMP_ACTION_DOWNLOAD"] = "Изтегли";
$MESS["MAIN_DUMP_DELETE"] = "Премахни";
$MESS["MAIN_DUMP_ALERT_DELETE"] = "Сигурни ли сте, че искате да изтриете файл?";
$MESS["MAIN_DUMP_FILE_PAGES"] = "Резервни копия";
$MESS["MAIN_RIGHT_CONFIRM_EXECUTE"] = "Внимание! Разархивирането на резервното копие на сайта може да повреди архива! Не оставяйте скрипта за възстановяване  и резервното копие  в главната папка на сайта!";
$MESS["MAIN_DUMP_RESTORE"] = "Отворете";
$MESS["MAIN_DUMP_ENCODE"] = "Внимание!Вие използвате кодирана версия на продукта";
$MESS["MAIN_DUMP_MYSQL_ONLY"] = "Системата на резервното копиране работи само с базата данни MySQL.<br> Моля, използвайте външни инструменти за създаването на архив";
$MESS["MAIN_DUMP_HEADER_MSG"] = "За да преместите архива на сайта на друг хостинг,поставете в корената папка на новият сайт скрипт за възтановяване<a href='/bitrix/admin/restore_export.php'>restore.php</a> и самият архив, след това наберете в браузера &quot;&lt;името на сайта&gt;/restore.php&quot; и следвайте инструкциите по  разархивирането.<br>Подробната инструкция е достъпна на <a href='http://dev.1c-bitrix.ru/api_help/main/going_remote.php' target=_blank> в раздела за справки</a>.";
$MESS["MAIN_DUMP_SKIP_SYMLINKS"] = "Прескачане на символичните линкове към директориите:";
$MESS["MAIN_DUMP_MASK"] = "Изключване от архива файлове и директории по маска:";
$MESS["MAIN_DUMP_MORE"] = "Още...";
$MESS["MAIN_DUMP_FOOTER_MASK"] = "За маската на изключенията действат следващите правила:






	<p>






	<li>шаблона на маската може да съдържа символи &quot;*&quot;, който съответстват на всеки брой символи в името на файла или папката;</li>






	<li>ако в началото има наклонена черта (&quot;/&quot; или &quot;\\&quot;), пътя започва от корена на сайта;</li>






	<li>в противен случай шаблона се поставя към всеки файл или папка;</li>






	<p>Примери за шаблони:</p>






	<li>/content/photo - изключване из цяло на папката /content/photo;</li>






	<li>*.zip - изключване на файлове с разширения &quot;zip&quot;;</li>






	<li>.access.php - изключване на всички файлове &quot;.access.php&quot;;</li>






	<li>/files/download/*.zip - изключване на файлове с расширения &quot;zip&quot; от директорията /files/download;</li>






	<li>/files/d*/*.ht* - изключване на файлове от директорията, която започва &quot;/files/d&quot;  с разширенията, на &quot;ht&quot;.</li>






	";
$MESS["MAIN_DUMP_ERROR"] = "Грешка";
$MESS["DUMP_NO_PERMS"] = "Недостатъчни права за създаване на архив";
$MESS["DUMP_NO_PERMS_READ"] = "Грешка при отварянето на архива";
$MESS["DUMP_DB_CREATE"] = "Създаване на dump на базата данни";
$MESS["DUMP_CUR_PATH"] = "Текущ път:";
$MESS["INTEGRITY_CHECK"] = "Проверка на целостта ";
$MESS["CURRENT_POS"] = "Текуща позиция:";
$MESS["TAB_STANDARD"] = "Стандартни ";
$MESS["TAB_STANDARD_DESC"] = "Стандартни режими за създаване на резервно копие";
$MESS["TAB_ADVANCED"] = "Разширени";
$MESS["TAB_ADVANCED_DESC"] = "Специални настройки за създаване на резервно копие";
$MESS["MODE_DESC"] = "Ще се създаде пълен архив на публичната част на <b>този сайт</b> (за многосайтова конфигурация на различни домейни),<b>ядрото на продукта</b> и <b>базата данни</b> (само за MySQL), който подхожда за пълно възстановяване на системата и преместването на друг сървър. След избор на един от режимите  може да се коригират настройките от &quot;<b>Разширения</b>&quot;.";
$MESS["MODE_VPS"] = "Отделен сървър или VPS (оптимално по време)";
$MESS["MODE_SHARED"] = "Стандартен хостинг (подхожда за повечето сайтове)";
$MESS["MODE_SLOW"] = "Безопасен режим (ако другите режими не работят: без компресия, с интервали между стъпките)";
$MESS["PUBLIC_PART"] = "Публична част на сайта:";
$MESS["SERVER_LIMIT"] = "Сървърни ограничения";
$MESS["STEP_LIMIT"] = "Продължителност на стъпката:";
$MESS["DISABLE_GZIP"] = "Изключване на компресията (намалява натоварването на процесора)";
$MESS["INTEGRITY_CHECK_OPTION"] = "При завършването проверете архива,за грешки:";
$MESS["MAIN_DUMP_DB_PROC"] = "Компресиране на dump база данни";
$MESS["CDIR_FOLDER_ERROR"] = "Грешка при обработката на папката:";
$MESS["CDIR_FOLDER_OPEN_ERROR"] = "Грешка при отварянето на файла:";
$MESS["CDIR_FILE_ERROR"] = "Грешка при обработката на файла:";
$MESS["BACKUP_NO_PERMS"] = "Няма разрешение за запис в папката /bitrix/backup";
$MESS["TIME_SPENT"] = "За време:";
$MESS["TIME_H"] = "час.";
$MESS["TIME_M"] = "мин.";
$MESS["TIME_S"] = "сек.";
?>