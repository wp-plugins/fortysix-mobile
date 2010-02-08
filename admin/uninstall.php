<?php
/* ===================================================================
 *  @class MoSc_Uninstall
 *  プラグイン無効処理
 * ==================================================================
*/
if ( ! class_exists('FsMb_Uninstall') ) {

	class FsMb_Uninstall
	{
	
		function FsMb_Uninstall()
		{
			$this->delete_mobile_option();
		}
	
		function delete_mobile_option()
		{
			delete_option('fsmb_all_size');
			delete_option('fsmb_auto_tel');
			delete_option('fsmb_auto_mail');
			delete_option('fsmb_inquiry_page');
			delete_option('fsmb_inquiry_mail');
			delete_option('fsmb_menu_top');
			delete_option('fsmb_menu_sub');
			delete_option('fsmb_menu_off1');
			delete_option('fsmb_menu_off2');
			delete_option('fsmb_menu_off3');
			delete_option('fsmb_menu_off4');
			delete_option('fsmb_menu_off5');
			delete_option('fsmb_image_flg');
			delete_option('fsmb_image_size');
			delete_option('fsmb_image_quality');
			delete_option('fsmb_news1_flg');
			delete_option('fsmb_news1_title');
			delete_option('fsmb_news1_category');
			delete_option('fsmb_news2_flg');
			delete_option('fsmb_news2_title');
			delete_option('fsmb_news2_category');
			delete_option('fsmb_news2_cnt');
			delete_option('fsmb_google_map_markers');
			delete_option('fsmb_google_map_zoom');
			delete_option('fsmb_google_map_size');
			delete_option('fsmb_google_map_key');
			delete_option('fsmb_google_map_page');
		}

	}
}
?>