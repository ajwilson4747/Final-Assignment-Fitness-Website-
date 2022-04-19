<?php
//TASK 1: connect to the appropriate database and store userInformation
//this version only ulitizes php and mySql

$conn = new mysqli("127.0.0.1", "admin1" , "admin1" , "fitnessAppexcersizes" );
if ($conn->connect_errno){
  echo "Failed to connect to MySQL: (". $conn->connect_errno . ")" . $conn->connect_error; //return error if fail to connect to database
}

else{
  //TASK 2: build variables that will hold the specified user input for their account activation
  $firstname = $_GET['firstname'];
  $lastname = $_GET['lastName'];
  $email = $_GET['email'];
  $password = $_GET['password'];

  $sql_FN       = "SELECT   FROM `userInformation` WHERE `first_Name` = '$firstname'";  //look for name index
  $sql_LN       = "SELECT   FROM `userInformation` WHERE `last_Name` = '$lastname'" ; //look for the last name index column
  $sql_Email    = "SELECT   FROM `userInformation` WHERE `email` = '$email'"; //look for the email column
  $sql_password = "SELECT   FROM `userInformation` WHERE `password` = '$password'" ;  //look for the password column

  $sql_checkFN = "SELECT * FROM `userInformation` WHERE `first_Name` ='$firstname'";  //next four lines search the database for the listed informaiton
  $sql_checkLN = "SELECT * FROM `userInformation` WHERE `last_Name` ='$lastname'";
  $sql_checkEmail = "SELECT * FROM `userInformation` WHERE `email` ='$email'";
  $sql_checkPassword = "SELECT * FROM `userInformation` WHERE `password` = '$password'";

  $check_FN= mysqli_query($conn, $sql_checkFN); //connect to the database table
  $check_LN= mysqli_query($conn, $sql_checkLN);
  $check_Email= mysqli_query($conn, $sql_checkEmail);
  $check_Password= mysqli_query($conn, $sql_checkPassword);

    //check to see info provided is in the database already
     if (mysqli_num_rows($check_FN)> 0 && mysqli_num_rows($check_LN) > 0 && mysqli_num_rows($check_Email) > 0 && mysqli_num_rows($check_Password) > 0 ){ // if the table has more than 0 entries? proceed and check to see if information that exsists
       $valid = "user already exsists!";
   }
   //check to see if the user provided a proper email
   elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $valid =  "Invaild Email address. Try agin. ";
   }
   //if not, insert into data table
  else{
    $reg = "INSERT INTO `userInformation` (`first_Name`, `last_Name`, `email`, `password`) VALUES ('$firstname', '$lastname', '$email', PASSWORD('$password'))";
    //for hacker prevention, replace the actual password of user with a mocked one (previous line)
    mysqli_query($conn, $reg);  //connect to table
    $valid = "You're information has been successfully saved."; //make json object store the result of this condition
    //echo $password;
  }

  //establish a json class

  $json = new stdClass();

  //enable variable conversion
  @$json->valid = $valid;
  //wrap that variable
  echo json_encode($json);
}
?>
