$(document).ready(function(){

        if(getCookie('user_priv') == 2){
            $(".auditor").show()
        }else{
            $(".auditor").hide()
        }

        if(getCookie('user_priv') == 3){
            $(".admin").show()
        }else{
            $(".admin").hide()
        }
});


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

// END OF INPUT VALIDATON -----------------------------------

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









