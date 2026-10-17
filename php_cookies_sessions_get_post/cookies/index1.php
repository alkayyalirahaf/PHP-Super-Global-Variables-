<?php

echo "  <form method='POST'>

<select name='color'>

<option value='Red'>Red</option>
<option value='Blue'>Blue</option>
<option value='Green'>Green</option>


</select>

<button type='submit' name='submit' >submit</button>



</form>  ";

if(isset($_POST['submit'])){
     $color=$_POST['color'];
     setcookie("bgColor",$color);

     echo " <body style = 'background-color :"  .$color."'> ";

}



?>