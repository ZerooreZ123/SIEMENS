/**
* 脚本名称：页面加载Loading脚本
* 脚本说明：
* 1.因为使用到document.body.scrollHeight对象，脚本引入时，脚本应放到body内，否则报错；
* 2.loadingImage为loading的图片，您可以替换为您想要的图片；loading弹窗的样式可以通过代码修改； 
* 3.使用方法：弹出遮罩：whir.loading.add("加载中，请稍候", 1);扔掉遮罩： whir.loading.remove();
* 
*/
var whir = window.whir || {};
whir.loading =
{
    add: function (title, imgUrl) {
        var arr = this.getPageSize();
        var width = parseInt(arr[2]);
        var height = parseInt(arr[3]);
        var loadingImage = "loading.gif";

        //背景遮罩
        var mask = document.createElement("div");
        mask.id = 'mask';
        mask.style.position = 'fixed';
        mask.style.left = '0';
        mask.style.top = '0';
        mask.style.width = '100%';
        mask.style.height = parseInt(arr[1]) + "px";
        mask.style.background = "#000";
        mask.style.opacity = "0.3";
        mask.style.zIndex = "10000";
        mask.addEventListener('touchstart', function (e) { e.preventDefault(); }, false); 	//触摸事件
        mask.addEventListener('touchmove', function (e) { e.preventDefault(); }, false); 	//滑动事件
        mask.addEventListener('touchend', function (e) { e.preventDefault(); }, false); 		//离开元素事件
        document.body.appendChild(mask);

        //提示文本
        var loading = document.createElement("div");
        loading.id = 'loading';
        loading.style.position = 'fixed';
        loading.style.left = ((width / 2) - 25) + "px";
        loading.style.top = (height / 2 - 70) + "px";
        loading.style.height = "150px";
        loading.style.width = "150px";
//        loading.style.lineHeight = "28px";
        loading.style.display = "inline-block";
//        loading.style.padding = "0px 5px 0 30px";
//        loading.style.fontSize = " 0.5em";
//        loading.style.fontFamily = " initial";
        loading.style.zIndex = "100001";
//        loading.style.background = "#fff url(" + imgUrl + ") no-repeat scroll 5px 5px";
        loading.style.background = "url(../assets/img/frontend/icon/loading.gif) no-repeat";
        loading.style.backgroundSize = "50px";
//        loading.style.border = "1px solid #ccc";
//        loading.style.color = "#000";
//        title = (title != undefined && title.length > 0) ? title : "加载中，请稍候...";
//        loading.innerHTML = title;
        document.body.appendChild(loading);
    },
    remove: function () {
        var element = document.getElementById("mask");
        element.parentNode.removeChild(element);
        element = document.getElementById("loading");
        element.parentNode.removeChild(element);
    },
    getPageSize: function () {
        var xScroll, yScroll;
        if (window.innerHeight && window.scrollMaxY) {
            xScroll = window.innerWidth + window.scrollMaxX;
            yScroll = window.innerHeight + window.scrollMaxY;
        } else {
            if (document.body.scrollHeight > document.body.offsetHeight) { // all but Explorer Mac    
                xScroll = document.body.scrollWidth;
                yScroll = document.body.scrollHeight;
            } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari    
                xScroll = document.body.offsetWidth;
                yScroll = document.body.offsetHeight;
            }
        }
        var windowWidth = 0;
        var windowHeight = 0;
        var pageHeight = 0;
        var pageWidth = 0;

        if (self.innerHeight) { // all except Explorer    
            if (document.documentElement.clientWidth) {
                windowWidth = document.documentElement.clientWidth;
            } else {
                windowWidth = self.innerWidth;
            }
            windowHeight = self.innerHeight;
        } else {
            if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode    
                windowWidth = document.documentElement.clientWidth;
                windowHeight = document.documentElement.clientHeight;
            } else {
                if (document.body) { // other Explorers    
                    windowWidth = document.body.clientWidth;
                    windowHeight = document.body.clientHeight;
                }
            }
        }
        // for small pages with total height less then height of the viewport    

        if (yScroll < windowHeight) {
            pageHeight = windowHeight;
        } else {
            pageHeight = yScroll;
        }
        // for small pages with total width less then width of the viewport    
        if (xScroll < windowWidth) {
            pageWidth = xScroll;
        } else {
            pageWidth = windowWidth;
        }
        var arrayPageSize = new Array(pageWidth, pageHeight, windowWidth, windowHeight);
        return arrayPageSize;
    }
};
/** 
 * 时间对象的格式化; 
 */  
Date.prototype.format = function(format) {  
    /* 
     * eg:format="yyyy-MM-dd hh:mm:ss"; 
     */  
    var o = {  
        "M+" : this.getMonth() + 1, // month  
        "d+" : this.getDate(), // day  
        "h+" : this.getHours(), // hour  
        "m+" : this.getMinutes(), // minute  
        "s+" : this.getSeconds(), // second  
        "q+" : Math.floor((this.getMonth() + 3) / 3), // quarter  
        "S" : this.getMilliseconds()  
        // millisecond  
    }; 
  
    if (/(y+)/.test(format)) {  
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4  
                        - RegExp.$1.length));  
    }  
  
    for (var k in o) {  
        if (new RegExp("(" + k + ")").test(format)) {  
            format = format.replace(RegExp.$1, RegExp.$1.length == 1  
                            ? o[k]  
                            : ("00" + o[k]).substr(("" + o[k]).length));  
        }  
    }  
    return format;  
};