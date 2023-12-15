<?php
session_start();
include('server.php');

// Обробка форми входу
if (isset($_POST['login_user'])) {
    $username_or_email = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Перевірка, чи користувач ввів ім'я користувача чи електронну пошту
    if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE email='$username_or_email'";
    } else {
        $query = "SELECT * FROM users WHERE username='$username_or_email'";
    }

    $result = mysqli_query($db, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        // Перевірка паролю
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['success'] = "Ви увійшли в систему";
            header('location: index.php');
        } else {
            array_push($errors, "Неправильний пароль");
        }
    } else {
        array_push($errors, "Користувач не знайдений");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style4.css">

  <link
      href="62a4a986359f4110a45d2b88/css/westukrtrants-e6d64034e3911a503cb9bf2e1.webflow.956efd5ca-2.css"
      rel="stylesheet"
      type="text/css"
      />
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous"/>

</head>
<body>

    <div
      data-collapse="small"
      data-animation="default"
      data-duration="400"
      data-easing="ease"
      data-easing2="ease"
      role="banner"
      class="navigation w-nav"
    >
      <div class="navigation-wrap">
        <a href="styleguide.html" class="logo-link w-nav-brand"
          ><img
            width="80"
            height="50"
            src="62a4a986359f4110a45d2b88/654fefb753440ac99f1d25ac_%D0%97%D0%BD%D1%96%D0%BC%D0%BE%D0%BA%20%D0%B5%D0%BA%D1%80%D0%B0%D0%BD%D0%B0%202023-11-11%20231704.png"
            alt=""
            class="logo-image"
        /></a>
        <div class="menu">
          <nav role="navigation" class="navigation-items w-nav-menu">
            <a href="styleguide.html" class="navigation-item w-nav-link">Головна</a
            ><a href="blog.html" class="navigation-item w-nav-link">Про Нас</a
            ><a href="about.html" class="navigation-item w-nav-link">Прайс</a>
            <div class="container-11 w-container">
            </div>
          </nav>
        </div>
        <div class="w-layout-blockcontainer container-12 w-container"></div>
        <a
          href="login.php"
          aria-current="page"
          class="button-3 w-button w--current"
          >Вхід</a>
      </div>
    </div>
    <form class="form" method="post" action="login.php">
          <?php include('errors.php'); ?>
          <div class="input-group">
              <label>Логін або Email</label>
              <input type="text" name="username">
          </div>
          <div class="input-group">
              <label>Пароль</label>
              <input type="password" name="password">
          </div>
          <div class="input-group">
              <button type="submit" class="btn" name="login_user" >Вхід</button>
              <a href="styleguide.html" class="btn" type="submit" >Повернутись</a>
          </div>
          <p>
              Ви ще не зареєстровані? <a href="register.php">Sign up</a>
          </p>
      </form>
</body>
<script
      src="js/jquery-3.5.1.min.dc5e7f18c8.js?site=62a4a986359f4110a45d2b88"
      type="text/javascript"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>
    <script
      src="62a4a986359f4110a45d2b88/js/webflow.d5f364058.js"
      type="text/javascript"
    ></script>
</html>
