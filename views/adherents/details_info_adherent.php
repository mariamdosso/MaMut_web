<div class="page d-flex flex-row flex-column-fluid">
    <div class="wrapper d-flex flex-column flex-row-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <div class="ccontainer-fluid mt-2">
                <div class="card mb-2 mb-xl-10">
                    <div class="card-body compact pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="me-7 mb-2">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="/assets/images/adherent-profile.jpg" alt="image">
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-3 fw-bold me-1"><?= $adherent['full_name'] ?></a>
                                            <a href="#"><i class="ki-duotone ki-verify fs-2 text-primary"><span class="path1"></span><span class="path2"></span></i></a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                               <span class="mx-2"> <i class="bi bi-geo-alt"></i></span><span><?= $adherent['municipality_department'] ?></span>
                                            </a>
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                               <span class="mx-2"><i class="bi bi-envelope-at-fill"></i></span><span><?= $adherent['email'] ?></span> 
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap flex-stack">
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <div class="d-flex flex-wrap">
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1"><?= $adherent['date_of_joining'] ?></div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Date d'adhésion</div>
                                            </div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">0</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Nombre de particaption</div>
                                            </div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-3 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1"><?= $adherent['call_number'] ?></div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Téléphone</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent  fw-bold">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="/metronic8/demo1/account/overview.html">
                                    Overview </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo1/account/settings.html">
                                    Settings </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo1/account/security.html">
                                    Security </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>