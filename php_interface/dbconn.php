<?define("BX_CRONTAB_SUPPORT", true);
define("SHORT_INSTALL_CHECK", true);
define("BX_USE_MYSQLI", true);
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "bitrix0";
$DBPassword = "";
$DBName = "sitemanager";
$DBDebug = false;
$DBDebugToFile = false;

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);
define("CACHED_b_search_tags", true);
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
umask(000);
@umask(~BX_DIR_PERMISSIONS);

define("SHORT_INSTALL", true);
define("BX_UTF", true);
define("BX_DISABLE_INDEX_PAGE", true);

// define("BX_CACHE_TYPE", "memcache");
// define("BX_CACHE_SID", $_SERVER["DOCUMENT_ROOT"]."#01");
// define("BX_MEMCACHE_HOST", "localhost");
// define("BX_MEMCACHE_PORT", "11211");
// define("BX_MEMCACHE_HOST", "unix:///tmp/memcached.sock");
// define("BX_MEMCACHE_PORT", "0");
define("BX_TEMPORARY_FILES_DIRECTORY", "/home/bitrix/.bx_temp/sitemanager/");