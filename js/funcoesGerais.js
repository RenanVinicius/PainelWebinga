$(document).ready(function(){
    execNiceScroll();
    postContato();
});

$(window).load(function() {
    $('#slider').nivoSlider({
        effect:'fade', // Specify sets like: 'fold,fade,sliceDown'
        slices:15, // For slice animations
        boxCols: 10, // For box animations
        boxRows: 6, // For box animations
        animSpeed:1500, // Slide transition speed
        pauseTime:4000, // How long each slide will show
        startSlide:0, // Set starting Slide (0 index)
        directionNav:true, // Next & Prev navigation
        directionNavHide:true, // Only show on hover
        controlNav:false, // 1,2,3... navigation
        controlNavThumbs:false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav:true, // Use left & right arrows
        pauseOnHover:false, // Stop animation while hovering
        manualAdvance:false, // Force manual transitions
        captionOpacity:0.8, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });
});


//Scroll
var nice = false;
function execNiceScroll(){
	nice = $("html").niceScroll({
        cursorwidth:"10px",
        cursorborder:"0px",
        cursorborderradius:"0px",
        cursorcolor: "#CC5D01",   
        background: "#D9D1B7"
    });
    var obj = window;
console.log(obj.length);
console.log("selector" in obj);
}


//Post Contato
function postContato(){
   	$("#enviarContato").click(function() {
	var nomeC     = $("#nomeC").val();
	var emailC    = $("#emailC").val();
	var telefoneC = $("#telefoneC").val();
	var assuntoC  = $("#assuntoC").val();
	var msgC      = $("#msgC").val();
	$("#resultContato").html("Carregando, aguarde...").fadeIn('slow');
	$.post('postContato.php', {nomeC: nomeC, emailC: emailC, telefoneC: telefoneC, assuntoC: assuntoC, msgC: msgC}, function(resposta) {
			$("#resultContato");
			if (resposta != false) {
				$("#resultContato").html(resposta);
			} 
	});
	});
}

//jQuery Mask
$(document).ready(function(){
    $("#cepPreCad").mask("99999-999");
    $("#campoTelefone").mask("(99) 9999-9999");
});

/*Bloqueia Ctrl V e Ctrl C
onKeyDown="blockCtrl();"
*/
function blockCtrl(){
    var ctrl=window.event.ctrlKey;
    var tecla=window.event.keyCode;
    if (ctrl && tecla==67) {
        event.keyCode=0; event.returnValue=false;
    }
    if (ctrl && tecla==86) {
        event.keyCode=0; event.returnValue=false;
    }
}

function flash(arqflash,largura,altura) {
	document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="' + largura + '" height="' + altura + '">');
	document.write('<param name="movie" value="' + arqflash + '" />');
	document.write('<param name="allowFullScreen" value="false" />');	
	document.write('<param name="allowScriptAccess" value="sameDomain" />');
	document.write('<param name="quality" value="high" />');
	document.write('<param name="menu" value="false" />');
	document.write('<param name="play" value="true" />');
	document.write('<param name="loop" value="true" />');
	document.write('<param name="autostart" value="true" />');
	document.write('<param name="wmode" value="transparent" />');
	document.write('<embed src="' + arqflash + '" width="' + largura + '" height="' + altura + '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" menu="false" loop="true" autostart="true" wmode="transparent" allowScriptAccess="sameDomain" allowFullScreen="false"></embed>');
	document.write('</object>');
}

function popup(url, w, h){
	window.open(''+url+'', '', 'width='+w+'px,height='+h+'px,menubar=0,resizable=1,scrollbars=1,status=0,toolbar=0');
}

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function romanos(v){
    v=v.toUpperCase()             //MaiÃƒÂºsculas
    v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que nÃƒÂ£o for I, V, X, L, C, D ou M
    //Essa ÃƒÂ© complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"")
    return v
}

function dinheiro(v){
        v=v.replace(/\D/g,"") //Remove tudo o que nÃ£o Ã© dÃ­gito
        v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1,$2");
        //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
        v=v.replace(/(\d)(\d{2})$/,"$1,$2") //Coloca ponto antes dos 2 Ãºltimos digitos
        return v
}
function Site(v){
        v=v.replace("www","")
        v=v.replace("http://","")
        v=v.replace("https://","")
        v=v.replace("http://www","")
        v=v.replace("https://www","")
        return v
}

function Hora(v){                       //SEM SEGUNDOS
    if (v.length >= 6){
        v=v.substring(0,5);
        }
    v=v.replace(/\D/g,"")                    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v=v.replace(/(\d{2})(\d)/,"$1:$2")
    return v
}