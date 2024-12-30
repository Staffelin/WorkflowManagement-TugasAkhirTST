<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-4">Add New Article</h1>

    <?php if (isset($validation)): ?>
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/articles/create') ?>" method="post">
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="<?= old('title') ?>"
                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                required
            />
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea
                name="content"
                id="content"
                rows="5"
                class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                required
            ><?= old('content') ?></textarea>
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg"
            >
                Save Article
            </button>
        </div>
    </form>
</div>

</body>
</html>
