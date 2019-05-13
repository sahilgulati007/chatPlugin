<?php
/*
  Plugin Name: Chat Plugin
  Description: Plugin for main page
  Version: 1
  Author: Sahil gulati
 */
global $jal_db_version;
$jal_db_version = '1.0';
function jal_install() {
    global $wpdb;
    global $jal_db_version;
    $table_name = $wpdb->prefix . 'chat';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
		cid mediumint(9) NOT NULL AUTO_INCREMENT,
		cnm tinytext NOT NULL,
	    cemail text NOT NULL,
		PRIMARY KEY  (cid)
	) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    $table_name = $wpdb->prefix . 'chat_detail';
    $sql = "CREATE TABLE $table_name (
		cdid bigint(20) NOT NULL AUTO_INCREMENT,
		cid mediumint(9) NOT NULL,
		dtext text NOT NULL,
	    texttype text NOT NULL,
	    notifiy mediumint(9) NOT NULL,
		PRIMARY KEY  (cdid)
	) $charset_collate;";
    dbDelta( $sql );
    add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'jal_install' );
//adding in menu
add_action('admin_menu', 'at_chat_menu');
function at_chat_menu()
{
    //adding plugin in menu
    add_menu_page('chat_list', //page title
        'Chat Listing', //menu title
        'manage_options', //capabilities
        'Chat_Listing', //menu slug
        'chat_list' //function
    );
    //adding submenu to a menu
    add_submenu_page(null,//parent page slug
        'Chat_view',//page title
        'Chat View',//menu title
        'manage_options',//manage options
        'Chat_View',//slug
        'chat_view'//function
    );

}

add_action( 'wp_enqueue_scripts', 'so_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'so_enqueue_scripts' );
function so_enqueue_scripts(){
    wp_register_script('jquery3','https://code.jquery.com/jquery-3.3.1.js');
    wp_enqueue_script( 'jquery3');
    wp_register_script(
        'ajaxHandle',
        '/wp-content/plugins/chat_plugin/js/chat.js',
        array(),
        false,
        true
    );
    wp_enqueue_script( 'ajaxHandle' );
    wp_localize_script(
        'ajaxHandle',
        'ajax_object',
        array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
    );
}
function plugin_enqueue_script() {

}
add_action('wp_enqueue_scripts', 'plugin_enqueue_script');

add_action( 'wp_ajax_send_chat', 'send_chat' );
add_action( 'wp_ajax_nopriv_send_chat', 'send_chat' );

function send_chat() {
    global $wpdb; // this is how you get access to the database

    $msg = $_POST['msg'] ;
    $cid = $_POST['cid'] ;
    $table_name = $wpdb->prefix . 'chat_detail';
    $d=$wpdb->insert(
        $table_name,
        array(
            'cid' => $cid,
            'dtext' => $msg,
            'texttype' => '1',
            'notifiy' => '1'
        )
    );

    echo $d;

    wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_reg_chat', 'reg_chat' );
add_action( 'wp_ajax_nopriv_reg_chat', 'reg_chat' );

function reg_chat() {
    global $wpdb; // this is how you get access to the database

    $nm = $_POST['nm'] ;
    $em = $_POST['em'] ;
    $table_name = $wpdb->prefix . 'chat';
    $result= $wpdb->get_results("select * from ".$table_name." where cemail='".$em."'");
    if($wpdb->num_rows>0){
        foreach ($result as $r){
            echo $r->cid;
            break;
        }
    }
    else {
        $d = $wpdb->insert(
            $table_name,
            array(
                'cnm' => $nm,
                'cemail' => $em,
            )
        );

        echo $wpdb->insert_id;
    }

    wp_die(); // this is required to terminate immediately and return a proper response
}

add_action( 'wp_ajax_get_chat', 'get_chat' );
add_action( 'wp_ajax_nopriv_get_chat', 'get_chat' );

function get_chat() {
    global $wpdb; // this is how you get access to the database
    $cid = $_POST['cid'] ;
    //echo $cid;
    $table_name = $wpdb->prefix . 'chat_detail';
    $result= $wpdb->get_results("select * from ".$table_name." where cid=".$cid ." order by cdid");
    //echo "select * from ".$table_name." where cid=".$cid;
    echo json_encode($result);

    wp_die(); // this is required to terminate immediately and return a proper response
}

add_action( 'wp_ajax_update_chat', 'update_chat' );
add_action( 'wp_ajax_nopriv_update_chat', 'update_chat' );

function update_chat() {
    global $wpdb; // this is how you get access to the database
    $cid = $_POST['cid'] ;
    //echo $cid;
    $table_name = $wpdb->prefix . 'chat_detail';
//    $result= $wpdb->get_results("select * from ".$table_name." where cid=".$cid);
//    //echo "select * from ".$table_name." where cid=".$cid;
//    echo json_encode($result);
    $wpdb->update(
        $table_name,
        array(
            'notifiy' => '0',
        ),
        array(
            'cid' => $cid,
            'texttype' => '0'
            ));

        wp_die(); // this is required to terminate immediately and return a proper response
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'chat_list.php');
require_once(ROOTDIR . 'chat_view.php');
require_once(ROOTDIR . 'chat_front.php');
