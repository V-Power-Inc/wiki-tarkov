function antiadblock(){
    var var1 = $('iframe[style="visibility: visible; position: fixed !important; display: block !important; border: 0px !important; -webkit-box-shadow: rgba(0, 0, 0, 0.498039) 5px 5px 20px; z-index: 2147483647; left: 50px; top: 50px; width: 416px; height: 195px; opacity: 0.7;"]'),
        var2 = $('iframe[style="visibility: visible; position: fixed !important; display: block !important; border: 0px !important; -webkit-box-shadow: rgba(0, 0, 0, 0.498039) 5px 5px 20px; z-index: 2147483647; left: 50px; top: 50px; width: 416px; height: 195px;"]'),
        var3 = $('iframe[id="adguard-assistant-dialog"]'),
        var4 = $('iframe[class="sg_ignore adg-view-important"]'),
        div = $('div[class="__adblockplus__overlay"]'),
        div2 = $('div[class="sg_border"]'),
        div3 = $('div[class="sg_border sg_bottom_border"]');

    var1.remove();
    var2.remove();
    var3.remove();
    var4.remove();
    div.remove();
    div2.remove();
    div3.remove();
    setTimeout(function(){antiadblock();},250);
}

antiadblock();