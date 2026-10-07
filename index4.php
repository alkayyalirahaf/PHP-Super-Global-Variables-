<?php
session_start();
if(!isset($_SESSION['tasks'])){
    $_SESSION['tasks']=[];
}
echo '
<form method="POST">

    <label>Task:</label>
    <input type="text" name="task" required>

    <button type="submit" name="add">Add</button>

</form>';




if(isset($_POST['add'])){
    $task=$_POST['task'];

    if($task !== ""){
        $_SESSION['tasks'][]=$task;
    }

}

echo "<ul>";
foreach($_SESSION['tasks'] as $task){
    echo "<li>$task</li>";
}
echo "</ul>";




?>