<div class="page d-flex flex-row flex-column-fluid">
    <div class="wrapper d-flex flex-column flex-row-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <div class="container-fluid mt-2">

                <!-- Fund Header Card -->
                <div class="card mb-2 mb-xl-10">
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-gray-900 text-hover-primary fs-3 fw-bold me-1"><?= htmlspecialchars($fund['code']) ?></span>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-2 pe-2">
                                        <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                            <i class="bi bi-tag me-2"></i>
                                            <?= htmlspecialchars($fund['label']) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">

                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-check fs-3 text-success me-2"></i>
                                                <div class="fs-3 fw-bold"><?= date('d/m/Y', strtotime($fund['created_at'])) ?></div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-500">Created At</div>
                                        </div>

                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-wallet2 fs-3 text-primary me-2"></i>
                                                <div class="fs-3 fw-bold">$<?= number_format($fund['balance'], 2) ?></div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-500">Balance</div>
                                        </div>

                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-sliders fs-3 text-warning me-2"></i>
                                                <div class="fs-3 fw-bold"><?= htmlspecialchars($fund['status_label']) ?></div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-500">Status</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fw-bold mt-4" id="fundTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" data-bs-target="#tab-infos" role="tab">
                                Fund Info
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-bs-target="#tab-participants" role="tab">
                                Participants
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-bs-target="#tab-payment" role="tab">
                                Payments
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="tab-infos" role="tabpanel">
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-body p-9">
                                <?php include __DIR__ . '/tabs/fund_infos.php'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-participants" role="tabpanel">
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-body p-9">
                                <?php include __DIR__ . '/tabs/fund_participants.php'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-payment" role="tabpanel">
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-body p-9">
                                <?php include __DIR__ . '/tabs/fund_payments.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
