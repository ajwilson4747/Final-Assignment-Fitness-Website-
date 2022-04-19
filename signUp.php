<?php
session_start();
//TASK 1: Make a connection to the DATABASE, display error for a failed connection
//arguemtn 1: IP address provided by GoDaddy
//argument 2: DATABASE user with access odbc_tableprivileges
//argument 3: DATABASE name
//argument 5: port for MYSQL, which is not hosted locally

$conn = new mysqli("127.0.0.1", "admin1" , "admin1" , "fitnessAppexcersizes" );
if ($conn->connect_errno){
  echo "Failed to connect to MySQL: (". $conn->connect_errno . ")" . $conn->connect_error;
}

//TASK 2: build variables that will hold the specified user input for their account activation
$firstname = $_GET['firstName'];
$lastname = $_GET['lastName'];
$email = $_GET['email'];
$password = $_GET['password'];

$sql_FN       = "SELECT   FROM userInformation WHERE first_Name = '".$firstname."' " ;  //look for the name index
$sql_LN       = "SELECT   FROM userInformation WHERE last_Name = '".$lastname."' " ;
$sql_Email    = "SELECT   FROM userInformation WHERE email = '".$email."' " ;
$sql_password = "SELECT   FROM userInformation WHERE password = '".$password."' " ;

$checkFN        = mysqli_query($conn, $sql_FN);
$checkLN        = mysqli_query($conn, $sql_LN);
$checkEmail     = mysqli_query($conn, $sql_Email);
$checkPassword  = mysqli_query($conn, $sql_password);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT); //for hacker prevention, replace the actual password of user with a mocked one

if($checkFN->num_rows > 0  && $checkLN->num_rows > 0 && $checkEmail->num_rows > 0 && $checkPassword->num_rows > 0 ){ //check to see if any infor exsist
  $valid = "false";
  echo $valid;
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $valid = "incorrectE"
  echo $valid;
}

}
else{
  $upload = "INSERT INTO `userInformation` (`first_Name`, `last_Name`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$password')";

  //DEBUGGING
  //$upload = "INSERT INTO userInformation (first_Name, last_Name, email, password)
  //VALUES ('firstname' , 'lastname' , 'email' , 'hashedPassword' ) ";
  $sqlsearch = mysqli_query($conn,$upload); //make connection to database
  //$sqlsent= $conn->query($upload);
  if ($sqlsearch){
        echo "<div class='form'> <h3>You are registered successfully.</h3>
              <br/>Click here to <a href='login.php'>Login</a></div>";
        $valid = "true";
        echo $valid;
  }
}



//check to see if the user supplied all required fields
// if (empty ($firstname) || empty($lastname) || empty($email) || empty($password)){
//   header("Location: ../signUp.php?error=emptyfields&firstName=".$firstname."&email=".$email);
//   exit();
//   echo "One or two fields were missing during submission!!!";
// }
// elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//   header ("Location: ../signUp.php?error=invalidemail&firstName=".$firstname);
//   exit();
//   echo "Not a valid email";
// }
//
// else {
//   //TASK 3: Build a string variable containing a mySql instruction
//   //TASK 3a: use the established database connection to process the database query
//   $sql = "SELECT `first_Name` FROM `userInformation`=?";  //look for the name index
//   $sqlsearch = mysqli_stmt_init($conn); //make connection to database
//
//   //TASK 4: check to see if firstName and lastName of a potential user already exsist
//   mysqli_stmt_bind_param($sqlsearch, "ss", $firstname, $lastname);
//   mysqli_stmt_execute($sqlsearch);
//   mysqli_stmt_store_result($sqlsearch);
//   $result = mysqli_stmt_num_rows($sqlsearch); //check row entries
//
//   if ($result > 0){ // if the table has more than 0 entries? proceed and check to see if information that exsists
//     header("Location../signUp.php?error=accountExists".$email);
//     exit();
//   }
//   //if information does not exsist, add to the table
//   else{
//     $sql = "INSERT INTO `userInformation`(`first_Name`, `last_Name`, `email`, `password`) VALUES (?,?,?,?)";
//     $sqlsearch= mysqli_stmt_init($conn);
//     $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //for hacker prevention, replace the actual password of user with a mocked one
//     mysqli_stmt_bind_param($sqlsearch, "ssss", $firstname, $lastname, $email, $hashedPassword); //take the connection, tell it to bind four string parameters, with the following php variables from the user
//     mysqli_stmt_store_result($sqlsearch);
//
//     header("Location../signUp.php?signup=success"); //let user know in the header which it will let them know that the information has successfully been sent
//     exit();
//   }
//
//   mysqli_stmt_close($sqlsearch);
//   mysqli_stmt_close($conn);
// }
// }


?>
