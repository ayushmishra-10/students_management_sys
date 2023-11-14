
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>LPU Result</title>
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
    <?php
    include("init.php");
    include("session.php");
    if (!isset($_POST['class']))
        $class = null;
    else
        $class = $_POST['class'];
    $rno = $_POST['rno'];
    if (empty($class) || empty($rno) || preg_match("/[a-z]/i", $rno)) {
        if (empty($class))
            echo '<div class="alert alert-danger">Please select your class</div>';
        if (empty($rno))
            echo '<div class="alert alert-danger">Please enter your roll number</div>';
        if (preg_match("/[a-z]/i", $rno))
            echo '<div class="alert alert-danger">Please enter a valid roll number</div>';
        exit();
    }

    $name_sql = mysqli_query($conn, "SELECT `sname` FROM `student` WHERE `rno`='$rno' and `class`='$class'");

    while ($row = mysqli_fetch_assoc($name_sql)) {
        $name = $row['sname'];
    }

    $result = mysqli_query($conn, "SELECT `p1`, `p2`, `p3`, `p4`, `p5`, `marks`, `percentage` FROM `result` WHERE `rno`='$rno' and `class`='$class'");
    while ($row = mysqli_fetch_assoc($result)) {
        $p1 = $row['p1'];
        $p2 = $row['p2'];
        $p3 = $row['p3'];
        $p4 = $row['p4'];
        $p5 = $row['p5'];
        $mark = $row['marks'];
        $percentage = $row['percentage'];
    }
    if (mysqli_num_rows($result) == 0) {
        echo "<script language='javascript'>";
        echo "alert('No result found')";
        echo "</script>";
        exit();
    }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4">Result</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>Name:</strong> <?php echo $name; ?></p>
                <p><strong>Class:</strong> <?php echo $class; ?></p>
                <p><strong>Roll No:</strong> <?php echo $rno; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Subjects</th>
                            <th>Paper 1</th>
                            <th>Paper 2</th>
                            <th>Paper 3</th>
                            <th>Paper 4</th>
                            <th>Paper 5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Marks</td>
                            <td><?php echo $p1; ?></td>
                            <td><?php echo $p2; ?></td>
                            <td><?php echo $p3; ?></td>
                            <td><?php echo $p4; ?></td>
                            <td><?php echo $p5; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>Total Marks:</strong> <?php echo $mark; ?></p>
                <p><strong>Percentage:</strong> <?php echo $percentage; ?>%</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-primary" onclick="window.print()">Print Result</button>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
