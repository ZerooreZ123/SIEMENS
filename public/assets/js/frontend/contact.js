$(function () {
    $(".title").click(function(){
        $(this).siblings().toggle();
    });
    //点击显示改地址的地图坐标
    $(".adr").click(function () {
        var name = $(this).parents('.info').siblings('.title').text();
        var address = $(this).text();
        $.ajax({
            url: "{:url('Contact/getLocation')}",
            type: "POST",
            data: { address: address},
            success: function(data){
                var res = eval("("+data+")");
                //使用微信内置地图查看位置接口
                wx.openLocation({
                    latitude : res.result.location.lat, // 纬度，浮点数，范围为90 ~ -90
                    longitude : res.result.location.lng, // 经度，浮点数，范围为180 ~ -180。
                    name : name, // 位置名
                    address : address, // 地址详情说明
                    scale : 28, // 地图缩放级别,整形值,范围从1~28。默认为最大
                    infoUrl : '' // 在查看位置界面底部显示的超链接,可点击跳转
                });

            }
        });
    });
});