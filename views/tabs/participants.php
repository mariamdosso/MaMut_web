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
<div class="row g-6 mb-6 g-xl-9 mb-xl-9">
    <?php if (!empty($participants)): ?>
        <?php foreach ($participants as $p): ?>
            <div class="col-md-6 col-xxl-4">
                <div class="card ">
                    <div class="card-body d-flex flex-center flex-column py-9 px-5">
                        <a href="#" class="fs-4 text-gray-800 line_none text-hover-primary fw-bold mb-0"><?= $p["user_name"]; ?></a>
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
                        <div class="d-flex flex-row justify-content-between">
                            <a href="details_user_event?id=<?= $p['participant_id'] ?>" data-bs-toggle="tooltip"
                                title="Voir le détail">
                                <button class="btn btn-sm btn-light-primary btn-flex btn-center mx-2" data-kt-follow-btn="true">

                                    <span class="indicator-progress">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </button>
                            </a>
                            <form action="/MaMut_web/delete_participant" method="POST"
                                onsubmit="return confirm('Supprimer ce participant ?');">

                                <input type="hidden" name="participant_id" value="<?= $p['participant_id'] ?>">
                                <input type="hidden" name="event_id" value="<?= $eventId ?>">

                                <button class="btn btn-sm btn-light-danger btn-flex btn-center mx-2">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
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