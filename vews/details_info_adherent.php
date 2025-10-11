<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-sm border rounded">
                <div class="card-body p-4">
                    <h2 class="fw-bold" style="color:#FFD230;">Informations Détaillées</h2>
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-1">
                                <div class="d-flex flex-column">
                                    <h3 class="mb-2 text-dark fw-bold">
                                        <?= htmlspecialchars($adherent['full_name']); ?>
                                    </h3>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-3">
                                        <span class="d-flex align-items-center text-muted me-4 mb-2">
                                            <i class="ki-outline ki-profile-circle fs-5 me-2"></i>
                                            <?= htmlspecialchars($adherent['birth_date']); ?>
                                        </span>
                                        <span class="d-flex align-items-center text-muted me-4 mb-2">
                                            <i class="ki-outline ki-geolocation fs-5 me-2"></i>
                                            <?= htmlspecialchars($adherent['city']); ?>
                                        </span>
                                        <span class="d-flex align-items-center text-muted mb-2">
                                            <i class="ki-outline ki-sms fs-5 me-2"></i>
                                            <?= htmlspecialchars($adherent['email']); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex my-2">
                                    <a href="member_list" class="btn btn-sm" style="background-color:#FFD230; color:#000; font-weight:bold;">
                                        Retour à la liste des adhérents
                                    </a>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <div class="border border-dashed rounded p-3 h-100 text-center">
                                        <div class="fs-5 fw-bold mb-1">
                                            <?= htmlspecialchars($adherent['call_number'] ?? 'N/A'); ?>
                                        </div>
                                        <div class="text-muted small">Téléphone</div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="border border-dashed rounded p-3 h-100 text-center">
                                        <div class="fs-5 fw-bold mb-1">
                                            <?= htmlspecialchars($adherent['municipality_department'] ?? 'N/A'); ?>
                                        </div>
                                        <div class="text-muted small">Département/commune</div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="border border-dashed rounded p-3 h-100 text-center">
                                        <div class="fs-5 fw-bold mb-1">
                                            <?= htmlspecialchars($adherent['date_of_joining'] ?? 'N/A'); ?>
                                        </div>
                                        <div class="text-muted small">Date d'adhésion</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold mb-0">
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="#">
                                        Information Compte 
                                    </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">
                                        Cotisation
                                    </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">
                                        Evèvements
                                    </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">
                                        Payments
                                    </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">
                                        Billing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
