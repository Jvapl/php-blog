<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - PHP Blog</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <nav class="nav-bar">
        <h1>PHP Blog</h1>
        <div class="nav-components">
            <a class="navButtonClass" href="index.php">Home</a>
            <a class="navButtonClass" href="loginPage.php">Log in</a>
            <a class="ButtonClass" href="registerPage.php">Create account</a>
        </div>
    </nav>

    <main class="page-content">
        <h2>Log in</h2>
        <p class="page-description">Log in to find your posts.</p>

        <form class="form-box small-form">
            <label for="email">Email address</label>
            <input id="email" type="email" placeholder="example@email.com">

            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Your password">

            <a class="ButtonClass" href="index.php">Log in</a>
        </form>

        <p>Don't have an account? <a class="log" href="registerPage.php">Sign up here.</a></p>
    </main>
    <?php
    include 'components/footer.php';
    echo $footerHTML;
    ?>
</body>
</html>
