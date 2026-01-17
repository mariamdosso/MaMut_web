<div class="card-header cursor-pointer">
    <div class="card-title m-0">
        <h3 class="fw-bold m-0">Informations de la caisse</h3>
    </div>
</div>

<div class="card-body p-9">

    <?php if (empty($eventFund)) : ?>
        <div class="alert alert-warning">
            Aucune caisse n’est encore associée à cet événement.
        </div>
    <?php else : ?>

        <div class="row mb-7">
            <label class="col-lg-4 fw-semibold text-muted">Code de la caisse</label>
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">
                    <?= htmlspecialchars($eventFund['fund_code']) ?>
                </span>
            </div>
        </div>

        <div class="row mb-7">
            <label class="col-lg-4 fw-semibold text-muted">Libellé</label>
            <div class="col-lg-8">
                <span class="fw-semibold fs-6 text-gray-800">
                    <?= htmlspecialchars($eventFund['fund_label']) ?>
                </span>
            </div>
        </div>

        <?php
            $statusClass = match (strtoupper($eventFund['status_code'] ?? '')) {
                'OPEN'   => 'bg-success',
                'CLOSED' => 'bg-danger',
                'LOCKED' => 'bg-warning',
                default  => 'bg-secondary',
            };
        ?>


        <div class="row mb-7">
            <label class="col-lg-4 fw-semibold text-muted">Statut</label>
            <div class="col-lg-8">
                <span class="badge <?= $statusClass ?>">
                    <?= htmlspecialchars($eventFund['status_label'] ?? 'Inconnu') ?>
                </span>
            </div>
        </div>

        <div class="row mb-7">
            <label class="col-lg-4 fw-semibold text-muted">Solde actuel</label>
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">
                    <?= number_format($eventFund['balance'], 0, ',', ' ') ?> FR
                </span>
            </div>
        </div>

        <div class="row mb-7">
            <label class="col-lg-4 fw-semibold text-muted">Date de création</label>
            <div class="col-lg-8">
                <span class="fw-semibold fs-6 text-gray-800">
                    <?= $eventFund['fund_created_at'] ?>
                </span>
            </div>
        </div>

        <div class="row mb-7">
            <label class="col-lg-4 fw-semibold text-muted">Date d’attachement</label>
            <div class="col-lg-8">
                <span class="fw-semibold fs-6 text-gray-800">
                    <?= $eventFund['attached_at'] ?>
                </span>
            </div>
        </div>

    <?php endif; ?>

</div>
