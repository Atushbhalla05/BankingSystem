<!--Developer: Juan Romano and Atush Bhalla -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Mini Bank Account</title>
	<link rel="stylesheet" href="MainStyle.css">
</head>
<body>
	<div class='centerDiv' id='main_page'>
        <div class='Login-card'>
            <h1 class='LoginTitle'><b>Log-In</b></h1><br>
            <input type='text'     id='username' class='LoginInput' placeholder="Username" required>
            <input type='password' id='password' class='LoginInput' placeholder="Password" required>
            <input type='submit'   id='login' class='LoginButton' value="Login" onclick="checkDetails(); return false">

            <div class='LoginNoAccount'>
                <b>
                    <a>Don't have an account?
                        <a class='RegisterLink' onclick='RegisterForm(); return false' href=""> Register</a>
                    </a>
                </b>
            </div>
        </div>
	</div>

    <script>
		Main_Page = document.getElementById("main_page");

		function checkDetails(){
			var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;

			var ajax = new XMLHttpRequest();
			ajax.open('GET', 'Controller.php?login'+'&username=' + username + '&password=' + password,true);
	        ajax.send();
	        ajax.onreadystatechange = function () {
	        	if (ajax.readyState == 4 && ajax.status == 200) {
					var cover =ajax.responseText;
	                Main_Page.innerHTML = cover;
	           	}
	        }
		}
		
		function Deposit() {
			var input = document.getElementById('actionAmount').value;
			var ajax = new XMLHttpRequest();
			ajax.open('GET', 'Controller.php?deposit'+'&amount=' + input,true);
	        ajax.send();
	        ajax.onreadystatechange = function () {
	           	if (ajax.readyState == 4 && ajax.status == 200) {
				    var cover = ajax.responseText;
	                Main_Page.innerHTML = cover;
	           	}
	        }
		}

		function Withdraw() {
			var input = document.getElementById('actionAmount').value;
			var ajax = new XMLHttpRequest();
			ajax.open('GET', 'Controller.php?withdraw'+'&amount=' + input,true);
	        ajax.send();
	        ajax.onreadystatechange = function () {
	           	if (ajax.readyState == 4 && ajax.status == 200) {
					var cover = ajax.responseText;
	                Main_Page.innerHTML = cover;
	           	}
	        }
		}

		function RegisterForm() {
				var Register_Form = "<form onsubmit='NewRegister(); return false' method='post'> <div class='centerDiv'>"+
                	"<div class='Login-card'>"+
                    	"<h1 class='LoginTitle'><b>Register</b></h1><br>"+
                    	"<input type='text'      id='firstName'   class='LoginInput' placeholder='First Name'             maxlength='16' size='16' required>"+
                    	"<input type='text'      id='lastName'    class='LoginInput' placeholder='Last Name'              maxlength='16' size='16' required>"+
                    	"<input type='text'      id='userName'    class='LoginInput' placeholder='Username'               maxlength='20' size='16' required>"+
                    	"<input type='password'  id='passWord'    class='LoginInput' placeholder='Password'               maxlength='20' size='16' required>"+
                    	"<input type='text'      id='SSN'         class='LoginInput' placeholder='SSN (### - ### - ####)' maxlength='20' size='16' required>"+
                    	"<input type='text'      id='DOB'         class='LoginInput' placeholder='Date of Birth (MM/DD/YYYY)'                                   required>"+
                    	"<input type='email'     id='EMAIL'       class='LoginInput' placeholder='Email'                                          required>"+
                    	"<input type='text'      id='phoneNumber' class='LoginInput' placeholder='Phone Number' maxlength='16' size='16' required>"+
                    	"<input type='submit' id='login' class='LoginButton' value='Register'>"+
                    	"<div class='LoginNoAccount'>"+
                        	"<b><a>Already have an account?<a class='RegisterLink' onclick='LoginForm(); return false' href=''> Login</a></a></b>"+
                    	"</div>"+
                	"</div>"+
            	"</div>"+
        	"</form>"
			Main_Page.innerHTML = Register_Form;
		}
		
		function LoginForm() {
			Main_Page.innerHTML = "<div class='Login-card'><h1 class='LoginTitle'><b>Log-In</b></h1><br><input type='text'     id='username' class='LoginInput' placeholder='Username' required><input type='password' id='password' class='LoginInput' placeholder='Password' required><input type='submit'   id='login' class='LoginButton' value='Login' onclick='checkDetails(); return false'><div class='LoginNoAccount'><b><a>Don't have an account?<a class='RegisterLink' onclick='RegisterForm(); return false' href=''> Register</a></a></b></div></div>";
		}

		function NewRegister(){
            var FN = document.getElementById("firstName").value;
            var LN = document.getElementById("lastName").value;
            var UN = document.getElementById("userName").value;
            var PW = document.getElementById("passWord").value;
            var SSN = document.getElementById("SSN").value;
            var DOB = document.getElementById("DOB").value;
            var EMAIL = document.getElementById("EMAIL").value;
            var PN = document.getElementById("phoneNumber").value;
            var ajax = new XMLHttpRequest();

            ajax.open('GET', 'Controller.php?register'+
                                '&firstname='   + FN    +
                                '&lastname='    + LN    +
                                '&username='    + UN    + 
                                '&password='    + PW    + 
                                '&ssn='         + SSN   + 
                                '&dob='         + DOB   + 
                                '&email='       + EMAIL + 
                                '&phonenumber=' + PN, true);
            ajax.send();
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var cover = ajax.responseText;
                    Main_Page.innerHTML = cover;
                }
            }
        }
    </script>
</body>
</html>