<?php

defined('ABSPATH') || exit;

show_admin_bar(false);

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support( 'menus' );


function true_register_wp_sidebars() {
	register_sidebar(
		array(
			'id' => 'true_side',
			'name' => 'Боковая колонка', 
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
			'after_title' => '</h3>'
		)
	);
}
add_action( 'widgets_init', 'true_register_wp_sidebars' );


//Убрать p в СF7
add_filter('wpcf7_autop_or_not', '__return_false');


// Скрываем уведомления о новой версии WordPress
if ( 1 ) {

	// Общий счётчик обновлений в админ-баре
	add_action( 'admin_bar_menu', function ( $wp_adminbar ) {
		$wp_adminbar->remove_node( 'updates' );
	}, 999 );

	add_action( 'admin_menu', function () {

		// "Доступен WordPress X.X" в Консоле - Для Single установки
		remove_action( 'admin_notices', 'update_nag', 3 );

		// "Доступен WordPress X.X" в Консоле - Для Multisite установки
		remove_action( 'network_admin_notices', 'update_nag', 3 );

		// "Скачать версию X.X" в футере
		remove_action( 'update_footer', 'core_update_footer' );

		// Общий счётчик обновлений в админ-меню
		remove_submenu_page( 'index.php', 'update-core.php' );

		// Счётчик плагинов для обновления в админ-меню
		$GLOBALS['menu'][65][0] = __( 'Plugins' );

	}, 999 );

	// "Обновление до X.X" в виджете "На виду" в Консоле
	add_action( 'admin_head-index.php', function () {
		?>
		<style>
			#wp-version-message .button {
				display: none;
			}
		</style>
		<?php
	} );

}


function remove_plugin_updates($value) {
    return null;
  }
  
  add_filter('site_transient_update_plugins', 'remove_plugin_updates');