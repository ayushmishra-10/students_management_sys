<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="classesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classes</a>
                <div class="dropdown-menu" aria-labelledby="classesDropdown">
                    <a class="dropdown-item" href="add_class.php">Add Class</a>
                    <a class="dropdown-item" href="edit_class.php">View/Edit Class</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="studentsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</a>
                <div class="dropdown-menu" aria-labelledby="studentsDropdown">
                    <a class="dropdown-item" href="add_student.php">Add Student</a>
                    <a class="dropdown-item" href="edit_student.php">View/Edit Student</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="resultsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Results</a>
                <div class="dropdown-menu" aria-labelledby="resultsDropdown">
                    <a class="dropdown-item" href="add_result.php">Add Result</a>
                    <a class="dropdown-item" href="edit_result.php">View/Edit Result</a>

                </div>
                
            </li>
            <li class="nav-item">
                <a class="nav-link" href="result.php">Show Result</a>
               
            </li>
            <li>
                 <a href="logout.php" class="nav-link">Logout</a>
    </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <form action="" method="post">
            <fieldset>
                <legend class="text-center">Add Student</legend>
                <div class="form-group">
                    <input type="text" class="form-control" name="student_name" placeholder="Student Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="roll_no" placeholder="Roll No">
                </div>
                <?php
                include('init.php');
                include('session.php');

                $cresult = mysqli_query($conn, "SELECT `cname` FROM `class`");
                echo '<div class="form-group">';
                echo '<select class="form-control" name="class_name">';
                echo '<option selected disabled>Select Class</option>';
                while ($row = mysqli_fetch_array($cresult)) {
                    $display = $row['cname'];
                    echo '<option value="' . $display . '">' . $display . '</option>';
                }
                echo '</select>';
                echo '</div>';
                ?>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </fieldset>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php

    if(isset($_POST['student_name'],$_POST['roll_no'])) {
        $name=$_POST['student_name'];
        $rno=$_POST['roll_no'];
        if(!isset($_POST['class_name']))
            $class_name=null;
        else
            $class_name=$_POST['class_name'];

        if (empty($name) or empty($rno) or empty($class_name) or preg_match("/[a-z]/i",$rno) or !preg_match("/^[a-zA-Z ]*$/",$name)) {
            if(empty($name))
                echo '<p class="error">Please enter name</p>';
            if(empty($class_name))
                echo '<p class="error">Please select your class</p>';
            if(empty($rno))
                echo '<p class="error">Please enter your roll number</p>';
            if(preg_match("/[a-z]/i",$rno))
                echo '<p class="error">Please enter valid roll number</p>';
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    echo '<p class="error">Only alphabets to be in student name</p>'; 
                  }
            exit();
        }
        
        $sql = "INSERT INTO `student` (`sname`, `rno`, `class`) VALUES ('$name', '$rno', '$class_name')";
        $result=mysqli_query($conn,$sql);
        
        if (!$result) {
            echo '<script language="javascript">';
            echo 'alert("Invalid Details")';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Successful")';
            echo '</script>';
        }

    }
?>