(function(jQuery){
	jQuery.fn.parentn = function(n){
		var $target = jQuery(this[0]);
		for (var i = 0; i < n && $target; i++) {
			$target = $target.parent();
		}
		return $target;
	}
})(jQuery);


function init_cgfastselector() {
jQuery('[myid=cgaj_div]').css('display','block');
jQuery('*').hover(function() {
if (jQuery('[myid=cgaj_div]').css('display') == 'block'){
jQuery(this).siblings().stop().css('opacity',0.5);
}
}, function() {
if (jQuery('[myid=cgaj_div]').css('display') == 'block'){
jQuery(this).siblings().stop().css('opacity',1);
}
});
return false;
}
function disable_cgfastselector() {
 jQuery('*').css('opacity',1);
 jQuery('*[cgbackground-color]').each(function(){
   jQuery(this).css('background-color',jQuery(this).attr('cgbackground-color'));
 });
 jQuery('*[cgborder]').each(function(){
   jQuery(this).css('border',jQuery(this).attr('cgborder'));
 });
 jQuery('div[myid=cgaj_div]').css('display','none');
 return false;
}


jQuery(document).ready(function() {



if (jQuery('#bx-panel').size()) {
//alert(jQuery('#panel').size());

if (!jQuery('a[href=#init_cgfastselector]').size()) {
 jQuery('#bx-panel').append('<a href="#init_cgfastselector" style="position: absolute !important;top: 4px;left: 333px;z-index: 110;"><img src="/bitrix/images/fileman/panel/web_form.gif" border=0></a>');
}

jQuery('a[href=#init_cgfastselector]').click(function(){
if (jQuery(this).attr('init')) {
jQuery(this).attr('init','');
jQuery(this).css('border','0px !important');
disable_cgfastselector();
}
else {
jQuery(this).attr('init','1');
jQuery(this).css('border','1px solid gray !important');
init_cgfastselector();
}
return false;});


var bobj;
var bobj2;



var text1='<div id=panel  myid=cgaj_div style="display:none;position:fixed;left:10px;right:10px;padding:10px;bottom:40px;width:95%;border:1px solid black; background-color:#bbbbbb;">Кликните по элементу, и селектор до него появится в текстовом поле ниже.<br>Выбранный элемент будет выделен зеленым, а элементы которые так же подпадают под данный селектор: синим<br>Вы можете ввести селектор вручную, или отредактировать текущий, и нажать "Обновить" что бы оценить его дейтсвие<textarea style="width:100%;height:40px;"></textarea><a href="#" id="cgfr" not_sel=1 >Обновить</a> | Найдено <span id=cgsel_count>0</span> элементов удовлетворяющих селектору на данной странице<br>Что бы выключить селектор нажмите еще раз на иконку селектора в панели администрирования</div>';
var charset = document.charset || document.characterSet;
//alert(charset);
if (charset != 'UTF-8') { 
jQuery("body").append(text1);
}
else {
jQuery("body").append('<div id=panel  myid=cgaj_div style="display:none;position:fixed;left:10px;right:10px;padding:10px;bottom:40px;width:95%;border:1px solid black; background-color:#bbbbbb;">Кликните по элементу, и селектор до него появится в текстовом поле ниже.<br>Выбранный элемент будет выделен зеленым, а элементы которые так же подпадают под данный селектор: синим<br>Вы можете ввести селектор вручную, или отредактировать текущий, и нажать "Обновить" что бы оценить его дейтсвие<textarea style="width:100%;height:40px;"></textarea><a href="#" id="cgfr" not_sel=1 >Обновить</a> | Найдено <span id=cgsel_count>0</span> элементов удовлетворяющих селектору на данной странице<br>Что бы выключить селектор нажмите еще раз на иконку селектора в панели администрирования</div>');
}
var elem = jQuery("div[myid=cgaj_div] > textarea");



function cgfastrefresh(){
unselect();
var cgc = 0;
bobj2 = jQuery(elem.val());
jQuery(elem.val()).each(function(){
cgc++;
var mcss = 'background-color';
var mval = 'green';
var mval2 = 'blue';

if (jQuery(this).get(0).tagName == 'IMG') {
//alert(jQuery(this).get(0).tagName);
mcss = 'border';
mval = '1px solid green';
mval2 = '1px solid blue';
}
if (!jQuery(this).attr('cg'+mcss)) {
  jQuery(this).attr('cg'+mcss,jQuery(this).css(mcss));
}
jQuery(this).css(mcss,mval2);
});


jQuery('#cgsel_count').text(cgc);
return false;
}

jQuery('#cgfr').click(function(event){
cgfastrefresh();
    event = event || window.event
    
    if (event.stopPropagation) {
        event.stopPropagation()
    } else {
        event.cancelBubble = true
    }


return false;
});

//START

var flup = 0;
jQuery("*").click(function(event){

var mcss = 'background-color';
var mval = 'green';
var mval2 = 'blue';
if (this.tagName == 'IMG') {
mcss = 'border';
mval = '1px solid green';
mval2 = '1px solid blue';
}
var flag = 0;
if (jQuery(this).attr('id') && (jQuery(this).attr('id').indexOf('bx_') + 1) == 0) {$idd = '#'+jQuery(this).attr('id'); if ($idd == '#panel'){flag = 1;}}
jQuery(this).parents().each(function()   { 
  $idd = '';
  if (jQuery(this).attr('id') && (jQuery(this).attr('id').indexOf('bx_') + 1) == 0) {$idd = '#'+jQuery(this).attr('id'); if ($idd == '#panel'){flag = 1;}}
});


if (flag) {return true;} 


if (jQuery('[myid=cgaj_div]').css('display') == 'block' && jQuery(this).attr('not_sel') != '1' && this.tagName != 'HTML' && this.tagName != 'BODY') {
if ((!jQuery(this).find('[cg_sel=1]').size()) || (jQuery(this).attr('cg_sel'))) {
//alert(this.tagName);
unselect();
elem.val('');
var txt = '';
var cgc = 0;
$idd = '';
$cls = '';
if (jQuery(this).attr('id') && (jQuery(this).attr('id').indexOf('bx_') + 1) == 0) {$idd = '#'+jQuery(this).attr('id'); if ($idd == '#panel'){flag = 1;}}
if (this.className) {$cls = '.'+this.className;}
elem.val(this.tagName +$idd+$cls+txt+elem.val());
jQuery(this).parents().each(function()   { 

  $idd = '';
$cls = '';
  txt = " > ";
  if (jQuery(this).attr('id') && (jQuery(this).attr('id').indexOf('bx_') + 1) == 0) {$idd = '#'+jQuery(this).attr('id'); if ($idd == '#panel'){flag = 1;}}
if (this.className) {$cls = '.'+this.className;}
  elem.val(this.tagName +$idd+$cls+ txt+elem.val());
});


if (flag) {return true;}
if (!jQuery(this).attr('cg'+mcss)) {
  jQuery(this).attr('cg'+mcss,jQuery(this).css(mcss));
}
jQuery(elem.val()).each(function(){
  cgc++;
var mcss = 'background-color';
var mval = 'green';
var mval2 = 'blue';

if (jQuery(this).get(0).tagName == 'IMG') {
//alert(jQuery(this).get(0).tagName);
mcss = 'border';
mval = '1px solid green';
mval2 = '1px solid blue';
}
if (!jQuery(this).attr('cg'+mcss)) {
  jQuery(this).attr('cg'+mcss,jQuery(this).css(mcss));
}
});
  
var mmcss = 'background-color';
var mmval2 = 'blue';
if (jQuery(elem.val()).get(0).tagName == 'IMG') {
mmcss = 'border';
mmval2 = '1px solid blue';
}
jQuery(elem.val()).css(mmcss,mmval2);
jQuery(this).css(mcss,mval);
jQuery(this).attr('cg_sel','1');
bobj = this;
bobj2 = jQuery(elem.val());
jQuery('#cgsel_count').text(cgc);
}
else {
jQuery(this).css(mcss,jQuery(this).attr('cg'+mcss))
jQuery(elem.val()).each(
  function(){
   jQuery(this).css(mcss,jQuery(this).attr('cg'+mcss))
  }
);
jQuery(this).attr('cg_sel','0');
}
return false;
}else {
if (jQuery(this).attr('not_sel') == '1') {
    event = event || window.event // пїЅпїЅпїЅпїЅпїЅ-пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ
    
    if (event.stopPropagation) {
        // пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ W3C:
        event.stopPropagation()
    } else {
        // пїЅпїЅпїЅпїЅпїЅпїЅпїЅ Internet Explorer:
        event.cancelBubble = true
    }
return false;

} else {

return true;}
}
});

function unselect(){
if (bobj) {
var mcss = 'background-color';
var mval = 'green';
var mval2 = 'blue';
if (bobj.tagName == 'IMG') {
mcss = 'border';
mval = '1px solid green';
mval2 = '1px solid blue';
}
if (jQuery('[myid=cgaj_div]').css('display') == 'block'){
jQuery(bobj).css(mcss,jQuery(bobj).attr('cg'+mcss))
jQuery(bobj2).each(
  function(){
var mcss = 'background-color';
var mval = 'green';
var mval2 = 'blue';

if (jQuery(this).get(0).tagName == 'IMG') {
//alert(jQuery(this).get(0).tagName);
mcss = 'border';
mval = '1px solid green';
mval2 = '1px solid blue';
}
   jQuery(this).css(mcss,jQuery(this).attr('cg'+mcss))
  }
);
jQuery(bobj).attr('cg_sel','0');
}
}
}

}       



//FASTELEMENTVIEW


jQuery("body").append('<div style="display:none" ><div id=cgaj_div style=""></div><a href="#cgaj_div" id=cgaaj_div></a></div>');
//'div.catalog-item-image > a, div.catalog-item-title > a'

function cgfev_init(){
var elems = cgfev_elements.split(';');
var contr = cgfev_container.split(';');
var cgfev_elements_now;
var cgfev_container_now;
//alert(contr.length);
for(var idx in elems){
cgfev_elements_now = elems[idx]; 
if (contr[idx]) {
 cgfev_container_now = contr[idx];
} else {
 if (contr.length == 1) {
   cgfev_container_now = contr[0];
 }
 else {
   cgfev_container_now = '';
 }
}

if (cgfev_elements_now) {
jQuery(cgfev_elements_now).attr('cgfev_container_now',cgfev_container_now);
//alert(cgfev_elements_now+'|'+cgfev_container_now+'|'+jQuery(cgfev_elements_now).attr('id'));
}
}
} // END INIT

$("body").delegate('a','mouseenter',function(){cgfev_init()});

var elems = cgfev_elements.split(';');
var contr = cgfev_container.split(';');
var cgfev_elements_now;
var cgfev_container_now;
//alert(contr.length);
for(var idx in elems){
cgfev_elements_now = elems[idx]; 
if (contr[idx]) {
 cgfev_container_now = contr[idx];
} else {
 if (contr.length == 1) {
   cgfev_container_now = contr[0];
 }
 else {
   cgfev_container_now = '';
 }
}

if (cgfev_elements_now) {
jQuery(cgfev_elements_now).attr('cgfev_container_now',cgfev_container_now);
//alert(cgfev_elements_now+'|'+cgfev_container_now+'|'+jQuery(cgfev_elements_now).attr('id'));


var cgfev_obj;
jQuery("body").delegate(cgfev_elements_now,'click', function(){

cgfev_obj = $(this);
cgfev_container_now = jQuery(this).attr('cgfev_container_now');
link = jQuery(this).attr('href');
//alert(this.tagName+'|'+cgfev_container_now);
if (link) {
  jQuery('<div id="fancybox-loading"><div></div></div>').appendTo('body');
if (cgfev_container_now) {
  jQuery('#cgaaj_div').attr('href','#cgaj_div');
  jQuery.get(link, function(data){
  $('#fancybox-loading').remove();
         var htm = '';

if (!cgfev_eval_script || cgfev_eval_script == 0) {
    el = document.getElementById('cgaj_div');

    el.innerHTML=data;

         jQuery(el).find(cgfev_container_now).each(function(){
           htm = htm + $(this).html();
    scripts = el.getElementsByTagName("script");
//    alert('|'+scripts.length+'|'+$(scripts).size());
    head = $(document).find('head')[0];
    for(i=0 ; i<scripts.length ; i++)
    { 
 //     alert($(scripts[i]).html()) ;  
   //     eval ($(scripts[i]).html());
 /*       var script = document.createElement('script');
        script.src = scripts[i].src;
        head.appendChild(script);
*/
    }

         });
}
else {
         jQuery(data).find(cgfev_container_now).each(function(){
           htm = htm + $(this).html();
         });
}
         jQuery('div#cgaj_div').html('<noindex>'+htm+'</noindex>');

       //jQuery('div#cgaj_div').find("a").attr('rel','nofollow');
if (cgfev_cb == 2) {
      var bart = {'inline':true,'photo':false};
      jQuery.extend(cgfev_fb_style, bart);
      jQuery('#cgaaj_div').colorbox(cgfev_fb_style).click();
}else {
      jQuery('#cgaaj_div').fancybox(cgfev_fb_style).click();
}
      cng_fev_after_load();
 });
}
else {
      jQuery('#cgaaj_div').attr('href',link);
if (cgfev_cb == 2) {
      
      var bart = {'inline':false,'photo':true};
      jQuery.extend(cgfev_fb_style, bart);
      //cgfev_fb_style.push({'inlune':false,'iframe':true});
      jQuery('#cgaaj_div').colorbox(cgfev_fb_style).click();
}else {
      jQuery('#cgaaj_div').fancybox(cgfev_fb_style).click();
}
      cng_fev_after_load();
}


return false;
}
return true; 
 
});
} // IF
} // FOR

});
