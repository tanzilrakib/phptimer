<?php 

// if (isset($_POST['rm-img']))
// {	

	require "../config/config.php";
	
	try 
	{	

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT *  FROM initializers WHERE id='1'";


		$statement = $connection->prepare($sql);

		$statement->execute();

		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();

	}


	if ($statement->rowCount()>0) 
	{ 	
		 if (file_exists('../public/'.$result[0]["cbimage"])) {
		    unlink('../public/'.$result[0]["cbimage"]);
		  }
		$sql = sprintf("UPDATE initializers SET cbimage = '' WHERE id=1");
		$statement = $connection->prepare($sql);
		$statement->execute();

	    header("Location: ../public/index.php");
	}


	
// }

