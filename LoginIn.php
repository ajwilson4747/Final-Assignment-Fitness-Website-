<?php
session_start();
//TASK 1: Make a connection to the DATABASE, display error for a failed connection
//arguemtn 1: IP address provided by GoDaddy
//argument 2: DATABASE user with access odbc_tableprivileges
//argument 3: DATABASE name
//argument 4: port for MYSQL, which is not hosted locally

//make database connection
$conn = new mysqli("127.0.0.1", "admin1", "admin1", "fitnessAppexcersizes" );
if ($conn->connect_errno){
  echo "Failed to connect to MySQL: (". $conn->connect_errno . ")" . $conn->connect_error;
}

//make variables based on login html variables
$givenEmail = $_GET['email'];
$givenPassword = $_GET['password'];


$sql = "SELECT * FROM userInformation WHERE email = '$givenEmail' && password= PASSWORD('$givenPassword')"; //make a sql instruction line
$sqlsearch= $conn->query($sql);  //initate the connection to database

if ($sqlsearch-> num_rows > 0 ){
  $returnDATA = "valid";
  echo $returnDATA;
}

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// //else {
//   //check to see if the login parameters are filled or not
//   if(empty($givenEmail) || empty($givenPassword)){
//     header("Location../LoginIn.php?error=emptyfields"); //return error if not
//     exit();
//   }
//
//   else{ //else progress forward
//     $sql = "SELECT * FROM userInformation WHERE email = '$givenEmail' && password='$givenPassword' "; //make a sql instruction line
//     $sqlsearch= $conn->query($conn);  //initate the connection to database
//     if(!mysqli_stmt_prepare($sqlsearch, $sql)){ //check to see if it was successful
//       header("Location../LoginIn.php?error=sqlerror"); //throw error if not
//       exit();
//     }
//     else{
//       mysqli_stmt_bind_param($sqlsearch, "ss", $givenEmail, $givenEmail); //proceed forward and look for the user's provided email
//       mysqli_stmt_execute($sqlsearch);  //execute the demand
//
//       $outcome = mysqli_stmt_get_result($sqlsearch);  //store the result
//
//       if($row = mysqli_fetch_assoc($outcome)){  //if email found
//         $pswCheck= password_verify($givenPassword, $row['password']); //compare password provided with the actual password
//
//         if($pswCheck ===false){ //if false
//           header("Location../LoginIn.php?error=wrongpsw"); //return message in header the it is the wrong password
//           exit();
//         }
//
//         elseif ($pswCheck ===true){ //if true, start user session
//           session_start();
//           header("Location../LoginIn.php?login=success"); //put message in header indicating success
//           exit();
//         }
//
//         else{
//           header("Location../LoginIn.php?error=wrongpsw"); //else return false because info isn't correct
//           exit();
//         }
//       }
//
//       else{ //or return an error in header indicating the user's email is nonexsistant in the database
//         header("Location../LoginIn.php?error=nouser");
//         exit();
//       }
//
//     }
//
//   }
// }
