<h3>Participants de l'événement <?= $eventId ?></h3>

<?php if (!empty($participants)): ?>
    <ul>
        <?php foreach ($participants as $p): ?>
            <li><?= htmlspecialchars($p['name']) ?> - <?= htmlspecialchars($p['email']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun participant trouvé.</p>
<?php endif; ?>