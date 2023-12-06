jQuery(document).ready(function() {
jQuery("body").append('<div style="display:none" ><div id=cgaj_div style=""></div><a href="#cgaj_div" id=cgaaj_div></a></div>');
//'div.catalog-item-image > a, div.catalog-item-title > a'

jQuery("body").delegate(cgfev_elements,'click', function(){
link = jQuery(this).attr('href');
  jQuery.get(link, function(data){
       
       jQuery('div#cgaj_div').html('<noindex>'+jQuery(data).find(cgfev_container).html()+'</noindex>');
       //jQuery('div#cgaj_div').find("a").attr('rel','nofollow');

      jQuery('#cgaaj_div').fancybox(cgfev_fb_style).click();
      cng_fev_after_load();

 });
  return false;
});

});

