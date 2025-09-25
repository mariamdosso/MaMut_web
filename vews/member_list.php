<?php 
require("controller/member_list_controller.php");
?>
<div class="container mt-5 w-100">
    <h1 class="text-center mb-4">Gestion des Membres</h1>
    <a href="add_member" class="btn btn-primary mb-4">➕ Ajouter un membre</a>

    <div class="row g-4">
        <?php if (count($members)) { 
            foreach ($members as $member) { ?>
            
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100 border-0 rounded-4 member-card">
                        <div class="text-center mt-3">
                            <img src="draw2.webp" class="rounded-circle img-fluid" alt="Photo Membre" style="width:100px;height:100px;object-fit:cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-center mb-3">
                                <?= $member["firstname_member"] . " " . $member["member_name"];?>
                            </h5>
                            
                            <ul class="list-unstyled small">
                                <li><strong>Nom :</strong> <?= $member["member_name"];?></li>
                                <li><strong>Prénom :</strong> <?= $member["firstname_member"];?></li>
                                <li><strong>Date de naissance :</strong> <?= $member["date_birth_member"];?></li>
                                <li><strong>Contact :</strong> <?= $member["contact_member"];?></li>
                                <li><strong>Genre :</strong> <?= $member["gender_member"];?></li>
                                <li><strong>Ville :</strong> <?= $member["member_city"];?></li>
                                <li><strong>Commune :</strong> <?= $member["member_municipality"];?></li>
                                <li><strong>Quartier :</strong> <?= $member["member_district"];?></li>
                            </ul>

                            <!-- Ajoute Font Awesome dans ton <head> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<div class="d-flex justify-content-center gap-2 mt-3">
    <!-- Bouton Modifier -->
    <a href="modifier?id=<?=$member['member_id']?>" 
       class="btn btn-warning btn-sm" 
       data-bs-toggle="tooltip" 
       data-bs-placement="top" 
       title="Modifier ce membre">
        ✏️
    </a>

    <!-- Bouton Supprimer -->
    <a href="remove_member?id=<?=$member['member_id']?>" 
       class="btn btn-danger btn-sm" 
       data-bs-toggle="tooltip" 
       data-bs-placement="top" 
       title="Supprimer ce membre">
        🗑️
    </a>

    <!-- Bouton Détails -->
    <button class="btn btn-info btn-sm btn-details" 
            data-id="<?=$member['member_id']?>"
            data-bs-toggle="tooltip" 
            data-bs-placement="top" 
            title="Voir les détails du membre">
        ℹ️
    </button>
</div>
<!-- Script Bootstrap pour activer les tooltips -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>

                        </div>
                    </div>
                </div>

        <?php } 
        } else { ?>
            <p class="text-center">Aucun membre trouvé.</p>
        <?php } ?>
    </div>
</div>

<!-- Style personnalisé -->
<style>
.member-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.member-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.member-card ul li {
    margin-bottom: 4px;
}
</style>
