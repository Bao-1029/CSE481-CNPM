<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/admin_style.css">
    <?php switch ($page):
        case 'login': ?>
            <link rel="stylesheet" href="css/login.css">
        <?php
            break;
        case 'dashboard': ?>
            <link rel="stylesheet" href="css/dashboard.css">
    <?php endswitch; ?>
</head>