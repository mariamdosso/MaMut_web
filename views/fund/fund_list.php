<div class="container-fluid list-bg mt-3 w-100">

    <h2 class="fw-bold link-primary-login mb-3">
        Fund Management
    </h2>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <a href="/MaMut_web/add_fund" class="btn login-button mb-3">
            ➕ Add Fund
        </a>
    </div>

    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
        <?php if (!empty($funds)) {
            foreach ($funds as $fund) { ?>
                <div class="col-md-6 col-xxl-4">
                    <div class="card">

                        <!-- Card Header -->
                        <div class="card-header border-0 pt-9 d-flex justify-content-between align-items-center">
                            <div class="symbol symbol-50px w-50px bg-light fw-bold d-flex align-items-center justify-content-center">
                                <?= htmlspecialchars($fund['code']) ?>
                            </div>

                            <!-- Status Badge Dropdown -->
                            <?php
                                $statusClass = match (strtoupper($fund['status_code'])) {
                                    'OPEN' => 'bg-success',
                                    'CLOSED' => 'bg-danger',
                                    'LOCKED' => 'bg-warning',
                                    default => 'bg-secondary'
                                };
                            ?>
                            <div class="dropdown">
                                <span class="badge <?= $statusClass ?> fw-bold px-4 py-2 dropdown-toggle"
                                      role="button" id="statusDropdown<?= $fund['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= htmlspecialchars($fund['status_label']) ?>
                                </span>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown<?= $fund['id'] ?>">
                                    <?php foreach ($statuses as $status) { ?>
                                        <?php if ($status['id'] !== $fund['fund_status_id']) { ?>
                                        <li>
                                            <form action="/MaMut_web/change_fund_status" method="POST" class="m-0">
                                                <input type="hidden" name="id" value="<?= $fund['id'] ?>">
                                                <input type="hidden" name="fund_status_id" value="<?= $status['id'] ?>">
                                                <button type="submit" class="dropdown-item">
                                                    <?= htmlspecialchars($status['label']) ?>
                                                </button>
                                            </form>
                                        </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">

                            <div class="fs-3 fw-bold text-gray-900">
                               <?= number_format($fund['balance'], 2) ?> F CFA
                            </div>

                            <div class="fs-6 text-gray-300 mb-3">
                               <?= htmlspecialchars($fund['label']) ?> - Créé le : <?= date('d/m/Y', strtotime($fund['created_at'])) ?>
                            </div>

                            <div class="d-flex flex-row justify-content-between mt-3">

                                <!-- View Modal Button -->
                                <button type="button" class="btn btn-sm btn-light-primary mx-2" 
                                        data-bs-toggle="modal" data-bs-target="#fundDetailsModal<?= $fund['id'] ?>">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                <!-- Edit Fund Button -->
                                <a href="/MaMut_web/edit_fund?id=<?= $fund['id'] ?>"
                                   data-bs-toggle="tooltip"
                                   title="Edit fund">
                                    <button class="btn btn-sm btn-light-primary mx-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </a>

                                 <!-- Manage Fund Button -->
                                <a href="/MaMut_web/fund_details?id=<?= $fund['id'] ?>"
                                class="btn btn-sm btn-primary mx-2"
                                title="Manage Fund">
                                    <i class="bi bi-gear-fill"></i> 
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fund Details Modal -->
                <div class="modal fade" id="fundDetailsModal<?= $fund['id'] ?>" tabindex="-1" aria-labelledby="fundDetailsLabel<?= $fund['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fundDetailsLabel<?= $fund['id'] ?>">
                                    Fund Details: <?= htmlspecialchars($fund['label']) ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Code:</strong> <?= htmlspecialchars($fund['code']) ?></p>
                                <p><strong>Label:</strong> <?= htmlspecialchars($fund['label']) ?></p>
                                <p><strong>Balance:</strong> FCFA<?= number_format($fund['balance'], 2) ?></p>
                                <p><strong>Status:</strong> 
                                    <span class="badge <?= $statusClass ?>">
                                        <?= htmlspecialchars($fund['status_label']) ?>
                                    </span>
                                </p>
                                <p><strong>Created At:</strong> <?= date('d/m/Y', strtotime($fund['created_at'])) ?></p>
                                <p><strong>Updated At:</strong> <?= date('d/m/Y', strtotime($fund['updated_at'])) ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

        <?php }
        } else { ?>
            <p class="text-muted">No funds available.</p>
        <?php } ?>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1) { ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>

</div>
