// JavaScript Document
$.extend($.fn.validatebox.defaults.rules, {  
    /*必须和某个字段相等*/
    equals: {
        validator:function(value,param){
            return $(param[0]).val() == value;
        },
        message:'两次输入不一致'
    }
           
});

$(function(){
    //初始化左侧菜单
    $(".navbar-button:eq(0)").addClass("active").click();
    $('#body-lock-screen-loading').fadeOut('slow');
});