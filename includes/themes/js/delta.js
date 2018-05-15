/** DELTA ADMIN **/
$(document).ready(function(){
	// ----- Sidebar navigation ---------------------//
	
	$('.submenu > a').click(function(e)
	{
		e.preventDefault();
		var submenu = $(this).siblings('ul');
		var li = $(this).parents('li');
		var submenus = $('#sidebar li.submenu ul');
		var submenus_parents = $('#sidebar li.submenu');
		if(li.hasClass('open'))
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				submenu.slideUp();
			} else {
				submenu.fadeOut(250);
			}
			li.removeClass('open');
		} else 
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				submenus.slideUp();			
				submenu.slideDown();
			} else {
				submenus.fadeOut(250);			
				submenu.fadeIn(250);
			}
			submenus_parents.removeClass('open');		
			li.addClass('open');	
		}
	});
	
	var ul = $('#sidebar > ul');
	
	$('#sidebar > a').click(function(e)
	{
		e.preventDefault();
		var sidebar = $('#sidebar');
		if(sidebar.hasClass('open'))
		{
			sidebar.removeClass('open');
			ul.slideUp(250);
		} else 
		{
			sidebar.addClass('open');
			ul.slideDown(250);
		}
	});
	
	// ----- Resize window related -----  //
	$(window).resize(function()
	{
		if($(window).width() > 479)
		{
			ul.css({'display':'block'});	
			$('#content-header .btn-group').css({width:'auto'});		
		}
		if($(window).width() < 479)
		{
			ul.css({'display':'none'});
			fix_position();
		}
		if($(window).width() > 768)
		{
			$('#user-nav > ul').css({width:'auto',margin:'0'});
            $('#content-header .btn-group').css({width:'auto'});
		}
	});
	
	if($(window).width() < 468)
	{
		ul.css({'display':'none'});
		fix_position();
	}
	if($(window).width() > 479)
	{
	   $('#content-header .btn-group').css({width:'auto'});
		ul.css({'display':'block'});
	}
	
	// ----- Tooltips ----- //
	$('.tip').tooltip();	
	$('.tip-left').tooltip({ placement: 'left' });	
	$('.tip-right').tooltip({ placement: 'right' });	
	$('.tip-top').tooltip({ placement: 'top' });	
	$('.tip-bottom').tooltip({ placement: 'bottom' });	
	
	// ----- Search input typeahead ----- //
	$('#search input[type=text]').typeahead({
		source: ['Dashboard','Form elements','Common Elements','Validation','Wizard','Buttons','Icons','Interface elements','Support','Calendar','Gallery','Reports','Charts','Graphs','Widgets'],
		items: 4
	});
	
	//----- Fixes the position of buttons group in content header and top user navigation -----  //
	function fix_position()
	{
		var uwidth = $('#user-nav > ul').width();
		$('#user-nav > ul').css({width:uwidth,'margin-left':'-' + uwidth / 2 + 'px'});
        
        var cwidth = $('#content-header .btn-group').width();
        $('#content-header .btn-group').css({width:cwidth,'margin-left':'-' + uwidth / 2 + 'px'});
	}
	
	// ----- Style switcher ----- //
	$('#style-switcher i').click(function()
	{
		if($(this).hasClass('open'))
		{
			$(this).parent().animate({marginRight:'-=220'});
			$(this).removeClass('open');
		} else 
		{
			$(this).parent().animate({marginRight:'+=220'});
			$(this).addClass('open');
		}
		$(this).toggleClass('icon-arrow-left');
		$(this).toggleClass('icon-arrow-right');
	});
	
	$('#style-switcher a').click(function()
	{
		var style = $(this).attr('href').replace('#','');
		$('.skin-color').attr('href','themes/style/unicorn.'+style+'.css');
		$(this).siblings('a').css({'border-color':'transparent'});
		$(this).css({'border-color':'#aaaaaa'});
	});
});

//posisi kotak petunjuk
var horizontal_kotak="9px"
var vertikal_kotak="0"

//untuk browser
var ie=document.all
var ns6=document.getElementById&&!document.all
function yangtersembunyi(coba,tipe){
	var totalgaris=(tipe=="left")? coba.offsetLeft:coba.offsetTop;
	var kotak=coba.offsetParent;
	while(kotak!=null){
		totalgaris=(tipe=="left")? totalgaris+kotak.offsetLeft:totalgaris+kotak.offsetTop;
		kotak=kotak.offsetParent;
	}
	return totalgaris;
}

function tesbrowserie(){
	return(document.compatMode&& document.compatMode!="BackCompat")? document.documentElement : document.body
}

function menghapusbrowser(objek,garistepi){
	var edgeoffset=(garistepi=="tepikanan")? parseInt(horizontal_kotak)*-1: parseInt(vertikal_kotak)*-1
	if(garistepi=="tepikanan"){
		var tepiwindow=ie && !window.opera?
		tesbrowserie().scrollLeft + tesbrowserie().clientWidth-30: window.pageXOffset+window.innerWidth-40
		dropmenuobjek.contentmeasure=dropmenuobjek.offsetWidth
		if(tepiwindow-dropmenuobjek.x < dropmenuobjeck.contentmeasure)
			edgeoffset=dropmenuobjek.contentmeasure+objek.offsetWidth+parseInt(horizontal_kotak)
	}else{
		var tepiwindow=ie && !window.opera?
		tesbrowserie().scrollTop+tesbrowserie().clientHeight-15: window.pageYOffset+window.innerHeight-18
		dropmenuobjek.contentmeasure=dropmenuobjek.offsetHeight
		if(tepiwindow-dropmenuobjek.y < dropmenuobjek.contentmeasure)
			edgeoffset=dropmenuobjek.contentmeasure-objek.offsetHeight
	}
	return edgeoffset
}

function menampilkanpetunjuk(menucontents,objek,e,tipwidth){
	if((ie||ns6)&&document.getElementById("kotakpetunjuk")){
		dropmenuobjek=document.getElementById("kotakpetunjuk")
		dropmenuobjek.innerHTML=menucontents
		dropmenuobjek.style.left=dropmenuobjek.style.top=-500
		if(tipwidth=""){
			dropmenuobjek.widthobjek=dropmenuobjek.style
			dropmenuobjek.widthobjek.width=tipwidth
		}
		dropmenuobjek.x=yangtersembunyi(objek, "left")
		dropmenuobjek.y=yangtersembunyi(objek, "top")
		dropmenuobjek.style.left=dropmenuobjek.x-menghapusbrowser(objek, "tepikanan")+objek.offsetWidth+"px"
		dropmenuobjek.style.top=dropmenuobjek.y-menghapusbrowser(objek,"tepibawah")+"px"
		dropmenuobjek.style.visibility="visible"
		objek.onmouseout=menyembunyikan
	}
}

function menyembunyikan(e){
	dropmenuobjek.style.visibility="tersembunyi"
	dropmenuobjek.style.left="-500px"
}

function buatkotakpetunjuk(){
	var blokdivnya=document.createElement("div")
	blokdivnya.setAttribute("id", "kotakpetunjuk")
	document.body.appendChild(blokdivnya)
}
if(window.addEventListener)
window.addEventListener("load", buatkotakpetunjuk, false)
else if(window.attachEvent)
window.attachEvent("onload", buatkotakpetunjuk)
else if(document.getElementById)
window.onload=buatkotakpetunjuk

