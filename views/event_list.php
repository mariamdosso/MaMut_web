
<div class="container list-bg mt-5 w-100">
    <h2 class="fw-bold text-primary mb-3 mb-md-0">👥 Gestion des évenements</h2>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <a href="/MaMut_web/add_event" class="btn btn-primary mb-3"> ➕ Ajouter un événement</a>
    </div>

    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
        <?php if (count($events)) {
            foreach ($events as $event) { ?>

                <div class="col-md-6 col-xxl-4">
                    <div class="card ">
                        <div class="card-header border-0 pt-9">
                            <div class="card-title m-0">
                                <div class="symbol symbol-50px w-50px bg-light">
                                    <?= $event["event_ref"]; ?>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <span class="badge badge-light-primary fw-bold me-auto px-4 py-3 "><?= $event["with_participation"]? "Oui" : "Non"; ?></span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">

                            <div class="fs-3 fw-bold text-gray-900"><?= $event["label"]; ?></div>
                            <a href="#" class="fs-4 text-gray-800 line_none text-hover-primary fw-bold mb-0">$<?= $event["event_amount"]; ?></a>
                            <div class="d-flex flex-center flex-row mb-2 mt-3">
                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3">
                                    <div class="fs-6 fw-bold text-gray-700"><?= $event["event_start_date"]; ?></div>
                                    <div class="fw-semibold text-gray-500">Date de début</div>
                                </div>
                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3">
                                    <div class="fs-6 fw-bold text-gray-700"><?= $event["event_end_date"]; ?></div>
                                    <div class="fw-semibold text-gray-500">Date de fin</div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <a href="event_details?id=<?= $event['id'] ?>" data-bs-toggle="tooltip"
                                    title="Voir les détails">
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">
                                        <span class="indicator-progress">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </button>
                                </a>
                                <a href="edit_event?id=<?= $event['id'] ?>"
                                    data-bs-toggle="tooltip"
                                    title="Modifier cet adhérent">
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">
                                        <span class="indicator-progress">
                                            <i class="bi bi-pencil-square"></i>
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>

    <?php if ($totalPages > 1) { ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>

</div>