<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= get_option('site_description'); ?>">
    <meta name="keywords" content="<?= get_option('keywords'); ?>">
    <meta name="author" content="<?= get_option('author'); ?>">

    <title><?= site_name(); ?></title>
    <link rel="icon" type="image/x-icon" href="<?= (file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . get_option('site_logo')) && get_option('site_logo')) ? BASE_URL . 'uploads/logo/' . get_option('site_logo') : BASE_ASSET . 'img/logo.png'; ?>">

    <link href="<?= theme_asset(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= theme_asset(); ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <link href="<?= theme_asset(); ?>/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <link href="<?= theme_asset(); ?>/css/creative.css" rel="stylesheet">
    <link href="<?= theme_asset(); ?>/css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?= theme_asset(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= theme_asset(); ?>/js/script.js"></script>

</head>
