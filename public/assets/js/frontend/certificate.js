$(function() {
    $(".img_photo").on('click',function(ev) {
        $(".mask").show();
        $('body').addClass('body_hidden');
        var $src=$(this).attr("src");
        $('.photo').attr('src',$src)
    });
    $('.mask').mouseup(function(e){
        var _con = $(".img_photo");
        if(!_con.is(e.target) && _con.has(e.target).length === 0){
            $(".mask").hide();
            $('body').removeClass('body_hidden');
        }
    });
    //    var $targetObj = $('#targetObj');
    //    cat.touchjs.scale($targetObj, function (scale) { });
});