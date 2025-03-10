<form method="POST" action="controller/update_member_controller.php" class="mt-6">
<input type="hidden" name="id" value="5">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="name" value="ancien nom" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom" value="ancien prenom" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" name="date_naissance" value="17/03/2003" required>
                </div>
                <div class="col-md-6">
                    <label for="date_adhesion" class="form-label">Date d'adhesion :</label>
                    <input type="date" class="form-control" name="date_adhesion" value="11/24/2015" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre :</label>

                    <input type="radio"  name="genre" value="femme" value="ancien genre" required>
                    <label for="femme">femme </label>

                    <input type="radio"  name="genre" value="homme" value="ancien genre" required>
                    <label for="homme">Homme</label>
                </div>
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="ville" value="bouake" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="commune" class="form-label">Commune :</label>
                    <input type="text" class="form-control" name="commune" value="cocody" required>
                </div>
                <div class="col-md-6">
                    <label for="quartier" class="form-label">Quartier :</label>
                    <input type="text" class="form-control" name="quartier" value="chateaux" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="contact" class="form-label">Contact :</label>
                    <input type="text" class="form-control" name="contact" value="0101030496" required>
                </div>
                <div class="col-md-6">
                    <label for="profession" class="form-label">Profession :</label>
                    <input type="text" class="form-control" name="profession" value="electricien" required>
                </div>
            </div>

            <div class="row mb-3 ">
                <div class="col-md-6 ">
                    <label for="role" class="form-label ">fonction :</label>
                        <select id="fonction" name="fonction" required class="form-select">
                            <option value="president">Membre</option>
                            <option value="president">President</option>
                            <option value="president">Secretaire generale</option>
                            <option value="vice president">Vice President</option>
                            <option value="tresorier">Tresorier</option>
                            <option value="secretaire">Secretaire</option>
                            <option value="autre">Autre</option>
                        </select>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" value="ancienemail.com" required>
                </div>
            </div>
                <div class=" d-flex p-2 w-100 justify-content-center  ">
                <button type="submit" class="btn btn-primary ">modifier</button>
                </div>
         </form>