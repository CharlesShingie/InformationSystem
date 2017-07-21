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
	
  $logoutGoTo = "login.php";
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

$MM_restrictGoTo = "adminLogin.php";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "userRegForm")) {
	$password = $_POST['password'];
	$encryptedPassword = password_hash ($password , PASSWORD_BCRYPT , array('cost' => 10));
  $insertSQL = sprintf("INSERT INTO adminusers (name, surname, username, cellNumber, email, userLevel, depot , password) VALUES (%s, %s, %s, %s, %s, %s, %s , '{$encryptedPassword}')",
                       GetSQLValueString($_POST['nameText'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['cellNumber'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['userLevelField'], "int"),
                       GetSQLValueString($_POST['depot'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());
}




$colname_users = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_users = $_SESSION['MM_Username'];
}
mysql_select_db($database_connect, $connect);
$query_users = sprintf("SELECT * FROM adminusers WHERE username = %s", GetSQLValueString($colname_users, "text"));
$users = mysql_query($query_users, $connect) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New User sRgistration PageAccounts | Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
</head>

<body class="container">
	<div id="header">
    	
    </div>
    <div class="content">
    <div class="contentLeft col-md-2">
    	<h4>Accounts Page</h4>
        <p>Delete Users</p>
        <p>Register New User</p>
        <p>Edit User Accounts</p>
        <p>&nbsp;<a href="<?php echo $logoutAction ?>">Log out</a></p>
    </div>
    
    <div class="contentRight col-md-9">
      <table width="700" border="0" align="center">
   	    <tr>
    	    <td><form id="userRegForm" name="userRegForm" method="POST" action="<?php echo $editFormAction; ?>">
    	      <table width="500" border="0" align="center">
    	        <tr>
    	          <td width="207">Name</td>
    	          <td width="283"><span id="name">
    	            <label for="nameText"></label>
                  <input name="nameText" type="text" class="form-control" id="nameText" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td>Surname</td>
    	          <td><span id="surnameValidation">
    	            <label for="surname"></label>
                  <input name="surname" type="text" class="form-control" id="surname" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td>UserName</td>
    	          <td><span id="usernameValidation">
    	            <label for="username"></label>
                  <input name="username" type="text" class="form-control" id="username" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td>CellNumber</td>
    	          <td><span id="cellNumberValidation">
                  <label for="cellNumber"></label>
                  <input type="text" class="form-control" name="cellNumber" id="cellNumber" />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td>Email</td>
    	          <td><label for="email"></label>
    	            <span id="emailValidatiom">
                    <label for="email"></label>
                    <input name="email" type="text" class="form-control" id="email" />
                    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td>Depot</td>
    	          <td><span id="DepotValidation">
    	            <label for="depot"></label>
                  <select name="depot" size="1" id="depot">
   	                  <option value="Harare">Harare</option>
   	                  <option value="Bulawayo">Bulawayo</option>
   	                  <option value="Masvingo">Masvingo</option>
   	                  <option value="Mutare">Mutare</option>
                  </select>
                  <span class="selectRequiredMsg">Please select an item.</span></span>
   	              <p>&nbsp;</p></td>
  	          </tr>
    	        <tr>
    	         <p class="form-control"> <td>UserLevel</td>
    	          <td><span id="userLevelValidation">
    	            <label for="userLevelField"></label>
                  <select name="userLevelField" id="userLevelField">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  <span class="selectRequiredMsg">Please select an item.</span></span>
   	              <p>&nbsp;</p></td></p>
  	          </tr>
    	        <tr>
    	          <td>Password</td>
    	          <td><span id="passwordValidation">
    	            <label for="password"></label>
                  <input name="password" type="password" class="form-control" id="password" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td>ConfirmPassword</td>
    	          <td><span id="confirmpasswordvalidation">
    	            <label for="confirmpassword"></label>
    	            <input name="confirmpassword" type="password" class="form-control" id="confirmpassword" />
   	              <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></td>
  	          </tr>
    	        <tr>
    	          <td><input name="resetUserButton" type="reset" class="btn btn-info" id="resetnewUserButton" value="Reset" />    	            <input name="resetFormButton" type="submit" class="btn btn-success" id="resetFormButton" value="Register" /></td>
    	          <td>&nbsp;</td>
  	          </tr>
  	        </table>
    	      <input type="hidden" name="MM_insert" value="userRegForm" />
  	        </form></td>
  	    </tr>
  	  </table>
    	<p>&nbsp;</p>
    </div>
</div>
    <footer>
    copyright &copy; 2017 Inter-Africa Internal Records System designed by | Mr C Dziruni
    </footer>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("name");
var sprytextfield2 = new Spry.Widget.ValidationTextField("surnameValidation");
var sprytextfield3 = new Spry.Widget.ValidationTextField("usernameValidation");
var sprytextfield4 = new Spry.Widget.ValidationTextField("cellNumberValidation", "integer");
var sprytextfield5 = new Spry.Widget.ValidationTextField("emailValidatiom", "email");
var spryselect1 = new Spry.Widget.ValidationSelect("DepotValidation");
var spryselect2 = new Spry.Widget.ValidationSelect("userLevelValidation");
var sprytextfield6 = new Spry.Widget.ValidationTextField("passwordValidation");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("confirmpasswordvalidation", "password");
</script>
</body>
</html>
<?php
mysql_free_result($users);
?>
