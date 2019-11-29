// alert(243) ;
/*$(document).ready(function(){
	alert(132) ;x
}) ;*/

var appendcount = 1 ;
control = true ;
$(".appendbtn").click(function(){
	// $diff = appendcount - 1 ;
	$count = $("#count").val() ;
	$clearance_status = $("#clearance_status").val() ;
	
	/*divhr = document.getElementsByClassName('divhr') ;
	divspan = document.getElementsByClassName('divspan') ;*/
	// appmore = document.getElementsByClassName('appendmore') ;
	// id = document.getElementsByClassName('control') ;
	/*a = divspan[0] ;
	b = divhr[0] ;
	if(appendcount == 1){ $(a).show() ;	$(b).show() ; }*/
	control = false ;
	// var append = $(".appendmore").html() ;
	if(control == false)
	{
		// appendid = appendcount - 1 ;
		fn = "appendmore"+appendcount ;
		label = appendcount+1 ;
		alert(fn) ;
		append = "<div id='appendmore"+appendcount+"' class='appendmore"+appendcount+"'>"+
             "<hr style='border: 1px solid grey ;opacity: 0.5 ;' class='divhr'>"+//<span class='badge divspan'>"+ label +"</span>"+
             "<div class='form-group img_doc'><label class='col-md-3 control-label' for='document"+$count+"'>Upload documents</label>"+
             "<div class='col-md-9'><input type='file' name='document' id='document"+$count+"' class='form-control'>"+
             "</div></div><div class='form-group info_doc'><label class='col-md-3 control-label' for='addinfo"+$count+"'>"+
             "Additional Info</label><div class='col-md-9'><textarea name='addinfo' id='addinfo"+$count+"' class='form-control'>"+$clearance_status+"</textarea>"+
             "</div></div><div class='form-group del_doc'><div class='col-md-9 pull-right'>"+
             "<button type='button' class='btn btn-xs btn-danger pull-right' onclick='deldoc("+fn+")'>"+
             "<i class='fa fa-remove'></i> Remove</button></div></div></div>" ;
		$("#doc_timeline").append(append) ;
		// $("#doc_timeline").append(delbtn) ;
		// appmore[appendcount-1].innerHTML += delbtn ;
		// alert(appmore[appendcount-1].innerHTML) ;
		// c = divspan[appendcount].innerHTML = appendcount+1 ;
		// $(id[appendcount-1]).val(appendcount+1) ;
		appendcount = appendcount + 1 ;
	}
	/*var values = Array.prototype.map.call(divspan, function(el) {
					    alert(el.innerHTML);
					});*/
	// a = divspan[0].innerHTML ;
}) ;

/*$(".deldoc").click(function(){
	val = $(this).html() ;
	alert(val) ;
}) ;*/

function deldoc(val)
{
	alert(val) ;
	val.parentNode.removeChild(val) ;
	// appendcount = appendcount - 1 ;
	// control = false ;
}