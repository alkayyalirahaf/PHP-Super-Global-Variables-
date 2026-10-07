

<?php

echo"  <form  method='POST'>
        <label>URL:</label><br>
        <input type='text' name='url' required><br><br>
        <button type='submit'>GO</button>
    </form>";



    if(isset($_POST['url'])){
    $url = $_POST['url'] ;
  
 echo "<script>
            window.location.href='$url';
          </script>";

    }
?>











