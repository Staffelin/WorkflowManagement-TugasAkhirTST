<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Workflow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">
    <!-- Back to Workflow Board Button -->
    <div class="mb-6">
        <a href="/workflows" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded shadow hover:bg-blue-600">
            &#8592; Back to Workflow Board
        </a>
    </div>

    <!-- Create Workflow Form -->
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">Create New Workflow</h1>
        <form id="create-workflow-form">
            <div class="mb-4">
                <label for="name" class="block font-bold mb-2">Workflow Name:</label>
                <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block font-bold mb-2">Description:</label>
                <textarea id="description" name="description" class="w-full border rounded px-3 py-2" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label for="article" class="block font-bold mb-2">Select Article:</label>
                <select id="article" name="article_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select an Article --</option>
                    <?php foreach ($articles as $article): ?>
                        <option value="<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="user" class="block font-bold mb-2">Assign to User:</label>
                <select id="user" name="user_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select a User --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" id="create-button" class="w-full bg-green-500 text-white font-bold rounded px-3 py-2 hover:bg-green-600">
                Create Workflow
            </button>
        </form>
    </div>

    <script>
        document.getElementById('create-button').addEventListener('click', function () {
            const name = document.getElementById('name').value.trim();
            const description = document.getElementById('description').value.trim();
            const articleId = document.getElementById('article').value;
            const userId = document.getElementById('user').value;

            if (!name || !description || !articleId || !userId) {
                alert('Please fill in all fields.');
                return;
            }

            fetch('/workflow/store', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name: name,
                    description: description,
                    article_id: parseInt(articleId), // Ensure article_id is sent as an integer
                    user_id: parseInt(userId), // Ensure user_id is sent as an integer
                })
            })
            .then(async response => {
                if (!response.ok) {
                    const errorDetails = await response.json();
                    alert(`Failed to create workflow: ${errorDetails.message || 'Unknown error'}`);
                } else {
                    alert('Workflow created successfully!');
                    window.location.href = '/workflow'; // Redirect to Workflow Board
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    </script>
</body>
</html>
