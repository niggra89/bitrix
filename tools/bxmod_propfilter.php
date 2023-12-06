<?
    #################################
    #   Developer: Lynnik Danil     #
    #   Site: http://bxmod.ru       #
    #   E-mail: support@bxmod.ru    #
    #################################

    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    if ( !CModule::IncludeModule( "bxmod.propfilter" ) ) exit;

    if ( isset( $_GET["data"] ) ) {
        $data = BxmodPropFilter::GetFieldData ( $_GET["data"] );
        
        foreach ( $data AS $k1=>$v1 ) {
            foreach ( $v1 AS $k2=>$v2 ) {
                foreach ( $v2 AS $k3=>$v3 ) {
                    if ( defined( "SITE_CHARSET" ) && strpos( SITE_CHARSET, "1251" ) !== false ) {
                        $v3 = iconv("cp1251", "utf-8", $v3);
                    }
                    $data[$k1][$k2][$k3] = rawurlencode( $v3 );
                }
            }
        }
        
        die ( json_encode( $data ) );
    }
?>