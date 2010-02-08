<?php
/* ===================================================================
 *  @class MoSc_Install
 *  プラグイン有効処理
 * ==================================================================
*/
if ( ! class_exists('FsMb_Install') ) {

	class FsMb_Install
	{
	
		function FsMb_Install()
		{
			$this->create_mobile_option();
		}

		function create_mobile_option()
		{
			update_option('fsmb_all_size', 1);
			update_option('fsmb_auto_tel', '');
			update_option('fsmb_auto_mail', '');
			update_option('fsmb_inquiry_page', 0);
			update_option('fsmb_inquiry_mail', '');
			update_option('fsmb_menu_top', 1);
			update_option('fsmb_menu_sub', 0);
			update_option('fsmb_menu_off1', 0);
			update_option('fsmb_menu_off2', 0);
			update_option('fsmb_menu_off3', 0);
			update_option('fsmb_menu_off4', 0);
			update_option('fsmb_menu_off5', 0);
			update_option('fsmb_image_flg', 1);
			update_option('fsmb_image_size', 100);
			update_option('fsmb_image_quality', 70);
			update_option('fsmb_news1_flg', 1);
			update_option('fsmb_news1_title', '新着情報');
			update_option('fsmb_news1_category', 0);
			update_option('fsmb_news2_flg', 1);
			update_option('fsmb_news2_title', 'コラム');
			update_option('fsmb_news2_category', 0);
			update_option('fsmb_news2_cnt', 10);
			update_option('fsmb_google_map_markers', '');
			update_option('fsmb_google_map_zoom', 16);
			update_option('fsmb_google_map_size', 200);
			update_option('fsmb_google_map_key', '');
			update_option('fsmb_google_map_page', '');
		}

	}
}
?>