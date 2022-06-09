<?php
// connecting with database
require_once "config.php";

// when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) 
{
    // preparing statement
    $sql = "DELETE FROM `task` WHERE `id` = ?;";
    $stmt = mysqli_prepare ($link, $sql);

    // binding the statement
    mysqli_stmt_bind_param ($stmt, "i", $_POST['id']);
 
    // executing parameters
    if (mysqli_stmt_execute($stmt)) 
    {
	    header("location: dashboard.php");
	    exit();
    }

    // closing statement
    mysqli_stmt_close($stmt);

    // closing connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
    <style>
    input[type=submit] {
            background-color: lightgreen;
            border: none;
            padding: 10px;
    }
    input[type=submit]:hover {
        background-color: lightblue;
        cursor: pointer;
   }
    </style>
</head>
<body>
<h1>Delete Task</h1>
<form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
	<input type = "hidden" name = "id" value = "<?php echo $_GET['id']; ?>"/>
	<p><strong>Are you sure you want to delete this task ?</strong></p>
    <br/>
	<p>
		<input type = "submit" value="Yes">
		<a href = "dashboard.php">No</a>
	</p>
</form> 
</body>
</html>
