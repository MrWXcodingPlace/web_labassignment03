<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
?>

<?php
include "dbconnect.php";

$sql = "SELECT tutor_id, tutor_email, tutor_phone, tutor_name FROM tbl_tutors";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result_per_page = 10;
$number_of_result = $stmt->rowCount();
//determine number of total pages available and rounding
$page_number = ceil($number_of_result / $result_per_page);

//determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $result_per_page;

// retrieve selected results from database and display them on page
$sql = 'SELECT tutor_id, tutor_email, tutor_phone, tutor_name FROM tbl_tutors LIMIT ' . $this_page_first_result . ',' .  $result_per_page;
$stmt = $conn->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/basic_layout.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/pagination.css">
    <title>W3.CSS Template</title>
    <style>
    table {
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid black;
    }
    </style>
</head>

<body>

    <nav>
        <div class="logo">MyTutor</div>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Course</a></li>
            <li><a href="tutorpage.php">Tutor</a></li>
            <li><a href="#">Subscription</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </nav>

    <main>
        <div class="grid">
            <?php
            foreach ($stmt as $row) {
            ?>
            <div class="card">
                <img src="../res/images/tutors/<?php echo $row['tutor_id']; ?>.jpg"
                    alt="Tutor <?php echo $row['tutor_id']; ?>" style="width:100%">
                <div class="container">
                    <h2 class="title"><?php echo $row['tutor_name']; ?></h2>
                    <br>
                    <p><?php echo $row['tutor_email']; ?></p>
                    <p><?php echo $row['tutor_phone']; ?></p>

                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </main>

    <div class="pagination">
        <?php
        // display the links to the pages
        for ($page = 1; $page <= $page_number; $page++) {
            echo '<a href="tutorpage.php?page=' . $page . '">' . $page . '</a>';
        }

        ?>
    </div>

    <!-- End of the page -->
    <footer>
        <p>&copy; 2022 MyTutor Inc. All rights reserved.</p>
        <div class="social-icon">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-linkedin"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-youtube"></a>
        </div>
    </footer>
    <script src="../js/navigation.js"></script>
</body>

</html>