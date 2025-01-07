<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="flex justify-center items-center min-h-screen bg-blue-50">

<div class="w-[350px] bg-white rounded-lg shadow-md">
    <div class="p-6">
        <h1 class="text-xl font-bold text-center">Profile</h1>
        <p class="text-sm text-center text-gray-500">Update your personal information</p>
    </div>
    <div class="p-6">
        <a href="<?= base_url('/dashboard') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 010-1.414L10.586 10 7.707 7.121a1 1 0 011.414-1.414l3.5 3.5a1 1 0 010 1.414l-3.5 3.5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>
        <form action="<?= base_url('/profile/update') ?>" method="post">
            <div class="space-y-4">
                <!-- Name Input -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" value="<?= esc($user['username']) ?>" required class="block w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-500 focus:outline-none" />
                </div>

                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="<?= esc($user['email']) ?>" required class="block w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-500 focus:outline-none" />
                </div>
            </div>

            <button type="submit" class="w-full mt-6 px-4 py-2 bg-yellow-500 text-white font-medium rounded-md hover:bg-yellow-600 focus:outline-none">
                Update Profile
            </button>
        </form>
    </div>
    <div class="p-6 text-center text-sm text-gray-500">
        Your information is securely stored and never shared.
    </div>
</div>

</body>
</html>
