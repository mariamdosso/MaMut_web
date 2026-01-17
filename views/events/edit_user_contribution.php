<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="fw-bold mb-0">Modifier la participation</h3>
        </div>

        <div class="card-body">
            <form action="/MaMut_web/event/participant/update" method="POST">

                <!-- Identifiants -->
                <input type="hidden" name="id" value="<?= $contribution['id'] ?>">
                <input type="hidden" name="event_id" value="<?= $eventId ?>">
                <input type="hidden" name="user_id" value="<?= $contribution['user_id'] ?>">

                <!-- 👤 Adhérent (lecture seule) -->
                <div class="mb-3">
                    <label class="form-label">Adhérent</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($contribution['user_name']) ?>"
                        disabled>
                </div>

                <!-- 💰 Montant dû -->
                <div class="mb-3">
                    <label class="form-label">Montant à payer</label>
                    <input
                        type="number"
                        name="amount_due"
                        class="form-control"
                        min="0"
                        value="<?= $contribution['amount_due'] ?>"
                        <?= $contribution['amount_paid'] > 0 ? 'readonly' : 'required' ?>>
                    <?php if ($contribution['amount_paid'] > 0): ?>
                        <small class="text-warning">
                            ⚠️ Impossible de modifier le montant dû car un paiement a déjà été effectué.
                        </small>
                    <?php endif; ?>
                </div>

                <!-- 💳 Montant payé -->
                <div class="mb-3">
                    <label class="form-label">Montant payé</label>
                    <input
                        type="number"
                        name="amount_paid"
                        class="form-control"
                        min="0"
                        max="<?= $contribution['amount_due'] ?>"
                        value="<?= $contribution['amount_paid'] ?>"
                        required>
                </div>

                <!-- 🔘 Actions -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/MaMut_web/event_details?id=<?= $eventId ?>"
                       class="btn btn-light">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Mettre à jour
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
