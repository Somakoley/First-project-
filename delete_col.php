<?php 
require("config.php");
require("session.php");

$upd=mysqli_query($conn,"UPDATE college SET status='0' WHERE col_id=".$_POST['col_id'])or die(mysqli_error($conn));
//echo $upd;
if($upd==1){
	echo "College details delete successful";
}else{
	echo "College details not delete";
}

?>