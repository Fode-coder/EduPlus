<?php
function getStatIcon($stat)
{
    $icons = [
        'cours' => 'fas fa-book-open',
        'fascicules' => 'fas fa-file-pdf',
        'membres' => 'fas fa-users',
        'actualites' => 'fas fa-newspaper',
        'cours_online' => 'fas fa-video'
    ];
    return $icons[$stat] ?? 'fas fa-chart-line';
}

function getRecentActivity($pdo, $limit = 5)
{
    $stmt = $pdo->query("
        (SELECT 'cours' as type, titre, created_at FROM cours ORDER BY created_at DESC LIMIT $limit)
        UNION ALL
        (SELECT 'fascicules', nom_fichier, created_at FROM fascicules ORDER BY created_at DESC LIMIT $limit)
        ORDER BY created_at DESC
        LIMIT $limit
    ");
    return $stmt->fetchAll();
}
