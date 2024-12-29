<div class="container mt-5">
    <h2>Workflows</h2>
    <a href="<?= site_url('/workflows/create') ?>" class="btn btn-success mb-3">Create New Workflow</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workflows as $workflow): ?>
                <tr>
                    <td><?= esc($workflow['name']) ?></td>
                    <td><?= esc($workflow['description']) ?></td>
                    <td>
                        <a href="<?= site_url('/workflows/' . $workflow['id']) ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?= site_url('/workflows/edit/' . $workflow['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="<?= site_url('/workflows/delete/' . $workflow['id']) ?>" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
