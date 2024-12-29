<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workflow Management</title>
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

    <h1 class="text-3xl font-bold text-blue-800">Workflow Management</h1>
    
    <!-- New Workflow Button -->
    <a href="<?= base_url('/workflow/new') ?>" 
       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        New Workflow
    </a>

    <!-- Workflow Cards -->
    <!-- Add your workflow card code here -->
</div>

</body>
</html>

    
    <!-- Workflow Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php 
        // Example workflows data
        $workflows = [
            ['id' => 1, 'name' => 'News Article', 'stages' => ['Draft', 'Review', 'Edit', 'Publish']],
            ['id' => 2, 'name' => 'Feature Story', 'stages' => ['Research', 'Draft', 'Peer Review', 'Edit', 'Fact Check', 'Publish']],
            ['id' => 3, 'name' => 'Opinion Piece', 'stages' => ['Draft', 'Editorial Review', 'Revisions', 'Publish']],
        ];
        foreach ($workflows as $workflow): 
        ?>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-800"><?= esc($workflow['name']) ?></h2>
                    <a href="<?= base_url('/workflow/edit/' . $workflow['id']) ?>" class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17.5V21h-3.5l8.5-8.5 3.5 3.5-8.5 8.5H11z" />
                        </svg>
                    </a>
                </div>
                <p class="text-gray-600 mb-4">Workflow Stages</p>
                <div class="flex flex-wrap items-center gap-2">
                    <?php foreach ($workflow['stages'] as $index => $stage): ?>
                        <div class="flex items-center">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded"><?= esc($stage) ?></span>
                            <?php if ($index < count($workflow['stages']) - 1): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
