<div class="page d-flex flex-row flex-column-fluid">
    <div class="wrapper d-flex flex-column flex-row-fluid">
        <div class="toolbar py-2" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class=" container-fluid  d-flex align-items-center">
            </div>
            <!--end::Container-->
        </div>
        <div class="content d-flex flex-column flex-column-fluid">
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Container-->
                <div id="kt_content_container" class=" container-xxl ">

                    <!--begin::Basic info-->
                    <div class="card mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold  m-0">Modifier un adhérent</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->

                        <!--begin::Content-->
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <!--begin::Form-->
                            <form method="POST" action="/MaMut_web/update_adherent_controller" id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                <!--begin::Card body-->
                                <input type="hidden" name="adherent_id" value="<?= $adherent['adherent_id'] ?>">
                                <div class="card-body border-top p-9">

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nom complet</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="text" name="full_name" class="form-control form-control-lg form-control-solid" placeholder="Max Tinker" value="<?= htmlspecialchars($adherent['full_name'] ?? '') ?>" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col--
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="example@gmail.com" value="<?= htmlspecialchars($adherent['email'] ?? '') ?>" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Contact</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="tel" name="call_number" class="form-control form-control-lg form-control-solid" placeholder="0710203546" value="<?= htmlspecialchars($adherent['call_number'] ?? '') ?>" required  pattern="^[0-9]{8,15}$" >
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Date de naissance</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="date" name="birth_date" class="form-control form-control-lg form-control-solid" placeholder="JJ/MM/YYYY" value="<?= htmlspecialchars($adherent['birth_date'] ?? '') ?>" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Date d'adhésion</span>


                                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span> </label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="date" name="date_of_joining" class="form-control form-control-lg form-control-solid" placeholder="Phone number"value="<?= htmlspecialchars($adherent['date_of_joining'] ?? '') ?>" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Genre</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                            <!--begin::Options-->
                                            <div class="d-flex align-items-center mt-3">
                                                <!--begin::Option-->
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-invalid">
                                                    <input class="form-check-input" name="gender" type="radio" value="homme" id="homme" data-gtm-form-interact-field-id="1"
                                                     <?= (isset($adherent['gender']) && $adherent['gender'] === 'homme') ? 'checked' : '' ?> required>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Homme
                                                    </span>
                                                </label>
                                                <!--end::Option-->

                                                <!--begin::Option-->
                                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <input class="form-check-input" name="gender" type="radio" id="femme" value="femme"
                                                    <?= (isset($adherent['gender']) && $adherent['gender'] === 'femme') ? 'checked' : '' ?> required>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Femme
                                                    </span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Ville</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="city" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="<?= htmlspecialchars($adherent['city'] ?? '') ?>">
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Département / Commune</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="municipality_department" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="<?= htmlspecialchars($adherent['municipality_department'] ?? '') ?>">
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Adresse</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="<?= htmlspecialchars($adherent['address'] ?? '') ?>" >
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="button" onclick="window.location.href='member_list'" class="btn btn-light btn-active-light-primary me-2">Annuler</button>
                                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>