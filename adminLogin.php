<?php require_once('Connections/connect.php'); ?>
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

$colname_AdminLogin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_AdminLogin = $_SESSION['MM_Username'];
}
mysql_select_db($database_connect, $connect);
$query_AdminLogin = sprintf("SELECT * FROM adminusers WHERE username = %s", GetSQLValueString($colname_AdminLogin, "text"));
$AdminLogin = mysql_query($query_AdminLogin, $connect) or die(mysql_error());
$row_AdminLogin = mysql_fetch_assoc($AdminLogin);
$totalRows_AdminLogin = mysql_num_rows($AdminLogin);

mysql_select_db($database_connect, $connect);
$query_registerUserPage = "SELECT * FROM adminusers";
$registerUserPage = mysql_query($query_registerUserPage, $connect) or die(mysql_error());
$row_registerUserPage = mysql_fetch_assoc($registerUserPage);
$totalRows_registerUserPage = mysql_num_rows($registerUserPage);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "userLevel";
  $MM_redirectLoginSuccess = "adminPage.php";
  $MM_redirectLoginFailed = "adminLogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connect, $connect);
  	
  $LoginRS__query=sprintf("SELECT username, password, userLevel FROM adminusers WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'userLevel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inter-Africa</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body class="container">
	
    <div class="container ">
    	<div class="row">
        	<div class="col-sm-6 col-md-4 col-md-offset-4">
            	<div class="panel panel-default">
                <div id="header"></div>
                <div class="panel-heading">Login To Proceed</div>
                <div class="panel-body">
                  <form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
                    <span id="sprytextfield1">
                    <label for="username"></label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="enter your username!"/>
                    <span class="textfieldRequiredMsg">A value is required.</span></span>
                    <p id="textField"><span id="sprytextfield2">
                    <label for="password"></label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="enter your password" />
                      <span class="textfieldRequiredMsg">A value is required.</span></span></p>
                    <p>
                      <input type="submit" class="btn btn-lg btn-success btn-block" name="login" id="login" value="Admin Login" />
                    </p>
                     <p>
                     <a href="login.php">
                       <input type="button" class="btn btn-lg btn-primary btn-block" name="login2" value="Ordinary Login" />
                     </p></a>
                  </form>
                	<div class="panel-footer ">
						Super Adminstrator Login
					</div>
                </div>
                
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>
<?php
mysql_free_result($AdminLogin);

mysql_free_result($registerUserPage);
?>
