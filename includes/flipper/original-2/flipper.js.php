<?
header('Content-type: text/javascript');
?>
var nFlipper = {
	fromNum:null,
	getRefNumbers: function(){
		var rn = {};       
<? foreach (flipper_get_all() as $ref=>$row) { ?>
        rn['<?=$ref?>']={};
    <? foreach ($row as $s=>$r) { ?> 
       
        rn['<?=$ref?>']['<?=$s?>']='<?=chop($r)?>';
    <? }
    };
    ?>       
		return rn;
	},
    getReferer: function(){
		alert(document.URL);
	},
	getQueryVariable: function(variable){
		var query = window.location.search.substring(1);
		var vars = query.split('&');
		for (var i = 0; i < vars.length; i++) {
			var pair = vars[i].split('=');
			if (decodeURIComponent(pair[0]) == variable) {
				return decodeURIComponent(pair[1]);
			}
		}	
	},
    esc: function(txt){
        if(typeof encodeURIComponent=="function"){
            return encodeURIComponent(txt)
        }else{
            return escape(txt)
        }
    },

    unesc: function(txt){
        if(typeof decodeURIComponent=="function"){
            return decodeURIComponent(txt)
        }else{
            return unescape(txt)
        }
    },
	
    setCookie: function(name, val, exp){
        var ck = name + "=" + this.esc( val ) + "; path=/";
        if(exp){
            var now = new Date();
            exp = new Date( now.getTime() + (exp * 1000));
            ck = ck + "; expires=" + exp.toGMTString();
        }
        document.cookie = ck;
    },
    getSpecificCookie: function(n) {
        var s, e, c = document.cookie, n = n + '=';
        while((s = c.indexOf(n)) > -1) {
            if (s && c.charAt(s-1) !== ' ') continue;
            e = c.indexOf(';', s);
            if (e == -1) e = c.length;
            break;
        }
        return e > -1 ? c.substring(s + n.length, e) : null;
    },

    getCookie: function(n){
        var v = this.getSpecificCookie(n);
        return v == null ? null : this.unesc(v);
    },

	recurse: function(element)
	{
		if (element.childNodes.length > 0) 
			for (var i = 0; i < element.childNodes.length; i++) 
				this.recurse(element.childNodes[i]);
		if( element.nodeName == 'SCRIPT' || element.nodeName == 'STYLE' ) return;	
		if (element.nodeType == Node.TEXT_NODE && /\S/.test(element.nodeValue)/* element.nodeValue != ''*/) {
			element.nodeValue = element.nodeValue.replace(this.fromNum,this.toNum);
		};
	},
    
	toNum:null,
	
	process: function() {
		var ref=this.getQueryVariable('ref');
		if (typeof ref != 'undefined' && ref!="") {
			this.setCookie('ref',ref);
		};		
		ref = this.getCookie('ref');
		console.log('ref is '+this.getCookie('ref'));
		if (ref!=null) {
			var rn = this.getRefNumbers();
            if (rn.hasOwnProperty(ref)) {
            	for (var key in rn[ref]) {
					this.fromNum = key;
					this.toNum = rn[ref][key];
					this.recurse(document.getElementsByTagName('html')[0]);
                    
                    var links = document.getElementsByTagName("a");
                    for(var j=0; j<links.length; j++) {
                      for (var att, i = 0, atts = links[j].attributes, n = atts.length; i < n; i++){
                          att = atts[i];
                          links[j].attributes[i].nodeValue=att.nodeValue.replace(this.fromNum,this.toNum);
                      }
                    }
                };
            };
		};
	}
}
window.onload = function(e){ 
	nFlipper.process();
}
