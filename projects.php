<?php
session_start();

// Перевірка, чи користувач увійшов в систему
if (!isset($_SESSION['username'])) {
    // Якщо користувач не увійшов в систему, перенаправте його на сторінку входу
    header('location: login.php');
    exit();
}

// Здійснюємо підключення до бази даних (ваші дані підключення)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "registration";
$port = "8889";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання ім'я користувача з сесії
$username = $_SESSION['username'];

// Отримання інформації про користувача з бази даних
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Виведення інформації про користувача
    while ($row = $result->fetch_assoc()) {
        $name = $row['username']; // Припустимо, що у вас є поле 'name' в таблиці користувачів
        $email = $row['email'];
        $phone = $row['phone']; // Аналогічно для 'email'
    }
} else {
    echo "Інформація про користувача не знайдена";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <link rel="stylesheet" type="text/css" href="style12.css"> 
    <link
      href="62a4a986359f4110a45d2b88/css/westukrtrants-e6d64034e3911a503cb9bf2e1.webflow.956efd5ca-2.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Додайте ваші стилі та інші теги <head> тут -->
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
        src="62a4a986359f4110a45d2b88/654fefb753440ac99f1d25ac_%D0%97%D0%BD%D1%96%D0%BC%D0%BE%D0%BA%20%D0%B5%D0%BA%D1%80%D0%B0%D0%BD%D0%B0%202023-11-11%20231704-3.png"
        alt=""
        class="logo-image"
    /></a>
    <div class="menu">
      <nav role="navigation" class="navigation-items w-nav-menu">
        <a href="styleguide.html" class="navigation-item w-nav-link">Головна</a
        ><a href="blog.html" class="navigation-item w-nav-link">Про Нас</a
        ><a
          href="about-2.html"
          aria-current="page"
          class="navigation-item w-nav-link w--current"
          >Прайс</a
        >
        <div class="container-11 w-container">
        </div>
      </nav>
      <nav class="menu-button w-nav-button">
        <img
          width="50"
          height="50"
          src="62a4a986359f4110a45d2b88/62a4a986359f414e905d2bb3_icon%2044px%20-4.png"
          alt=""
          class="menu-icon"
        />
      </nav>
    </div>
    <div class="w-layout-blockcontainer container-12 w-container"></div>
    <a href="login.php" class="button-3 w-button">Вхід</a>
  </div>
</div>

<div class="section cc-home-wrap">
        <div><h1 class="heading-17">Ваші дані про акаунт</h1></div>
    </div>

    <div class="section">
        <div class="w-form">
            <form
                    id="email-form"
                    name="email-form"
                    data-name="Email Form"
                    method="post"
                    class="form-4"
                    data-wf-page-id="62a4a986359f418b2c5d2b84"
                    data-wf-element-id="a8298025-ee26-5e5e-804a-ecbea4ed4c20"</form>
                <label for="name" class="field-label-10">Name:</label>
                <input
                        type="username"
                        class="w-input"
                        maxlength="256"
                        name="name"
                        data-name="username"
                        placeholder=""
                        id="name"
                        value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>"
                        readonly
                />
                <label for="email" class="field-label-11">Email Address:</label>
                <input
                        type="email"
                        class="w-input"
                        maxlength="256"
                        name="email"
                        data-name="Email"
                        placeholder=""
                        id="email"
                        value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                        readonly
                />
                <label for="email" class="field-label-11">Phone:</label>
                <input
                        type="phone"
                        class="w-input"
                        maxlength="256"
                        name="phone"
                        data-name="phone"
                        placeholder=""
                        id="phone"
                        value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>"
                        readonly
                />
                <a href="login.php" class="btn">Вихід </a>
            </form>
        </div>
    </div>

    <!-- Ваш HTML-код для сторінки -->
</body>
</html>
