<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link href="css/dragonhouse.css" rel="stylesheet" type="text/css">
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
<style type="text/css">
	#contenair{
		height: 100%;
		width: 100%;
		
	}
	#r{
		margin-top: 5%;
		margin-bottom: 5%;
		
		height:95%;
		
		background-color: #b7bcbd;
		
	}
	
	</style>
	

</head>
<body>
<header> <a href="index.html"> 
    <h4 class="logo">DragonHouse</h4>
   
    <nav>
      <ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="rooms.php">ROOMS</a></li>
        <li> <a href="adminindex.php">LOGIN Admin</a></li>
		<li> <a href="custindex.php">LOGIN Customer</a></li>
        <li> <a href="registration.php">REGISTER</a></li>
      </ul>
	  </a>
	  </nav>
  </header>
<div id="contenair">
	<div id="r" >
	
	<?php 
	include('db_con.php');
	session_start();
		if (isset($_POST['username'],$_POST['password']))
			   {
                $username=$_POST['username'];
                $password=$_POST['password'];
  
                   if (empty($username) || empty($password))
                   {
                      $error = 'Hey All fields are required!!';
                    }
                     
					 else {  
					 $login="select * from useradmin where username='".$username."' and password ='".$password."'";
					 $result=mysql_query($login);
					 print_r($result);
				
					 
					if(mysql_fetch_array($result)){
				 $_SESSION['logged_in']='true';
				 $_SESSION['username']=$username;
					 header('Location:manageroom.php');
					 exit();
					 } else {
					 $error='Incorrect details !!';
					 }
					       }
		}
  
  ?>
	<form action="adminindex.php" method="POST">
	<h2 align="center" id="h"><u><i>Login Here........</i></u></h2>
        <table align="center">
		<tr> <?php  if (isset($error)) {?>
           <small style="color:#aa0000;"><?php echo $error; ?>
            <br /> <br />
           <?php } ?> </tr>
          <tr>
            <td width="113">Username:</td>
            <td width="215">
              <input name="username" type="text"  size="40" /></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td>
              <input name="password" type="password"  size="40" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center">
			<input type="submit" name="sub" value="Login" /></td>
            </tr>
			
       </table>
		</form>
		
		
	</div>
</div>
</body>
</html>