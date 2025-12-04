<div class="container mt-5 w-100 edit-container" style="background-color: e4e4e7;">
    <h1 class="text-center mb-4">
        Bienvenue <?= $adherent["full_name"] ?? "Utilisateur" ?> 
    </h1>

    <div class="row g-4">
        <div class="col-12">
            <div class="row">

                <div class="col-md-6">
                    <div class="card shadow-sm border-0 rounded-4 member-card">
                        <div class="card-header card-header-custom" style="background-color: feebe7;">
                            <h5>Infos Personnelles</h5>
                        </div>
                        <div class="card-body" style="background-color: feebe7;">
                            <div class="text-center mb-3 " >
                                <ul class="list-unstyled small">
                                <li><strong>Utilisateur</strong> <?= $adherent["adherent_id"] ?? "N/A"; ?></li>
                                </ul>
                            </div>
                            <ul class="list-unstyled small">
                                <li><strong>Nom :</strong> <?= $adherent["full_name"] ?? "N/A"; ?></li>
                                <li><strong>Date d'adhésion :</strong> <?= $adherent["date_of_joining"] ?? "N/A"; ?></li>
                                <li><strong>Date de naissance :</strong> <?= $adherent["birth_date"] ?? "N/A"; ?></li>
                                <li><strong>Contact :</strong> <?= $adherent["call_number"] ?? "N/A"; ?></li>
                                <li><strong>Genre :</strong> <?= $adherent["gender"] ?? "N/A"; ?></li>
                                <li><strong>Ville :</strong> <?= $adherent["city"] ?? "N/A"; ?></li>
                                <li><strong>Commune ou département :</strong> <?= $adherent["municipality_department"] ?? "N/A"; ?></li>
                                <li><strong>Adresse :</strong> <?= $adherent["address"] ?? "N/A"; ?></li>
                            </ul>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="modifier?id=<?= $adherent['adherent_id'] ?>" 
                                   class="btn btn-login btn-sm">
                                    ✏️ Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm border-0 rounded-4 member-card">
                        <div class="card-header card-header-custom" style="background-color: feebe7;">
                            <h5>Infos du Compte</h5>
                        </div>
                        <div class="card-body"style="background-color: feebe7">
                            <ul class="list-unstyled small">
                                <li><strong>Login :</strong> <?= $user["login"] ?? "N/A"; ?></li>
                                <li><strong>Statut :</strong> <?= $user["status"] ?? "N/A"; ?></li>
                            </ul>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="modifier_compte?id=<?= $user['id'] ?>" 
                                   class="btn btn-login btn-sm">
                                    ✏️ Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
