var ads = "no-adb"
onload=function(){
    if (document.getElementsByClassName == undefined) {
        document.getElementsByClassName = function(className)
        {
            var hasClassName = new RegExp("(?:^|\s)" + className + "(?:$|\s)");
            var allElements = document.getElementsByTagName("*");
            var results = [];
            var element;
            for (var i = 0; (element = allElements[i]) != null; i++) {
                var elementClass = element.className;
                if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
                    results.push(element);}
            return results;
        }
    }
    blocked = 0;
    var ad_nodes = document.getElementsByClassName(ads);
    for(i in ad_nodes){
        if (ad_nodes[i].offsetHeight == 0){
            blocked = 1;
            document.getElementById('mdl_ctnr').style.display='block';
        }
    }
}