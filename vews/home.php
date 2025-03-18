 
 <?php 
    require("controller/home_controller.php");
?>

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
                                    
                                    echo "Nombre de membres : " . $members['total']??0;
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
                                    
                                    echo "Nombre des evenements : " . $events['total']??0;
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
                                    
                                    echo "Nombre de caisses : " . $fund['total']??0;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                 
                <!-- <div class="mt-4">
                    <h4>Dernières Transactions</h4>
                    <table class="table table-striped">

                    <tbody>
            <?php  if (count($members)){ 
                foreach($members as $member){
                     ?>
                <tr>
                    <td> <?= $member["member_name"];?></td>
                    <td><?= $member["firstname_member"];?> </td>
                    <td><?= $member["date_birth_member"];?></td>
                    <td><?= $member["contact_member"];?></td>
                    <td><?= $member["gender_member"];?></td>
                    <td><?= $member["member_city"];?></td>
                    <td><?= $member["member_municipality"];?></td>
                    <td><?= $member["member_district"];?></td>
                    <td>
                    
                        <a href="modifier_membre.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete_membre.php?id=1" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
                <?php
                            }
                        }
                            ?>
            </tbody>
                        <thead>
                        <?php  if (count($events)){ 
                            foreach($events as $event){
                        ?>
                    <tr>
                    <td> <?= $event["event_label"];?></td>
                    <td><?= $event["event_type"];?> </td>
                    <td><?= $event["event_domaine"];?></td>
                    <td><?= $event["event_date_start"];?></td>
                    <td><?= $event["event_date_end"];?></td>
                    <td><?= $event["event_periodicity"];?></td>
                    <td><?= $event["event_contribution_amount"];?></td>
                    <td>
                    
                        <a href="modifier_membre.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_membre.php?id=1" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                        </tr>
                        <?php
                             }
                            }
                        ?>
                        </thead>
                        
                    </table>
                </div> -->
            </main>
        </div>
    </div>  
 

