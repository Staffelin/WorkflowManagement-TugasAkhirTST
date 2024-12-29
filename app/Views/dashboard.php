<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journalist Workflow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide@latest/dist/lucide.css">
</head>
<body class="bg-gray-100">

<div class="space-y-8 p-8">
    <h1 class="text-4xl font-bold text-blue-800 text-center">Welcome to Journalist Workflow</h1>
    <p class="text-xl text-center text-blue-600">Streamline your article management, workflow, and approval process</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Article Management Card -->
        <a href="<?= base_url('/articles') ?>" class="hover:shadow-lg transition-shadow block">
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l2-2m0 0l-2-2m2 2h8m-6 4h6M6 8h.01M6 12h.01M6 16h.01M6 20h.01M10 4h6M8 20h6" />
                    </svg>
                    <span class="text-lg font-semibold">Article Management</span>
                </div>
                <p class="mt-2 text-gray-600">Manage your articles efficiently</p>
            </div>
        </a>

        <!-- Workflow Management Card -->
        <a href="<?= base_url('/workflow') ?>" class="hover:shadow-lg transition-shadow block">
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4m4-4H3m6 8H3m0 0v-6m0 6l6-6" />
                    </svg>
                    <span class="text-lg font-semibold">Workflow Management</span>
                </div>
                <p class="mt-2 text-gray-600">Streamline your editorial workflow</p>
            </div>
        </a>

        <!-- Approval Management Card -->
        <a href="<?= base_url('/approval') ?>" class="hover:shadow-lg transition-shadow block">
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 20h10a2 2 0 002-2v-8a2 2 0 00-2-2h-4a2 2 0 00-2-2V4a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2h4a2 2 0 002 2v6a2 2 0 00-2 2z" />
                    </svg>
                    <span class="text-lg font-semibold">Approval Management</span>
                </div>
                <p class="mt-2 text-gray-600">Simplify the approval process</p>
            </div>
        </a>
    </div>
</div>

</body>
</html>
