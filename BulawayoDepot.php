<?php require_once('Connections/connect.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "adminLogin.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Blues = 10;
$pageNum_Blues = 0;
if (isset($_GET['pageNum_Blues'])) {
  $pageNum_Blues = $_GET['pageNum_Blues'];
}
$startRow_Blues = $pageNum_Blues * $maxRows_Blues;

mysql_select_db($database_connect, $connect);
$query_Blues = "SELECT * FROM bulawayo";
$query_limit_Blues = sprintf("%s LIMIT %d, %d", $query_Blues, $startRow_Blues, $maxRows_Blues);
$Blues = mysql_query($query_limit_Blues, $connect) or die(mysql_error());
$row_Blues = mysql_fetch_assoc($Blues);

if (isset($_GET['totalRows_Blues'])) {
  $totalRows_Blues = $_GET['totalRows_Blues'];
} else {
  $all_Blues = mysql_query($query_Blues);
  $totalRows_Blues = mysql_num_rows($all_Blues);
}
$totalPages_Blues = ceil($totalRows_Blues/$maxRows_Blues)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bulawayo Depot | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
	<div id="header">
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
    	
    </div>
     <div class="contentLeft col-md-2">
    	<h3>Admin Actions</h3>
        <p><a href="BulawayoDiesel.php">Diesel</a></p>
       	<p><a href="DeleteUsers.php">Delete User</a></p>
        <p><a href="NewUser.php"> Register New User </a></p>
       <p><a href="#">Edit User Accounts</a></p>
       <p><a href="adminPage.php">Admin Home Page</a></p>
        <p><a href="<?php echo $logoutAction ?>">Log out</a></p>
    </div>
    <div class="col-sm-9">
   	  <table class="table table-hover" id="task-table">
      <h3>Bulawayo Depot contact Mr XX 0776786971</h3>
Showing <?php echo ($startRow_Blues + 1) ?>  to <?php echo min($startRow_Blues + $maxRows_Blues, $totalRows_Blues) ?> of  <?php echo $totalRows_Blues ?> Bus  Records  Today   
<thead>
   	  <th> Time</th>
    	<th>Bus</th>
        <th>Route</th>
        <th>Driver</th>
        <th>Cash</th>
        <th>Fuel</th>
        <th>Expenses</th>
        <th>Net Cash</th>
        <th  >Auditor(s)</th>
    </thead>
    
    <tbody>
      <?php do { ?>
        <tr>
          <td><?php echo $row_Blues['Time']; ?></td>
          <td><?php echo $row_Blues['RegNumber']; ?></td>
          <td> <?php echo $row_Blues['Route']; ?></td>
          <td> <?php echo $row_Blues['DriverName']; ?></td>
          <td><?php echo $row_Blues['Cash']; ?> </td>
          <td><?php echo $row_Blues['Diesel']; ?></td>
          <td><?php echo $row_Blues['Expenses']; ?></td>
          <td bgcolor="#6666FF"><?php echo $row_Blues['NetCash']; ?></td>
          <td><?php echo $row_Blues['Auditor']; ?></td>
        </tr>
        <?php } while ($row_Blues = mysql_fetch_assoc($Blues)); ?>
<tr>
        <td></td>
        <td>Next</td>
        
        <td><a class = "btn btn-success btn-print" href = "" onclick = "window.print()"> Print</a></td>
        </tr>
        
    </tbody>
    </table>
    </div>
    
<footer>
    Copyright &copy; 2017 Inter-Africa Internal Records System designed by | Mr C Dziruni
    </footer>
</body>
</html>
<?php
mysql_free_result($Blues);
?>
