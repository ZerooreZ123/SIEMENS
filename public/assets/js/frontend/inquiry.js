$(function(){

    // 固定底部
    // getHight();

    // 弹窗
    $('.inquiry').on('click',function(event){
        window.location.href='{:url("Company/dialog",["id"=>$inf["id"]])}';
        // event.stopPropagation();
        // $('.mask').show();
        // $('body').removeClass('background_loose').addClass('background_lock');
    });
    // $('.mask').on('click',function(event){
    //     var _con = $('.mask');
    //     if( _con.has(event.target).length === 0){
    //         $('.mask').hide();
    //     }
    //     $('body').addClass('background_loose').removeClass('background_lock');
    // });

    // function getHight() {
    //     var $window = $(window).height();
    //     var $wrapper = $('.wrapper').height();
    //     if($window > $wrapper) {
    //         $('.wrapper_footer').addClass('fixed_footer');
    //     }else{
    //         $('.wrapper_footer').removeClass('fixed_footer');
    //     }
    // }

    //固定所有图片宽度，除id为icon的元素
    var _width = $(window).width();
    var width = $("#icon").width();
    $("img").width(_width);
    $("#icon").width(width);

    //固定所有字体大小
    $(".content_M div").css("font-size","125%");
    $(".content_M p").css("font-size","125%");
    $(".content_M span").css("font-size","125%");
});

function check(form) {
    if(!(/^1[34578]\d{9}$/.test(form.phone.value))){
        alert("手机号码格式不正确!");
        form.phone.focus();
        return false;
    }
    return true;
}