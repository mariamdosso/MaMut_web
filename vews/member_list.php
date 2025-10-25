<?php
require("controller/member_list_controller.php");
?>

<div class="container list-bg mt-5 w-100">
    <h2 class="fw-bold text-primary mb-3 mb-md-0">👥 Gestion des Membres</h2>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <!-- Bouton d’ajout -->
        <a href="add_member" class="btn btn-primary mb-2">➕ Ajouter un membre</a>

        <!-- Formulaire de recherche -->
        <form method="GET" action="" class="d-flex align-items-center mb-2" style="max-width: 480px; width: 100%;">
            <div class="input-group">
                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="🔍 Rechercher par nom, email, ville ou genre..."
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    style="min-width: 250px;">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>

    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
        <?php if (count($adherents)) {
            foreach ($adherents as $adherent) { ?>

                <div class="col-md-6 col-xxl-4">
                    <div class="card ">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-65px symbol-circle mb-5 position-relative">
                                <span class="symbol-label fs-2x fw-semibold text-warning bg-light-warning">
                                    <?php if (!empty($adherent["photo"])) { ?>
                                        <img src="<?= $adherent["photo"]; ?>"
                                            alt="Photo de <?= $adherent["full_name"]; ?>"
                                            class="img-fluid rounded-circle"
                                            style="width:65px; height:65px; object-fit:cover;">
                                    <?php } else { ?>
                                        <?= strtoupper(substr($adherent["full_name"], 0, 1)); ?>
                                    <?php } ?>

                                </span>
                                <div class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3"></div>
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Name-->
                            <a href="#" class="fs-4 text-gray-800 line_none text-hover-primary fw-bold mb-0"><?= $adherent["full_name"]; ?></a>
                            <!--end::Name-->

                            <!--begin::Position-->
                            <div class="fw-semibold text-gray-500 mb-6"><?= $adherent["city"]; ?> - <?= $adherent["gender"]; ?></div>
                            <!--end::Position-->

                            <!--begin::Info-->
                            <div class="d-flex flex-center flex-row mb-2 mt-3">
                                <!--begin::Stats-->
                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3">
                                    <div class="fs-6 fw-bold text-gray-700"><?= $adherent["birth_date"]; ?></div>
                                    <div class="fw-semibold text-gray-500">Naissance</div>
                                </div>
                                <!--end::Stats-->

                                <!--begin::Stats-->
                                <div class="border border-dashed rounded min-w-90px py-3 px-2 mx-2 mb-3">
                                    <div class="fs-6 fw-bold text-gray-700"><?= $adherent["call_number"]; ?></div>
                                    <div class="fw-semibold text-gray-500">Contact</div>
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->

                            <div class="d-flex flex-row justify-content-between">
                                <a href="details_adherent?id=<?= $adherent['adherent_id'] ?>" data-bs-toggle="tooltip"
                                    title="Voir les détails">
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">

                                        <span class="indicator-progress">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </button>
                                </a>
                                <a href="update_adherent?id=<?= $adherent['adherent_id'] ?>"
                                    data-bs-toggle="tooltip"
                                    title="Modifier cet adhérent">
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">


                                        <span class="indicator-progress">
                                            <i class="bi bi-pencil-square"></i>
                                        </span>
                                    </button>
                                </a>

                                <?php if (empty($adherent['has_account_id'])): ?>
                                    <a href="create_account?id=<?= $adherent['adherent_id'] ?>"
                                        data-bs-toggle="tooltip"
                                        title="Créer un compte pour cet adhérent">
                                        <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">

                                            <span class="indicator-progress">
                                                <i class="bi bi-person-fill-add"></i>
                                            </span>
                                        </button>
                                    </a>

                                <?php endif; ?>
                                <?php if (!empty($adherent['has_account_id'])): ?>
                                    <?php if ($adherent["user_status"] == "active") { ?>
                                        <a href="/MaMut_web/toggle_status?id=<?= $adherent['has_account_id'] ?>&user_status=inactive"
                                            data-bs-toggle="tooltip"
                                            title="Désactiver l'utilisateur">
                                            <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2 " tooltip="test" data-kt-follow-btn="true">
                                                <span class="indicator-progress">
                                                    <i class="bi bi-unlock-fill"></i>
                                                </span>
                                            </button>
                                        </a>
                                    <?php } else {  ?>
                                        <a href="/MaMut_web/toggle_status?id=<?= $adherent['has_account_id'] ?>&user_status=active"
                                            data-bs-toggle="tooltip"
                                            title="Activer l'utilisateur">
                                            <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2 " tooltip="test" data-kt-follow-btn="true">


                                                <span class="indicator-progress">
                                                    <i class="bi bi-lock-fill"></i>
                                                </span>
                                            </button>
                                        </a>

                                    <?php
                                    }
                                    ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <!--begin::Card body-->
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