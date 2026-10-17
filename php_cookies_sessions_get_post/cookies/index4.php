<?php
$cookieName = "test_user";

if (isset($_COOKIE[$cookieName])) {

  
    echo $_COOKIE[$cookieName];

} else {
    
  
    setcookie($cookieName, "Rahaf", time() + 60, "/");

 

}
?>