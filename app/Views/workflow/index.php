<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workflow Board</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
    <!-- Back to Dashboard and Create Workflow Buttons -->
    <div class="mb-6 flex justify-between">
        <a href="/dashboard" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded shadow hover:bg-blue-600">
            &#8592; Back to Dashboard
        </a>
        <a href="/workflow/create" class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-bold rounded shadow hover:bg-green-600">
            + Create New Workflow
        </a>
    </div>

    <!-- Kanban Board -->
    <h1 class="text-3xl font-bold text-center mb-6">Workflow Board</h1>
    <div class="grid grid-cols-4 gap-4">
        <?php
        $statuses = ['To Do', 'In Progress', 'In Evaluation', 'Finished'];
        foreach ($statuses as $status) {
        ?>
        <div class="bg-white rounded shadow p-4">
            <h2 class="font-bold text-lg mb-4 text-center"><?= $status ?></h2>
            <div id="<?= strtolower(str_replace(' ', '-', $status)) ?>" class="kanban-column min-h-[300px] bg-gray-50 rounded p-2">
                <?php
                foreach ($workflows as $workflow) {
                    if ($workflow['status'] === $status) {
                ?>
                <div class="kanban-task bg-blue-100 border border-blue-400 rounded p-2 mb-2 cursor-pointer relative" data-id="<?= $workflow['id'] ?>">
                    <!-- Task Content -->
                    <h3 class="font-bold"><?= htmlspecialchars($workflow['name']) ?></h3>
                    <p class="text-sm text-gray-700"><?= htmlspecialchars($workflow['description']) ?></p>

                    <!-- Meatballs Menu -->
                    <div class="absolute top-2 right-2">
                        <div class="relative">
                            <button class="meatballs-menu-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 3a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>
                            <div class="meatballs-menu hidden bg-white border rounded shadow-md text-sm z-10 absolute right-0 mt-1 w-32">
                                <button class="delete-task-btn w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100"
                                    data-id="<?= $workflow['id'] ?>">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Dropdown Form for Task Update -->
    <div class="max-w-xl mx-auto bg-white mt-8 p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Update Workflow Status</h2>
        <form id="workflow-form">
            <!-- Task Dropdown -->
            <div class="mb-4">
                <label for="task" class="block font-bold mb-2">Select Task:</label>
                <select id="task" name="task" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select a Task --</option>
                    <?php foreach ($workflows as $workflow): ?>
                        <option value="<?= $workflow['id'] ?>">
                            <?= htmlspecialchars($workflow['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-4">
                <label for="status" class="block font-bold mb-2">Select Status:</label>
                <select id="status" name="status" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select a Status --</option>
                    <?php
                    foreach ($statuses as $status):
                    ?>
                        <option value="<?= $status ?>"><?= $status ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Save Button -->
            <button type="button" id="save-button" class="w-full bg-blue-500 text-white font-bold rounded px-3 py-2 hover:bg-blue-600">
                Save
            </button>
        </form>
    </div>

    <script>
        // Toggle Meatballs Menu
        document.querySelectorAll('.meatballs-menu-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const menu = button.nextElementSibling;
                menu.classList.toggle('hidden');
            });
        });

        // Hide Meatballs Menu on Outside Click
        document.addEventListener('click', () => {
            document.querySelectorAll('.meatballs-menu').forEach(menu => menu.classList.add('hidden'));
        });

        // Delete Task
        document.querySelectorAll('.delete-task-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.stopPropagation();
                const taskId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this task?')) {
                    fetch(`/workflow/delete/${taskId}`, {
                        method: 'DELETE',
                    })
                    .then(async response => {
                        if (response.ok) {
                            alert('Task deleted successfully!');
                            window.location.reload(); // Reload the page to update the board
                        } else {
                            const error = await response.json();
                            alert(`Failed to delete task: ${error.message || 'Unknown error'}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
                }
            });
        });

        // Kanban Board Logic
        const statuses = <?= json_encode(array_map(fn($status) => strtolower(str_replace(' ', '-', $status)), $statuses)) ?>;
        statuses.forEach(status => {
            const column = document.getElementById(status);
            new Sortable(column, {
                group: 'kanban',
                animation: 150,
                onEnd: function (evt) {
                    const taskId = evt.item.getAttribute('data-id');
                    const newStatus = evt.to.id.replace('-', ' ');

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

        // Dropdown Form Logic
        document.getElementById('save-button').addEventListener('click', function () {
            const taskId = document.getElementById('task').value;
            const newStatus = document.getElementById('status').value;

            if (!taskId || !newStatus) {
                alert('Please select both a task and a status.');
                return;
            }

            fetch(`/workflow/updateStatus/${taskId}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ status: newStatus })
            })
            .then(async response => {
                if (!response.ok) {
                    const errorDetails = await response.json();
                    alert(`Failed to update status: ${errorDetails.message || 'Unknown error'}`);
                } else {
                    alert('Task status updated successfully!');
                    window.location.reload(); // Refresh the page
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
