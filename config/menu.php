<?php 
$menu = [
    [
        "label" => "Accueil",
        "icon" => "home",
        "url" => "/MaMut_web/home",
        "roles" => ["admin", "membre", "caissier"]
    ],

    [
        "label" => "Gestion des adhérents",
        "icon" => "people",
        "url" => "/MaMut_web/member_list",
        "roles" => ["admin", "secretaire"]
    ],

    [
        "label" => "Gestion des événements",
        "icon" => "calendar-event",
        "url" => "/MaMut_web/event_list",
        "roles" => ["admin", "secretaire"]
    ],

    [
        "label" => "Gestion des caisses",
        "icon" => "wallet",
        "url" => "/MaMut_web/fund",
        "roles" => ["admin", "caissier"]
    ],

    [
        "label" => "Configuration",
        "icon" => "gear",
        "roles" => ["admin"],
        "children" => [
            ["label" => "Type d’événement", "url" => "/MaMut_web/add_fund"],
            ["label" => "Mode paiement", "url" => "/MaMut_web/fund"]
        ]
    ],
];

?>