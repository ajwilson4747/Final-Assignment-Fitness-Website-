<?php
//TASK 1: Make a connection to the DATABASE, display error for a failed connection
  //arguemtn 1: IP address provided by GoDaddy
  //argument 2: DATABASE user with access odbc_tableprivileges
  //argument 3: DATABASE name
  //argument 4: port for MYSQL, which is not hosted locally

  $mysqli = new mysqli('localhost', 'ajwilson4747', 'HelloWorld12@', 'fitnessAppexcersizes');
  if ($mysqli->connect_errno){
    echo "Failed to connect to MySQL: (". $mysqli->connect_errno . ")" . $mysqli->connect_error;
  }

  //TASK 2: Build a string containing a mySql instruction
  $option = $_GET["MuscleGroup"];

  switch ($option) {
    case "ABDOMINALS":
      $sql = "SELECT `typeof_Workout` FROM `workOuts` WHERE `muscle_group`='$option'";
      return $sql;
      break;
    case "BICEPS":
      $sql = "SELECT `typeof_Workout` FROM `workOuts` WHERE `muscle_group`='$option'";
      return $sql;
      break;
    case "LEGS":
      $sql = "SELECT `typeof_Workout` FROM `workOuts` WHERE `muscle_group`='$option'";
      return $sql;
      break;
  }

  //TASK 3: use the established database connection to process the database query
  // store the results in a variable
  $result = $mysqli->query($sql);

  //TASK 4: Build a table of results in a string
  if ($result -> num_rows > 0){
    $myDisplayResults = "<table>";
    $myDisplayResults .= "<tr>";
    $myDisplayResults .= "<th> Workout Type </th>";
    $myDisplayResults .= "<th> Recommended excersize </th>";
    $myDisplayResults .= "</tr>";

    while ($row = $result->fetch_assoc()){
      $myDisplayResults .= "<tr>";
      $myDisplayResults .= "<td> $row[muscle_group] </td>";
      $myDisplayResults .= "<td> $row[typeof_Workout] </td>";
      $myDisplayResults .= "</td>";
    }
    $myDisplayResults .= "</table";
    echo $myDisplayResults;
    echo $option;
  }

  else{
    echo "0 Results";
  }
 ?>
