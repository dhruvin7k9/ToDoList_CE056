<?php
    if (isset($_POST['signout']))
    {
        session_start();
        session_unset();
        header("Location: index.php");
        exit();
    }
    else if (isset($_POST['delete_account']))
    {
        // connecting with database
        require_once "config.php";
        session_start();

        /*** deleting user account in register table ***/
        // preparing statement
        $sql1 = "DELETE FROM `register` WHERE `email_id` = ?;";
        $stmt1 = mysqli_prepare ($link, $sql1);

        // binding the statement
        mysqli_stmt_bind_param ($stmt1, "s", $_SESSION['email_id']);

        /*** deleting user tasks in task table ***/
        // preparing statement
        $sql2 = "DELETE FROM `task` WHERE `email_id` = ?;";
        $stmt2 = mysqli_prepare ($link, $sql2);

        // binding the statement
        mysqli_stmt_bind_param ($stmt2, "s", $_SESSION['email_id']);
 
        // executing parameters
        if (mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2)) 
        {   
            // closing statement
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);

            // closing connection
            mysqli_close($link);

            session_unset();
	        header("location: index.php");
	        exit();
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
    <link rel="stylesheet" href="style1.css">
    <style>
        body {
            margin : 0;
        }
        #sidebar {
            width : 20%;
            margin : 0;
            border : 1px solid black;
            height : 100vh;
            background-image : linear-gradient(yellow, white);
        }
        #sidebar h2 {
            margin-left: 6%;
        }
        #sidebar button{
            background-color: lightpink;
            margin-left: 4%;
        }
        #sidebar button:hover{
            background-color: red;
        }

        #row-color {
            background : tomato;
        }
	
	#main h2 {
            margin-left: 22%;
            margin-top: -48%;
        }
	    
        table {
          margin-left : 20.2%;
          margin-top : -50%;
          border-collapse: collapse;
          width: 79.5%;
        }
        th, td {
          text-align: left;
          padding: 8px;
        }
        tr:nth-child(even){background-color: #f2f2f2}
        th {
          background-color: #04AA6D;
          color: white;
        }
    </style>
</head>

<body>
    
    <div id = "sidebar">
        <h2> Welcome <?php session_start(); echo $_SESSION['name']; ?> !</h2>
        <form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "post">

            <p><strong>Click here to add task :</strong></p>
            <button formaction="create.php" type = "submit">add task</button>
            
            <p><strong>Click here to signout :</strong></p>
            <button type = "submit" name = "signout" onclick = 'alert("You are about to sign out !")'>signout</button>
            
            <p><strong>Click here to delete your account :</strong></p>
            <button type = "submit" name = "delete_account" onclick = 'alert("Your account will be permanently deleted !")'>delete account</button>
        
        </form>
    </div>

    <div id = "main">
        <?php
        // Include config file
        require_once "config.php";

        // Attempt select query execution
        $sql = "SELECT * FROM task WHERE email_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) != 0) 
        {
            $i = 1;
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>No.</th>";
            echo "<th>Task</th>";
            echo "<th>Deadline</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_array($result)) 
            {
                $deadline = strtotime($row['timer']);
		    
		$current = time();

                $diff = $deadline - $current -12600;
		/*
		 * if rows are not highlited even though deadline
		   is passed then use below variable, 
		   as there might be delay of 3.5 hours(12600 s) in time()
		*/
		// $diff = $deadline - $current;
                if ($diff < 0)
                {
                    echo "<tr id = 'row-color'>";
                }
                else
                {
                    echo "<tr>";
                }
                echo "<td>".$i."</td>";
                echo "<td>".$row['task']."</td>";
                echo "<td>".$row['timer']."</td>";
                echo "<td>";
                echo "<a href='update.php?id=".$row['id']."'>update task</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='delete.php?id=".$row['id']."'>delete task</a>";
                echo "</td>";
                echo "</tr>";
                ++$i;
            }
            echo "</tbody>";
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } 
        else 
        {
            echo "<h2>"."No task found, PLease add some tasks !"."</h2>";
        }
        // Close connection
        mysqli_close($link);
        ?>
    </div>
</body>
</html>
