<?php
session_start();
?>
<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
</head><body bgcolor="tan">  
<center><b><font color = "white" size="6">Simple PHP Polling System</font></b></center><br><br>
<div id="page">
<div id="header">
<h1>Logged Out Successfully </h1>
<p align="center">&nbsp;</p>
</div>
<?php
session_destroy();
?>
You have been successfully logged out.<br><br><br>
Return to <a href="index.php">Login</a>
<div id="footer">
<div class="bottom_addr">&copy; Simple PHP Polling System. All Rights Reserved Aditya Mathapati USN : 2BL21CI005</div>
</div>
</div>
</body></html>