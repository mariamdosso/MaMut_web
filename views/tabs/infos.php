<div class="card-header cursor-pointer">
    <div class="card-title m-0">
        <h3 class="fw-bold m-0">Informations détaillées de l'évenement</h3>
    </div>
</div>
<div class="card-body p-9">
    <div class="row mb-7">
        <label class="col-lg-4 fw-semibold text-muted">Réference</label>
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800"><?= $event['event_ref'] ?></span>
        </div>
    </div>
    <div class="row mb-7">
        <label class="col-lg-4 fw-semibold text-muted">libelet</label>
        <div class="col-lg-8 fv-row">
            <span class="fw-semibold text-gray-800 fs-6"><?= $event['label'] ?></span>
        </div>
    </div>
    <div class="row mb-7">
        <label class="col-lg-4 fw-semibold text-muted">
            Date de début

            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> </span>
        </label>
        <div class="col-lg-8 d-flex align-items-center">
            <span class="fw-bold fs-6 text-gray-800 me-2"><?= $event['event_start_date'] ?></span>
        </div>
    </div>
    <div class="row mb-7">
        <label class="col-lg-4 fw-semibold text-muted">Date de début</label>
        <div class="col-lg-8">
            <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?= $event['event_end_date'] ?></a>
        </div>
    </div>
    <div class="row mb-7">
        <label class="col-lg-4 fw-semibold text-muted">Montant évenement</label>
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800"><?= $event['event_amount'] ?> FR</span>
        </div>
    </div>
    <div class="row mb-10">
        <label class="col-lg-4 fw-semibold text-muted">Target Montant</label>
        <div class="col-lg-8">
            <span class="fw-semibold fs-6 text-gray-800"><?= $event['event_target_participation'] ?> FR</span>
        </div>
    </div>
     <div class="row mb-7">
        <label class="col-lg-4 fw-semibold text-muted">
            Description
            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Country of origination" data-bs-original-title="Country of origination" data-kt-initialized="1">
                <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> </span>
        </label>
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800"><?= $event['description'] ?></span>
        </div>
    </div>
</div>