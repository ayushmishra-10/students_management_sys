<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .title {
            background-color: #007BFF;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .title h1 a {
            text-decoration: none;
            color: white;
        }

        .main {
            padding: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
    <title>Dashboard</title>
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

    <div class="container main">
        <form action="" method="post">
            <fieldset>
                <legend class="text-center">Enter Marks</legend>
                <div class="form-group">
                    <label for="class_name">Select Class</label>
                    <select class="form-control" name="class_name">
                        <option selected disabled>Select Class</option>
                        <?php
                        include("init.php");
                        include("session.php");

                        $cresult = mysqli_query($conn, "SELECT `cname` FROM `class`");

                        while ($row = mysqli_fetch_array($cresult)) {
                            $display = $row['cname'];
                            echo '<option value="' . $display . '">' . $display . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rno">Roll No</label>
                    <input type="text" class="form-control" name="rno" placeholder="Roll No">
                </div>
                <div class="form-group">
                    <label for="p1">Paper 1</label>
                    <input type="text" class="form-control" name="p1" id="" placeholder="Paper 1">
                </div>
                <div class="form-group">
                    <label for="p2">Paper 2</label>
                    <input type="text" class="form-control" name="p2" id="" placeholder="Paper 2">
                </div>
                <div class="form-group">
                    <label for="p3">Paper 3</label>
                    <input type="text" class="form-control" name="p3" id="" placeholder="Paper 3">
                </div>
                <div class="form-group">
                    <label for="p4">Paper 4</label>
                    <input type="text" class="form-control" name="p4" id="" placeholder="Paper 4">
                </div>
                <div class="form-group">
                    <label for="p5">Paper 5</label>
                    <input type="text" class="form-control" name="p5" id="" placeholder="Paper 5">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>

</body>

</html>







<?php
if (isset($_POST['rno'], $_POST['p1'], $_POST['p2'], $_POST['p3'], $_POST['p4'], $_POST['p5'])) {
    $rno = $_POST['rno'];
    if (!isset($_POST['class_name'])) {
        $class_name = null;
    } else {
        $class_name = $_POST['class_name'];
    }
    $p1 = (int) $_POST['p1'];
    $p2 = (int) $_POST['p2'];
    $p3 = (int) $_POST['p3'];
    $p4 = (int) $_POST['p4'];
    $p5 = (int) $_POST['p5'];

    // Check if the student exists in the "student" table
    $name_query = mysqli_query($conn, "SELECT `sname` FROM `student` WHERE `rno`='$rno' and `class`='$class_name'");

    if ($row = mysqli_fetch_array($name_query)) {
        $display = $row['sname'];

        // Calculate marks and percentage
        $marks = $p1 + $p2 + $p3 + $p4 + $p5;
        $percentage = $marks / 5;

        $sql = "INSERT INTO `result` (`name`, `rno`, `class`, `p1`, `p2`, `p3`, `p4`, `p5`, `marks`, `percentage`) VALUES ('$display', '$rno', '$class_name', '$p1', '$p2', '$p3', '$p4', '$p5', '$marks', '$percentage')";
        $sql = mysqli_query($conn, $sql);

        if (!$sql) {
            echo '<script language="javascript">';
            echo 'alert("Invalid Details")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Successful")';
            echo '</script>';
        }
    } else {
        echo '<p class="error">Student not found in the database for the given class and roll number.</p>';
    }
}
?>