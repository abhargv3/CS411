<?php
$connect = mysqli_connect("localhost", "root", "password123", "crimedata");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
  $querySubTbl =  mysql_query("CREATE PROCEDURE neighborsearch() BEGIN SELECT crime.ID, Arrest, crime.Description, Datetime, Neighbourhood FROM crime, location, date WHERE crime.LocationID = location.ID and crime.DateID = date.ID and location.neighbourhood='Bridgeport'");

  $resultSubTbl = mysql_query("call neighborhoodsearch()");
	if(mysql_num_rows($resultSubTbl)>0){
		while($row = mysql_fetch_array($resultSubTbl))
		{
			$output[] = $row;
		}
		echo json_encode($output);
	}


?>