<?php
include(__DIR__ . '/../config/db.php');

$stmt = $pdo->query("SELECT id, label FROM event_type WHERE status = 1 ORDER BY label ASC");
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content d-flex flex-column flex-column-fluid">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class=" container-xxl ">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="/MaMut_web/add_event_controller" method="POST" data-gtm-form-interact-id="0">
                        <div class="mb-13 border-bottom ">
                            <h1 class="mb-3">Ajouter un nouveau évenement</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container mt-3">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Label de l'évenementt</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Specify a target name for future usage and reference" data-bs-original-title="Specify a target name for future usage and reference" data-kt-initialized="1">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span> </label>
                            <input type="text" class="form-control form-control-solid" placeholder="label" name="label" required>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container mt-3">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Montant de l'évenement</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Specify a target name for future usage and reference" data-bs-original-title="Specify a target name for future usage and reference" data-kt-initialized="1">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span> </label>
                            <input type="number" class="form-control form-control-solid" placeholder="Montant" name="event_amount" required>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Montant target évenement</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Specify a target name for future usage and reference" data-bs-original-title="Specify a target name for future usage and reference" data-kt-initialized="1">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span> </label>
                            <input type="number" class="form-control form-control-solid" placeholder="Montant cible" name="event_target_participation" required>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Date de début</label>
                                <div class="position-relative d-flex align-items-center">
                                    <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i> 
                                    <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Select a date" name="event_start_date" type="date" required>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Date de fin</label>
                                <div class="position-relative d-flex align-items-center">
                                    <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i> 
                                    <input class="form-control form-control-solid ps-12 flatpickr-input" placeholder="Select a date" name="event_end_date" type="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Is participation</label>
                            <div class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                <div class="d-flex align-items-center mt-3">
                                    <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-invalid">
                                        <input class="form-check-input" name="with_participation" type="radio" value="1" data-gtm-form-interact-field-id="1"
                                            required>
                                        <span class="fw-semibold ps-2 fs-6">
                                            Oui
                                        </span>
                                    </label>
                                    <label class="form-check form-check-custom form-check-inline form-check-solid">
                                        <input class="form-check-input" name="with_participation" type="radio" value="0"
                                            required>
                                        <span class="fw-semibold ps-2 fs-6">
                                            Non
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Type évenement</label>
                            <div class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                <div class="d-flex align-items-center mt-3">
                                    <select name="event_type_id" class="form-select" required>
                                        <option value="">Sélectionner un type</option>
                                        <?php foreach ($types as $t): ?>
                                            <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['label']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-semibold mb-2">Description de l'évenement</label>

                            <textarea class="form-control form-control-solid" rows="3" name="description" placeholder="Description de l'événement"></textarea>
                        </div>

                        <div class="text-end">
                            <button type="reset"  onclick="window.location.href='event_list'" id="kt_modal_new_target_cancel" class="btn btn-light me-3">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-progress">
                                    Enregistrer
                                </span>
                            </button>
                        </div>
                    </form>
                    <div id="formResult"></div>
                </div>
            </div>
        </div>
    </div>
</div>