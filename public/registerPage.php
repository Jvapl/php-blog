<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - PHP Blog</title>
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
        <h2>Create an account</h2>
        <p class="page-description">Join the blog and share your ideas.</p>

        <form class="form-box small-form">
            <label for="name">Username</label>
            <input id="name" type="text" placeholder="Your name">

            <label for="email">Email address</label>
            <input id="email" type="email" placeholder="example@email.com">

            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Your password">

            <a class="ButtonClass" href="index.php">Create my account</a>
        </form>

        <p>Already have an account? <a class="log" href="loginPage.php">Log in here.</a></p>
    </main>

    <?php
    include 'components/footer.php';
    echo $footerHTML
    ?>
</body>
</html>
