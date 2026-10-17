<?php

echo"  <form  method='POST'>
        <label>Email:</label><br>
        <input type='email' name='email' required><br><br>

        <label>Password:</label><br>
        <input type='password' name='password' required><br><br>

        <button type='submit'>Send Data</button>
    </form>";


    // Determine the HTTP request method and display the sent data

    
    $email = $_POST['email'] ;
    $password = $_POST['password'];

echo $email;
echo $password;


?>
