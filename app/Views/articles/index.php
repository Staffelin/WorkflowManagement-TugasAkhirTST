<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-8">

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <!-- Back to Dashboard Button -->
        <a href="<?= base_url('/dashboard') ?>" 
           class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md">
            Back to Dashboard
        </a>

        <!-- Create New Article Button -->
        <a href="<?= base_url('/articles/new') ?>" 
           class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
            Create New Article
        </a>
    </div>

    <h1 class="text-3xl font-bold text-blue-800">Articles</h1>

    <table class="min-w-full bg-white rounded-lg shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-3 px-6 text-left">Title</th>
                <th class="py-3 px-6 text-left">Author</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr class="border-t">
                    <td class="py-3 px-6"><?= esc($article['title']) ?></td>
                    <td class="py-3 px-6"><?= esc($article['author_id']) ?></td>
                    <td class="py-3 px-6"><?= esc($article['status']) ?></td>
                    <td class="py-3 px-6"><?= esc($article['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
