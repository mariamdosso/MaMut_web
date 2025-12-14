<div class="page d-flex flex-row flex-column-fluid">
    <div class="wrapper d-flex flex-column flex-row-fluid">
        <div class="toolbar py-2" id="kt_toolbar">
            <div id="kt_toolbar_container" class=" container-fluid  d-flex align-items-center">
            </div>
        </div>
        <div class="content d-flex flex-column flex-column-fluid">
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div id="kt_content_container" class=" container-xxl ">
                    <div class="card mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bold  m-0">Ajouter un nouveau adhérent</h3>
                            </div>
                        </div>
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <form method="POST" action="/MaMut_web/add_member_controller" id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                <div class="card-body border-top p-9">
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nom complet</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="text" name="full_name" class="form-control form-control-lg form-control-solid" placeholder="Ex : Jean Dupont" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Ex : jean.dupont@email.com" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Contact</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="tel" name="call_number" class="form-control form-control-lg form-control-solid" placeholder="Ex : +225 0702035467" required pattern="^[0-9]{8,15}$">
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Date de naissance</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="date" name="birth_date" class="form-control form-control-lg form-control-solid" placeholder="JJ/MM/YYYY" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Date d'adhésion</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span> </label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="date" name="date_of_joining" class="form-control form-control-lg form-control-solid" placeholder="JJ/MM/YYYY" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Genre</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                            <div class="d-flex align-items-center mt-3">
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-invalid">
                                                    <input class="form-check-input" name="gender" type="radio" value="homme" id="homme" data-gtm-form-interact-field-id="1"
                                                        required>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Homme
                                                    </span>
                                                </label>
                                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <input class="form-check-input" name="gender" type="radio" id="femme" value="femme"
                                                        required>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Femme
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-6">
                                       
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Ville</label>
                                       
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="city" class="form-control form-control-lg form-control-solid" placeholder="Entrez le nom de la ville">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Département / Commune</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="municipality_department" class="form-control form-control-lg form-control-solid" placeholder="Ex : Abobo, Cocody, Yopougon...">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Adresse</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Ex : Rue des Jardins, Immeuble XYZ, 3e étage">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="button" onclick="window.location.href='member_list'" class="btn btn-light btn-active-light-primary me-2">Annuler</button>
                                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Enregistrer</button>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>