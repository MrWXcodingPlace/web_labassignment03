<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
?>

<?php
include "dbconnect.php";

$sql = "SELECT * FROM tbl_subjects";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Pagination
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

if (isset($_GET["submit"])) {
    $key = $_GET["key"];
    $sql = "SELECT * FROM tbl_subjects WHERE subject_name LIKE '%$key%'";
} else {
    // retrieve selected results from database and display them on page
    $sql = 'SELECT * FROM tbl_subjects LIMIT ' . $this_page_first_result . ',' .  $result_per_page;
}
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/pagination.css">
    <title>Main Page</title>
</head>

<body>

    <nav>
        <div class="logo">MyTutor</div>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="#course">Course</a></li>
            <li><a href="tutorpage.php">Tutor</a></li>
            <li><a href="#">Subscription</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </nav>

    <header>
        <div class="bottom-left">
            <h1>MyTutor</h1>
            <p>
                Where you learn new things every day
            </p>
        </div>
    </header>

    <main>
        <h2 id="course">Course</h2>
        <div class="search-bar">
            <form action="index.php" method="get">
                <input type="text" placeholder="Search for ..." name="key" id="key">
                <input type="submit" value="Search" name="submit" id="submit">
                <button onClick="index.php">Clear</button>
            </form>
        </div>
        <?php
        if (isset($_GET["submit"])) {
            $key = $_GET["key"];
            if (!empty($key)) {
                echo "<p class='search-key'>Searching for \"$key\"...</p>";
            } else if (!empty($row)) {
                echo "<p>No result</p>";
            }
        }
        ?>
        <div class="grid">
            <?php
            foreach ($stmt as $row) {
            ?>
            <div class="card">
                <img src="../res/images/courses/<?php echo $row['subject_id']; ?>.png"
                    alt="Subject <?php echo $row['tutor_id']; ?>">
                <div class="container">
                    <a href="course_detail.php?id=<?php echo $row['subject_id']; ?>">
                        <h3 class="title"><?php echo $row['subject_name']; ?></h3>
                    </a>
                    <br>
                    <p><?php echo $row['subject_description']; ?></p>
                    <p class="detail">By tutor <?php echo $row['tutor_id']; ?> / <?php echo $row['subject_sessions']; ?>
                        hours</p>
                    <p class="rating">Rating: <?php echo $row['subject_rating']; ?></p>
                    <br>
                    <p class="price">RM<?php echo $row['subject_price']; ?></p>
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
            echo '<a href="index.php?page=' . $page . '">' . $page . '</a>';
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