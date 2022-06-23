<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/basic_layout.css">
    <link rel="stylesheet" href="../css/course_detail.css">
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

    <main>
        <?php
        include "dbconnect.php";
        $subid = $_GET['id'];
        $sqlselect = "SELECT * FROM `tbl_subjects` WHERE subject_id = '$subid'";
        $stmt = $conn->prepare($sqlselect);
        $stmt->execute();
        foreach ($stmt as $row_subject) {
        ?>
            <div class="detail-section">
                <div class="left">
                    <img src="../res/images/courses/<?php echo $row_subject['subject_id']; ?>.png" alt="Subject <?php echo $row_subject['tutor_id']; ?>">
                </div>
                <div class="right">
                    <h1><?= $row_subject['subject_name'] ?></h1>
                    <br />
                    <p>
                        <span><?= $row_subject['subject_rating'] ?></span>
                        <?php
                        for ($x = 0; $x < round($row_subject['subject_rating']); $x++) {
                            echo "<span class='fa fa-star checked'></span>";
                        }
                        for ($x = 0; $x < 5 - round($row_subject['subject_rating']); $x++) {
                            echo "<span class='fa fa-star'></span>";
                        }
                        ?>
                        <span> | <?= $row_subject['subject_sessions'] ?> hours</span>
                    </p>
                    <p>
                        <?php
                        $tutid = $row_subject['tutor_id'];
                        $sqlselect = "SELECT * FROM `tbl_tutors` WHERE tutor_id = '$tutid'";
                        $stmt = $conn->prepare($sqlselect);
                        $stmt->execute();
                        foreach ($stmt as $row_tutor) {
                        ?>
                            <span>Tutor: <?= $row_tutor['tutor_name'] ?></span>
                        <?php } ?>
                    </p>
                    <br />
                    <p class="price">RM <?= $row_subject['subject_price'] ?></p>
                    <br />
                    <p><?= $row_subject['subject_description'] ?></p>
                    <br />
                    <button>Take course</button>
                    <p>*Try for Free: Enroll to start your 7-day full access free trial.</p>
                </div>
            </div>
        <?php
        }
        ?>
    </main>

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