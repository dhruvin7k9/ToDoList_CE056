<?php
// Include config file
require_once "config.php";

// Processing form data when form is submitted
if (isset($_POST['submit'])) 
{
    session_start();
    // Prepare an insert statement
    $sql = "INSERT INTO task (email_id, task, timer) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $_SESSION['email_id'], $_POST['task'], $_POST['timer']);

    // execute
    mysqli_stmt_execute($stmt);

    header("location: dashboard.php");
    exit();

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
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
<h1>Add New Task</h1>
<p><strong>Fill this form and submit to add new task :</strong></p> 

<form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
    <label for = "text">Task :</label>
    <br>
    <input type = "text" name = "task" required>
    <br>
    <label for = "timer">Timer :</label>
    <br>
    <input type = "datetime-local" name = "timer">
    <br>
    <input type = "submit" name = "submit" value = "Submit">
    <a href = "dashboard.php">Go Back</a>
</form>

</body>
</html>