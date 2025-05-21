<<?php 
require("controller/fund_liste_controller.php");
?>
<div class="container mt-5 w-100">
    <h1 class="text-center mb-4">Gestion des caisses</h1>
    <a href="add_fund" class="btn btn-primary mb-3">Ajouter une caisse</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Date de création</th>
                <th>Montant total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php  
        if (isset($funds) && count($funds) > 0) {
            $i = 1;
            foreach($funds as $fund){
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($fund["fund_name"]); ?></td>
                <td><?= htmlspecialchars($fund["date_ceation_fund"]); ?></td>
                <td><?= htmlspecialchars($fund["tatal_amount_fund"]); ?> FCFA</td>
                <td>
                    <a href="modifier_fund?id=<?= $fund['fund_id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="remove_fund?id=<?= $fund['fund_id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    <button class="btn btn-info btn-sm voir-details" data-id="<?= $fund['fund_id'] ?>">Détails</button>
                </td>
            </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="5" class="text-center">Aucune caisse disponible.</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX pour charger les détails -->
<script>
// $(document).ready(function(){
//     $(".voir-details").click(function(){
//         console.log("Clic sur Détails !");
//         var fund_id = $(this).data("id");
//         console.log("ID de la caisse : " + fund_id);

//         $.ajax({
//             url: "detail_caisse.php",
//             type: "POST",
//             data: { fund_id: fund_id },
//             success: function(data){
//                 $("#detailsCaisse").html(data);
//             }
//         });
//     });
// });
</script> -->







