<?
//include(dirname(dirname(__FILE__)).'/js/number-flipper.php');
//echo "sdsd";exit;
header('Content-type: text/javascript');
//include(dirname(dirname(__FILE__)).'/wm4d-options.php');
//include(dirname(dirname(__FILE__)).'/framework/number-flipper.php');
//include_once(dirname(dirname(__FILE__)).'/includes/flipper.php');
//print_r(flipper_get_all());exit;

/*


//echo dirname(dirname(__FILE__)).'/wm4d-options.php';exit;
//print_r($wm4d_phones);$phones = get_phones($wm4d_phones);
//print_r($phones);print_r(get_flip_phones());
print_r(get_option('wm4d_flipper_phone'));
echo "\n---------------------\n";
print_r(get_option('wm4d_flipper_phones'));
exit;
*/
?>
//alert('<? //echo flipper_get_ref();?>');
var nFlipper = {
	fromNum:null,
	getRefNumbers: function(){
		var rn = {};       
<? foreach (flipper_get_all() as $ref=>$row) { ?>
		rn['<?=$ref?>']={};
<?		foreach ($row as $s=>$r) {	?> 
       
		rn['<?=$ref?>']['<?=$s?>']='<?=chop($r)?>';
<? 		}
   };
 ?>       
/*
//		this.fromNum='(847) 801-9901';
		this.fromNum='Word';
		
		rn['ref1']='(847) 801-9909';
		rn['ref2']='(847) 801-9902';
		rn['ref3']='(847) 801-9903';
        
for (var key in rn) {
    console.log(key+' = '+rn[key]);
} 
*/               
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
//			console.log(element.nodeValue);
		};
	},
/*	
	replaceNumbers: function(node){
//	console.log(node.nodeName);
        if( node.nodeName == 'P' ){
//			console.log(node.nodeValue);

//            this.rewrite_text_node( node );
        }
		
        for(i=0; i<node.childNodes.length; i++){
			alert(node.childNodes.length);
//            nn = node.childNodes.length;
//            this.replaceNumbers( node.childNodes[i] );
        }
		
	},
*/	
	toNum:null,
	
	process: function() {
//		alert('in');

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
//		this.replaceNumbers(document);

	}
	
}
window.onload = function(e){ 

	nFlipper.process();
//	alert(nFlipper.getRefNumbers());
}

function flip_number() {
//	$('body').html().replace(/first/,'aaaaaaaaa');
	document.body.innerHTML = document.body.innerHTML.replace(/first/, "aaaaaaaaaaa");
}
