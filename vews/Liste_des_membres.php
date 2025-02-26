<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Membres</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Gestion des Membres</h1>
        <a href="ajouter_membre.php" class="btn btn-primary mb-3">Ajouter un membre</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Date d'adhésion</th>
                    <th>genre</th>
                    <th>ville</th>
                    <th>commune</th>
                    <th>quartier</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td>1</td>
                    <td>Dupont</td>
                    <td>Jean</td>
                    <td>2025-01-01</td>g
                    <td>2025-01-01</td>
                    <td>feminin</td>
                    <td>abidjan</td>
                    <td>yopougon</td>
                    <td>gesco</td>
                    <td>
                        <a href="modifier_membre.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_membre.php?id=1" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
