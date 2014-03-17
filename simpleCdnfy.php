<?php
/**
 * @package simpleCdmfy
 *
 * Plugin Name : simpleCdnfy
 * Version : 0.0.1
 * To Be Continue
 */
/*
Plugin Name: Simple Cdnfy
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: It's a simple cdn setting plugin help people who host blog on sae (sae.sina.com.cn) and does not have an icp license which is bullshit.
Author: Eric.Chan
Version: 0.0.2
Author URI: http://blog.ext5.com
*/

/**
 * namespace _
 */

if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

if (!class_exists('simpleCndfy')) {

    class simpleCndfy {
        private $_simpleCdn_assets_url  = '';
        private $_simpleCdn_file_url    = '';
        private $_siteurl              = '';
        function __construct() {
            $this->init_options();
            // activate && deactivate this plugin
            if (is_admin()) {
                add_action('activate_simpleCdnfy/simpleCdnfy.php' , array($this , 'activate'));
                add_action('deactivate_simpleCdnfy/simpleCdnfy.php' ,array($this , 'deactivate'));
                // admin menu
                add_action('admin_init', array($this , 'init_option'));
                add_action( 'admin_menu', array($this, 'admin_menu'));
                // add plugin setting link to
                add_filter('plugin_action_links_'.plugin_basename(__FILE__), array(&$this, 'filter_plugin_actions'), 10, 2);
            }

            add_filter('script_loader_src',  array( $this ,'script_loader_src') );
//            add_filter('style_loader_src',  array( $this ,'script_loader_src') );
        }

        private function init_options() {
            $this->_simpleCdn_assets_url  = get_option('_simpleCdn_assets_url');
            $this->_simpleCdn_file_url    = get_option('_simpleCdn_file_url');
            $this->_siteurl               = get_option('siteurl');
            if ('/' != substr($this->_simpleCdn_assets_url ,-1)) {
                $this->_simpleCdn_assets_url .= '/';
            }

            if ('/' != substr($this->_siteurl ,-1)) {
                $this->_siteurl .= '/';
            }


        }

        private $src = array();
        function script_loader_src($src) {
          // 移除 ? 后面的内容
          $parts = explode('?', $src);
          $src = $parts[0];
          $this->src[] = $src;
          $src = str_replace($this->_siteurl , $this->_simpleCdn_assets_url , $src);
          return $src;
        }

        function options_page() {
            include dirname(__FILE__) .'/options_page.php';
        }

            function init_option() {
                register_setting('simplecdnfy', '_simpleCdn_assets_url');
                register_setting('simplecdnfy', '_simpleCdn_file_url');
            }

            function filter_plugin_actions($l, $file) {
                $settings_link = '<a href="options-general.php?page=simpleCdnfy">'.__('Settings').'</a>';
                array_unshift($l, $settings_link);
                return $l;
            }

        function admin_menu() {
            add_submenu_page('options-general.php', __('SimpleCdnfy'), __('SimpleCdnfyß'), 'manage_options', 'simplecdnfy' , array($this , 'options_page'));
        }

        function activate() {
            add_option('_simpleCdn_assets_url','', null ,'yes');
//            add_option('_simpleCdn_file_url','', null ,'yes');
        }

        function deactivate() {
            delete_option('_simpleCdn_assets_url');
//            delete_option('_simpleCdn_file_url');
        }
    }

    new simpleCndfy();
}


// add admin menu


