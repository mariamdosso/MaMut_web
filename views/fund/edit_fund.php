<div class="container-fluid mt-3 w-50">
    <h2 class="fw-bold mb-4">Edit Fund</h2>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="/MaMut_web/edit_fund_controller" method="POST">
        <input type="hidden" name="id" value="<?= $fund['id'] ?>">

        <div class="mb-3">
            <label for="label" class="form-label">Fund Label</label>
            <input type="text" class="form-control" id="label" name="label"
                   value="<?= htmlspecialchars($fund['label']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Current Status</label>
            <span class="badge 
                <?= $fund['status_code'] === 'OPEN' ? 'bg-success' : ($fund['status_code'] === 'CLOSED' ? 'bg-danger' : 'bg-secondary') ?>
                fw-bold px-3 py-2">
                <?= htmlspecialchars($fund['status_label']) ?>
            </span>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="/MaMut_web/fund_list" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
