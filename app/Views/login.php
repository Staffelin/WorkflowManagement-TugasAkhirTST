<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body class="flex justify-center items-center min-h-screen bg-blue-50">
    <div class="card w-[350px]">
        <div class="card-header">
            <h2>Login</h2>
            <p>Access your account</p>
        </div>
        <div class="card-content">
            <form action="<?= base_url('auth/login') ?>" method="post">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input id="login-email" type="email" name="email" placeholder="Enter your email" required class="input">
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input id="login-password" type="password" name="password" placeholder="Enter your password" required class="input">
                </div>
                <button type="submit" class="btn bg-yellow-500 hover:bg-yellow-600 w-full mt-6">
                    Login
                </button>
            </form>
        </div>
        <div class="card-footer text-center">
            <p class="text-sm">Don't have an account? <a href="<?= base_url('auth/register') ?>">Sign up</a></p>
        </div>
    </div>
</body>
</html>
