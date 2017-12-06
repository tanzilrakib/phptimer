<?php 
if (isset($_POST['submit']))
{
	
	require "../config/config.php";
	
	try 
	{

		$connection = new PDO($dsn, $username, $password, $options);

		$setprop = array(
			"fontsize" => $_POST['fontsize'],
			"cbcolor" => $_POST['cbcolor'],
			"ccolor" => $_POST['ccolor'],
			"lcolor" => $_POST['lcolor']
		);

		if(!empty($_FILES)){

			require "remove-img.php";

			$target_dir =  "../public/img/";
			$target_file = $target_dir . basename($_FILES["cbimage"]["name"]);
			
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			// if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["cbimage"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			// }
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["cbimage"]["size"] > 1000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["cbimage"]["tmp_name"], $target_file)) {	
						$setprop["cbimage"] = "img/".$_FILES["cbimage"]["name"];

			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}

			// die($setprop["cbimage"]);
		}


		$sql = "SELECT *  FROM initializers WHERE id='1'";


		$statement = $connection->prepare($sql);
		// $statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();

		if($statement->rowCount() == 0){

			$sql = sprintf(
					"INSERT INTO %s (%s) values (%s)",
					"initializers",
					implode(", ", array_keys($setprop)),
					":" . implode(", :", array_keys($setprop))
			);

		}
		else {

			$propts = '';
			//setting column = value string 
			$i=1;
			foreach ($setprop as $key => $value) {
					$propts .= sprintf($key.' = "'. $value.'"');
					($i<count($setprop)) ? $propts .= ", " : '';
					$i++;
			}

			$propts = rtrim($propts, ",");

			$sql = sprintf("UPDATE %s SET %s WHERE id=1",
			"initializers",
			$propts
			);

		}


		$statement = $connection->prepare($sql);
		$statement->execute($setprop);

		$_SESSION['success'] = 'Insertion Successful!';

		header("Location: ../public/index.php");
		exit;

	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}

