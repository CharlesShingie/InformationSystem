<?php @session_start(); ?>
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
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "3";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "adminPage.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

$colname_adminPage = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_adminPage = $_SESSION['MM_Username'];
}
mysql_select_db($database_connect, $connect);
$query_adminPage = sprintf("SELECT * FROM adminusers WHERE username = %s", GetSQLValueString($colname_adminPage, "text"));
$adminPage = mysql_query($query_adminPage, $connect) or die(mysql_error());
$row_adminPage = mysql_fetch_assoc($adminPage);
$totalRows_adminPage = mysql_num_rows($adminPage);$colname_adminPage = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_adminPage = $_SESSION['MM_Username'];
}
mysql_select_db($database_connect, $connect);
$query_adminPage = sprintf("SELECT * FROM adminusers WHERE username = %s", GetSQLValueString($colname_adminPage, "text"));
$adminPage = mysql_query($query_adminPage, $connect) or die(mysql_error());
$row_adminPage = mysql_fetch_assoc($adminPage);
$totalRows_adminPage = mysql_num_rows($adminPage);
 @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Home Pager | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
</head>

<body class="container">
	<div id="header">
    	
    </div>
    
<div class="container">
   
  <div class="col-md-2">
    	<h5><?php echo $row_adminPage['name']; ?>    <?php echo $row_adminPage['surname']; ?>!</h5>
        <p><a href="HarareDiesel.php">Diesel</a></p>
<p><a href="NewUser.php"> Register New User </a></p>
        <p><a href="DeleteUsers.php">Delete Users</a></p>
        
        <a href="<?php echo $logoutAction ?>">Log out</a>        
        
        
        
  </div>
  <div class="row">
  	<div class="col-sm-2">
  	
  <li class="">
    <a href="HarareDepot.php" class="thumbnail">
    	<h3>Harare</h3>
      <img src="img/joomla_logo_black.jpg" height="200px" width="200px" alt="">
    </a>
    
  </li></div>
  <div class="col-sm-2">
  
  <li class="">
    <a href="BulawayoDepot.php" class="thumbnail">
    <h3>Bulawayo</h3>
      <img src="img/bg.png" height="200px" width="200px" alt="">
    </a>
    
  </li></div>
  
  <div class="col-sm-2">
  	
  <li class="">
    <a href="MutareDepot.php" class="thumbnail">
    <h3>Mutare</h3>
      <img src="img/joomla_logo_black.jpg" height="200px" width="200px" alt="">
    </a>
    
  </li></div>
  
  <div class="col-sm-2">
  	
  <li class="">
    <a href="MasvingoDepot.php" class="thumbnail">
     <h3>Masvingo</h3>
      <img src="img/bg.png" height="200px" width="200px" alt="">
   
    </a>
    
  </li></div>
  
</ul>
</div>
  </div>
   
        </div>
</body>
    <footer>
    copyright &copy; 2017 Inter-Africa Internal Records System designed by | Mr C Dziruni
    </footer>
</body>
</html>
<?php
mysql_free_result($adminPage);
?>
