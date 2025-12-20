<?php 
$menu = [
    [
        "label" => "Accueil",
        "icon" => "house",
        "url" => "/MaMut_web/home",
        "roles" => ["admin"]
    ],

    [
        "label" => "Gestion des adhérents",
        "icon" => "people",
        "url" => "/MaMut_web/member_list",
        "roles" => ["admin"]
    ],

    [
        "label" => "Gestion des événements",
        "icon" => "calendar-event",
        "url" => "/MaMut_web/event_list",
        "roles" => ["admin"]
    ],

    [
        "label" => "Gestion des caisses",
        "icon" => "wallet",
        "url" => "/MaMut_web/fund",
        "roles" => ["admin"]
    ],

    [
        "label" => "Configuration",
        "icon" => "gear",
        "roles" => ["admin"],
        "children" => [
            ["label" => "Type d’événement", "icon"=> "wallet" ,"url" => "/MaMut_web/add_fund"],
            ["label" => "Mode paiement", "icon"=> "gear" , "url" => "/MaMut_web/fund"]
        ]
    ],
];

?>