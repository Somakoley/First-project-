<?php require("config.php");
	  require("session.php");
	  $col_id=$_POST['col_id'];
	  $seminar_date=$_POST['seminar_date'];
	  //$src=;
	  $rs=mysqli_query($conn,"SELECT DISTINCT `dept` FROM `student` WHERE `col_id`=$col_id AND seminar_date='$seminar_date'")or die(mysqli_error($con));
	  if(mysqli_num_rows($rs)>0){
		  ?>
          <option value="">Select Department</option>
          <?php
		  while($rec=mysqli_fetch_assoc($rs)){
			  ?>
              <option value="<?php echo $rec['dept'] ?>"><?php echo $rec['dept'] ?></option>
			  <?php
		  }
	  }else{
		  echo '<option value="">Department Unavailable</option>'; 
	  }
	  
?>