<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <link rel="icon" href="<?= THEME_PATH; ?>/favicon.svg">
    <link rel="mask-icon" href="<?= THEME_PATH; ?>/favicon.svg">
    <link rel="shortcut icon" href="<?= THEME_PATH; ?>/favicon.svg">
    <link rel="apple-touch-icon" href="<?= THEME_PATH; ?>/favicon.svg">
    <style id="load-css"></style>
    <?php wp_head(); ?>
</head>

<body class="load-on-vissible--js notranslate" data-module="./modules/lazyLoad.js">
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="header__body">
                    Header

                    <button class="header__btn btn load-on-click--js" data-btn-id="popup"
                        data-module="./modules/modals.js">Открыть модалку</button>
                </div>
            </div>
        </header>