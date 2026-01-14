<div class="container-fluid mt-4">

    <h2 class="fw-bold link-primary-login mb-4">
        Create a Fund
    </h2>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php } ?>

    <form method="POST" action="/MaMut_web/add_fund_controller" class="row g-4">

        <!-- Fund label -->
        <div class="col-md-6">
            <label class="form-label fw-semibold">
                Fund name
            </label>
            <input
                type="text"
                name="label"
                class="form-control"
                placeholder="e.g. Emergency Fund"
                required
            >
        </div>

        <!-- Info -->
        <div class="col-12">
            <div class="alert alert-light">
                <ul class="mb-0">
                    <li>Fund code is generated automatically</li>
                    <li>Initial balance is set to 0</li>
                    <li>Status is set to <strong>OPEN</strong></li>
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div class="col-12 d-flex gap-3 mt-4">
            <button type="submit" class="btn login-button">
                💾 Create fund
            </button>

            <a href="/MaMut_web/fund_list" class="btn btn-light">
                Cancel
            </a>
        </div>

    </form>

</div>
