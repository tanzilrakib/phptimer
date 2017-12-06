<?php

	require "../config/config.php";
	require "../data/get-init.php";

?>


		<form id="styleForm" method="post" action="../data/insert-setters.php" enctype="multipart/form-data">
				<div class="form-group col-xs-12 col-md-12">
		        	<label for="fontsize" class="control-label">Font Size</label>
		        	<small><p>The counter font size in pixels unit</p></small>
		        	<input type="number" value="<?php echo htmlspecialchars($row['fontsize']);?>" class="form-control" name="fontsize" id="fontsize" placeholder="24">
		    	</div>

				<div class="form-group col-xs-12 col-md-12">
		        	<label for="cbcolor" class="control-label">Counter Background Color</label>
		        	<small><p>The counter background color</p></small>
		        	<input type="color" value="<?php echo htmlspecialchars($row['cbcolor']);?>" class="form-control" name="cbcolor" id="cbcolor" >
		    	</div>
		    	
		    	<div class="form-group">
		    	<div class="col-xs-10 col-md-10">
		        	<label for="cbimage" class="control-label">Counter Background Image</label>
		        	<small><p>The counter background image</p></small>
		        	<input type="file" value="<?php echo htmlspecialchars($row['cbimage']);?>" class="form-control" name="cbimage" id="cbimage" placeholder="24">
		    	</div>

		    	<div class="col-xs-2 col-md-2">
		    		<button id="rm-img" class="btn btn-danger">x</button>
		    	</div>

		    	</div>
				

				<div class="form-group col-xs-12 col-md-12">
		        	<label for="ccolor" class="control-label">Counter Color</label>
		        	<small><p>The counter text color</p></small>
		        	<input type="color" value="<?php echo htmlspecialchars($row['ccolor']);?>" class="form-control" name="ccolor" id="ccolor" >
		    	</div>

				<div class="form-group col-xs-12 col-md-12">
		        	<label for="lcolor" class="control-label">Label Color</label>
		        	<small><p>The label color</p></small>
		        	<input type="color" value="<?php echo htmlspecialchars($row['lcolor']);?>" class="form-control" name="lcolor" id="lcolor" >
		    	</div>

				<div class="form-group col-xs-12 col-md-12 text-center">
		    		<input id="change-styles" class="btn btn-primary" type="submit" name="submit" value="Change">
		    		<!-- <button type="submit" value="submit">Set Value</button> -->
	    		</div>

			</form>
			
			<form id="rm-img-form" method="get" action="../data/remove-img.php">
				
			</form>