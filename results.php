<?php
session_start();
//TASK 1: Make a connection to the DATABASE, display error for a failed connection
  //arguemtn 1: IP address provided by GoDaddy
  //argument 2: DATABASE user with access odbc_tableprivileges
  //argument 3: DATABASE name
  //argument 4: port for MYSQL, which is not hosted locally

  //$conn = mysqli_connect($serverName, $serverUsername, $serverPassword, $serverDB);
  $conn = new mysqli("127.0.0.1", "admin1" , "admin1" , "fitnessAppexcersizes" );
  if ($conn->connect_errno){
    echo "Failed to connect to MySQL: (". $conn->connect_errno . ")" . $conn->connect_error;
  }

  //TASK 2: Build a string containing a mySql instruction
  $muscle = $_GET['MuscleGroup'];

  //check to see what value the select button is set to
  //TASK 3: use the established database connection to process the database query
  // store the results in a variable

      $sql = "SELECT * FROM workOuts WHERE muscle_group ='$muscle'";
      $result = $conn->query($sql);
  //TASK 4: Build a table of results in a string
  if ($result->num_rows > 0){
      $myDisplayResults = "<table>";
      $myDisplayResults .= "<tr>";
      $myDisplayResults .= "<th> Muscle Group </th>";
      $myDisplayResults .= "<th> Workout Suggestion </th>";
      $myDisplayResults .= "</tr>";

    while ($row = $result-> fetch_assoc()){
      $myDisplayResults .= "<tr>";
      $myDisplayResults .= "<td> $row[muscle_group] </td>";
      $myDisplayResults .= "<td> $row[typeof_Workout] </td>";
      $myDisplayResults .= "</td>";
    }
      $myDisplayResults .= "</table";
      echo $myDisplayResults;
  }

  else{
    echo "0 Results";
  }
?>
