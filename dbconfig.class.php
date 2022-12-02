<?php

// $server = "localhost";
// $username = "root";
// $password = "";
// $dbname = "crud_oop_in_php";

// try {
// 	$conn = new PDO(
// 		"mysql:host=$server; dbname=$dbname",
// 		"$username", "$password"
// 	);
	
// 	$conn->setAttribute(
// 		PDO::ATTR_ERRMODE,
// 		PDO::ERRMODE_EXCEPTION
// 	);
// }
// catch(PDOException $e) {
// 	die('Unable to connect with the database');
// }

Class Connection {

private  $server = "mysql:host=localhost;dbname=gallery_img";

private  $user = "root";

private  $pass = "";

private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);

protected $con;
 
          	public function openConnection()

           	{

               try

                 {

	        $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);

	        return $this->con;

                  }

               catch (PDOException $e)

                 {

                     echo "There is some problem in connection: " . $e->getMessage();

                 }

           	}

public function closeConnection() {

   	$this->con = null;

	}

}



?>
