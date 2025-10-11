<?php
require("controller/member_list_controller.php");
?>

<div class="container mt-5 w-100">
    <h2 class=" mb-4">Gestion des Membres</h2>
    <a href="add_member" class="btn btn-primary mb-4">➕ Ajouter un membre</a>

    <div class="row g-4">
        <?php if (count($adherents)) {
            foreach ($adherents as $adherent) { ?>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100 border-0 rounded-4 text-center py-5 px-3">

                        <div class="symbol symbol-65px symbol-circle mb-4 mx-auto">
                            <?php if (!empty($adherent["photo"])) { ?>
                                <img src="<?= $adherent["photo"]; ?>"
                                    alt="Photo de <?= $adherent["full_name"]; ?>"
                                    class="img-fluid rounded-circle"
                                    style="width:65px; height:65px; object-fit:cover;">
                            <?php } else { ?>
                                <span class="symbol-label fs-2x fw-semibold text-primary bg-light-primary">
                                    <?= strtoupper(substr($adherent["full_name"], 0, 1)); ?>
                                </span>
                            <?php } ?>
                        </div>

                        <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold mb-1">
                            <?= $adherent["full_name"]; ?>
                        </a>

                        <div class="fw-semibold text-gray-500 small mb-4">
                            <?= $adherent["city"]; ?> - <?= $adherent["gender"]; ?>
                        </div>

                        <ul class="list-unstyled small text-start">
                            <li><strong>Date de naissance :</strong> <?= $adherent["birth_date"]; ?></li>
                            <li><strong>Contact :</strong> <?= $adherent["call_number"]; ?></li>
                            <li><strong>Créé par :</strong> <?= $adherent["created_by_login"]; ?></li>
                        </ul>

                        <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                            <a href="details_adherent?id=<?= $adherent['adherent_id'] ?>"
                                class="btn btn-sm btn-info"
                                data-bs-toggle="tooltip"
                                title="Voir les détails">
                                👁️
                            </a>

                            <a href="update_adherent?id=<?= $adherent['adherent_id'] ?>"
                                class="btn btn-sm btn-warning"
                                data-bs-toggle="tooltip"
                                title="Modifier cet adhérent">
                                ✏️
                            </a>

                            <?php if (empty($adherent['has_account_id'])): ?>
                                <a href="create_account?id=<?= $adherent['adherent_id'] ?>"
                                    class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip"
                                    title="Créer un compte pour cet adhérent">
                                    👤
                                   
                                </a>
                            <?php endif; ?>


                            <?php if (!empty($adherent['has_account_id'])): ?>
                                <?php if ($adherent["user_status"] == "active") { ?>
                                    <a href="/MaMut_web/toggle_status?id=<?= $adherent['has_account_id'] ?>&user_status=inactive"
                                        class="btn btn-sm btn-success"
                                        data-bs-toggle="tooltip"
                                        title="Désactiver l'utilisateur">
                                        ✅
                                    </a>
                                <?php } else { ?>
                                    <a href="/MaMut_web/toggle_status?id=<?= $adherent['has_account_id'] ?>&user_status=active"
                                        class="btn btn-sm btn-secondary"
                                        data-bs-toggle="tooltip"
                                        title="Activer l'utilisateur">
                                        ⛔
                                    </a>
                                <?php } ?>
                            <?php else: ?>
                                <span class="badge bg-warning">Pas de compte</span>
                            <?php endif; ?>
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


<style>
    .member-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .member-card ul li {
        margin-bottom: 4px;
    }
</style>