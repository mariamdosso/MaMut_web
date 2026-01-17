<div class="card-header cursor-pointer">
    <div class="card-title m-0">
        <h3 class="fw-bold m-0">Participants de l'événement</h3>
    </div>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addParticipantModal">
            ➕ Ajouter un participant
        </button>
    </div>
</div>
<div class="row g-6 mb-6 g-xl-9 mb-xl-9">
    <?php if (!empty($participants)): ?>
        <?php foreach ($participants as $p): ?>
            <div class="col-md-6 col-xxl-4">
                <div class="card ">
                    <div class="card-body d-flex flex-center flex-column py-9 px-5">
                        <a href="#" class="fs-4 text-gray-800 line_none text-hover-primary fw-bold mb-0"><?= $p["user_name"]; ?></a>
                        <?php
                            $isPaid = ((int)$p['remaining_amount'] === 0);

                            $statusClass = $isPaid ? 'badge-light-success' : 'badge-light-warning';
                            $statusLabel = $isPaid ? 'Soldé' : 'En cours';
                            ?>
                        <span class="badge <?= $statusClass ?> mb-3">
                            <?= $statusLabel ?>
                        </span>
                        <div class="fw-semibold text-gray-500 mb-6"><?= $p["user_email"]; ?> - <?= $p["user_gender"]; ?></div>
                        <div class="d-flex flex-center flex-row mb-2 mt-3">
                            <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700"><?= $p["user_phone"]; ?></div>
                                <div class="fw-semibold text-gray-500">Phone</div>
                            </div>
                            <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700"><?= $p["user_city"]; ?></div>
                                <div class="fw-semibold text-gray-500">City</div>
                            </div>
                        </div>
                        <div class="d-flex flex-center flex-row mb-2 mt-3">
                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3 text-center">
                                    <div class="fs-6 fw-bold text-gray-700">
                                        <?= number_format($p['amount_due'], 0, ',', ' ') ?> FCFA
                                    </div>
                                    <div class="fw-semibold text-gray-500">À payer</div>
                                </div>

                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3 text-center">
                                    <div class="fs-6 fw-bold text-success">
                                        <?= number_format($p['amount_paid'], 0, ',', ' ') ?> FCFA
                                    </div>
                                    <div class="fw-semibold text-gray-500">Payé</div>
                                </div>

                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3 text-center">
                                    <div class="fs-6 fw-bold text-danger">
                                        <?= number_format($p['remaining_amount'], 0, ',', ' ') ?> FCFA
                                    </div>
                                    <div class="fw-semibold text-gray-500">Reste</div>
                                </div>
                            </div>
                        <div class="d-flex flex-row justify-content-center gap-2">

                            <!-- 👁️ Voir le détail -->
                            <a href="/MaMut_web/event/participant/details?id=<?= $p['id'] ?>"
                            class="btn btn-sm btn-light-primary"
                            data-bs-toggle="tooltip"
                            title="Voir le détail">
                                <i class="bi bi-eye-fill"></i>
                            </a>

                            <!-- ✏️ Modifier la participation -->
                            <a href="/MaMut_web/event/show_edit_participant_form?id=<?= $p['id'] ?>"
                            class="btn btn-sm btn-light-warning"
                            data-bs-toggle="tooltip"
                            title="Modifier les montants">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <!-- 💰 Ajouter un paiement (désactivé si soldé) -->
                           <?php if ($p['remaining_amount'] > 0): ?>
                                <button
                                    class="btn btn-sm btn-light-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#paymentModal"
                                    data-id="<?= $p['id'] ?>"
                                    data-name="<?= htmlspecialchars($p['user_name']) ?>"
                                    data-remaining="<?= $p['remaining_amount'] ?>"
                                    data-amount-due="<?= $p['amount_due'] ?>"
                                    title="Ajouter un paiement">
                                    <i class="bi bi-cash-coin"></i>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-light-secondary" disabled>
                                    <i class="bi bi-check-circle-fill"></i>
                                </button>
                            <?php endif; ?>

                            <!-- 🗑️ Supprimer -->
                            <button
                                class="btn btn-sm btn-light-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteParticipantModal"
                                data-id="<?= $p['id'] ?>"
                                data-name="<?= htmlspecialchars($p['user_name']) ?>"
                                data-paid="<?= $p['amount_paid'] ?>"
                                title="Supprimer">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($totalPages > 1): ?>
            <div class="d-flex justify-content-center mt-5">
                <ul class="pagination">

                    <!-- Bouton précédent -->
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link"
                            href="?id=<?= $eventId ?>&page=<?= $page - 1 ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>

                    <!-- Pages -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link"
                                href="?id=<?= $eventId ?>&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- Bouton suivant -->
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link"
                            href="?id=<?= $eventId ?>&page=<?= $page + 1 ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>


    <?php else: ?>
        <p>Aucun participant trouvé.</p>
    <?php endif; ?>
</div>


<!-- Modal pour ajouter un participant à un événement -->
<div class="modal fade" id="addParticipantModal" tabindex="-1" aria-labelledby="addParticipantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/MaMut_web/event/add_participant" method="POST">
                <input type="hidden" name="event_id" value="<?= $eventId ?>">

                <div class="modal-header">
                    <h5 class="modal-title" id="addParticipantModalLabel">Ajouter un participant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                    <!-- Sélection de l'utilisateur -->
                    <div class="mb-3">
                        <label class="form-label">Adhérent</label>
                        <select name="user_id" class="form-select" required>
                            <?php foreach ($allUsers as $u): ?>
                                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['full_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Montant à payer si contribution par personne -->
                    <?php if ($event['contribution_type'] === 'per_person'): ?>
                        <div class="mb-3">
                            <label class="form-label">Montant à payer</label>
                            <input type="number" name="amount_due" class="form-control" min="0" required>
                        </div>
                    <?php else: ?>
                        <div class="mb-3">
                            <label class="form-label">Montant à payer</label>
                            <input type="number" class="form-control" value="<?= number_format($event['event_amount'], 0, ',', '') ?>" readonly>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour effectuer un paiement d'un participant -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="/MaMut_web/event/participant/update" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="paymentParticipantId">
                    <input type="hidden" name="event_id" value="<?= $eventId ?>">
                    <input type="hidden" name="amount_due" id="paymentAmountDue">

                    <div class="mb-3">
                        <label class="form-label">Montant restant</label>
                        <input type="text" id="paymentRemaining" class="form-control" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Montant à payer</label>
                        <input type="number" name="amount_paid" id="paymentAmount"
                               class="form-control" min="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Enregistrer le paiement
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal : confirmation de suppression d'un participant -->
<div class="modal fade" id="deleteParticipantModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    Confirmation de suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p id="deleteMessage"></p>
                <div id="deleteWarning" class="alert alert-warning d-none">
                    ⚠️ Cet adhérent a déjà effectué un paiement.
                    La suppression est interdite.
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">
                    Annuler
                </button>

                <form action="/MaMut_web/event/participant/delete" method="POST">
                    <input type="hidden" name="participant_id" id="deleteParticipantId">
                    <input type="hidden" name="event_id" value="<?= $eventId ?>">

                    <button type="submit" id="deleteConfirmBtn" class="btn btn-danger">
                        Supprimer
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    /* 💰 Paiement */
    document.getElementById('paymentModal').addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;

        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const remaining = btn.dataset.remaining;
        const amountDue = btn.dataset.amountDue;

        document.getElementById('paymentModalTitle').textContent =
            'Paiement – ' + name;

        document.getElementById('paymentParticipantId').value = id;
        document.getElementById('paymentRemaining').value =
            new Intl.NumberFormat('fr-FR').format(remaining) + ' FCFA';

        document.getElementById('paymentAmount').max = remaining;
        document.getElementById('paymentAmountDue').value = amountDue;
    });

    /* 🗑️ Suppression */
    document.getElementById('deleteParticipantModal').addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;

        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const paid = parseInt(btn.dataset.paid);

        document.getElementById('deleteParticipantId').value = id;
        document.getElementById('deleteMessage').innerHTML =
            `Voulez-vous supprimer <strong>${name}</strong> ?`;

        const warning = document.getElementById('deleteWarning');
        const confirmBtn = document.getElementById('deleteConfirmBtn');

        if (paid > 0) {
            warning.classList.remove('d-none');
            confirmBtn.disabled = true;
        } else {
            warning.classList.add('d-none');
            confirmBtn.disabled = false;
        }
    });
</script>
