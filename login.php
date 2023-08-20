<?php
session_start();
?> 

<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="loginstyle.css">
    </head>
    <body>
       
	 
	<table border="1" align="center">
	
	<tr>
	
	<p style="text-align:right;"> 
	<a href="web.php">Home</a> 
	

	</p>
	</td>
	</tr>
    <br>
    <br>
    <br>	
	<tr>
    <td>
        <fieldset>
			<legend>LOGIN</legend>
        <form method="post" action="loginval.php" enctype="">
              UserName: <input type="text" id="username" name="username"><br>
            Password: <input type="password" name="password" value=""/> <br>
             <input type="submit" name="btn" value="Submit"/>
        </form>		
		</fieldset>
    </td>
    </tr>		
	</table>
    </body>
</html>