<?php
	//addEntry.php
  //  $connect = mysqli_connect("localhost", "root", "password123", "crimedata");
	/* check connection */
	// if (mysqli_connect_errno()) {
  //   	printf("Connect failed: %s\n", mysqli_connect_error());
  //   	exit();
	// }
	$data = json_decode(file_get_contents("php://input"));
	if(count($data) > 0)
	{

		$Arrest = $data->Arrest;
		$Neighbourhood = $data->Neighbourhood;
		$Description = $data->Description;
		$ID = mt_rand(1,20000);

		//Formatting our datetime
		$date = $data->Datetime;
		$timestamp = strtotime($date);
    $Datetime = date('Y-m-d H:i:s', $timestamp);
		$month = date("m", $timestamp);
		$year = date("y", $timestamp);
		$day = date("d", $timestamp);

    // mysqli_autocommit($connect, FALSE);
		// $query = "INSERT INTO date(ID, Datetime, Year, Month, Day) VALUES('$ID', '$Datetime', '$year', '$month', '$day'); ";
		// mysqli_query($connect, $query);
		// $query2 = "INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES('$ID', 0, 0, '$Neighbourhood', NULL); ";
		// mysqli_query($connect, $query2);
    // $query3 = "INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES('$ID', '$Arrest', '$Description', '$ID', '$ID');";
    // mysqli_query($connect, $query3);
    // mysqli_commit($connect);
    // mysqli_close($connect);



  try {
    $host = 'localhost';
    $db   = 'crimedata';
    $user = 'root';
    $pass = 'password123';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dbh = new PDO($dsn, $user, $pass, $opt);
  } catch (Exception $e) {
  die("Unable to connect: " . $e->getMessage());
  }

  try {
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $dbh->beginTransaction();
  $dbh->exec("INSERT INTO date(ID, Datetime, Year, Month, Day) VALUES('$ID', '$Datetime', '$year', '$month', '$day')");
  $dbh->exec("INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES('$ID', 0, 0, '$Neighbourhood', NULL)");
  $dbh->exec("INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES('$ID', '$Arrest', '$Description', '$ID', '$ID')");
  $dbh->commit();
  echo "Worked!";

  } catch (Exception $e) {
  $dbh->rollBack();
  echo "Failed: " . $e->getMessage();
  }

}

    // INSERT INTO date(ID, Datetime, Year, Month, Day) VALUES('$ID', '$Datetime', '$year', '$month', '$day');
    // INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES('$ID', 0, 0, '$Neighbourhood', NULL);
    // INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES('$ID', '$Arrest', '$Description', '$ID', '$ID');
    //mysqli_query($connect, "DROP PROCEDURE added");
    //CREATE PROCEDURE added @id INT(11), @dt datetime, @y INT(11), @m INT(11), @d INT(11), @ne VARCHAR(45), @a TINYINT(1), @des VARCHAR(45) AS
    // $query3 = mysqli_query($connect, "BEGIN
    //                         INSERT INTO date(ID, DateTime, Year, Month, Day) VALUES(@id, @dt, @y, @m, @d);
    //                         INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES(@id, 0, 0, @ne, NULL);
    //                         INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES(@id, @a, @des, @id, @id);
    //                         END;");

    // $query3 = mysqli_query($connect, "BEGIN ATOMIC INSERT INTO date(ID, Datetime, Year, Month, Day) VALUES('$ID', '$Datetime', '$year', '$month', '$day');
    //                         INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES('$ID', 0, 0, '$Neighbourhood', NULL);
    //                         INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES('$ID', '$Arrest', '$Description', '$ID', '$ID';");

  //   $ze = 0;
  //   $noo = NULL;
  //   if($stmt = mysqli_prepare($connect, "BEGIN INSERT INTO date(ID, DateTime, Year, Month, Day) VALUES(?, ?, ?, ?, ?);
  //   INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES(?, ?, ?, ?, ?);
  //   INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES(?, ?, ?, ?, ?); END")) {
  //   mysqli_stmt_bind_param($stmt, "sssssssssssssss", $ID, $Datetime, $year, $month, $day, $ID, $ze, $ze, $Neighbourhood, $noo, $ID, $Arrest, $Description, $ID, $ID);
  //   mysqli_stmt_execute($stmt);
  // }
    //$qwerty = "execute added @id='$ID', @dt='$Datetime', @y='$year', @m='$month', @d='$day', @ne='$Neighbourhood', @a='$Arrest', @des='$Description' go";
    //$qwerty = "call added()";
    //$query4 = mysqli_query($connect, $query3);
    //echo $query3;

      // mysqli_query($connect, "DROP PROCEDURE added");
      // mysqli_query($connect, "CREATE PROCEDURE added @id INT(11), @dt datetime, @y INT(11), @m INT(11), @d INT(11), @ne VARCHAR(45), @a TINYINT(1), @des VARCHAR(45) AS BEGIN
      //                         INSERT INTO date(ID, DateTime, Year, Month, Day) VALUES(@id, @dt, @y, @m, @d);
      //                         INSERT INTO location(ID, Latitude, Longitude, Neighbourhood, Description) VALUES(@id, 0, 0, @ne, NULL);
      //                         INSERT INTO crime(ID, Arrest, Description, DateID, LocationID) VALUES(@id, @a, @des, @id, @id);
      //                         END;");
      // $qwerty = "call added @id='01', @dt=NULL, @y='1992', @m='09', @d='09', @ne='Austin', @a='1', @des='Nono' go";
      // echo $qwerty;
      // $query3 = mysqli_query($connect, $qwerty);
      // echo $query3;
 ?>
