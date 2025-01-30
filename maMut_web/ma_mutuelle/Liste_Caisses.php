<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Caisses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Gestion des Caisses</h1>
        <a href="ajouter_Caisse.php" class="btn btn-primary mb-3">Ajouter une Caisse</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Numero</th>
                    <th>nom</th>
                    <th>montant total</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>750</td>
                    <td>mariage</td>
                    <td>2oooooo</td>
                    <td>
                        <a href="modifier_membre.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_membre.php?id=1" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="creer_caisse.php" class="btn btn-success">Créer une Nouvelle Caisse</a>
    </div>
</body>
</html>
<?php require_once __DIR__ . "/config/db.php"; ?>




