<?php require("config.php");
require("session.php");
$col_id = $_POST['col_id'];
$issue_date = $_POST['issue_date'];
//$src=;
$rs = mysqli_query($conn, "SELECT DISTINCT `subject` FROM `certificate_table` WHERE `col_id`=$col_id AND `issue_date`='$issue_date'") or die(mysqli_error($con));
if (mysqli_num_rows($rs) > 0) {
?>
    <option value="">Select Subject</option>
    <?php
    while ($rec = mysqli_fetch_assoc($rs)) {
    ?>
        <option value="<?php echo $rec['subject'] ?>"><?php echo $rec['subject'] ?></option>
<?php
    }
} else {
    echo '<option value="">Subject Unavailable</option>';
}

?>