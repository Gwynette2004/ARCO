<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">   
</head>
<body>
    <section class="header">
        <img src="Picture1.jpg" alt="arcologo">
        <div class="nav">
            <ul class="nav-link">
                <li><a href="">HOME</a></li>
                <li><a href="">CREATE</a></li>
                <li><a href="" class="visited">SUMMARY</a></li>
                <li><ion-icon class="person" name="person-circle-outline"></ion-icon></li>
            </ul>
        </div>
    </section>



    <section class="summary-container"> 
    <H1 class="textTitle">SUMMARY OF EVENTS</H1>
    <?php 
    foreach ($months as $monthName => $activities) { ?>
        <div class="month"> 
            <h1><?php echo $monthName; ?></h1>
            <div class="activities-list">
                <?php foreach ($activities as $activity) { ?>
                    <div class="activity">
                        <h2><?php echo $activity['title']; ?></h2>
                        </div>
                <?php } ?>
            </div> 
        </div>
        <?php } ?>
        </section>  
</body>
</html>
