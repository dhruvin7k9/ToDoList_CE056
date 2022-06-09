<!DOCTYPE html>
<html lang="en">
<head>
    <title>ToDoList</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <style>
        body {
            background-image: linear-gradient(tomato, white);
            height: 100vh;
        }
        h1 {
            color: white;
            margin-left: 34%;
        }
        form {
            width: 50%;
            height: 50%;
            margin-left: 20%;
            margin-top: 6%;
            padding-left: 10%;
            padding-top: 5%;
            border-radius: 4px;
            background-image: linear-gradient(white, tomato);
        }
        form button {
            background: orange;
            padding: 15px;
            font-weight: 900;
        }
        form button:hover {
            background: yellow;
        }
        form p{
            font-size: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <h1> Welcome To Online ToDoList Site </h1>
    <form>
        <p>New to this place ? Then please, first register yourself :</p>
        <button name = "register" type = "submit" formaction = "register.php">Register</button>
        <br>
        <p>Allready have an account then please sign in here :</p>
        <button name = "signin" type = "submit" formaction = "signin.php">Sign In</button>
        <h3>Thank You !</h3>
    </form>
</body>
</html>