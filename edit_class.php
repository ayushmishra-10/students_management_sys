<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <?php
        include('init.php');
        include('session.php');
        $db = mysqli_select_db($conn, 'srms');

        if (isset($_POST['editClassName'])) {
            
            $classId = $_POST['classId'];
            $newClassName = $_POST['newClassName'];

            
            $updateSql = "UPDATE `class` SET `cname`='$newClassName' WHERE `cid`='$classId'";
            mysqli_query($conn, $updateSql);
        }

        $sql = "SELECT `cname`, `cid` FROM `class`";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'>
                <caption>Edit Class</caption>
                <thead class='thead-dark'>
                <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>Edit</th>
                </tr>
                </thead>
                <tbody>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['cid'] . "</td>";
                echo "<td>" . $row['cname'] . "</td>";
                echo "<td>
                            <form method='POST'>
                                <input type='hidden' name='classId' value='" . $row['cid'] . "'>
                                <input type='text' name='newClassName' placeholder='New Class Name'>
                                <button type='submit' name='editClassName' class='btn btn-primary btn-sm'>Edit</button>
                            </form>
                        </td>";
                echo "</tr>";
            }

            echo "</tbody>
                </table>";
        } else {
            echo "0 results";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
