<?php
    
    if (isset($_POST['signin']))
    {
        require_once "config.php";

        if ($link) 
        {   
            $sql = "SELECT * FROM register WHERE email_id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $_POST['email_id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                if ($_POST['name'] != $row['name'])
                    $error1 = "invalid name";
                if ($_POST['password'] != $row['password'])
                    $error2 = "invalid password";
                if ($_POST['name'] == $row['name'] && $_POST['password'] == $row['password'])
                {
                    session_start();
                    $_SESSION['name'] = $_POST['name'];
                    $_SESSION['email_id'] = $_POST['email_id'];
                    $_SESSION['password'] = $_POST['password'];

                    mysqli_free_result($result);

                    mysqli_close($link);

                    header("Location: dashboard.php");
                    exit();
                }
            }
            else
            {
                $error = "No user found !";
            }
        }
        else 
        {
            echo "connection error";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ToDoList</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
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
            margin-left: 43%;
            margin-top: 5%;
        }
    </style>
<body>
    
    <h1>Signin Yourself !</h1>

    <form id = "first" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "post">

        <strong> <?php if (isset($error)) echo "\""."$error"."\""; ?></strong>
        <br>

        <label for = "name">Name:</label>
        <small>
            <?php if (isset($error1)) echo "\""."$error1"."\""; ?>
        </small>
        <input type = "text" name = "name" placeholder = "enter your name" required>
        <br>

        <label for = "email_id">Email:</label>
        <input type = "email" name = "email_id" placeholder = "enter your email" required>
        <br>

        <label for = "password">password:</label>
        <small>
            <?php if (isset($error2)) echo "\""."$error2"."\""; ?>
        </small>
        <input type = "password" name = "password" placeholder = "enter your password" required>

        <br>
        <button type = "submit" name = "signin" value = "Sign In">Sign In</button>
    </form>
    <form id = "second">
        <button type = "submit" formaction = "index.php">Home</button>
    </form>

</body>
</html>