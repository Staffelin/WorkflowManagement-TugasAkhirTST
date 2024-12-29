<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-8">

<div class="space-y-6">
    <a href="<?= base_url('/dashboard') ?>" 
       class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Dashboard
    </a>

    <h1 class="text-3xl font-bold text-blue-800">Article Management</h1>
    
    <!-- New Article Button -->
    <a href="<?= base_url('/articles/new') ?>" 
       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        New Article
    </a>

        <!-- Articles Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Title</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Author</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Example articles data
                    $articles = [
                        ['id' => 1, 'title' => 'Breaking News: New Discovery', 'author' => 'John Doe', 'status' => 'Draft'],
                        ['id' => 2, 'title' => 'Tech Giants Announce Merger', 'author' => 'Jane Smith', 'status' => 'In Review'],
                        ['id' => 3, 'title' => 'Climate Change: New Study Released', 'author' => 'Bob Johnson', 'status' => 'Published'],
                    ];
                    foreach ($articles as $article): 
                    ?>
                        <tr class="border-t border-gray-300 hover:bg-gray-50">
                            <td class="py-3 px-6"><?= esc($article['title']) ?></td>
                            <td class="py-3 px-6"><?= esc($article['author']) ?></td>
                            <td class="py-3 px-6"><?= esc($article['status']) ?></td>
                            <td class="py-3 px-6">
                                <a href="<?= base_url('/articles/edit/' . $article['id']) ?>" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17.5V21h-3.5l8.5-8.5 3.5 3.5-8.5 8.5H11z" />
                                    </svg>
                                </a>
                                <a href="<?= base_url('/articles/delete/' . $article['id']) ?>" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-7 7-7-7" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
