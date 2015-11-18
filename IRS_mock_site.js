$(document).ready(function(){

        if(getCookie('user_priv') == 2){
            $(".auditor").show()
        }else{
            $(".auditor").hide()
        } // this checks priviledge level and shows / hides auditor class things pending on priviledge

        if(getCookie('user_priv') == 3){
            $(".admin").show()
        }else{
            $(".admin").hide()
        }// this checks priviledge level and shows / hides admin class things pending on priviledge

        if(getCookie('user_id') == null){
        	$(".sign_in").show()
            $(".sign_out").hide()
        }else{
        	$(".sign_in").hide()
            $(".sign_out").show()
        }

    $('#indiv_filing_status').change(function(){
        if( ($(this).val()==2) || ($(this).val()==3) )     {
            $("#indiv_married").show()
            $("#indiv_head_of_house").hide()             
        }
        else if ($(this).val()==4){
            $("#indiv_married").hide()        	
            $("#indiv_head_of_house").show()
        }
        else{
            $("#indiv_married").hide()
            $("#indiv_head_of_house").hide()            
        }
    });


    $('#search_option').change(function(){
        if($(this).val()=="email")     {
            $("#search_by_email").show()
            $("#search_by_privilege").hide()             
        }
        else if ($(this).val()=="privilege"){
            $("#search_by_email").hide()        	
            $("#search_by_privilege").show()
        }
        else{
            $("#search_by_email").hide()
            $("#search_by_privilege").hide()            
        }
    });










}); //this entire block of code is contantly running. in it, we can add code that checks uppdates on a page (text change, etc.)

function on_page_load() {

 	var signed_in = document.getElementsByClassName("igned_in");
	if(signed_in[0] != null)
	{
        if(getCookie('user_id') == null){		
			window.location.replace("http://project.patthickey.com");	
		}
	} // using the css class "sign_in" will only allow pages to load if a user is signed in

 	var not_signed_in = document.getElementsByClassName("not_signed_in");
	if(not_signed_in[0] != null)
	{
        if(getCookie('user_id') != null){		
			window.location.replace("http://project.patthickey.com");	
		}
	} // using the css class "not_sign_in" will only allow pages to load if a user is NOT signed in

 	var admin_privilege = document.getElementsByClassName("admin_privilege");
	if(admin_privilege[0] != null)
	{
        if(getCookie('user_priv') != 3){
			window.location.replace("http://project.patthickey.com");	
		}
	} // using the css class "admin_privilege" will only allow pages to load if a user is an admin

 	var auditor_privilege = document.getElementsByClassName("auditor_privilege");
	if(auditor_privilege[0] != null)
	{
        if((getCookie('user_priv') != 2)||(getCookie('user_priv') != 3)){
			window.location.replace("http://project.patthickey.com");	
		}
	}	// using the css class "auditor_privilege" will only allow pages to load if a user is an auditor or admin

}




// START OF INPUT VALIDATON -----------------------------------

function validate_signup() {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		
		if (email_up.value=="") {
			document.getElementById("email_up").focus();
			document.getElementById("email_up").style.backgroundColor="#FF6666";
			return false;
		}		

		if (!(re.test(email_up.value))){
			return false;
		}
		
		if(password1.value=="") {
			document.getElementById("password1").focus();
			document.getElementById("password1").style.backgroundColor="#FF6666";
			return false;
		}

		if(password2.value=="") {
			document.getElementById("password2").focus();
			document.getElementById("password2").style.backgroundColor="#FF6666";
			return false;
		}

		if(password1.value!=password2.value) {
			alert("passwords do not match");
			return false;
		}

		if(first_name.value=="") {
			document.getElementById("first_name").focus();
			document.getElementById("first_name").style.backgroundColor="#FF6666";
			return false;
		}

		if(middle_name.value=="") {
			document.getElementById("middle_name").focus();
			document.getElementById("middle_name").style.backgroundColor="#FF6666";
			return false;
		}

		if(last_name.value=="") {
			document.getElementById("last_name").focus();
			document.getElementById("last_name").style.backgroundColor="#FF6666";
			return false;
		}

		if(d_o_b.value=="") {
			document.getElementById("d_o_b").focus();
			document.getElementById("d_o_b").style.backgroundColor="#FF6666";
			return false;
		}


		else{
			$.ajax({
		  	type: 'POST',
		  	url: 'sign_up.php',
		  	data: {email_up:email_up.value, password1:password1.value, first_name:first_name.value, second_name:second_name.value, last_name:last_name.value},
		})
			return true;
		}
}

function validate_pw_change() {
		
	


		if(newpass1.value!=newpass2.value) {
			alert("passwords do not match");
			return false;
		}

		


		else{
			$.ajax({
		  	type: 'POST',
		  	url: 'change_password.php',
		  	data: {newpass1:newpass1.value, oldpass:oldpass.value},
		})
			return true;
		}
}

function validate_signin() {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		
		if (email_in.value=="") {
			document.getElementById("email_in").focus();
			document.getElementById("email_in").style.backgroundColor="#FF6666";
			return false;
		}		

		if (!(re.test(email_in.value))){
			return false;
		}
		
		if(password3.value=="") {
			document.getElementById("password3").focus();
			document.getElementById("password3").style.backgroundColor="#FF6666";
			return false;
		}

		else{
			$.ajax({
		  	type: 'POST',
		  	url: 'sign_in.php',
		  	data: {email_in:email_in.value, password3:password3.value},
		})
			return true;
		}
}

function validate_add_faqs() {

		if (add_faqs_question.value=="") {
			document.getElementById("add_faqs_question").focus();
			document.getElementById("add_faqs_question").style.backgroundColor="#FF6666";
			return false;
		}		
		
		if(add_faqs_answer.value=="") {
			document.getElementById("add_faqs_answer").focus();
			document.getElementById("add_faqs_answer").style.backgroundColor="#FF6666";
			return false;
		}

		else{
			$.ajax({
		  	type: 'POST',
		  	url: 'add_faqs.php',
		  	data: {add_faqs_question:add_faqs_question.value, add_faqs_answer:add_faqs_answer.value},
		})
			return true;
		}
}


function all_privilege_search() {

	if((search_email.value=="All")||(search_email.value=="all")||(search_email.value=="Email")||(search_email.value=="")) {
		search_email.value = "%%";
	}

	else {
		return true;
	}
}


// END OF INPUT VALIDATON -----------------------------------





// -----------------------------------------------------------

function textCounter(field, cnt, maxlimit) {         
var cntfield = document.getElementById(cnt) 
 if (field.value.length > maxlimit) // if too long...trim it!
    field.value = field.value.substring(0, maxlimit);
    // otherwise, update 'characters left' counter
    else
    cntfield.value = maxlimit - field.value.length;
 }

 function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}









