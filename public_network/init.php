<?php
/*
Plugin Name: Соцсеть
Description:
Version: 1
Author: Denis Zhyrnyi
Author URI: http://p96278i3.beget.tech/
*/
// Функция создания таблицы в базе данных					
function public_network_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "public_network";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` int(50) NOT NULL AUTO_INCREMENT,
             `name` varchar(50) CHARACTER SET utf8 NOT NULL,
             `link` varchar(100) CHARACTER SET utf8 NOT NULL,
            `foto` varchar(50) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// регистрация функции
register_activation_hook(__FILE__, 'public_network_options_install');

//добавление действия
add_action('admin_menu','public_network_modifymenu');
function public_network_modifymenu() {
		
	//Добавление поля в основное меню
	add_menu_page('Сети', //page title
	'Сети', //menu title
	'manage_options', //capabilities
	'network_list', //menu slug
	'network_list' //function
	);


			//добавление в подменю поля обновить/удалить 
	add_submenu_page('network_list', //parent slug
	'Все соцсети', //page title
	'Все соцсети', //menu title
	'manage_options', //capability
	'network_all', //menu slug
	'network_all'); //function




	//добавление в подменю поля создания записи
	add_submenu_page('network_list', //parent slug
	'Добавить соцсеть', //page title
	'Добавить соцсеть', //menu title
	'manage_options', //capability
	'network_create', //menu slug
	'network_create'); //function
	
	//страница обновление/удаления вызываемая с подменю обновление/удаления
	add_submenu_page(null, //parent slug
	'Все соцсети', //page title
	'Все соцсети', //menu title
	'manage_options', //capability
	'network_update', //menu slug
	'network_update'); //function

}



//Подключаем файлы с функциями отображения страниц, shortcode, API

define('ROOTDIR_network', plugin_dir_path(__FILE__));
require_once(ROOTDIR_network . 'network-all.php');
require_once(ROOTDIR_network . 'network-list.php');
require_once(ROOTDIR_network . 'network-create.php');
require_once(ROOTDIR_network . 'network-update.php');
require_once(ROOTDIR_network . 'network-metabox.php');
require_once(ROOTDIR_network . 'network-shortcode.php');
?>
