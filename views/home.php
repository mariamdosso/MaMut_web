  <div class="container-fluid">
        <div class="row">
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tableau de Bord</h1>
                </div>
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Liste Membre</h5>
                                <p class="card-text">
                                    <?php 
                                    
                                    echo "Nombre de membres : " .  $totalMembers ?? 0;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Liste Evenement</h5>
                                <p class="card-text">
                                <?php 
                                    
                                    echo "Nombre des evenements : " . $totalEvents ?? 0;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Liste Caisse</h5>
                                <p class="card-text">
                                <?php 
                                    
                                    echo "Nombre de caisses : " . $totalFunds ?? 0;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>  
 

