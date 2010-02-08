<?php
/* ===================================================================
 *  @class FsMb_Initial
 *  キャリア判別・初期処理
 * ===================================================================
*/
if ( ! class_exists('FsMb_Initial') ){

	class FsMb_Initial
	{
		var $is_mobile;
		
		/* init */
		function FsMb_Initial()
		{
			$this->if_mobile();
		}
		
		function if_mobile()
		{
			$agentx = $_SERVER['HTTP_USER_AGENT'];
			if ( preg_match('!^DoCoMo/1!', $agentx) || preg_match('!^DoCoMo/2!', $agentx) ) {
			
				$this->is_mobile = 'DOCOMO';
			
			} elseif ( preg_match('!^J-(PHONE|EMULATOR)/!', $agentx) || preg_match('!^(Vodafone/|MOT(EMULATOR)?-[CV]|SoftBank/|[VS]emulator/)!', $agentx) || preg_match('/iPhone/', $agentx) ) {
			
				$this->is_mobile = 'SOFTBANK';
			
			} elseif ( preg_match('/^KDDI-/', $agentx) || preg_match('/^UP\.Browser/', $agentx) ) {
			
				$this->is_mobile = 'KDDI';
			}
		}
		/* mobile */
		function init_mobile()
		{
			require_once(FSMB_PLUGINS_PATH . '/mobile/browser.php');
			$fsmb_browser = new FsMb_Browser;
			add_action('template_redirect', array(&$fsmb_browser, 'response_html'), 1);
		}
	
		/* pc */
		function init_pc()
		{
			if ( is_admin() ) {
				register_activation_hook(FSMB_PLUGINS_FILE, array($this, 'load_activation'));
				
				register_deactivation_hook(FSMB_PLUGINS_FILE, array($this, 'load_deactivation'));
				
				add_action('admin_menu', array($this, 'load_menu'));
			}
		}
		function load_activation()
		{
			require_once(FSMB_PLUGINS_PATH . '/admin/install.php');
			$fsmb_install = new FsMb_Install;
		}

		function load_deactivation()
		{
			require_once(FSMB_PLUGINS_PATH . '/admin/uninstall.php');
			$fsmb_uninstall = new FsMb_Uninstall;
		}

		function load_menu()
		{
			require_once(FSMB_PLUGINS_PATH . '/admin/mobile.php');
			
			$fsmb_mobile = new FsMb_Mobile;

			add_submenu_page('plugins.php', '携帯の設定', '携帯の設定', 8, 'mobile', array(&$fsmb_mobile, 'edit_mobile'));
		}
	}
}
?>