<?php
    // Developer: Juan Romano and Atush Bhalla
    session_start();
    include "./Model.php";
    $theDBA = new BankDataBase();
    
    if (isset($_GET['login'])) {
        $password = $_GET['password'];
        $username = $_GET['username'];
        if ($theDBA->Login_User($username, $password)) {
            $_SESSION['username']=$username;
            $output = $theDBA->clientData($username);
            echo $output;
        } 
        else {
            echo "<div class='centerDiv' id='main_page'>
                    <div class='Login-card'>
                        <h1 class='LoginTitle'><b>Log-In</b></h1>
                        <font color='red'> Username and Password are not found or do not match </font>
                        <input type='text'     id='username' class='LoginInput' placeholder='Username' required>
                        <input type='password' id='password' class='LoginInput' placeholder='Password' required>
                        <input type='submit'   id='login' class='LoginButton' value='Login' onclick='checkDetails(); return false'>
                        <div class='LoginNoAccount'>
                            <b><a>Don't have an account?<a class='RegisterLink' href='RegisterClient.php'> Register</a></a></b>
                        </div>
                    </div>
                  </div>";
        }
    }

    if (isset($_GET['register'])) {
        $FN = $_GET['firstname'];
        $LN = $_GET['lastname'];
        $_SESSION['username'] = $_GET['username'];
        $PW = $_GET['password'];
        $SSN = $_GET['ssn'];
        $DOB = $_GET['dob'];
        $EMAIL = $_GET['email'];
        $PN = $_GET['phonenumber'];

        $theDBA->Register_User($FN, $LN, $_SESSION['username'], $PW, $SSN, $DOB, $EMAIL, $PN);
        $output = $theDBA->clientData($_SESSION['username']);
        echo $output;
    }

    if (isset($_GET['deposit'])) {
        $amount = $_GET['amount'];
        $theDBA->Deposit($_SESSION['username'], $amount);
        $output = $theDBA->clientData($_SESSION['username']);
        echo $output;
    }

    if (isset($_GET['withdraw'])) {
        $amount = $_GET['amount'];
        $theDBA->Withdraw($_SESSION['username'], $amount);
        $output = $theDBA->clientData($_SESSION['username']);
        echo $output;
    }

    if (isset($_POST['LogOff'])) {
        header("Location: View.php");
        session_destroy();
    }

?>