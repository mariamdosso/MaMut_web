<div class="content d-flex flex-column flex-column-fluid">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class=" container-xxl ">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form action="/MaMut_web/edit_event_controller" method="POST">
                    <input type="hidden" name="id" value="<?= $event['id'] ?>">
                    <div class="mb-8">
                        <label>Label de l'événement</label>
                        <input type="text" name="label" class="form-control" value="<?= htmlspecialchars($event['label']) ?>" required>
                    </div>
                    <div class="mb-8">
                        <label>Cet événement nécessite-t-il une contribution ?</label><br>

                        <label>
                            <input type="radio" name="with_participation" value="1"
                                <?= $event['with_participation'] == 1 ? 'checked' : '' ?>>
                            Oui
                        </label>

                        <label class="ms-5">
                            <input type="radio" name="with_participation" value="0"
                                <?= $event['with_participation'] == 0 ? 'checked' : '' ?>>
                            Non
                        </label>
                    </div>
                    <div id="contributionTypeFields" style="display:none;">
                        <div class="mb-8">
                            <label>Type de contribution</label><br>

                            <label>
                                <input type="radio" name="contribution_type" value="global"
                                    <?= $event['contribution_type'] === 'global' ? 'checked' : '' ?>>
                                Montant global
                            </label>

                            <label class="ms-5">
                                <input type="radio" name="contribution_type" value="per_person"
                                    <?= $event['contribution_type'] === 'per_person' ? 'checked' : '' ?>>
                                Montant par personne
                            </label>
                        </div>
                    </div>
                    <div id="globalAmountFields" style="display:none;">
                        <div class="mb-8">
                            <label>Montant global de l'événement</label>
                            <input type="number"
                                name="event_amount"
                                class="form-control"
                                value="<?= $event['event_amount'] ?>">
                        </div>
                    </div>
                    <div id="perPersonAmountFields" style="display:none;">
                        <div class="mb-8">
                            <label>Montant par participant</label>
                            <input type="number"
                                name="event_target_participation"
                                class="form-control"
                                value="<?= $event['event_target_participation'] ?>">
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-md-6">
                            <label>Date de début</label>
                            <input type="date" name="event_start_date" class="form-control" value="<?= $event['event_start_date'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label>Date de fin</label>
                            <input type="date" name="event_end_date" class="form-control" value="<?= $event['event_end_date'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-8">
                    <div class="mb-8">
                        <label>Type d'événement</label>
                        <select name="event_type_id" class="form-control" required>
                            <option value="">Sélectionner un type</option>
                            <?php foreach ($types as $t): ?>
                                <option value="<?= $t['id'] ?>" <?= $t['id'] == $event['event_type_id'] ? 'selected' : '' ?>><?= htmlspecialchars($t['label']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-8">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($event['description']) ?></textarea>
                    </div>
                    <div class="text-end">
                        <button type="reset" onclick="window.location.href='event_list'" class="btn btn-light me-3">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
               <div id="formResult"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const participationRadios = document.querySelectorAll('input[name="with_participation"]');
    const contributionTypeRadios = document.querySelectorAll('input[name="contribution_type"]');

    const contributionTypeFields = document.getElementById('contributionTypeFields');
    const globalAmountFields = document.getElementById('globalAmountFields');
    const perPersonAmountFields = document.getElementById('perPersonAmountFields');

    function resetAmounts() {
        globalAmountFields.style.display = 'none';
        perPersonAmountFields.style.display = 'none';
    }

    participationRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === '1') {
                contributionTypeFields.style.display = 'block';
            } else {
                contributionTypeFields.style.display = 'none';
                resetAmounts();
            }
        });
    });

    contributionTypeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'global') {
                globalAmountFields.style.display = 'block';
                perPersonAmountFields.style.display = 'none';
            } else if (this.value === 'per_person') {
                perPersonAmountFields.style.display = 'block';
                globalAmountFields.style.display = 'none';
            }
        });
    });

    const withParticipationChecked = document.querySelector('input[name="with_participation"]:checked');
    if (withParticipationChecked && withParticipationChecked.value === '1') {
        contributionTypeFields.style.display = 'block';

        const contributionTypeChecked = document.querySelector('input[name="contribution_type"]:checked');
        if (contributionTypeChecked) {
            if (contributionTypeChecked.value === 'global') {
                globalAmountFields.style.display = 'block';
            } else if (contributionTypeChecked.value === 'per_person') {
                perPersonAmountFields.style.display = 'block';
            }
        }
    }
});
</script>
