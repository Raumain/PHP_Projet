<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <a href="/"><i class="fa-solid fa-arrow-left"></i>Back to products</a>
    <div class="forms">
        <div class="form-wrapper">
            <h1>Login</h1>
            <form action="/handlers/login.php" method="post">
                <input type="text" name="email" placeholder="email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="form-wrapper">
            <h1>Create account</h1>
            <form action="/handlers/create_account.php" method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="surname" placeholder="Surname" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Create account</button>
            </form>
        </div>
    </div>
    <?php if (isset($_GET['user-error'])) : ?>
        <p class="error"><?= $_GET['user-error'] ?></p>
    <?php endif; ?>
</body>

</html>