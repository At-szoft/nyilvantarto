/**
 * @author Attila
 */
$('.newitem').on('click',function() {
	$("#tartalom").load("newitem.php");
});
$('.newadmin').on('click',function() {
	$("#tartalom").load("newadmin.php");
});
$('.newpass').on('click',function() {
	$("#tartalom").load("newpass.php");
});
$('.moduser').on('click',function() {
	$("#tartalom").load("moduser.php");
});
$('.exit').on('click',function() {
	 var txt;
	    var r = confirm("Biztosan kilépsz?");
	    if (r == true) {
	    	window.location='logout.php'
	    } else {
	    	window.location='fooldal.php'
	    }	  
});	
$('.addsources').on('click',function() {
	$("#tartalom").load("addsources.php");
});
$('.addplace').on('click',function() {
	$("#tartalom").load("addplace.php");
});
$('.adduser').on('click',function() {
	$("#tartalom").load("adduser.php");
});
$('.userlist').on('click',function() {
	$("#tartalom").load("userlist.php");
});
