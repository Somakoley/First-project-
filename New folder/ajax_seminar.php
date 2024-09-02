<?php require("config.php");
	  require("session.php");
	  $col_id=$_POST['col_id'];
	  //$src=;
	  $rs=mysqli_query($conn,"SELECT DISTINCT `seminar_date` FROM `student` WHERE `col_id`=$col_id")or die(mysqli_error($con));
	  if(mysqli_num_rows($rs)>0){
		  ?>
          <option value="">Select Seminar Date</option>
          <?php
		  while($rec=mysqli_fetch_assoc($rs)){
			  ?>
              <option value="<?php echo $rec['seminar_date'] ?>"><?php echo $rec['seminar_date'] ?></option>
			  <?php
		  }
	  }else{
		  echo '<option value="">Seminar Date not available</option>'; 
	  }
	  
?>