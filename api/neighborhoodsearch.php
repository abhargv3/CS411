<?php
include 'filterCrimeData.php';
$connect = mysqli_connect("localhost", "root", "password123", "crimedata");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

  // session_start();
  // $keyword = $_SESSION['keyword'];
  //echo $keyword;
  //$output = array();
  $qry =  mysqli_query($connect, "create procedure doot() SELECT crime.ID, Arrest, crime.Description, Datetime, Neighbourhood FROM crime, location, date WHERE crime.LocationID = location.ID and crime.DateID = date.ID and location.neighbourhood='Armour Square'");
  // $res = mysqli_query($connect,"call doot()");
  //
  // while ($row = mysqli_fetch_array($res)){
  //   $output[] = $row;
  // }
  // echo json_encode($output);


?>
