<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Admin Login</title>  
        <link rel="stylesheet" href="../css/admin.css">

        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .login {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h1 {
            text-align: center;
            text-transform: uppercase;
            color: #ff4757;
        }

        form {
            text-align: left;
            text-transform: capitalize;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        button {
            background-color: #ff4757;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #ff4756d5;
        }

        .main-page {
            background-color: #ff4757;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .main-page:hover {
            background-color: #ff4756d5;
        }

        p {
            text-align: center;
        }
    </style>

    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            
            <!-- Login Form Starts HEre -->

            <form action="" method="POST" class="text-center">
                USERNAME: <br><br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                PASSWORD: <br><br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>

                <a href="../index.php">
                    <button type="button" class="main-page">Main Page</button>
                </a>

            </form> 
            <br><br>
            <!-- Login Form Ends HEre -->

            <p class="text-center">Created By - <em>Chidochashe Zhou</em></p>
        </div>
    </body
</html>

<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for login
        //1. Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available and Login Failed
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>