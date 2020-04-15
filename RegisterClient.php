<!--Developer: Juan Romano and Atush Bhalla -->
<!--<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>AJ Bank - Register Account </title>
        <link rel="stylesheet" href="MainStyle.css">
    </head>
    <body id='outputBalance'>
        <form onsubmit="Main(); return false" method="post" >
            <div class='centerDiv'>
                <div class='Login-card'>
                    <h1 class='LoginTitle'><b>Register</b></h1><br>
                    <input type="text"      id="firstName"   class='LoginInput' placeholder='First Name'             maxlength="16" size="16" required>
                    <input type="text"      id="lastName"    class='LoginInput' placeholder='Last Name'              maxlength="16" size="16" required>
                    <input type="text"      id="userName"    class='LoginInput' placeholder='Username'               maxlength="20" size="16" required>
                    <input type="password"  id="passWord"    class='LoginInput' placeholder='Password'               maxlength="20" size="16" required>
                    <input type="text"      id="SSN"         class='LoginInput' placeholder='SSN (### - ### - ####)' maxlength="20" size="16" required>
                    <input type="text"      id="DOB"         class='LoginInput' placeholder='Date of Birth (MM/DD/YYYY)'                                   required>
                    <input type="email"     id="EMAIL"       class='LoginInput' placeholder='Email'                                          required>
                    <input type="text"      id="phoneNumber" class='LoginInput' placeholder='Phone Number' maxlength="16" size="16" required>
                    <input type='submit' id='login' class='LoginButton' value="Register">
                    <div class='LoginNoAccount'>
                        <b><a>Already have an account?<a class='RegisterLink' href="View.php"> Login</a></a></b>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <script>
        function Main(){
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
                    document.getElementById("outputBalance").innerHTML = cover;
                }
            }
        }
    </script>
    
</html>-->