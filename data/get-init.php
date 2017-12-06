<?php

	try 
	{	
		require "../config/config.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT *  FROM initializers WHERE id='1'";


		$statement = $connection->prepare($sql);
		// $statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		// $result = mysql_fetch_assoc($statement);

		$sqlTimer = "SELECT *  FROM timersaver WHERE id='1'";

		$statementTimer = $connection->prepare($sqlTimer);
		// $statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statementTimer->execute();

		$resultTimer = $statementTimer->fetchAll(PDO::FETCH_ASSOC);
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
		echo $sqlTimer . "<br>" . $error->getMessage();
	}



	if (!$result || $statement->rowCount() <= 0) 

	{ 
				
				$row["fontsize"]=14;
				$row["cbcolor"]="#000000";
				$row["cbimage"]="";
				$row["ccolor"]="#ffffff";
				$row["lcolor"]="#000000";
	}
	else 
	{	

		$row = $result[0];

	} 

	if (!$resultTimer || $statementTimer->rowCount() <= 0) 

	{ 
				
				$row["start_at"]=0;
				$row["finish_at"]=0;
	}
	else 
	{	

		$row += $resultTimer[0];

	} 