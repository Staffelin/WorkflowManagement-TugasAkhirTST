<div class="container mt-5">
    <h2>Articles</h2>
    <a href="<?= site_url('/articles/create') ?>" class="btn btn-success mb-3">Create New Article</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= esc($article['title']) ?></td>
                    <td><?= esc($article['status']) ?></td>
                    <td>
                        <a href="<?= site_url('/articles/' . $article['id']) ?>" class="btn btn-info btn-sm">View</a>
                        <a href="<?= site_url('/articles/edit/' . $article['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="<?= site_url('/articles/delete/' . $article['id']) ?>" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
