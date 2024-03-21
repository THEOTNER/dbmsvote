<?php
require('../connection.php');

if (isset($_POST['Submit'])) {
    $position = addslashes($_POST['position']);
    $results = mysqli_query($con, "SELECT * FROM tbCandidates WHERE candidate_position='$position'");

    // Initialize an array to store candidate information
    $candidates = array();

    // Fetch all candidates for the given position
    while ($row = mysqli_fetch_array($results)) {
        $candidate = array(
            'name' => $row['candidate_name'],
            'votes' => $row['candidate_cvotes']
        );
        $candidates[] = $candidate;
    }
}
?>
<?php
// retrieving positions sql query
$positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>
<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}
?>

<?php if(isset($_POST['Submit'])){$totalvotes=$candidate_1+$candidate_2;} ?>

<html><head>
<link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/admin.js">
</script>
</head><body bgcolor="tan">
<center><b><font color = "white" size="6">Simple PHP Polling System</font></b></center><br><br>
<div id="page">
<div id="header">
<h1>POLL RESULTS </h1>
<a href="admin.php">Home</a> | <a href="positions.php">Manage Positions</a> | <a href="candidates.php">Manage Candidates</a> | <a href="refresh.php">Poll Results</a> | <a href="manage-admins.php">Manage Account</a> | <a href="change-pass.php">Change Password</a>  | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="420" align="center">
<form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
<tr>
    <td>Choose Position</td>
    <td><SELECT NAME="position" id="position">
    <OPTION VALUE="select">select
    <?php 
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT></td>
    <td><input type="submit" name="Submit" value="See Results" /></td>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<?php foreach ($candidates as $candidate): ?>
    <?php echo $candidate['name']; ?>:<br>
    <img src="images/<?php echo strtolower(str_replace(' ', '-', $candidate['name'])); ?>.gif"
         width='<?php echo ($candidate['votes'] != 0) ? (100 * round($candidate['votes'] / array_sum(array_column($candidates, 'votes')), 2)) : 0; ?>'
         height='20'>
    <?php echo ($candidate['votes'] != 0) ? (100 * round($candidate['votes'] / array_sum(array_column($candidates, 'votes')), 2)) : 0; ?>% of <?php echo array_sum(array_column($candidates, 'votes')); ?> total votes
    <br>votes <?php echo $candidate['votes']; ?>
    <br><br>
<?php endforeach; ?>

</div>
<div id="footer">
<div class="bottom_addr">&copy; Simple PHP Polling System. All Rights Reserved Aditya Mathapati USN : 2BL21CI005</div>
</div>
</div>
</body></html>