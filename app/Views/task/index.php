<div class="container mt-5">
    <h2>Tasks</h2>
    <a href="<?= site_url('/tasks/create') ?>" class="btn btn-success mb-3">Create New Task</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= esc($task['name']) ?></td>
                    <td><?= esc($task['status']) ?></td>
                    <td><?= esc($task['priority']) ?></td>
                    <td>
                        <a href="<?= site_url('/tasks/' . $task['id']) ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?= site_url('/tasks/edit/' . $task['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="<?= site_url('/tasks/delete/' . $task['id']) ?>" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
