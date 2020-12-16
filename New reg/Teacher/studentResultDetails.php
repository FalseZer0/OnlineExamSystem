<?php
session_start();
include "../mysql-connect.php";
$connect = mysqli_connect($server, $user, $pw, $db, $port);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard Teacher</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="dashboard.css" rel="stylesheet">

</head>

<body>
    <?php
    if (!isset($_POST['viewd'])) {
        header("Location: ../Teacher/viewExamT.php");
        exit();
    }
    $eid = $_POST['examid'];
    $sid = $_POST['tid'];
    ?>
    <!-- header -->
    <?php
    include "../Teacher/header.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php
            include "../Teacher/sidebarT.php";
            ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <h2>Student details</h2>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Score per question</th>
                            <th>Correct answer</th>
                            <th>Student`s answer</th>

                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM questions WHERE examID = '$eid'";
                        $result =  mysqli_query($connect, $sql);
                        if (!$result) {
                            die("Could not successfully run query." . mysqli_error($connect));
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr><td>" . $row['QBody'] . "</td><td>" . $row['points'] . "</td>";
                            switch (intval($row['Qanswer'])) {
                                case 1:
                                    print "<td>" . $row['opt1'] . "</td>";
                                    break;
                                case 2:
                                    print "<td>" . $row['opt2'] . "</td>";
                                    break;
                                case 3:
                                    print "<td>" . $row['opt3'] . "</td>";
                                    break;
                                case 4:
                                    print "<td>" . $row['opt4'] . "</td>";
                                    break;
                            }
                            $qid = $row['qID'];
                            $sql1 = "SELECT * FROM answers WHERE examID = '$eid' AND qID = '$qid' AND tID = '$sid'";
                            $result1 =  mysqli_query($connect, $sql1);
                            if (!$result1) {
                                die("Could not successfully run query." . mysqli_error($connect));
                            }
                            $row1 = mysqli_fetch_assoc($result1);
                            switch (intval($row1['uAnswer'])) {
                                case 1:
                                    print "<td>" . $row['opt1'] . "</td>";
                                    break;
                                case 2:
                                    print "<td>" . $row['opt2'] . "</td>";
                                    break;
                                case 3:
                                    print "<td>" . $row['opt3'] . "</td>";
                                    break;
                                case 4:
                                    print "<td>" . $row['opt4'] . "</td>";
                                    break;
                            }
                            print "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

</body>

</html>