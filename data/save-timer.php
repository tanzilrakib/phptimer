<?php 

if (isset($_POST['finish-time']))
{	
	
	require "../config/config.php";
	
	try 
	{
		


		$connection = new PDO($dsn, $username, $password, $options);

		$date = new DateTime();
		// $date = $date->format('Y-m-d H:i:s');

		$newDate = DateTime::createFromFormat('D M d Y H:i:s T +', $_POST['finish-time']);


		$timer = array(
			// "fontsize" => $_POST['fontsize'],
			"finish_at" => $newDate->add(DateInterval::createFromDateString('2 seconds'))->format('Y-m-d H:i:s'),
			"start_from" => $date->format('Y-m-d H:i:s'),
		);

		var_dump($timer['start_from']);

		$sql = "SELECT *  FROM timersaver WHERE id='1'";


		$statement = $connection->prepare($sql);
		// $statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();

		if($statement->rowCount() == 0){

			$sql = sprintf(
					"INSERT INTO %s (%s) values (%s)",
					"timersaver",
					implode(", ", array_keys($timer)),
					":" . implode(", :", array_keys($timer))
			);

		}
		else {

			$propts = '';
			//setting column = value string 
			$i=1;
			foreach ($timer as $key => $value) {
					$propts .= sprintf($key.' = "'. $value.'"');
					($i<count($timer)) ? $propts .= ", " : '';
					$i++;
			}

			$propts = rtrim($propts, ",");
			
			$sql = sprintf("UPDATE %s SET %s WHERE id=1",
			"timersaver",
			$propts
			);

		}


		$statement = $connection->prepare($sql);
		$statement->execute($timer);

		$_SESSION['success'] = 'Insertion Successful!';

		header("Location: ../index.php");
		exit;

	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}

