<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Results LPU</title>
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

    <div class="container mt-4">
        <h2>List of Students</h2>
        <?php
        include('init.php');
        include('session.php');

        $sql = "SELECT `sname`, `rno`, `class` FROM `student`";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'>
                <thead class='thead-dark'>
                <tr>
                <th>NAME</th>
                <th>ROLL NO</th>
                <th>CLASS</th>
                </tr>
                </thead>
                <tbody>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['sname'] . "</td>";
                echo "<td>" . $row['rno'] . "</td>";
                echo "<td>" . $row['class'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>
                </table>";
        } else {
            echo "No students found.";
        }
        ?>
    </div>
    <div class="container mt-4">
        <?php
        include('init.php');
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $studentName = $_POST['studentName'];
            $rollNo = $_POST['rollNo'];
            $className = $_POST['className'];

            $sql = "UPDATE `student` SET `sname`='$studentName', `class`='$className' WHERE `rno`='$rollNo'";
            $updateResult = mysqli_query($conn, $sql);

            if ($updateResult) {
                echo "Student data updated successfully.";
            } else {
                echo "Error updating student data: " . mysqli_error($conn);
            }
        }
        ?>

        <h2>Edit Student Data</h2>
      
        <form>
            <div class="form-group">
                <label for="studentName">Student Name</label>
                <input type="text" class="form-control" id="studentName" placeholder="Enter Student Name">
            </div>
            <div class="form-group">
                <label for="rollNo">Roll No</label>
                <input type="text" class="form-control" id="rollNo" placeholder="Enter Roll No">
            </div>
            <div class="form-group">
                <label for="className">Class Name</label>
                <input type="text" class="form-control" id="className" placeholder="Enter Class Name">
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
        <?php
include('init.php');
include('session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST['studentName'];
    $rollNo = $_POST['rollNo'];
    $className = $_POST['className'];

    $sql = "UPDATE `student` SET `sname`='$studentName', `class`='$className' WHERE `rno`='$rollNo'";
    $updateResult = mysqli_query($conn, $sql);

    if ($updateResult) {
        echo "Student data updated successfully.";
    } else {
        echo "Error updating student data: " . mysqli_error($conn);
    }
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>