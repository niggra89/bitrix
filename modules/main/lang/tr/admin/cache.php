<?
$MESS ['MCACHE_TITLE'] = "Önbellek ayarları";
$MESS ['MAIN_OPTION_HTML_CACHE'] = "HTML sayfaların oluşturma yönetimi ";
$MESS ['MAIN_TAB_3'] = "Önbellek dosyaların silinmesi";
$MESS ['MAIN_TAB_2'] = "HTML önbellek";
$MESS ['MAIN_TAB_4'] = "Bileşenlerin önbelleklemesi";
$MESS ['MAIN_OPTION_CLEAR_CACHE'] = "Önbellek dosyaların silinmesi";
$MESS ['MAIN_OPTION_PUBL'] = "Bileşenlerin önbellek ayarları";
$MESS ['MAIN_OPTION_CLEAR_CACHE_OLD'] = "Sadece geçersiz olanlar";
$MESS ['MAIN_OPTION_CLEAR_CACHE_ALL'] = "Tümü";
$MESS ['MAIN_OPTION_CLEAR_CACHE_MENU'] = "Menü";
$MESS ['MAIN_OPTION_CLEAR_CACHE_MANAGED'] = "Yönetilen tüm";
$MESS ['MAIN_OPTION_CLEAR_CACHE_STATIC'] = "HTML önbelleğin tüm sayfaları";
$MESS ['MAIN_OPTION_CLEAR_CACHE_CLEAR'] = "Temizle";
$MESS ['MAIN_OPTION_CACHE_ON'] = "Bileşenlerin otomatik önbellekleme işlemi açık";
$MESS ['MAIN_OPTION_CACHE_OFF'] = "Bileşenlerin otomatik önbellkeleme işlemi kapalı";
$MESS ['MAIN_OPTION_CACHE_BUTTON_OFF'] = "Otomatik önbellekleme işlemini kapat";
$MESS ['MAIN_OPTION_CACHE_BUTTON_ON'] = "Otomatik önbellekleme işlemini kapat";
$MESS ['MAIN_OPTION_HTML_CACHE_WARNING'] = "Dikkat! Reklam veya istatistik modülü yüklenmiştir. HTML önbellek için veri hesaplamaları yanlış yürütülecektir.";
$MESS ['MAIN_OPTION_HTML_CACHE_WARNING_TRANSID'] = "Dikkat! session.use_trans_sid. parametresi açıldı. Önbellek HTML çalışmayacaktır.";
$MESS ['MAIN_OPTION_HTML_CACHE_ON'] = "HTML önbelleği açık";
$MESS ['MAIN_OPTION_HTML_CACHE_OFF'] = "HTML önbelleği kapalı";
$MESS ['MAIN_OPTION_HTML_CACHE_BUTTON_OFF'] = "HTML önbelleği kapat";
$MESS ['MAIN_OPTION_HTML_CACHE_BUTTON_ON'] = "HTML önbelleği aç";
$MESS ['MAIN_OPTION_HTML_CACHE_OPT'] = "HTML önbellek ayarları";
$MESS ['MAIN_OPTION_HTML_CACHE_INC_MASK'] = "Dahili maskesi";
$MESS ['MAIN_OPTION_HTML_CACHE_EXC_MASK'] = "Silme maskesi";
$MESS ['MAIN_OPTION_HTML_CACHE_QUOTA'] = "Disk alanı (megabayt)";
$MESS ['MAIN_OPTION_HTML_CACHE_SUCCESS'] = "HTML önbellek oluşturma biçimi yanlış.";
$MESS ['MAIN_OPTION_HTML_CACHE_STAT'] = "İstatistik";
$MESS ['MAIN_OPTION_HTML_CACHE_STAT_HITS'] = "Önbellek eşleştirmesi";
$MESS ['MAIN_OPTION_HTML_CACHE_STAT_MISSES'] = "Önbellek isabetsizlik yüzdesi";
$MESS ['MAIN_OPTION_HTML_CACHE_STAT_QUOTA'] = "Disk boşluğun sınırlamasından dolayı önbellek temizlenmesi  ";
$MESS ['MAIN_OPTION_HTML_CACHE_STAT_POSTS'] = "Veri değişikliği nedeni ile önbellek temizlenmesi";
$MESS ['MAIN_OPTION_HTML_CACHE_SAVE'] = "HTML  önbellek ayarlarını kaydet";
$MESS ['MAIN_OPTION_HTML_CACHE_RESET'] = "Varsayılan olarak ayarları yükle";
$MESS ['cache_admin_note3'] = "<p>&#1052;&#1077;&#1093;&#1072;&#1085;&#1080;&#1079;&#1084; HTML-önbellek mekanizmasını anonim ziyaretçilerin düzenli ziyareti ile her hangi bir seyrek değişen bölüme dahil edilirse daha iyi olur, çünkü  HTML-önbelleğin çalışması durumunda şu işlemler gerçekleşmektedir:</p>
<ul style='font-size:100%'>
<li> HTML-önbellek mekanizması ile sadece dahili maskesinde belirtilen ve istisna maskesinde belirtilmeyen sayfalar işlenmektedir;</li>
<li>eğer bu sayfalara yetkili olmayan kullanıcı giriyorsa, önbellek dosyanın var oluşu kontrol ediliyor ve bu dosya bulunduysa, ürünün her hangi bir modülünü etkilemeksizin, önbellek içerisinden bir sayfa belirtilir; örneğin, istatistik modülü (bu kullanıcı işlemleri göz önünde bulunmayacaktır), reklam modülü, ana ve diğer modüller çalışmayacak;</li>
<li>bu durumda, önbellek başlama anında sıkıştırma modülü kuruldu ise, sayfa sıkıştırılmış şeklinde görüntülenecektir ;</li>
<li>eğer sayfa önbellek içerisinde bulunmadı ise, kod normal biçimde uygulanır;  sayfanın tam olarak oluşturuldu ise, kopyası  HTML-önbellek içerisinde kaydedilir;</li>
</ul>
<p>Önbellek temizlemesi:</p>
<ul style='font-size:100%'>
<li>eğer kaydedilen boyut önbellek disk kotasını aşıyor ise, önbellet tam olarak temizlenir;</li>
<li>önbelleğin tam temizliği, sistemin idari bölümünde verilerin her hangi bir değişikliğinde gerçekleşir;</li>
<li>eğer sitenin ortak kısmında &#1077;&#1089;&#1083;&#1080; &#1074; &#1087;&#1091;&#1073;&#1083;&#1080;&#1095;&#1085;&#1086;&#1081; &#1095;&#1072;&#1089;&#1090;&#1080; &#1089;&#1072;&#1081;&#1090;&#1072; &#1087;&#1088;&#1086;&#1080;&#1089;&#1093;&#1086;&#1076;&#1080;&#1090; veri POST'u gerçekleşiyor ise, (&#1085;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088;, &#1076;&#1086;&#1073;&#1072;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077; &#1082;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1103; &#1080;&#1083;&#1080; &#1075;&#1086;&#1083;&#1086;&#1089;&#1086;&#1074;&#1072;&#1085;&#1080;&#1077;), önbelleğin  ilgili kısmı atılır;</li>
</ul>

<p> Yetkili olmayan kullanıcılar için oturum silinmesi gerçekleştiği belirtmelidir  (örneğin, yetkisiz kullanıcı sitenin önbelleklenmiş kısmına geçicek ise, oturumun tüm bilgileri silinecektir).</p>

<p>Yükarıda belirtilenlerin içerisinden:</p>
<ul style='font-size:100%'>
<li>istatistik hesaplanması tutulmamaktadır;</li>
<li>reklam modülü sadece önbellek oluşturma anında çalışacaktır ( bu işlem dış dinamik reklamına ait değildir (Begun ve vb.);</li>
<li>örneğin, yetkili olmayan kullanıcılar için ürün kayıt sonuçları kaydedilmeyecektir (bunun verileri \"yol\" olamyan oturumda kayıtlıdır);</li>
<li> disk boşluğunda DoS-atak görüntülenmesinde disk kotasını belirtmek zorundasınız ;</li>
<li>HTML-önbellek mekanızmasının çalışmasından sonra, önbelleğin uygulandığı tüm bölüm işlevini kontrol etmeniz gerekir (örneğin, eski blog şablonların yorum yayınları ile çalışmayabilir);</li>
</ul>";
$MESS ['MAIN_OPTION_CACHE_OK'] = "Önbellek dosyaları temizlendi";
$MESS ['MAIN_OPTION_CACHE_SUCCESS'] = "Bileşenlerin önbellek tipi başarı ile değiştirildi";
$MESS ['MAIN_OPTION_CACHE_ERROR'] = "Bileşenlerin otomatik önbellek tipi bu değere zaaten sahiptir ";
$MESS ['cache_admin_note1'] = "<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">   <tr>     <td valign=\"top\"> &quot biçimin kullanılması;Otomatik önbellek&quot; sitenizin çalışmasını daha hızlı çalışmasına izin vermektedir!</td>   </tr>   <tr>     <td valign=\"top\"><br />     Lütfen dikkat: &quot biçimin kullanılmasında;Otomatik önbellek&quot; bileşenler ile görüntülenen bilgilerin yenilenmesi, ayrı bileşen parametrelerine uygun olarak gerçekleşecektir. </td>   </tr>   <tr>     <td valign=\"top\"><br />     Sayfa içerisinde önbelleklenmiş alan içeriklerin yenilenmesi için, uygulayabilirsiniz: </td>   </tr> </table> <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">   <tr>     <td align=\"center\" valign=\"top\">&nbsp;</td>   </tr>   <tr>     <td valign=top\">1. Gereken sayfaya geç ve önbelleklenmiş bilgilerin temizlenmesi için yönetim panosunda özel düğmeyi kullanarak içeriğini yenile. <br />     <img src=\"\"/bitrix/images/main/page_cache.png\"\" width=\"\"288\"\" height=\"\"108\"\" vspace=\"\"5\"\" /></td>   </tr>   <tr>     <td align=\"\"center\"\" valign=\"\"top\"\">&nbsp";
$MESS ['cache_admin_note2'] = "Önbellek dosyaların silinmesinden sonra, görüntülenen veriler mevcut durumuna kadar güncelenecektirler.Yeni önbellek dosyaları, önbelleklenmiş bölgeler ile indirme sayfa imkanlarına göre yavaş yavaş oluşturulacaklardır. ";
?>