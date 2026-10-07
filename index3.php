<?php
echo'
<form method="POST">

  
    <input type="number" name="num1" required><br><br>


    <input type="number" name="num2" required><br><br>

    <select name="operation">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select><br><br>

    <button type="submit" name="calculate">Calculate</button>

</form>';



$result = "";

if(isset($_POST['calculate'])){

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];

    switch($operation){

        case "+":
            $result = $num1 + $num2;
            break;

        case "-":
            $result = $num1 - $num2;
            break;

        case "*":
            $result = $num1 * $num2;
            break;

        case "/":
            if($num2 != 0){
                $result = $num1 / $num2;
            }else{
                $result = "Cannot divide by zero";
            }
            break;
    }
    echo $result;
}
?>




