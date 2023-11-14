<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
</head>
<body class="bg-red-100 h-screen flex items-center justify-center">
    <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <div class="text-center">
            <h1 class="text-3xl font-semibold text-gray-800">Lovely Professional University</h1>
        </div>
        <div class="mt-8">
            <form action="" method="post" name="login" class="space-y-4">
                <fieldset>
                    <legend class="text-xl font-semibold text-gray-700">Admin</legend>
                    <input type="text" name="userid" placeholder="User Id" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-400">
                    <input type="password" name="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-400">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded focus:outline-none focus:bg-blue-600">
                        Login
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>


<?php
    include("init.php");
    session_start();

    if (isset($_POST["userid"],$_POST["password"]))
    {
        $username=$_POST["userid"];
        $password=$_POST["password"];
        if ($username == "admin" && $password =="123" ){
            $_SESSION['login']=$username;
            header("Location: dashboard.php");
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password")';
            echo '</script>';
        }
       /* $sql = "SELECT user_id FROM user WHERE user_id='$username' and password = '$password'";
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);

        if($count==1) {
            $_SESSION['login']=$username;
            header("Location: dashboard.php");
        }else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password")';
            echo '</script>';
        }
        */
        
    }
?>

