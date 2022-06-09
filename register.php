<?php
    
    if (isset($_POST['register']))
    {
        session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email_id'] = $_POST['email_id'];
        $_SESSION['password'] = $_POST['password'];

        require_once "config.php";

        if ($link) 
        {   
            // preparing statements
            $sql = "INSERT INTO register (name, email_id, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($link, $sql);

            // binding variables
            mysqli_stmt_bind_param($stmt, "sss", $_POST['name'], $_POST['email_id'], $_POST['password']);

            // execute
            if (mysqli_stmt_execute($stmt))
            {
                header("Location: dashboard.php");
                exit();
            }
        }
        mysqli_close($link);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ToDoList</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <style>
        input[type=text], input[type=email], input[type=password], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form button {
            background-color: lightgreen;
        }
        form button:hover {
            background-color: lightblue;
        }
        #first {
            margin-left: 25%;
            margin-top: 5%;
            width: 50%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
        #second button{
            z-index: 10;
            margin-left: 25.2%;
            padding-left: 380px;
            padding-right: 380px;
        }
        h1 {
            margin-left: 38%;
            margin-top: 5%;
        }
    </style>
</head>
<body>
    <h1>Registration Yourself !</h1>
    <form id ="first" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "post">
        <label for = "name">Name:</label>
        <input type = "text" name = "name" placeholder = "set your name" required>
        <br>
        <label for = "email_id">Email:</label>
        <input type = "email" name = "email_id" placeholder = "set your email" required>
        <br>
        <label for = "password">password:</label>
        <input type = "password" name = "password" placeholder = "set password" required>
        <br>
        <button type = "submit" name = "register" value = "Register">Register</button>
    </form>
    <form id = "second">
        <button type = "submit" formaction = "index.php">Home</button>
    </form>
</body>
</html>