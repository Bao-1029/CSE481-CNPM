<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php switch ($page):
        case 'home': ?>
            <link rel="stylesheet" href="css/statistics.css">
        <?php
            break;
        case 'news': ?>
            <link rel="stylesheet" href="css/news.css">
        <?php
            break;
        case 'symptoms': ?>
            <link rel="stylesheet" href="css/symptoms.css">
        <?php
            break;
        case 'precaution': ?>
            <link rel="stylesheet" href="css/precaution.css">
    <?php endswitch; ?>
</head>