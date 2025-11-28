<div class="card-header cursor-pointer">
    <div class="card-title m-0">
        <h3 class="fw-bold m-0">Participants de l'événement</h3>
    </div>
    <form action="/MaMut_web/add_participant" method="POST">
        <input type="hidden" name="event_id" value="<?= $eventId ?>">

        <select name="user_id">
            <?php foreach ($allUsers as $u): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['full_name']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
    </form>
</div>
<div class="card-body p-9">
    <?php if (!empty($participants)): ?>
        <ul>
            <?php foreach ($participants as $p): ?>
                <div class="col-md-6 col-xxl-4">
                    <div class="card ">
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">
                            <a href="#" class="fs-4 text-gray-800 line_none text-hover-primary fw-bold mb-0"><?= $p["user_name"]; ?></a>
                            <div class="fw-semibold text-gray-500 mb-6"><?= $p["user_email"]; ?> - <?= $adherent["user_gender"]; ?></div>
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
                            <div class="d-flex flex-row justify-content-between">
                                <a href="details_adherent?id=<?= $p['user_id'] ?>" data-bs-toggle="tooltip"
                                    title="Voir les détails">
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">

                                        <span class="indicator-progress">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </button>
                                </a>
                                <a href="update_adherent?id=<?= $p['user_id'] ?>"
                                    data-bs-toggle="tooltip"
                                    title="Modifier cet adhérent">
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">


                                        <span class="indicator-progress">
                                            <i class="bi bi-pencil-square"></i>
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun participant trouvé.</p>
    <?php endif; ?>
</div>