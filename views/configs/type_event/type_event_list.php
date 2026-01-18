<div class="container-fluid list-bg mt-3 w-100">

    <h2 class="fw-bold link-primary-login mb-3">
        Gestion des types d'évenements
    </h2>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <button class="btn login-button mb-3"
                data-bs-toggle="modal"
                data-bs-target="#addEventTypeModal">
            ➕ Ajouter un type événement
        </button>
    </div>

    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
        <?php if (!empty($types)) {
            foreach ($types as $type) { ?>
                <div class="col-md-6 col-xxl-4">
                    <div class="card">

                        <!-- Card Header -->
                        <div class="card-header border-0 pt-9 d-flex justify-content-between align-items-center">
                            <div class="symbol symbol-50px w-50px bg-light fw-bold d-flex align-items-center justify-content-center">
                                <?= htmlspecialchars($type['code']) ?>
                            </div>

                            <!-- Status Badge Dropdown -->
                            <?php
                                $statusClass = $type['status'] == 1 ? 'bg-success' : 'bg-danger';
                                $statusLabel = $type['status'] == 1 ? 'Active' : 'Inactive';
                            ?>
                            <div class="dropdown">
                                <span class="badge <?= $statusClass ?> fw-bold px-4 py-2 dropdown-toggle"
                                      role="button" id="statusDropdown<?= $type['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $statusLabel ?>
                                </span>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown<?= $type['id'] ?>">
                                    <?php if ($type['status'] == 0): ?>
                                        <li>
                                            <button class="dropdown-item text-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmStatusModal"
                                                    data-action="activate"
                                                    data-id="<?= $type['id'] ?>"
                                                    data-label="<?= htmlspecialchars($type['label']) ?>">
                                                    <i class="bi bi-check-circle"></i>
                                                Activer
                                            </button>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <button class="dropdown-item text-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmStatusModal"
                                                    data-action="deactivate"
                                                    data-id="<?= $type['id'] ?>"
                                                    data-label="<?= htmlspecialchars($type['label']) ?>">
                                                    <i class="bi bi-slash-circle"></i>
                                                Désactiver
                                            </button>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">

                            <div class="fs-3 fw-bold text-gray-900">
                               <?= htmlspecialchars($type['label']) ?>
                            </div>

                            <div class="fs-6 text-gray-300 mb-3">
                               Créé le : <?= date('d/m/Y', strtotime($type['created_at'])) ?>
                            </div>

                            <div class="d-flex flex-row justify-content-between mt-3">

                                <!-- Edit Button -->
                                    <button class="btn btn-sm btn-light-primary mx-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editEventTypeModal<?= $type['id'] ?>">
                                       <i class="bi bi-pencil-square"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editEventTypeModal<?= $type['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form action="/MaMut_web/update_event_type" method="POST">

                            <input type="hidden" name="id" value="<?= $type['id'] ?>">

                            <div class="modal-header">
                                <h5 class="modal-title">Modifier le type d'événement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Libellé du type</label>
                                    <input type="text"
                                        name="label"
                                        class="form-control"
                                        value="<?= htmlspecialchars($type['label']) ?>"
                                        required>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-light"
                                        data-bs-dismiss="modal">
                                    Annuler
                                </button>

                                <button type="submit"
                                        class="btn btn-primary">
                                    Mettre à jour
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


        <?php }
        } else { ?>
            <p class="text-muted">No event types available.</p>
        <?php } ?>
    </div>
</div>
<?php if ($totalPages > 1): ?>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-4">

        <!-- Previous -->
        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link"
               href="?page=<?= $page - 1 ?>">
                &laquo;
            </a>
        </li>

        <!-- Pages -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                <a class="page-link"
                   href="?page=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
            <a class="page-link"
               href="?page=<?= $page + 1 ?>">
                &raquo;
            </a>
        </li>

    </ul>
</nav>
<?php endif; ?>

 <!-- Modal d'ajout d'un type d'évenement -->
<div class="modal fade" id="addEventTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="/MaMut_web/store_event_type" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un type d'événement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Libellé du type</label>
                        <input type="text"
                               name="label"
                               class="form-control"
                               placeholder="Ex : Réunion, Formation..."
                               required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal pour activer et désactiver un type d'évenement -->
<div class="modal fade" id="confirmStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="confirmStatusForm" method="GET">

                <input type="hidden" name="id" id="confirmItemId">

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalTitle">
                        Confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p id="confirmModalMessage" class="mb-0"></p>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <button type="submit"
                            class="btn btn-danger"
                            id="confirmModalButton">
                        Confirmer
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('confirmStatusModal');
    const form = document.getElementById('confirmStatusForm');
    const idInput = document.getElementById('confirmItemId');
    const message = document.getElementById('confirmModalMessage');
    const button = document.getElementById('confirmModalButton');

    modal.addEventListener('show.bs.modal', function (event) {

        const buttonClicked = event.relatedTarget;
        const action = buttonClicked.getAttribute('data-action');
        const id = buttonClicked.getAttribute('data-id');
        const label = buttonClicked.getAttribute('data-label');

        idInput.value = id;

        if (action === 'activate') {
            form.action = '/MaMut_web/activate_event_type';
            message.innerHTML = `Voulez-vous vraiment <strong>activer</strong> le type d’événement <strong>${label}</strong> ?`;
            button.className = 'btn btn-success';
            button.textContent = 'Activer';
        } else {
            form.action = '/MaMut_web/deactivate_event_type';
            message.innerHTML = `Voulez-vous vraiment <strong>désactiver</strong> le type d’événement <strong>${label}</strong> ?`;
            button.className = 'btn btn-danger';
            button.textContent = 'Désactiver';
        }
    });
});
</script>

