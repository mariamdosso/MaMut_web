<?php
// // require_once("config/db.php");

// // Vérifie qu'on a bien reçu l'id de la caisse
// if (isset($_POST['fund_id'])) {
//     $fund_id = $_POST['fund_id'];

//     // On peut éventuellement récupérer des infos sur la caisse ici si besoin
//     $sql = "SELECT * FROM fund WHERE fund_id = ?";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$fund_id]);
//     $fund = $stmt->fetch(PDO::FETCH_ASSOC);
// } else {
//     echo "Aucune caisse sélectionnée.";
//     exit;
// }
// ?>

<!-- // <div class="card">
//     <div class="card-header">
//         <h4>Détails de la Caisse : <?= htmlspecialchars($fund['fund_name']) ?></h4>
//     </div>
//     <div class="card-body">
//         <ul class="nav nav-tabs" id="myTab" role="tablist">
//             <li class="nav-item" role="presentation">
//                 <button class="nav-link active" id="flux-tab" data-bs-toggle="tab" data-bs-target="#flux" type="button" role="tab">Flux</button>
//             </li>
//             <!-- Tu peux ajouter d'autres onglets ici -->
//         </ul>

<!-- //         <div class="tab-content mt-3">
//             <div class="tab-pane fade show active" id="flux" role="tabpanel" aria-labelledby="flux-tab">
//                 <!-- Contenu des flux chargé via AJAX -->
//                 <div id="zone-flux"></div>
//             </div>
//         </div>
//     </div>
// </div> 

<script>
// Quand la page est prête, charge les flux
// $(document).ready(function(){
//     $.ajax({
//         url: "list_flux_controller.php",
//         type: "POST",
//         data: { fund_id: <?= $fund_id ?> },
//         success: function(data){
//             $("#zone-flux").html(data);
//         }
//     });
// });
</script>
