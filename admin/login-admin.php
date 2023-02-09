<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf(
        "SELECT * FROM user
                    WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["password"], $user["password_hash"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["Photo"] = $user["Photo"];
            header("Location: index.php");
            exit;
        }
    }

    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/login-admin.css">

</head>

<body>


    <form method="post">

        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <div class="login">
                        <h1 class="heading-login"> Login-Admin</h1>
                        <?php if ($is_invalid) : ?>
                            <em>Invalid login</em>
                        <?php endif; ?>
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>

                            <input type="email" name="email" class="login__input" id="email" placeholder="Enter Email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" name="password" class="login__input" id="password" placeholder="Enter Password" class="input-password">
                        </div>
                        <button class="button login__submit">
                            <span class="button__text">Log in</span>
                        </button>
                        <button class="button login__submit">
                            <span class="button__text"> <a href="./signup-admin.html"> Register </a> </span>
                        </button>
                    </div>

                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>
            </div>
        </div>
    </form>
</body>

</html>