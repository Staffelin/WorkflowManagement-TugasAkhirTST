<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Kanban Board</h1>

    <!-- Kanban Board -->
    <div class="grid grid-cols-4 gap-4">
        <?php
        // Define statuses for the columns
        $statuses = ['To Do', 'In Progress', 'In Evaluation', 'Finished'];
        foreach ($statuses as $status) {
        ?>
        <div class="bg-white rounded shadow p-4">
            <h2 class="font-bold text-lg mb-4 text-center"><?= $status ?></h2>
            <div id="<?= strtolower(str_replace(' ', '-', $status)) ?>" class="kanban-column min-h-[300px] bg-gray-50 rounded p-2">
                <?php
                // Loop through tasks and display only tasks with the current status
                foreach ($workflows as $workflow) {
                    if ($workflow['status'] === $status) {
                ?>
                <div class="kanban-task bg-blue-100 border border-blue-400 rounded p-2 mb-2 cursor-pointer" data-id="<?= $workflow['id'] ?>">
                    <h3 class="font-bold"><?= htmlspecialchars($workflow['name']) ?></h3>
                    <p class="text-sm text-gray-700"><?= htmlspecialchars($workflow['description']) ?></p>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

    <script>
        // Initialize Sortable for each Kanban column
        const statuses = <?= json_encode(array_map(fn($status) => strtolower(str_replace(' ', '-', $status)), $statuses)) ?>;
        statuses.forEach(status => {
            const column = document.getElementById(status);
            new Sortable(column, {
                group: 'kanban',
                animation: 150,
                onEnd: function (evt) {
                    const taskId = evt.item.getAttribute('data-id');
                    const newStatus = evt.to.id.replace('-', ' ');

                    // Update the task status in the backend
                    fetch(`/workflow/updateStatus/${taskId}`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ status: newStatus })
                    }).then(response => {
                        if (!response.ok) {
                            alert('Failed to update task status.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
