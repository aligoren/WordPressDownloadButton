<?php
defined('ABSPATH') or die("No script kiddies please!");
/*
Plugin Name: Download Buttons
Plugin URI: http://blog.aligoren.net
Description: Download Buttons
Version: 0.1
Author: Ali GOREN
License: GPLv2
Author URI: http://blog.aligoren.net
*/

//Download Button
function dwn_button( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'color' => 'red', // default red
			'link' => '', // default empty
			'target' => 'blank', // default target blank.
			'alt' => '', // default empty
			'title' => '', // default empty
			'lang' => 'en' // default english
		), $atts )
	);

	// plugins directory
	$directory_plugins = '/wp-content/plugins/download_button/images/';
	
	// colors array
	$colors = array('blue', 'crimson', 'red', 'wellread', 'green', 'aqua', 'silver',
	'gray', 'orange', 'azure', 'pink', 'purple', 'yellow', 'icecold', 'ghost',
	'eclipse', 'cyprus', 'chocolate', 'celtic', 'apache');
	
	// Return code
	//English Translate
	if($lang == 'en')
	{
		if(in_array(strtolower($color), $colors))
		{
			if($color == $color)
			{
				$rtn = '<a alt="'.$alt.'" title="'.$title.'" href='.$link.' target="_'.$target.'"><img src="'.$directory_plugins.''.$lang.'/'.$color.'.png"></a>';
				return $rtn;
			}
		}
		else
		{
			$rtn = '<a alt="'.$alt.'" title="'.$title.'" href='.$link.' target="_'.$target.'"><img src="'.$directory_plugins.''.$lang.'/crimson.png"></a>';
			return $rtn;
		}
	}

	//Turkish Translate
	else if($lang == 'tr')
	{
		if(in_array(strtolower($color), $colors))
		{
			if($color == $color)
			{
				$rtn = '<a alt="'.$alt.'" title="'.$title.'" href='.$link.' target="_'.$target.'"><img src="'.$directory_plugins.''.$lang.'/'.$color.'.png"></a>';
				return $rtn;
			}
		}
		else
		{
			$rtn = '<a alt="'.$alt.'" title="'.$title.'" href='.$link.' target="_'.$target.'"><img src="'.$directory_plugins.''.$lang.'/crimson.png"></a>';
			return $rtn;
		}
	}
}
add_shortcode( 'download', 'dwn_button' );

add_action('admin_menu', 'dwn_button_help_tab');
function dwn_button_help_tab() {
    $dwn_help_page = add_options_page(__('Download Button Help', 'dwn_help'), __('Download Button Help', 'dwn_help'), 'manage_options', 'dwn_help', 'dwn_help_admin_page');
	add_action('load-'.$dwn_help_page, 'dwn_add_help_tab');
}

function dwn_add_help_tab() {
    global $dwn_help_page;
    $dwn_screen = get_current_screen();
    
    $dwn_screen->add_help_tab( array(
        'id'	=> 'dwn_help_tab',
        'title'	=> __('Screenshot'),
        'content'	=> '
' . __( '<h3>Screenshoot</h3><img src="'.plugin_dir_url('download_button').'/download_button/images/screenshot.png">' ) . '
',
    ) );
	
	$dwn_screen->add_help_tab( array(
        'id'	=> 'dwn_about_tab',
        'title'	=> __('About'),
        'content'	=> '
' . __( '<h3>About Plug-in Author</h3>Ali GOREN<h3>Author Website:</h3><a href="http://blog.aligoren.net" target="_blank">http://blog.aligoren.net</a>
		<h3>Contact:</h3><a href="mailto:goren.ali@yandex.com">goren.ali@yandex.com</a>
' ) . '
',
    ) );
}

function dwn_help_admin_page() {
	if(get_locale() == 'tr_TR')
	{
		$usage = file_get_contents(plugin_dir_url('download_button').'/download_button/help.tr.html');
		printf('<h3>Nasıl Kullanılır?</h3><br>');
		printf('<b>Açıklama:</b> Bu eklenti ile dosya indirme linklerini butona çevirebilirsiniz.
		Eklenti 20 kadar renk desteği sağlamaktadır. Ve gerekli olan a, title, alt gibi tagleri desteklemektedir.
		Bunun yanında ek olarak açıklamak gerekirse, varsayılan renk olarak KIRMIZI kullanılmaktadır. Varsayılan dil İngilizcedir.
		Basit kullanım örneğindeki gibi bir kullanımda link yeni sekmede açılmaktadır. Ancak isteğe göre _self, _top, _parent seçenekleri kullanılabilir.
		Ayrıca ekran görüntüsüne yukarıda sağ taraftaki Ekran Görüntüsü bölümünden ulaşabiliriniz.<br><br>');
		printf($usage);
	}
	else if(get_locale() == 'en-US')
	{
		$usage = file_get_contents(plugin_dir_url('download_button').'/download_button/help.html');
		printf('<h3>How To Using?</h3><br>');
		printf($usage);
	}
	else if(get_locale() == 'en_GB')
	{
		$usage = file_get_contents(plugin_dir_url('download_button').'/download_button/help.html');
		printf('<h3>How To Using?</h3><br>');
		printf($usage);
	}
	else
	{
		printf("Not Supported");
	}

}

function dwn_button_now_activate() {
	add_option('dwn_button_now_activated', true);
}
register_activation_hook(__FILE__, 'dwn_button_now_activate');

function dwn_button_now_activated() {

	if(get_locale() == 'tr_TR')
	{
		if(get_option('dwn_button_now_activated', false)) {
			delete_option('dwn_button_now_activated');
			add_action('admin_notices', create_function('', 'echo 
			\'<div class="updated fade"><p><strong>Download Button</strong> aktif, eğer istersen, <a href="./options-general.php?page=dwn_help">Yardım Dökümanı</a> sana yardımcı olabilir.</div>\';'));
			}
		
	}
	else if(get_locale() == 'en-US')
	{
		if(get_option('dwn_button_now_activated', false)) {
			delete_option('dwn_button_now_activated');
			add_action('admin_notices', create_function('', 'echo 
			\'<div class="updated fade"><p><strong>Download Button</strong> is active, if you want to help, you can <a href="./options-general.php?page=dwn_help">Look Help Document </a></div>\';'));
		}
		
	}
	else if(get_locale() == 'en_GB')
	{
		if(get_option('dwn_button_now_activated', false)) {
			delete_option('dwn_button_now_activated');
			add_action('admin_notices', create_function('', 'echo 
			\'<div class="updated fade"><p><strong>Download Button</strong> is active, if you want to help, you can <a href="./options-general.php?page=dwn_help">Look Help Document </a></div>\';'));
		}
		
	}
}
add_action('admin_init', 'dwn_button_now_activated');
?>