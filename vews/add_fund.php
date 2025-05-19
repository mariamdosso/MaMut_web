

<div class="container d-flex justify-content-center align-items-center vh-100 bg-secondary">
  <div class="card p-4 shadow-lg bg-white rounded-4" style="width: 26rem;">
    <h2 class="text-center mb-4 text-primary fw-bold">Créer une Caisse</h2>

    <form method="POST" action="controller/add_fund_controller.php">
      <div class="mb-3">
        <label for="name" class="form-label"> Nom de la caisse</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Ex: Caisse de solidarité" required>
      </div>

      <div class="mb-3">
        <label for="date_caisse" class="form-label">  Date de création</label>
        <input type="date" name="date_caisse" class="form-control" id="date_caisse" required>
      </div>

      <div class="mb-3">
        <label for="total" class="form-label"> Montant total de la caisse (FCFA)</label>
        <input type="number" name="total" class="form-control" id="total" min="0" placeholder="Ex: 50000" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2"> Ajouter la caisse</button>
    </form>
  </div>
</div>
