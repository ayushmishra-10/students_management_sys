<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management</title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: #343a40;
            /* Dark background color */
            color: #fff;
            /* Light text color */
        }

        .main {
            padding: 20px;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
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
                <legend>Delete Result</legend>
                <?php
                include('init.php');
                include('session.php');

                $cresult = mysqli_query($conn, "SELECT `cname` FROM `class`");
                ?>
                <div class="form-group">
                    <select name="class_name" class="form-control">
                        <option selected disabled>Select Class</option>
                        <?php while ($row = mysqli_fetch_array($cresult)) { ?>
                            <option value="<?php echo $row['cname']; ?>">
                                <?php echo $row['cname']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="rno" class="form-control" placeholder="Roll No">
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </fieldset>
        </form>
        <form action="" method="post">
            <fieldset>
                <legend>Update Result</legend>
                <?php
                $cresult2 = mysqli_query($conn, "SELECT `cname` FROM `class`");
                ?>
                <div class="form-group">
                    <select name="class" class="form-control">
                        <option selected disabled>Select Class</option>
                        <?php while ($row = mysqli_fetch_array($cresult2)) { ?>
                            <option value="<?php echo $row['cname']; ?>">
                                <?php echo $row['cname']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="rn" class="form-control" placeholder="Roll No">
                </div>
                <div class="form-group">
                    <input type="text" name="p1" class="form-control" placeholder="Paper 1">
                </div>
                <div class="form-group">
                    <input type="text" name="p2" class="form-control" placeholder="Paper 2">
                </div>
                <div class="form-group">
                    <input type="text" name="p3" class="form-control" placeholder="Paper 3">
                </div>
                <div class="form-group">
                    <input type="text" name="p4" class="form-control" placeholder="Paper 4">
                </div>
                <div class="form-group">
                    <input type="text" name="p5" class="form-control" placeholder="Paper 5">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </fieldset>
        </form>
    </div>

   

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>


<?php
    if(isset($_POST['class_name'],$_POST['rno'])) {
        $class_name=$_POST['class_name'];
        $rno=$_POST['rno'];
        echo $class_name;
        echo $rno;
        $delete_sql=mysqli_query($conn,"DELETE from `result` where `rno`='$rno' and `class`='$class_name'");
        if(!$delete_sql){
            echo '<script language="javascript">';
            echo 'alert("Not available")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Deleted")';
            echo '</script>';
        }
    }

    if(isset($_POST['rn'],$_POST['p1'],$_POST['p2'],$_POST['p3'],$_POST['p4'],$_POST['p5'],$_POST['class'])) {
        $rno=$_POST['rn'];
        $class_name=$_POST['class'];
        $p1=(int)$_POST['p1'];
        $p2=(int)$_POST['p2'];
        $p3=(int)$_POST['p3'];
        $p4=(int)$_POST['p4'];
        $p5=(int)$_POST['p5'];

        $marks=$p1+$p2+$p3+$p4+$p5;
        $percentage=$marks/5;
        

        $sql="UPDATE `result` SET `p1`='$p1',`p2`='$p2',`p3`='$p3',`p4`='$p4',`p5`='$p5',`marks`='$marks',`percentage`='$percentage' WHERE `rno`='$rno' and `class`='$class_name'";
        $update_sql=mysqli_query($conn,$sql);

        if(!$update_sql){
            echo '<script language="javascript">';
            echo 'alert("Invalid Details")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Updated")';
            echo '</script>';
        }
    }
?>