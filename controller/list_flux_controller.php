<?php
require_once("config/db.php");

if (isset($_POST['fund_id'])) {
    $fund_id = $_POST['fund_id'];

    $sql = "SELECT * FROM cash_flow WHERE fund_id = ? ORDER BY date_cash_flow DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fund_id]);
    $flux = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($flux) {
        echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Montant</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($flux as $f) {
            echo "<tr>
                    <td>{$f['date_cash_flow']}</td>
                    <td>{$f['description_cash_flow']}</td>
                    <td>" . number_format($f['amount_cash_flow'], 0, ',', ' ') . " FCFA</td>
                    <td>{$f['type_cash_flow']}</td>
                  </tr>";
        }
        echo '</tbody></table>';
    } else {
        echo "<p>Aucun flux trouvé pour cette caisse.</p>";
    }
} else {
    echo "Caisse non spécifiée.";
}
?>
