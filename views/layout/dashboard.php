<main class="d-flex flex-nowrap">
    <h1 class="visually-hidden">Dashboard</h1>
    
    <?php require_once __DIR__ . '/sidebar.php'; ?>
    
    <section class="flex-grow-1 p-4">
        <?= $content ?? '' ?>
    </section>
</main>