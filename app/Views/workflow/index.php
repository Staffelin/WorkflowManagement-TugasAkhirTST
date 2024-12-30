<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workflows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-8">

<div class="space-y-6">
    <a href="<?= base_url('/dashboard') ?>" 
       class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md">
        Back to Dashboard
    </a>

    <h1 class="text-3xl font-bold text-blue-800">Workflows</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($workflows as $workflow): ?>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold text-blue-800"><?= esc($workflow['name']) ?></h2>
                <p class="text-gray-600"><?= esc($workflow['description']) ?></p>
                <p class="text-sm text-gray-500 mt-4">Created At: <?= esc($workflow['created_at']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
