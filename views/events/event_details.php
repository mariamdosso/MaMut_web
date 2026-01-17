<div class="page d-flex flex-row flex-column-fluid">
    <div class="wrapper d-flex flex-column flex-row-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <div class="container-fluid mt-2">
                <div class="card mb-2 mb-xl-10">
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-3 fw-bold me-1"><?= $event['event_ref'] ?></a>
                                            <a href="#"><i class="ki-duotone ki-verify fs-2 text-primary"><span class="path1"></span><span class="path2"></span></i></a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-2 pe-2">
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">

                                                <span class="path3 mx-2"><i class="bi bi-tag"></i> </span>
                                                <span><?= $event['label'] ?></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <?php if ($event['with_participation'] && empty($eventFund)) : ?>

                                            <button
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#attachFundModal">
                                                ➕ Ajouter une caisse
                                            </button>

                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap flex-stack">
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <div class="d-flex flex-wrap">
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 ">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1"><?= $event['event_start_date'] ?></div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Date de debut</div>
                                            </div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 ">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1"><?= $event['event_end_date'] ?></div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Date de fin</div>
                                            </div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1"><?= $event['event_amount'] ?> FR</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Montant évenement</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fw-bold" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" data-bs-target="#tab-infos" role="tab">
                                    Infos caisse </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 " data-bs-toggle="tab" data-bs-target="#tab-participants" role="tab">
                                    Participants </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 " data-bs-toggle="tab" data-bs-target="#tab-paiement" role="tab">
                                   Paiements</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="tab-infos" role="tabpanel">
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-body p-9">
                                <?php include __DIR__ . '/tabs/infos.php'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-participants" role="tabpanel">
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-body p-9">
                                <?php include __DIR__ . '/tabs/participants.php'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-paiement" role="tabpanel">
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-body p-9">
                                <?php include __DIR__ . '/tabs/payment.php'; ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="attachFundModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="/MaMut_web/event/attach_fund" class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une caisse à l'événement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Caisse</label>
                        <select name="fund_id" class="form-select" required>
                            <option value="">-- Sélectionner une caisse --</option>
                            <?php foreach ($attachableFunds as $fund): ?>
                                <option value="<?= $fund['id'] ?>">
                                    <?= htmlspecialchars($fund['label']) ?>
                                    (<?= number_format($fund['balance'], 0) ?> FR)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Associer
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
