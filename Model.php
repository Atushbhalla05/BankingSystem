<?php
    // Developer: Juan Romano and Atush Bhalla
    class BankDataBase{
        private $DB;
        
        public function __construct(){
            try{
                $this->DB = new PDO('mysql:dbname=ajbankdb; charset=utf8; host=127.0.0.1', 'root', '');
                $this->DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo ('Error Establishing Connection');
                Exit();
            }
        }

        public function Register_User($First_Name, $Last_Name, $UserName, $Password, $SSN, $DOB, $Email, $Phone){
            $stmt = $this->DB->prepare(
                "insert into client (First_Name, Last_Name, Username, Password, SSN, DOB, Email, Phone, Balance) values (
                    '".$First_Name."',
                    '".$Last_Name."',
                    '".$UserName."',
                    '".$Password."',
                    '".$SSN."',
                    '".$DOB."',
                    '".$Email."',
                    '".$Phone."', 0.00);"
                );
                $stmt-> execute();

                $amount = 0.00;
                $stmt2 = $this->DB->prepare("insert into action (username, Date, Action, Amount) values ('".$UserName."','".date('m/d/Y')."','Register','".$amount."');");
                $stmt2->execute();
            
        }

        public function Login_User($username,$password){
            $sql = "select * from client where username = '".$username."' and password='".$password."';";
            $result = $this->DB->query($sql);
            return ($result->rowCount() > 0);
        }

        public function clientData($username){
            $stmt3 = $this->DB->prepare("select action.date, action.action, action.amount, client.AccountNumber, client.First_Name, client.Last_Name, client.Email, client.Phone, client.Balance 
                                         from action INNER JOIN client ON action.username=client.username 
                                         where client.username='".$username."';");
            $stmt3->execute();
            $resultIn = array();
            $resultIn = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            
            $stringOutput = '';
            
            $MainPage_Beginning = " <div class='centerDiv'>
                                        <div class='grid-container'>
                                            <div class='Logo_Goes_Here'>
                                                <h1 class='Padding_Left'>
                                                    <b class='Title_Page'>A&J Bank</b>
                                                    <div class='Float_Right'>
                                                        <form action='Controller.php' method='post'>
                                                            <button id='sign_out' name='LogOff' onclick='SignOut()'>Sign Out</button>
                                                        </form>
                                                    </div>
                                                </h1>
                                            </div>

                                            <div class='Account_Information'>
                                                <div class='Profile_Information'>
                                                    <h3 class='LightBLue'>";
            $MainPage_Profile =                        "<div class='spacing'><b> Account Number: &nbsp</b> <i>" .$resultIn[0]['AccountNumber']. "</i></div>
                                                        <div class='spacing'><b> Name: &nbsp </b> <i>" .$resultIn[0]['Last_Name']. " , " .$resultIn[0]['First_Name']. "</i></div>
                                                        <div class='spacing'><b>Phone: &nbsp</b> <i>" .$resultIn[0]['Phone']. "</i></div>
                                                        <div class='spacing'><b>Email: &nbsp</b> <i>" .$resultIn[0]['Email']. "</i></div>    
                                                    </h3>
                                                </div>

                                                <div class='Current_Balance'>
                                                    <h1><u>Current Balance:</u><br><b>$ " .$resultIn[0]['Balance']. "</b></h1>
                                                </div>";
            
            $MainPage_Middle =                 "<div class='Widthdraw_Deposit_Section'>
                                                    <div class='spacing'><input type='text' id='actionAmount'></div>
                                                    <div class='spacing'><button id='deposit' onclick='Deposit()'><b>Deposit</b></button></div>
                                                    <div class='spacing'><button id='Withdraw'onclick='Withdraw()'><b>Withdraw</b></button></div>
                                                </div>
                                            </div>
                                            <div class='Action_Log'>
                                                <table class='TableCss'>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                        <th>Amount</th>
                                                    </tr>";
            $MainPage_Ending ="</table><br><br></div></div></div>";

            for ($i=0; $i < count($resultIn) ; $i++) { 
                $stringOutput .= "<tr><th>". $resultIn[$i]['date'] ."</th><th>". $resultIn[$i]['action'] ."</th><th>". $resultIn[$i]['amount'] ."</th></tr>";
            }

            return $MainPage_Beginning.$MainPage_Profile.$MainPage_Middle.$stringOutput.$MainPage_Ending;;
        }

        public function Deposit($username, $amount){
            $stmt4 = $this->DB->prepare("update client set balance=balance+".$amount." where Username='".$username."';");
            $stmt4->execute();
            $stmt4a = $this->DB->prepare("insert into action(username, Date, Action, Amount) values('".$username."','".date('m/d/Y')."','deposit','".$amount."');");
            $stmt4a->execute();
        }

        public function Withdraw($username, $amount){
            $stmt5 = $this->DB->prepare("update client set balance=balance-".$amount." where username='".$username."';");
            $stmt5->execute();
            $stmt5a = $this->DB->prepare("insert into action(username, Date, Action, Amount) values('".$username."','".date('m/d/Y')."','withdraw','".$amount."');");
            $stmt5a->execute();
        }
    }
?>
