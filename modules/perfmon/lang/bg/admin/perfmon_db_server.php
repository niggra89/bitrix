<?
$MESS["PERFMON_DB_SERVER_TITLE"] = "Монитор за ефективността: Сървър база данни";
$MESS["PERFMON_STATUS_TITLE"] = "Статистика на сървъра";
$MESS["PERFMON_WAITS_TITLE"] = "Статистика на изчакване на сървъра";
$MESS["PERFMON_PARAMETERS_TITLE"] = "Параметри на сървъра";
$MESS["PERFMON_STATS_TITLE"] = "Сбор на статистиката от обектите на базата данни";
$MESS["PERFMON_KPI_NAME"] = "Показател";
$MESS["PERFMON_KPI_VALUE"] = "Значение";
$MESS["PERFMON_KPI_RECOMENDATION"] = "Рекомендации";
$MESS["PERFMON_KPI_NAME_VERSION"] = "Версия";
$MESS["PERFMON_KPI_REC_VERSION_OLD"] = "Версията на MySQL е стара. Обновете я веднага!";
$MESS["PERFMON_KPI_REC_VERSION_OK"] = "Тази версия на MySQL поддържа тази диагностика.";
$MESS["PERFMON_KPI_REC_VERSION_NEW"] = "Тази версия на MySQL НЕ поддържа тази диагностика. Резултатите могат да бъдат грешни.";
$MESS["PERFMON_KPI_NAME_UPTIME"] = "Време";
$MESS["PERFMON_KPI_VAL_UPTIME"] = "#DAYS#д #HOURS#ч #MINUTES#м #SECONDS#с";
$MESS["PERFMON_KPI_REC_UPTIME_OK"] = "Продължителност на работата на сървъра MySQL.";
$MESS["PERFMON_KPI_REC_UPTIME_TOO_SHORT"] = "Сървъра  работил по-малко от 24 часа. Препоръките могат да бъдат неточни.";
$MESS["PERFMON_KPI_NAME_QUERIES"] = "Общо заявки към сървъра";
$MESS["PERFMON_KPI_REC_NO_QUERIES"] = "Не може да се диагностира сървъра, ако не обработва заявките.";
$MESS["PERFMON_KPI_NAME_GBUFFERS"] = "Глобални буфери";
$MESS["PERFMON_KPI_REC_GBUFFERS"] = "Размер на глобалните буфери (#VALUE#).";
$MESS["PERFMON_KPI_NAME_CBUFFERS"] = "Буфери за връзка";
$MESS["PERFMON_KPI_REC_CBUFFERS"] = "Размер на буфера на едно включване (#VALUE#).";
$MESS["PERFMON_KPI_NAME_CONNECTIONS"] = "Връзки";
$MESS["PERFMON_KPI_REC_CONNECTIONS"] = "Максимален брой включвания (#VALUE#).";
$MESS["PERFMON_KPI_NAME_MEMORY"] = "Памет";
$MESS["PERFMON_KPI_REC_MEMORY"] = "Максимално използване на паметта (Глобални буфери + Буфери на включванията * Включвания).<br> Уверете се, че не превишава 85-90 процента от физическата памет на сървъра (с изключване на други процеси).";
$MESS["PERFMON_KPI_NAME_MYISAM_IND"] = "MyISAM индекси";
$MESS["PERFMON_KPI_REC_MYISAM_IND"] = "Размер на MyISAM индексите.";
$MESS["PERFMON_KPI_REC_MYISAM_NOIND"] = "MyISAM индексите отсъстват.";
$MESS["PERFMON_KPI_REC_MYISAM4_IND"] = "Няма възможност да се определи индексите за MySQL за версия по-малка от 5.";
$MESS["PERFMON_KPI_NAME_KEY_MISS"] = "Кеш на индексите MyISAM (пропуски)";
$MESS["PERFMON_KPI_REC_KEY_MISS"] = "Ако показателя е > 5%, увеличете значението на параметъра #PARAM_NAME# (сегашно значение: #PARAM_VALUE#)";
$MESS["PERFMON_KPI_NAME_QCACHE_SIZE"] = "Кеш заявки (размер)";
$MESS["PERFMON_KPI_REC_QCACHE_ZERO_SIZE"] = "Включване на кеш на заявките (настройте параметъра #PARAM_NAME# на повече или равно на #PARAM_VALUE_LOW#, но не помече от #PARAM_VALUE_HIGH#).";
$MESS["PERFMON_KPI_REC_QCACHE_TOOLARGE_SIZE"] = "Размера на кеша на заявките (#PARAM_NAME#) е повече от #PARAM_VALUE_HIGH#. Това може да се отрази на производителността.";
$MESS["PERFMON_KPI_REC_QCACHE_OK_SIZE"] = "Размер на кеш заявките (#PARAM_NAME#).";
$MESS["PERFMON_KPI_NAME_QCACHE"] = "Qcache_inserts/Qcache_hits";
$MESS["PERFMON_KPI_REC_QCACHE_NO"] = "Кеша на заявките не се използва поради отсъствие на SELECT на заявките.";
$MESS["PERFMON_KPI_REC_QCACHE"] = "Ако показателя е > 1%,  възможно е да се изисква увеличение на параметъра <span class=\"perfmon_code\">query_cache_size</span> (текущо значение: #VALUE#)";
$MESS["PERFMON_KPI_NAME_QCACHE_PRUNES"] = "Кеш заявки (prunes)";
$MESS["PERFMON_KPI_REC_QCACHE_PRUNES"] = "Брой заявки отрязани от кеша (#STAT_NAME#). Ако значението бързо расте, е необходимо да се увеличи параметъра #PARAM_NAME# (сегашно значение: #PARAM_VALUE#), но не повече от #PARAM_VALUE_HIGH#.";
$MESS["PERFMON_KPI_NAME_SORTS"] = "Подредба";
$MESS["PERFMON_KPI_REC_SORTS"] = "Общо сортиране (#STAT_NAME#).";
$MESS["PERFMON_KPI_NAME_SORTS_DISK"] = "Сортиране (диск)";
$MESS["PERFMON_KPI_REC_SORTS_DISK"] = "Процент на сортиране, изискващи създаването на временни таблици на диска (#STAT_NAME#). Ако процентът е повече от #GOOD_VALUE#, е необходимо да се увеличат параметрите на #PARAM1_NAME# (текущо значение: #PARAM1_VALUE#) и #PARAM2_NAME# (текущо значение: #PARAM2_VALUE#).";
$MESS["PERFMON_KPI_NAME_JOINS"] = "Select_range_check + Select_full_join";
$MESS["PERFMON_KPI_REC_JOINS"] = "Брой на обединените таблици не използващи индекси. (#STAT_NAME#). Ако значението е голямо, трябва да се увеличи параметъра #PARAM_NAME# (текущо значение: #PARAM_VALUE#) или да добавите индекси за обединяване на таблиците.";
$MESS["PERFMON_KPI_NAME_TMP_DISK"] = "Created_tmp_disk_tables";
$MESS["PERFMON_KPI_REC_TMP_DISK_1"] = "Процент на временните таблици изискващи дисково пространство (#STAT_NAME#).  Процента е повече от #STAT_VALUE# и трябва да се увеличи параметъра #PARAM1_NAME# (текущо значение: #PARAM1_VALUE#) и #PARAM2_NAME# (текущо значение: #PARAM2_VALUE#). Вижте, дали тези параметри са равни. Също е възможно да се съкрати  количеството SELECT DISTINCT на заявките без LIMIT.";
$MESS["PERFMON_KPI_REC_TMP_DISK_2"] = "Процент на временните таблици, изискващи дисково пространство (#STAT_NAME#). Процента е повече от #STAT_VALUE# и размерите на временните таблици са достатъчни големи. Възможно е да се съкрати количеството SELECT DISTINCT заявки без LIMIT.";
$MESS["PERFMON_KPI_REC_TMP_DISK_3"] = "Процент на временните таблици, изискващи дисково пространство (#STAT_NAME#) е достатъчно нисък (не повече #STAT_VALUE#).";
$MESS["PERFMON_KPI_NAME_THREAD_CACHE"] = "Кеш потоци";
$MESS["PERFMON_KPI_REC_THREAD_NO_CACHE"] = "Кеш потоците (#PARAM_NAME#) са изключени. Като начална стойност задайте в параметъра, равно на #PARAM_VALUE#.";
$MESS["PERFMON_KPI_REC_THREAD_CACHE"] = "Ефективност на кеш потока (#STAT_NAME#).Ако ефективността е по-малка от #GOOD_VALUE#, трябва да се увеличи значението на параметъра #PARAM_NAME# (текущо значение: #PARAM_VALUE#).";
$MESS["PERFMON_KPI_NAME_TABLE_CACHE"] = "Кеш на отворените таблици";
$MESS["PERFMON_KPI_REC_TABLE_CACHE"] = "Ефективност на кеша на отворените таблици (#STAT_NAME#).Ако ефективността е по-малка от #GOOD_VALUE#, трябва да се увеличи параметъра #PARAM_NAME# (текущо значение: #PARAM_VALUE#). Увеличавайте параметъра постепенно за да се избегне  превишаването на лимитите на количеството едновременни отворени файлове в операционната система. ";
$MESS["PERFMON_KPI_NAME_OPEN_FILES"] = "Отворени файлове";
$MESS["PERFMON_KPI_REC_OPEN_FILES"] = "Процент на отворените файлове (#STAT_NAME#). Ако е повече #GOOD_VALUE#, трябва да се увеличи параметъра #PARAM_NAME# (текущо значение: #PARAM_VALUE#).";
$MESS["PERFMON_KPI_NAME_LOCKS"] = "Защити";
$MESS["PERFMON_KPI_REC_LOCKS"] = "Процент заключвания получени без изчакване (#STAT_NAME#). Ако е по-малък от #GOOD_VALUE#, е необходимо да се оптимизират заявките или за се използва InnoDB.";
$MESS["PERFMON_KPI_NAME_INSERTS"] = "Едновременни прикачвания ";
$MESS["PERFMON_KPI_REC_INSERTS"] = "Едновременните (конкурентни) прикачвания са изключени. Включете с помощта на параметъра #PARAM_NAME# = #REC_VALUE#.";
$MESS["PERFMON_KPI_NAME_CONN_ABORTS"] = "Прекъсвания на връзката";
$MESS["PERFMON_KPI_REC_CONN_ABORTS"] = "Процент на неправилното затворени връзки. Ако тези връзки са повече от 5%, е необходимо да поправите приложението.";
$MESS["PERFMON_KPI_NAME_INNODB_BUFFER"] = "Буфер InnoDB";
$MESS["PERFMON_KPI_REC_INNODB_BUFFER"] = "Ефективност на буфера InnoDB (#STAT_NAME#). Ако ефективността е по-малка от #GOOD_VALUE#, прегледайте възможността да увеличите значението на параметъра #PARAM_NAME# (сегашно значение: #PARAM_VALUE#).";
$MESS["PERFMON_KPI_REC_INNODB_FLUSH_LOG"] = "Значението на параметъра #PARAM_NAME# се препоръчва да е равно на #GOOD_VALUE#.";
$MESS["PERFMON_KPI_REC_INNODB_FLUSH_METHOD"] = "Значението на параметъра #PARAM_NAME# се препоръчва да е равно на #GOOD_VALUE#.";
$MESS["PERFMON_KPI_REC_TX_ISOLATION"] = "Значението на параметъра #PARAM_NAME# се препоръчва да е равно на #GOOD_VALUE#.";
$MESS["PERFMON_KPI_EMPTY"] = "празно";
$MESS["PERFMON_KPI_NO"] = "не";
$MESS["PERFMON_KPI_NAME_INNODB_LOG_WAITS"] = "Брой изчаквания от буфера на дневника";
$MESS["PERFMON_KPI_REC_INNODB_LOG_WAITS"] = "Ако показателя е > 0 и расте, увеличите значението на параметъра <span class=\"perfmon_code\">innodb_log_file_size</span> (текущо значение: #VALUE#). Внимание! Първо инсталирайте  сървъра. След това mysql. Променете значението на параметъра във файла на настройките. Преместете съществуващите файлове на дневника в страни. Стартирайте сървъра. И ако всичко е успешно, премахнете старите файлове от дневника.";
$MESS["PERFMON_KPI_NAME_BINLOG"] = "Binlog_cache_disk_use";
$MESS["PERFMON_KPI_REC_BINLOG"] = "Ако показателя е > 0,  увеличете параметъра <span class=\"perfmon_code\">binlog_cache_size</span> (текущо значение: #VALUE#)";
$MESS["PERFMON_WAIT_EVENT"] = "Изчакващи събития на сървъра";
$MESS["PERFMON_WAIT_PCT"] = "Процент от общото време";
$MESS["PERFMON_WAIT_AVERAGE_WAIT_MS"] = "Средно време на събитието (мс)";
$MESS["PERFMON_PARAMETER_NAME"] = "Параметър";
$MESS["PERFMON_PARAMETER_VALUE"] = "Фактическо значение";
$MESS["PERFMON_REC_PARAMETER_VALUE"] = "Препоръчано значение";
$MESS["PERFMON_KPI_ORA_PERMISSIONS"] = "Недостатъчни права за показване на статистиката. Необходими права: <span class=\"perfmon_code\">SELECT ANY DICTIONARY</span>.";
$MESS["PERFMON_KPI_ORA_REC_DB_FILE_SEQUENTIAL_READ"] = "Събитието е нормално. При средно време за прочитане > 10 ms следва да се обърне внимание на производителността на подсистемата вход/ изход и размера на буфера на кеша <span class=\"perfmon_code\">SGA</span>. Сесията очаква край на процеса на последователното прочитане.";
$MESS["PERFMON_KPI_ORA_REC_DB_FILE_SCATTERED_READ"] = "Събитието е нормално. При средно време за прочитане > 15 ms следва да се обърне внимание на производителността на подсистемата вход/ изход и размера на буфера на кеша <span class=\"perfmon_code\">SGA</span>. Сесията очаква край на процеса на последователното прочитане, което се изпълнява по няколко блока наведнъж.";
$MESS["PERFMON_KPI_ORA_REC_ENQ__TX___ROW_LOCK_CONTENTION"] = "Изисква се проследяване на сесията. В началото на транзакцията е получено блокиране на ресурса, и до края се задържа.";
$MESS["PERFMON_KPI_ORA_REC_LOG_FILE_SYNC"] = "Събитието е нормално. При средно време за прочитане > 10 ms следва да се обърне внимание на производителността на подсистемата вход/изход и значението на параметъра <span class=\"perfmon_code\">COMMIT_WRITE</span>. По времето за изчакване, е включен запис в дневника за транзакции, и изчакването на нейното успешно изпълнение.";
$MESS["PERFMON_KPI_ORA_REC_LATCH__CACHE_BUFFERS_CHAINS"] = "Постоянният достъп към един и същи блок данни, или по малък брой от тях, е известно като \"горещ блок\".";
$MESS["PERFMON_KPI_ORA_REC_LATCH__LIBRARY_CACHE"] = "Следва да се обърне внимание на параметъра <span class=\"perfmon_code\">CURSOR_SHARING</span>, статистиката за обектите и значението <span class=\"perfmon_code\">METOD_OPT</span> при сбора на статистиката.Проблемите с тези заключвания нормално  са свързани с използването на биндове в заявките, или недостатъчен размер на разделящият заявките кеш.  Възможни причини: много различни заявки; заявките не използват бинд; недостатъчен размер на кеша в приложенията; чести включвания към сървъра, и изключвания; недостатъчен размер на  Shared Pool.";
$MESS["PERFMON_KPI_ORA_REC_ENQ__TX___INDEX_CONTENTION"] = "Сесията изисква проследяване. От началото на транзакцията е получено блокиране на ресурса, и се задържа до края на транзакцията.";
$MESS["PERFMON_KPI_ORA_REC_LOG_FILE_SWITCH_COMPLETION"] = "Отнася се към скоростта на вход/изход. Очаква включване към дневника на транзакциите. ";
$MESS["PERFMON_KPI_ORA_REC_SQL_NET_MORE_DATA_FROM_CLIENT"] = "Отнася се към скоростта на клиент-сървърни съобщения. Сървъра изпраща на клиента съобщение, а той още не е отговорил на предишното.";
$MESS["PERFMON_KPI_ORA_REC_LATCH__SHARED_POOL"] = "Следва да се обърне внимание на параметъра <span class=\"perfmon_code\">CURSOR_SHARING</span>, статистиката за обектите и значението <span class=\"perfmon_code\">METOD_OPT</span> при сбора на статистиката.Проблемите с тези заключвания нормално  са свързани с използването на биндове в заявките, или недостатъчен размер на разделящият заявките кеш.  Възможни причини: много различни заявки; заявките не използват бинд; недостатъчен размер на кеша в приложенията; чести включвания към сървъра, и изключвания; недостатъчен размер на  Shared Pool.";
$MESS["PERFMON_KPI_ORA_REC_CURSOR__PIN_S_WAIT_ON_X"] = "Следва да се обърне внимание на параметъра <span class=\"perfmon_code\">CURSOR_SHARING</span>, статистиката за обектите и значението <span class=\"perfmon_code\">METOD_OPT</span> при сбора на статистиката. Сесията се опитва да получи разделяно блокиране което се удържа от друга сесия.  ";
$MESS["PERFMON_KPI_ORA_REC_BUFFER_BUSY_WAITS"] = "Може да бъде следствие на низката скорост на вход/изход. Изчаква момента когато блока с данните ще бъде достъпен.Или блока се чете от друга сесия, или е в процес на редактиране.";
$MESS["PERFMON_KPI_ORA_REC_READ_BY_OTHER_SESSION"] = "Може да бъде следствие на низката скорост на вход/изход.Това събитие възниква когато сесията изисква блок който се чете в кеша от друга сесия.";
$MESS["PERFMON_KPI_ORA_REC_EVENTS_IN_WAITCLASS_OTHER"] = "Проблем на поддръжката Битрикс-Oracle.";
$MESS["PERFMON_KPI_ORA_REC_ROW_CACHE_LOCK"] = "Може да бъде следствие на низката скорост на вход/изход. Сесията се опитва да блокира метаданните.";
$MESS["PERFMON_KPI_ORA_REC_DB_FILE_PARALLEL_READ"] = "Може да бъде следствие на низката скорост на вход/изход";
$MESS["PERFMON_KPI_ORA_REC_DB_BLOCK_CHECKSUM"] = "За ускоряване на операцията изпълнявана от процеса <span class=\"perfmon_code\">DBWR</span>.";
$MESS["PERFMON_KPI_ORA_REC_SESSION_CACHED_CURSORS"] = "Препоръчано от специалистите на Битрикс.";
$MESS["PERFMON_KPI_ORA_REC_CURSOR_SHARING_FORCE"] = "Характерно за HTTP / PHP приложенията не използващи обвързващи променливи в заявките.";
$MESS["PERFMON_KPI_ORA_REC_PARALLEL_MAX_SERVERS"] = "Препоръчано от специалистите на Битрикс.";
$MESS["PERFMON_KPI_ORA_REC_COMMIT_WRITE"] = "За ускорение на операциите за изпълняване на процеса <span class=\"perfmon_code\">LGWR</span>.";
$MESS["PERFMON_KPI_ORA_REC_OPEN_CURSORS"] = "Препоръчано от специалистите на Битрикс.";
$MESS["PERFMON_KPI_ORA_REC_OPTIMIZER_MODE"] = "Препоръчано от специалистите на Битрикс.";
$MESS["PERFMON_USER_NAME"] = "Име на схемата";
$MESS["PERFMON_MIN_LAST_ANALYZED"] = "Време на най-старият анализ на схемата";
$MESS["PERFMON_MAX_LAST_ANALYZED"] = "Време на най-последният анализ на схемата";
$MESS["PERFMON_KPI_ORA_REC_STATS_NEW"] = "Статистиката по обектите на потребителя #USER_NAME# е актуална.";
$MESS["PERFMON_KPI_ORA_REC_STATS_OLD"] = "Проблем! В статистиката по обектите на потребителя #USER_NAME# out of date. Препоръчва се поне един път в седмица да се събира статистиката чрез процедурата <span class=\"perfmon_code\">BEGIN DBMS_STATS.GATHER_SCHEMA_STATS('#USER_NAME#', ESTIMATE_PERCENT=>NULL, CASCADE=>TRUE); END;</span>";
?>