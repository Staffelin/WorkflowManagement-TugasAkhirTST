<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body class="flex justify-center items-center min-h-screen bg-blue-50">
    <div class="card w-[350px]">
        <div class="card-header">
            <h2>Sign Up</h2>
            <p>Create a new account</p>
        </div>
        <div class="card-content">
            <form action="<?= base_url('auth/register') ?>" method="post">
                <div class="form-group">
                    <label for="signup-name">Name</label>
                    <input id="signup-name" type="text" name="username" placeholder="Enter your name" required class="input">
                </div>
                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input id="signup-email" type="email" name="email" placeholder="Enter your email" required class="input">
                </div>
                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input id="signup-password" type="password" name="password" placeholder="Create a password" required class="input">
                </div>
                <button type="submit" class="btn bg-yellow-500 hover:bg-yellow-600 w-full mt-6">
                    Sign Up
                </button>
            </form>
        </div>
        <div class="card-footer text-center">
            <p class="text-sm">Already have an account? <a href="<?= base_url('auth/login') ?>">Login</a></p>
        </div>
    </div>
</body>
</html>
