/*** Change Color Preset ***/
jQuery(function ($) {  
        a = $(".sp-megamenu-parent > li.active > a").css("color");
        document.documentElement.style.setProperty('--background-color',a);
        document.documentElement.style.setProperty('--text-color',a);
        document.documentElement.style.setProperty('--border-color',a);
});
