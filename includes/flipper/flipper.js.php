<?php
header('Content-type: text/javascript');
?>
var nFlipper = {
	fromNum:null,
	getRefNumbers: function(){
		var rn = {};       
<?php foreach (flipper_get_all() as $ref=>$row) { ?>
        rn['<?=$ref?>']={};
    <?php foreach ($row as $s=>$r) { ?> 
       
        rn['<?=$ref?>']['<?=$s?>']='<?=chop($r)?>';
    <?php }
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
		if (/*element.nodeType == Node.TEXT_NODE*/element.nodeType == 3 && /\S/.test(element.nodeValue)/* element.nodeValue != ''*/) {
//  \(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})

            found = element.nodeValue.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/ig);   
            if (found) 
	            for (var j in found)  {
                    phoneClean = found[j].replace(/[^0-9]/g,"");
 //                   console.log(found[j]);                
                    for (var key2 in this.rnr) {
                        this.fromNum = key2;
                        this.toNum = this.rnr[key2];
//                        console.log(""+key2+": "+this.toNum);
//                        console.log(phoneClean);

                        if (phoneClean == key2) {
//                            console.log("Replacing "+found[j] + ' to '+this.toNum);
                            element.nodeValue = element.nodeValue.replace(found[j],this.toNum);
                        }
                    };
                };

//			element.nodeValue = element.nodeValue.replace(this.fromNum,this.toNum);
		};
	},
    
	toNum:null,
	
	process: function(ref) {
		if (ref!=null) {
			var rn = this.getRefNumbers();
            if (rn.hasOwnProperty(ref)) {
//                    console.log(rn[ref]);
					this.rnr = rn[ref];
					this.recurse(document.getElementsByTagName('html')[0]);
                    
                    var searchAttr=[];
                    searchAttr.push(document.getElementsByTagName("a"));
                    searchAttr.push(document.getElementsByClassName("pointer"));
//                    console.log(searchAttr.length);
                    var links = null;
//                    var links = document.getElementsByTagName("a");
//                    for(var k=0; k<searchAttr.length; k++)
                    while (searchAttr.length>0) {
                        links = searchAttr.pop();
//    	                console.log(searchAttr.length);

//						console.log(links);                        
                        for(var j=0; j<links.length; j++) {
                          for (var att, i = 0, atts = links[j].attributes, n = atts.length; i < n; i++){
                              att = atts[i];
                              
                              found = att.nodeValue.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/ig);   
                              if (found) {
//                              	  console.log(links[j].innerHTML);
                                  phoneClean = found[0].replace(/[^0-9]/g,"");
                                            
                                  for (var key2 in this.rnr) {
                                      this.fromNum = key2;
                                      this.toNum = this.rnr[key2];
//                                      console.log(""+key2+": "+this.toNum);
                                      if (phoneClean == key2) {
//                                          console.log("Replacing "+found[0] + ' to '+this.toNum);
                                          links[j].attributes[i].nodeValue = att.nodeValue.replace(found[0],this.toNum);
                                      }
                                  };
                              };                                                  
    //                        links[j].attributes[i].nodeValue=att.nodeValue.replace(this.fromNum,this.toNum);
                          }
                        }
                };
            };
		};
	}
}
window.onload = function(e){ 
<?php
	$opts=flipper_get_settings();
?>
    var wm4dLanding = nFlipper.getCookie('wm4d_landing');
//alert(wm4dLanding);
    if (/*true || */wm4dLanding===null || wm4dLanding=='undefined') {
//		alert(window.location.href);

    	nFlipper.setCookie('wm4d_landing',window.location.href);	
    }
    
<?php	if ($opts['client_mode']) { ?>
    var keepCookie=<?=$opts['keep_cookie']?"true":"false";?>;
    var ref = nFlipper.getQueryVariable('ref');
    var cref = nFlipper.getCookie('ref');
    
    if (typeof ref != 'undefined' && ref!="") {
        if (keepCookie && ref=='_cleanit') nFlipper.setCookie('ref','undefined');
        console.log(ref);
        if (!keepCookie || (cref===null || cref=='undefined')) nFlipper.setCookie('ref',ref);	
    };
<?php } ?>
    ref = nFlipper.getCookie('ref');    
    console.log('wm4d_landing is '+nFlipper.getCookie('wm4d_landing'));
    console.log('ref is '+nFlipper.getCookie('ref')+' keep cookie is <?=$opts['keep_cookie'];?>');
<?php 
//print_r(get_option('wm4d_flipper_select')=="enable");
//	if (($opts['client_mode'] && $opts['client_flip']) || get_option('wm4d_flipper_select')=="enable") {
	if (/*$opts['client_mode'] && */$opts['client_flip'] && get_option('wm4d_flipper_select')=="enable") {
		 ?>
	nFlipper.process(ref);
<?php } ?>    
}
