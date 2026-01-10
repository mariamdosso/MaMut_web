<?php
require_once __DIR__ . '/../../config/menu.php';
$user = $_SESSION['user_info'] ?? null;
$userRole = $user['role'] ?? 'guest';
$currentUrl = $_SERVER['REQUEST_URI'];
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100 sidebar" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">MaMut</span>
    </a>
    
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <?php foreach ($menu as $item): 
            if (!in_array($userRole, $item['roles'])) continue;
            $hasChildren = isset($item['children']);
        ?>
            <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center justify-content-between <?= $hasChildren ? 'collapsed' : '' ?>"
                   href="<?= $item['url'] ?? '#' ?>"
                   <?= $hasChildren ? 'data-bs-toggle="collapse" data-bs-target="#menu' . md5($item['label']) . '"' : '' ?>>
                   
                    <span>
                        <i class="bi bi-<?= htmlspecialchars($item['icon']) ?> me-2"></i>
                        <?= htmlspecialchars($item['label']) ?>
                    </span>

                    <?php if ($hasChildren): ?>
                        <i class="bi bi-chevron-right toggle-icon"></i>
                    <?php endif; ?>
                </a>

                <?php if ($hasChildren): ?>
                    <ul class="collapse list-unstyled ps-3" id="menu<?= md5($item['label']) ?>">
                        <?php foreach ($item['children'] as $child): ?>
                            <li>
                                <a href="<?= $child['url'] ?>" class="nav-link text-white d-flex align-items-center">
                                    <?php if (isset($child['icon'])): ?>
                                        <i class="bi bi-<?= htmlspecialchars($child['icon']) ?> me-2"></i>
                                    <?php endif; ?>
                                    <?= htmlspecialchars($child['label']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <div class="dropdown mt-3">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown">
            <img src="https://github.com/mdo.png" width="32" height="32" class="rounded-circle me-2">
            <strong><?= htmlspecialchars($user['login']); ?></strong>
        </a>

        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="/MaMut_web/info_user">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/MaMut_web/logout">Se déconnecter</a></li>
        </ul>
    </div>
</div>
