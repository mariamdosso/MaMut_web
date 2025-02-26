<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <form method="POST" action="add_member.php">
            <!-- Première ligne -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="date_naissance" required>
                </div>
                <div class="col-md-6">
                    <label for="date_adhesion" class="form-label">Date d'adhesion :</label>
                    <input type="date" class="form-control" name="date_adhesion" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre :</label>
                    <input type="text" class="form-control" name="genre" required>
                </div>
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="ville" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="commune" class="form-label">Commune :</label>
                    <input type="text" class="form-control" name="commune" required>
                </div>
                <div class="col-md-6">
                    <label for="quartier" class="form-label">Quartier :</label>
                    <input type="text" class="form-control" name="quartier" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="contact" class="form-label">Contact :</label>
                    <input type="text" class="form-control" name="contact" required>
                </div>
                <div class="col-md-6">
                    <label for="profession" class="form-label">Profession :</label>
                    <input type="text" class="form-control" name="profession" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role :</label>
                    <input type="text" class="form-control" name="role" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="col-md-6">
                    <label for="confirm_password" class="form-label">Confirmer le mot de passe :</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
