<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGISTIC+</title>
    <link rel="stylesheet" type="text/css" href="style4.css">
</head>
<body>

<div class="header">
    <h2>Успішний вхід</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>


    <!-- logged in user information -->
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Вітаємо <strong><?php echo $_SESSION['username']; ?></strong></p><br>
        <p> <a href="index.php?logout='1'" class="btn">Вихід</a> </p><br>
        <!-- Додана кнопка -->
        <a href="projects.php?username=<?php echo $_SESSION['username']; ?>" class="btn">Продовжити</a>
    <?php endif ?>
</div>

</body>
</html>
