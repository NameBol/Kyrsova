<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'registration', '8889');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Login не вірний"); }
  if (empty($email)) { array_push($errors, "Email не вірний"); }
  if (empty($password_1)) { array_push($errors, "Password не вірний"); }
  if ($password_1 != $password_2) {
        array_push($errors, "Два паролі не сходяться");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, phone, password)
                          VALUES('$username', '$email', '$phone', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: projects.php');
  }
}

// LOGIN USER
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

        // Перевірка паролю (використовуйте md5 тільки якщо паролі в базі даних зберігаються в md5)
        if (md5($password) === $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['success'] = "Ви увійшли в систему";

            header('location: projects.php');
            exit();
        } else {
            array_push($errors, "Неправильний пароль");
        }
    } else {
        array_push($errors, "Користувач не знайдений");
    }
}
