<?php
// Include config file
require_once "config.php";
session_start();

// Processing form data when form is submitted
if (isset($_POST['update'])) 
{   
    // Prepare an insert statement
    $sql = "UPDATE task SET task=?, timer=? WHERE id=?;";
    $stmt = mysqli_prepare($link, $sql);

    mysqli_stmt_bind_param($stmt, "ssi", $_POST['task'], $_POST['timer'], $_POST['id']);

    if(mysqli_stmt_execute($stmt))
    {
        header("location: dashboard.php");
        exit();
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
else
{
    // this else is specially for getting of task to show it in text box
    $sql = "SELECT * FROM task WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);

    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $var = $result['task'];
}
// Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
    <style>
        input[type=text], input[type=datetime-local], select {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
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
<h1>Update Task</h1>
<p><strong>Fill this form and submit to update the task :</strong></p> 

<form action = "<?php echo basename($_SERVER['REQUEST_URI']); ?>" method = "post">
    <label for = "text">Task :</label>
    <input type = "text" name = "task" value = "<?php echo $var; ?>" required>
    <br>
    <label for = "timer">Timer :</label>
    <input type = "datetime-local" name = "timer">
    <br>
    <input type = "hidden" name = "id" value = "<?php echo $_GET['id']?>"/>
    <input type = "submit" value = "Submit" name = "update">
    <a href = "dashboard.php">Go Back</a>
</form>

</body>
</html>