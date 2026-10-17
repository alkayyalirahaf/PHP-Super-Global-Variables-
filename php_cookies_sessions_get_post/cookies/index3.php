<?php


if(isset($_POST['submit']))
{

$userName=$_POST['userName'];
setcookie("name",$userName);

}




echo ' <form method = "POST">

<label for="userName">UserName</label>
<input type="text" id= "userName" name="userName" value="'. $userName .'">
<button type="submit" name = "submit">submit</button>
</form>   ' ;

?>