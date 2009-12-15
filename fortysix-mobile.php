<?php
/*
Plugin Name: FortySix Mobile
Plugin URI: http://www.fortysix.co.jp/news/760/
Description: Japanese mobile telephone simple display plugin.
Version: 1.0
Author: iFortySix
Author URI: http://www.fortysix.co.jp/
*/
/*  Copyright 2009 FortySix Inc(email : support at fortysix.jp)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//===================================================================
// メイン｜携帯対応
//-------------------------------------------------------------------
// Copyright (C) 2009 FortySix Inc.
// This file is distributed under the GPL 2 license.
//===================================================================

//===================================================================
// 関数宣言
//===================================================================
// プラグイン有効処理
function fsmb_on_mobile() {
	// データベース項目追加処理
	if (get_option('fsmb_all_size') == false) {
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
		update_option('fsmb_google_map_markers', '');
		update_option('fsmb_google_map_zoom', 16);
		update_option('fsmb_google_map_size', 200);
		update_option('fsmb_google_map_key', '');
		update_option('fsmb_google_map_page', '');
	}
}
// プラグイン停止処理
function fsmb_off_mobile(){
	// データベース項目削除処理
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
	delete_option('fsmb_google_map_markers');
	delete_option('fsmb_google_map_zoom');
	delete_option('fsmb_google_map_size');
	delete_option('fsmb_google_map_key');
	delete_option('fsmb_google_map_page');
}
// プラグインメニュー>サブメニュー追加処理
function fsmb_add_menu_mobile() {
	add_submenu_page('plugins.php', '携帯の設定', '携帯の設定', 8, __FILE__, 'fsmb_option_mobile');
}
// 設定画面表示処理
function fsmb_option_mobile() {
	$ctheme = get_current_theme();
	if (isset($_POST['btnxxx']) == false) {
		// 初期
		$allszx = fsmb_change_out_db(get_option('fsmb_all_size'),'int');
		$atelxx = fsmb_change_out_db(get_option('fsmb_auto_tel'),'text');
		$amailx = fsmb_change_out_db(get_option('fsmb_auto_mail'),'text');
		$ipagex = fsmb_change_out_db(get_option('fsmb_inquiry_page'),'int');
		$imailx = fsmb_change_out_db(get_option('fsmb_inquiry_mail'),'text');
		$mntopx = fsmb_change_out_db(get_option('fsmb_menu_top'),'int');
		$mnsubx = fsmb_change_out_db(get_option('fsmb_menu_sub'),'int');
		$mnoff1 = fsmb_change_out_db(get_option('fsmb_menu_off1'),'int');
		$mnoff2 = fsmb_change_out_db(get_option('fsmb_menu_off2'),'int');
		$mnoff3 = fsmb_change_out_db(get_option('fsmb_menu_off3'),'int');
		$mnoff4 = fsmb_change_out_db(get_option('fsmb_menu_off4'),'int');
		$mnoff5 = fsmb_change_out_db(get_option('fsmb_menu_off5'),'int');
		$imgflg = fsmb_change_out_db(get_option('fsmb_image_flg'),'int');
		$imgszx = fsmb_change_out_db(get_option('fsmb_image_size'),'int');
		$imgqtx = fsmb_change_out_db(get_option('fsmb_image_quality'),'int');
		$ns1flg = fsmb_change_out_db(get_option('fsmb_news1_flg'),'int');
		$ns1ttl = fsmb_change_out_db(get_option('fsmb_news1_title'),'text');
		$ns1cnt = fsmb_change_out_db(get_option('posts_per_page'),'int');
		$ns1cat = fsmb_change_out_db(get_option('fsmb_news1_category'),'text');
		$gposxx = fsmb_change_out_db(get_option('fsmb_google_map_markers'),'text');
		$gzoomx = fsmb_change_out_db(get_option('fsmb_google_map_zoom'),'int');
		$gszxxx = fsmb_change_out_db(get_option('fsmb_google_map_size'),'int');
		$gkeyxx = fsmb_change_out_db(get_option('fsmb_google_map_key'),'text');
		$gpagex = fsmb_change_out_db(get_option('fsmb_google_map_page'),'int');
	}else{
		// 設定
		global $wpdb;
		if($_FILES[logoxx][name] != ''){
			$idxxxx = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid LIKE %s", '%uploads/irogo.jpg'));
			if($idxxxx > 0){wp_delete_attachment($idxxxx);}
			media_handle_upload('logoxx','');
		}
		$errct1 = 0;
		$errmg1 = array();
		fsmb_check_request($_POST['allszx'],'サイト全体のフォントのサイズ','int2',true,1,$errct1,$errmg1);
		fsmb_check_request($_POST['mntopx'],'トップページのメニュー階層','int',true,1,$errct1,$errmg1);
		fsmb_check_request($_POST['mnsubx'],'各ページのメニュー階層','int',true,1,$errct1,$errmg1);
		fsmb_check_request($_POST['imgflg'],'画像を表示する','int2',false,1,$errct1,$errmg1);
		fsmb_check_request($_POST['imgszx'],'表示する画像の最大サイズ','int2',true,3,$errct1,$errmg1);
		fsmb_check_request($_POST['imgqtx'],'表示する画質','int2',false,3,$errct1,$errmg1);
		
		fsmb_check_request($_POST['ns1flg'],'利用する','int2',false,1,$errct1,$errmg1);
		if($_POST['ns1flg'] == ''){
			fsmb_check_request($_POST['ns1ttl'],'表示するタイトル','text',false,30,$errct1,$errmg1);
			fsmb_check_request($_POST['ns1cnt'],'表示する件数','int2',false,2,$errct1,$errmg1);
			fsmb_check_request($_POST['ns1cat'],'表示するカテゴリー','int',true,1,$errct1,$errmg1);
		}else{
			fsmb_check_request($_POST['ns1ttl'],'表示するタイトル','text',true,30,$errct1,$errmg1);
			fsmb_check_request($_POST['ns1cnt'],'表示する件数','int2',true,2,$errct1,$errmg1);
			fsmb_check_request($_POST['ns1cat'],'表示するカテゴリー','int',true,1,$errct1,$errmg1);
		}
		fsmb_check_request($_POST['atelxx'],'電話番号','phone',false,20,$errct1,$errmg1);
		fsmb_check_request($_POST['amailx'],'メールアドレス','mail',false,100,$errct1,$errmg1);
		fsmb_check_request($_POST['ipagex'],'設定するページ','int',false,5,$errct1,$errmg1);
		fsmb_check_request($_POST['imailx'],'お問い合わせメールアドレス','mail',false,100,$errct1,$errmg1);
		fsmb_check_request($_POST['gposxx'],'位置情報','text',false,40,$errct1,$errmg1);
		fsmb_check_request($_POST['gzoomx'],'倍率','int2',false,2,$errct1,$errmg1);
		fsmb_check_request($_POST['gszxxx'],'表示する画像のサイズ','int2',true,3,$errct1,$errmg1);
		fsmb_check_request($_POST['gkeyxx'],'GoogleマップのAPIキー','text',false,200,$errct1,$errmg1);
		fsmb_check_request($_POST['gpagex'],'表示するページ','int2',true,5,$errct1,$errmg1);
		fsmb_check_request($_POST['mnoff1'],'表示しないページ1','int',true,5,$errct1,$errmg1);
		fsmb_check_request($_POST['mnoff2'],'表示しないページ2','int',true,5,$errct1,$errmg1);
		fsmb_check_request($_POST['mnoff3'],'表示しないページ3','int',true,5,$errct1,$errmg1);
		fsmb_check_request($_POST['mnoff4'],'表示しないページ4','int',true,5,$errct1,$errmg1);
		fsmb_check_request($_POST['mnoff5'],'表示しないページ5','int',true,5,$errct1,$errmg1);
		$allszx = fsmb_change_request($_POST['allszx'],'int');
		$mntopx = fsmb_change_request($_POST["mntopx"],'int');
		$mnsubx = fsmb_change_request($_POST["mnsubx"],'int');
		$imgflg = fsmb_change_request($_POST['imgflg'],'int');
		$imgszx = fsmb_change_request($_POST['imgszx'],'int');
		$imgqtx = fsmb_change_request($_POST['imgqtx'],'int');
		$ns1flg = fsmb_change_request($_POST['ns1flg'],'text');
		$ns1ttl = fsmb_change_request($_POST['ns1ttl'],'text');
		$ns1cnt = fsmb_change_request($_POST['ns1cnt'],'int');
		$ns1cat = fsmb_change_request($_POST['ns1cat'],'text');
		$atelxx = fsmb_change_request($_POST['atelxx'],'text');
		$amailx = fsmb_change_request($_POST["amailx"],'text');
		$ipagex = fsmb_change_request($_POST["ipagex"],'int');
		$imailx = fsmb_change_request($_POST["imailx"],'text');
		$gposxx = fsmb_change_request($_POST['gposxx'],'text');
		$gzoomx = fsmb_change_request($_POST['gzoomx'],'int');
		$gszxxx = fsmb_change_request($_POST['gszxxx'],'int');
		$gkeyxx = fsmb_change_request($_POST['gkeyxx'],'text');
		$gpagex = fsmb_change_request($_POST['gpagex'],'int');
		$mnoff1 = fsmb_change_request($_POST["mnoff1"],'int');
		$mnoff2 = fsmb_change_request($_POST["mnoff2"],'int');
		$mnoff3 = fsmb_change_request($_POST["mnoff3"],'int');
		$mnoff4 = fsmb_change_request($_POST["mnoff4"],'int');
		$mnoff5 = fsmb_change_request($_POST["mnoff5"],'int');
		if($errct1 == 0){
			// 更新
			update_option('fsmb_all_size', fsmb_change_in_db($allszx,'int'));
			update_option('fsmb_menu_top', fsmb_change_in_db($mntopx,'int'));
			update_option('fsmb_menu_sub', fsmb_change_in_db($mnsubx,'int'));
			update_option('fsmb_image_flg', fsmb_change_in_db($imgflg,'int'));
			update_option('fsmb_image_size', fsmb_change_in_db($imgszx,'int'));
			update_option('fsmb_image_quality', fsmb_change_in_db($imgqtx,'int'));
			update_option('fsmb_news1_flg', fsmb_change_in_db($ns1flg,'int'));
			update_option('fsmb_news1_title', fsmb_change_in_db($ns1ttl,'text'));
			update_option('posts_per_page', fsmb_change_in_db($ns1cnt,'int'));
			update_option('fsmb_news1_category', fsmb_change_in_db($ns1cat,'int'));
			update_option('fsmb_auto_tel', fsmb_change_in_db($atelxx,'text'));
			update_option('fsmb_auto_mail', fsmb_change_in_db($amailx,'text'));
			update_option('fsmb_inquiry_page', fsmb_change_in_db($ipagex,'int'));
			update_option('fsmb_inquiry_mail', fsmb_change_in_db($imailx,'text'));
			update_option('fsmb_google_map_markers', fsmb_change_in_db($gposxx,'text'));
			update_option('fsmb_google_map_zoom', fsmb_change_in_db($gzoomx,'int'));
			update_option('fsmb_google_map_size', fsmb_change_in_db($gszxxx,'int'));
			update_option('fsmb_google_map_key', fsmb_change_in_db($gkeyxx,'text'));
			update_option('fsmb_google_map_page', fsmb_change_in_db($gpagex,'int'));
			update_option('fsmb_menu_off1', fsmb_change_in_db($mnoff1,'int'));
			update_option('fsmb_menu_off2', fsmb_change_in_db($mnoff2,'int'));
			update_option('fsmb_menu_off3', fsmb_change_in_db($mnoff3,'int'));
			update_option('fsmb_menu_off4', fsmb_change_in_db($mnoff4,'int'));
			update_option('fsmb_menu_off5', fsmb_change_in_db($mnoff5,'int'));
		}
	}
	// カテゴリ情報取得
	$categories = get_terms('category', 'orderby=ID&order=ASC');
	$rows1 = 0;
	$i = 0;
	$data1 = array();
	foreach ($categories as $category) {
		$data1[$i]['idxxxx'] = fsmb_change_out_db($category->term_id,'int');
		$data1[$i]['namexx'] = fsmb_change_out_db($category->name,'text');
		$i++;
	}
	$rows1 = $i;
	// ページ情報取得
	$pages = get_pages('sort_column=menu_order&sort_order=asc');
	$rows2 = 0;
	$i = 0;
	$data2 = array();
	foreach ($pages as $page) {
		$data2[$i]['idxxxx'] = fsmb_change_out_db($page->ID,'int');
		$data2[$i]['namexx'] = fsmb_change_out_db($page->post_title,'text');
		$i++;
	}
	$rows2 = $i;
?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"><br/></div>
	<h2>携帯の設定</h2>
	<?php if($errct1 > 0){ ?>
	<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
		<p><strong>入力に誤りがあります</strong></p>
		<ul>
		<?php for($i=0; !empty($errmg1[$i]); $i++){ ?>
		<li><?php fsmb_change_html($errmg1[$i]); ?></li>
		<?php } ?>
		</ul>
	</div>
	<?php }elseif(isset($_POST['btnxxx']) == true){ ?>
	<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
		<p><strong>設定を保存しました</strong></p>
	</div>
	<?php } ?>
	<form method="post" action="<?php fsmb_change_html($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
		<input type="hidden" name="action" value="update" />
		現在のテーマ <b><?php fsmb_change_html($ctheme); ?></b> の携帯を設定します。<br>
		<h3>基本設定</h3>
		※会社ロゴの画像ファイルは()内のファイル名に変更してから選択してください。<br>
		幅250pixcel以内を推奨します。<br>
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="logoxx">会社ロゴ(携帯用)<br>(irogo.jpg)</label></th>
			<td><input id="logoxx" type="file" size="60" maxlength="30" value="" name="logoxx"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="allszx">サイト全体のフォントのサイズ</label></th>
			<td>
			<select id="allszx" class="postform" name="allszx">
			<option <?php if($allszx == 1){ ?>selected="selected"<?php } ?> value="1">1(最小)</option>
			<option <?php if($allszx == 2){ ?>selected="selected"<?php } ?> value="2">2</option>
			<option <?php if($allszx == 3){ ?>selected="selected"<?php } ?> value="3">3</option>
			<option <?php if($allszx == 4){ ?>selected="selected"<?php } ?> value="4">4(最大)</option>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="mntopx">トップページのメニュー階層</label></th>
			<td>
			<select id="mntopx" class="postform" name="mntopx">
			<option <?php if($mntopx == 0){ ?>selected="selected"<?php } ?> value="0">すべて</option>
			<option <?php if($mntopx == 1){ ?>selected="selected"<?php } ?> value="1">1(標準)</option>
			<option <?php if($mntopx == 2){ ?>selected="selected"<?php } ?> value="2">2</option>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="mnsubx">各ページのメニュー階層</label></th>
			<td>
			<select id="mnsubx" class="postform" name="mnsubx">
			<option <?php if($mnsubx == 0){ ?>selected="selected"<?php } ?> value="0">すべて(標準)</option>
			<option <?php if($mnsubx == 1){ ?>selected="selected"<?php } ?> value="1">1</option>
			<option <?php if($mnsubx == 2){ ?>selected="selected"<?php } ?> value="2">2</option>
			</select>
			</td>
		</tr>
		</tr>
		</tbody>
		</table>
		<h3>画像の設定</h3>
		※携帯画像は、サイズ縮小されて表示されます。<br />
		※縮小可能な画像はWordPress標準の場所(wp-content/uploads)に保存されたjpg,png,gif形式の画像のみです。<br>
		それ以外の場所に保存された画像は表示されません。<br />
		<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="imgflg">画像を表示する</label></th>
			<td><fieldset><input id="imgflg" type="checkbox" value="1"<?php if ($imgflg){ ?> checked="checked"<?php } ?> name="imgflg" /></fieldset></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="imgszx">表示する画像の最大サイズ</label></th>
			<td>
			<select id="imgszx" class="postform" name="imgszx">
			<option <?php if($imgszx == 50){ ?>selected="selected"<?php } ?> value="50">50pixcel(最小)</option>
			<option <?php if($imgszx == 100){ ?>selected="selected"<?php } ?> value="100">100pixcel</option>
			<option <?php if($imgszx == 150){ ?>selected="selected"<?php } ?> value="150">150pixcel</option>
			<option <?php if($imgszx == 200){ ?>selected="selected"<?php } ?> value="200">200pixcel(最大)</option>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="imgqtx">表示する画質</label></th>
			<td>
			<select id="imgqtx" class="postform" name="imgqtx">
			<option <?php if($imgqtx == 10){ ?>selected="selected"<?php } ?> value="10">10%</option>
			<option <?php if($imgqtx == 20){ ?>selected="selected"<?php } ?> value="20">20%</option>
			<option <?php if($imgqtx == 30){ ?>selected="selected"<?php } ?> value="30">30%</option>
			<option <?php if($imgqtx == 40){ ?>selected="selected"<?php } ?> value="40">40%</option>
			<option <?php if($imgqtx == 50){ ?>selected="selected"<?php } ?> value="50">50%</option>
			<option <?php if($imgqtx == 60){ ?>selected="selected"<?php } ?> value="60">60%</option>
			<option <?php if($imgqtx == 70){ ?>selected="selected"<?php } ?> value="70">70%(標準)</option>
			<option <?php if($imgqtx == 80){ ?>selected="selected"<?php } ?> value="80">80%</option>
			<option <?php if($imgqtx == 90){ ?>selected="selected"<?php } ?> value="90">90%</option>
			<option <?php if($imgqtx == 100){ ?>selected="selected"<?php } ?> value="100">100%</option>
			</select>
			</td>
		</tr>
		</tbody>
		</table>
		<h3>新着情報の設定</h3>
		※トップページの新着情報をカテゴリ指定で表示できます。<br />
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="ns1flg">利用する</label></th>
			<td><fieldset><input id="ns1flg" type="checkbox" value="1"<?php if ($ns1flg){ ?> checked="checked"<?php } ?> name="ns1flg" /></fieldset></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns1ttl">表示するタイトル</label></th>
			<td><input id="ns1ttl" class="regular-text" type="text" size="40" maxlength="30" value="<?php fsmb_change_html($ns1ttl); ?>" name="ns1ttl"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns1cnt">表示する件数</label></th>
			<td><input id="ns1cnt" class="small-text" type="text" size="3" maxlength="2" value="<?php fsmb_change_html($ns1cnt); ?>" name="ns1cnt"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns1cat">表示するカテゴリー</label></th>
			<td>
			<select id="ns1cat" class="postform" name="ns1cat">
			<option class="level-0" value="0">すべて</option>
			<?php for($i=0; $i<$rows1; $i++){ ?>
			<option class="level-0" <?php if($data1[$i]['idxxxx'] == $ns1cat){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data1[$i]['idxxxx']);?>"><?php fsmb_change_html($data1[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		</tbody>
		</table>
		<h3>自動リンクの設定</h3>
		※設定した電話番号もしくはメールアドレスが本文中にあると携帯リンクで表示されます。<br />
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="atelxx">電話番号</label></th>
			<td><input id="atelxx" class="regular-text" type="text" size="40" maxlength="20" value="<?php fsmb_change_html($atelxx); ?>" name="atelxx"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="amailx">メールアドレス</label></th>
			<td><input id="amailx" class="regular-text" type="text" size="40" maxlength="100" value="<?php fsmb_change_html($amailx); ?>" name="amailx"/></td>
		</tr>
		</tbody>
		</table>
		<h3>お問い合わせの設定</h3>
		※設定したページがメニュー選択されますと自動でメールアドレスを表示します。<br />
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="ipagex">設定するページ</label></th>
			<td>
			<select id="ipagex" class="postform" name="ipagex">
			<option <?php if(0 == $ipagex){ ?>selected="selected"<?php } ?> value="0">利用しない</option>
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $ipagex){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="imailx">お問い合わせメールアドレス</label></th>
			<td><input id="imailx" class="regular-text" type="text" size="40" maxlength="100" value="<?php fsmb_change_html($imailx); ?>" name="imailx"/></td>
		</tr>
		</table>
		<h3>Google マップの設定</h3>
		※携帯用Googleマップを表示できます。<br>
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="gposxx">位置情報</label></th>
			<td><input id="gposxx" class="regular-text" type="text" size="40" maxlength="40" value="<?php fsmb_change_html($gposxx); ?>" name="gposxx"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="gzoomx">倍率</label></th>
			<td>
			<select id="gzoomx" class="postform" name="gzoomx">
			<option <?php if($gzoomx == 17){ ?>selected="selected"<?php } ?> value="17">1(最大)</option>
			<option <?php if($gzoomx == 16){ ?>selected="selected"<?php } ?> value="16">2</option>
			<option <?php if($gzoomx == 15){ ?>selected="selected"<?php } ?> value="15">3</option>
			<option <?php if($gzoomx == 14){ ?>selected="selected"<?php } ?> value="14">4(最小)</option>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="gszxxx">表示する画像のサイズ</label></th>
			<td>
			<select id="gszxxx" class="postform" name="gszxxx">
			<option <?php if($gszxxx == 100){ ?>selected="selected"<?php } ?> value="100">100(最小)</option>
			<option <?php if($gszxxx == 150){ ?>selected="selected"<?php } ?> value="150">150</option>
			<option <?php if($gszxxx == 200){ ?>selected="selected"<?php } ?> value="200">200</option>
			<option <?php if($gszxxx == 250){ ?>selected="selected"<?php } ?> value="250">250(最大)</option>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="gkeyxx">GoogleマップのAPIキー</label></th>
			<td><input id="gkeyxx" class="regular-text" type="text" size="40" maxlength="200" value="<?php fsmb_change_html($gkeyxx); ?>" name="gkeyxx"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="gpagex">表示するページ</label></th>
			<td>
			<select id="gpagex" class="postform" name="gpagex">
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $gpagex){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		</tbody>
		</table>
		<h3>アクセス制御の設定</h3>
		※携帯で表示させたくないページを指定できます。<br />
		※フォームやオリジナルテンプレートを利用したページは動作しないため、こちらで指定してメニューからはずすことができます。<br />
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="mnoff1">表示しないページ1</label></th>
			<td>
			<select id="mnoff1" class="postform" name="mnoff1">
			<option <?php if(0 == $mnoff1){ ?>selected="selected"<?php } ?> value="0">利用しない</option>
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $mnoff1){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="mnoff2">表示しないページ2</label></th>
			<td>
			<select id="mnoff2" class="postform" name="mnoff2">
			<option <?php if(0 == $mnoff2){ ?>selected="selected"<?php } ?> value="0">利用しない</option>
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $mnoff2){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="mnoff3">表示しないページ3</label></th>
			<td>
			<select id="mnoff3" class="postform" name="mnoff3">
			<option <?php if(0 == $mnoff3){ ?>selected="selected"<?php } ?> value="0">利用しない</option>
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $mnoff3){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="mnoff4">表示しないページ4</label></th>
			<td>
			<select id="mnoff4" class="postform" name="mnoff4">
			<option <?php if(0 == $mnoff4){ ?>selected="selected"<?php } ?> value="0">利用しない</option>
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $mnoff4){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="mnoff5">表示しないページ5</label></th>
			<td>
			<select id="mnoff5" class="postform" name="mnoff5">
			<option <?php if(0 == $mnoff5){ ?>selected="selected"<?php } ?> value="0">利用しない</option>
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $mnoff5){ ?>selected="selected"<?php } ?> value="<?php fsmb_change_html($data2[$i]['idxxxx']);?>"><?php fsmb_change_html($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		</table>
		<p class="submit"><input class="button-primary" type="submit" value="設定" name="btnxxx"/></p>
	</form>
</div>
<?php
}
// 携帯画面表示処理
function fsmb_response_mobile() {
	// キャリア判別と絵文字設定
	$agentx = $_SERVER['HTTP_USER_AGENT'];
	$typexx = -1;
	$emoji = array();
	if(preg_match('!^DoCoMo/1!', $agentx) || 
		preg_match('!^DoCoMo/2!', $agentx)){
		$typexx = 0;
		$emoji = array('&#xE6EB;','&#xE6E2;','&#xE6E3;','&#xE6E4;','&#xE6E5;','&#xE6E6;','&#xE6E7;','&#xE6E8;','&#xE6E9;','&#xE6EA;',
						'&#xE683;','&#xE663;','&#xE71A;','&#xE6D3;');
	}elseif( preg_match('!^J-(PHONE|EMULATOR)/!', $agentx) || 
		preg_match('!^(Vodafone/|MOT(EMULATOR)?-[CV]|SoftBank/|[VS]emulator/)!', $agentx) || 
		preg_match('/iPhone/', $agentx)){
		$typexx = 1;
		$emoji = array('$FE','$F<','$F=','$F>','$F?','$F@','$FA','$FB','$FC','$FD',
						'$Eh','$GV','$E.','$E#');
	}elseif(preg_match('/^KDDI-/', $agentx) || 
		preg_match('/^UP\.Browser/', $agentx)){
		$typexx = 2;
		$emoji = array('&#xE5AC;','&#xE522;','&#xE523;','&#xE524;','&#xE525;','&#xE526;','&#xE527;','&#xE528;','&#xE529;','&#xE52A;',
						'&#xE49F;','&#xE4AB;','&#xE5C9;','&#xE521;');
	}
	if($typexx < 0){
		return true;
	}
	// 携帯出力
	mb_http_output("sjis-win");
	ob_start("mb_output_handler");
	$sizexx = fsmb_change_out_db(get_option('fsmb_all_size'),'int');
	add_filter('the_content',  'fsmb_the_content',46);
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS" />
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo(''); ?></title>
<body>
<?php
if(is_home()){ 
	////////// トップページ //////////
	if($_POST['search'] != ''){
		$search = fsmb_change_request($_POST['search'],'text');
		$wordxx = mb_convert_encoding($search, 'UTF-8','sjis-win');
		header("HTTP/1.1 301 Moved Permanently"); 
		header(sprintf("Location: %s/?s=%s",get_option('home'),$wordxx)); 
		exit;
	}
?>
<center>
<a href="<?php bloginfo('home'); ?>/"><img src="/wp-content/uploads/irogo.jpg" alt="<?php bloginfo('name'); ?>" border="0"></a><br>
<form action="/" method="post">
<input type="text" name="search" size="15" value=""/>
<input type="submit" value="検索"/>
</form>
<br>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>タグで検索</b></font></td>
</tr>
</table>
<?php
	$tags = get_tags();
	foreach($tags as $tag){
		$tgidxx = fsmb_change_out_db($tag->term_id,'int');
		$tagnmx = fsmb_change_out_db($tag->name,'text');
?>
<a href="<?php fsmb_change_html(get_tag_link($tgidxx)) ?>"><font size="<?php fsmb_change_html($sizexx); ?>"><?php fsmb_change_html($tag->name); ?></font></a> 
<?php
	}
?>
</center>
<br>
<!-- whatsnew -->
<?php 
	if (have_posts()){
		$flgxxx = fsmb_change_out_db(get_option('fsmb_news1_flg'),'int');
		if($flgxxx > 0){
			$titlex = fsmb_change_out_db(get_option('fsmb_news1_title'),'text');
			if($titlex !=''){?>
<table cellspacing="0" border="0" bgcolor="#ff9900" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b><?php fsmb_change_html($titlex); ?></b></font></td>
</tr>
</table>
<?php
			}
			$catcdx = fsmb_change_out_db(get_option('fsmb_news1_category'),'int');
			$cntxxx = fsmb_change_out_db(get_option('posts_per_page'),'int');
			if($catcdx > 0){
				$data2 = query_posts("cat=$catcdx&showposts=-1&offset=0&orderby=date&order=DESC"); // カテゴリー指定あり
			}else{
				$data2 = query_posts("showposts=-1&offset=0&orderby=date&order=DESC"); // すべて
			}
			$ns1max = count($data2);
			if(isset($_GET['ns1pgx']) == false){
				$ns1pgx = 1;
				$offset = 0;
			}else{
				$ns1pgx = fsmb_change_request($_GET['ns1pgx'],'int');
				$offset = ($ns1pgx - 1) * $cntxxx;
			}
			query_posts("cat=$catcdx&showposts=$cntxxx&offset=$offset&orderby=date&order=DESC");
?>
<?php while (have_posts()) : the_post(); ?>
<font size="<?php fsmb_change_html($sizexx); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>(<?php the_time('y/m/d')?>)</font><br>
<?php endwhile; ?>
<br>
<?php if($ns1pgx > 1){$pagexx = $ns1pgx - 1; ?><a href="./?ns1pgx=<?php fsmb_change_html($pagexx); ?>"><font size="<?php fsmb_change_html($sizexx); ?>">新しい記事を読む</font></a><br><?php } ?>
<?php if(($offset + $cntxxx) < $ns1max){$pagexx = $ns1pgx + 1; ?><a href="./?ns1pgx=<?php fsmb_change_html($pagexx); ?>"><font size="<?php fsmb_change_html($sizexx); ?>">過去の記事を読む</font></a><br><?php } ?>
<?php
		}
	}
?>
<!-- whatsnew end -->
<br>
<!-- menu -->
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
$mntopx = fsmb_change_out_db(get_option('fsmb_menu_top'),'int');
$mnoff1 = fsmb_change_out_db(get_option('fsmb_menu_off1'),'int');
$mnoff2 = fsmb_change_out_db(get_option('fsmb_menu_off2'),'int');
$mnoff3 = fsmb_change_out_db(get_option('fsmb_menu_off3'),'int');
$mnoff4 = fsmb_change_out_db(get_option('fsmb_menu_off4'),'int');
$mnoff5 = fsmb_change_out_db(get_option('fsmb_menu_off5'),'int');

if($mntopx == 0){
	$pages1 = get_pages('sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = fsmb_change_out_db($page1x->ID,'int');
		$pg1ttl = fsmb_change_out_db($page1x->post_title,'text');
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo get_page_link($pg1idx); ?>"><font size="<?php fsmb_change_html($sizexx); ?>"><?php fsmb_change_html($pg1ttl); ?></font></a><br>
<?php
		}
	}
}elseif($mntopx == 1){
	$pages1 = get_pages('parent=0&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = fsmb_change_out_db($page1x->ID,'int');
		$pg1ttl = fsmb_change_out_db($page1x->post_title,'text');
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff && $pg1idx != $mnoff4 && $pg1idx != $mnoff53){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo get_page_link($pg1idx); ?>"><font size="<?php fsmb_change_html($sizexx); ?>"><?php fsmb_change_html($pg1ttl); ?></font></a><br>
<?php
		}
	}
}elseif($mntopx == 2){
	$pages1 = get_pages('parent=0&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = fsmb_change_out_db($page1x->ID,'int');
		$pg1ttl = fsmb_change_out_db($page1x->post_title,'text');
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo get_page_link($pg1idx); ?>"><font size="<?php fsmb_change_html($sizexx); ?>"><?php fsmb_change_html($pg1ttl); ?></font></a><br>
<?php
			$pages2 = get_pages('child_of='.$pg1idx.'&sort_column=menu_order&sort_order=asc');
			foreach($pages2 as $page2x) {
				$pg2idx = fsmb_change_out_db($pg2idx,'int');
				$pg2ttl = fsmb_change_out_db($page2x->post_title,'text');
				if ($page2x->post_parent != $pg1idx) continue;
				if($pg2idx != $mnoff1 && $pg2idx != $mnoff2 && $pg2idx != $mnoff3 && $pg2idx != $mnoff4 && $pg2idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo get_page_link($pg2idx); ?>"><font size="<?php fsmb_change_html($sizexx); ?>"><?php fsmb_change_html($pg2ttl); ?></font></a><br>
<?php
				}
			}
		}
	}
}
?>
<!-- menu end -->
<?php
}elseif(is_page()){ 
	////////// 固定ページ //////////
	$gposxx = fsmb_change_out_db(get_option('fsmb_google_map_markers'),'text');
	$gzoomx = fsmb_change_out_db(get_option('fsmb_google_map_zoom'),'int');
	$gszxxx = fsmb_change_out_db(get_option('fsmb_google_map_size'),'int');
	$gkeyxx = fsmb_change_out_db(get_option('fsmb_google_map_key'),'text');
	$gpagex = fsmb_change_out_db(get_option('fsmb_google_map_page'),'int');
	$ipagex = fsmb_change_out_db(get_option('fsmb_inquiry_page'),'int');
	$mnoff1 = fsmb_change_out_db(get_option('fsmb_menu_off1'),'int');
	$mnoff2 = fsmb_change_out_db(get_option('fsmb_menu_off2'),'int');
	$mnoff3 = fsmb_change_out_db(get_option('fsmb_menu_off3'),'int');
	$mnoff4 = fsmb_change_out_db(get_option('fsmb_menu_off4'),'int');
	$mnoff5 = fsmb_change_out_db(get_option('fsmb_menu_off5'),'int');
	$imailx = fsmb_change_out_db(get_option('fsmb_inquiry_mail'),'text');
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<?php if (have_posts()){ while (have_posts()) : the_post(); global $id; $id = fsmb_change_out_db($id,'int'); ?>
<?php if($id == $ipagex && $ipagex > 0 && $imailx !=''){?>
<a href="mailto:<?php fsmb_change_html($imailx); ?>"><font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[13]; ?><?php fsmb_change_html($imailx); ?></font></a><br>
<?php }elseif(($id == $mnoff1 && $mnoff1 > 0) || ($id == $mnoff2 && $mnoff2 > 0) || ($id == $mnoff3 && $mnoff3 > 0) || ($id == $mnoff4 && $mnoff4 > 0) || ($id == $mnoff5 && $mnoff5 > 0)){ ?>
<font size="<?php fsmb_change_html($sizexx); ?>">携帯で表示できません。</font><br>
<?php }else{ ?>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[12]; ?><?php the_title(); ?></font>
<hr color="#959fff" />
<br>
<font size="<?php fsmb_change_html($sizexx); ?>"><?php the_content(); ?></font>
<?php if($id == $gpagex && $gposxx != '' && $gkeyxx != ''){ ?>
<img src="http://maps.google.com/staticmap?markers=<?php fsmb_change_html($gposxx); ?>,red&zoom=<?php fsmb_change_html($gzoomx); ?>&size=<?php fsmb_change_html($gszxxx); ?>x<?php fsmb_change_html($gszxxx); ?>&maptype=mobile&key=<?php fsmb_change_html($gkeyxx); ?>"><br>
<?php } ?>
<?php } ?>
<br>
<?php endwhile; } ?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
$mntopx = fsmb_change_out_db(get_option('fsmb_menu_top'),'int');
$mnsubx = fsmb_change_out_db(get_option('fsmb_menu_sub'),'int');
$mnoff1 = fsmb_change_out_db(get_option('fsmb_menu_off1'),'int');
$mnoff2 = fsmb_change_out_db(get_option('fsmb_menu_off2'),'int');
$mnoff3 = fsmb_change_out_db(get_option('fsmb_menu_off3'),'int');
$mnoff4 = fsmb_change_out_db(get_option('fsmb_menu_off4'),'int');
$mnoff5 = fsmb_change_out_db(get_option('fsmb_menu_off5'),'int');

if($mnsubx == 0){
	$pages1 = get_pages('child_of='.$id.'&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = fsmb_change_out_db($page1x->ID,'int');
		$pg1ttl = fsmb_change_out_db($page1x->post_title,'text');
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■<a href="<?php echo get_page_link($pg1idx); ?>"><?php fsmb_change_html($pg1ttl); ?></a></font><br>
<?php
		}
	}
}elseif($mnsubx == 1){
	$pages1 = get_pages('child_of='.$id.'&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = fsmb_change_out_db($page1x->ID,'int');
		$pg1ttl = fsmb_change_out_db($page1x->post_title,'text');
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■<a href="<?php echo get_page_link($pg1idx); ?>"><?php fsmb_change_html($pg1ttl); ?></a></font><br>
<?php
		}
	}
}elseif($mnsubx == 2){
	$pages1 = get_pages('child_of='.$id.'&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = fsmb_change_out_db($page1x->ID,'int');
		$pg1ttl = fsmb_change_out_db($page1x->post_title,'text');
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■<a href="<?php echo get_page_link($pg1idx); ?>"><?php fsmb_change_html($pg1ttl); ?></a></font><br>
<?php
			$pages2 = get_pages('child_of='.$pg1idx.'&sort_column=menu_order&sort_order=asc');
			foreach($pages2 as $page2x) {
				$pg2idx = fsmb_change_out_db($pg2idx,'int');
				$pg2ttl = fsmb_change_out_db($page2x->post_title,'text');
				if ($page2x->post_parent != $pg1idx) continue;
				if($pg2idx != $mnoff1 && $pg2idx != $mnoff2 && $pg2idx != $mnoff3 && $pg2idx != $mnoff4 && $pg2idx != $mnoff5){
?>
<font size="<?php fsmb_change_html($sizexx); ?>" color="#959FFF">■<a href="<?php echo get_page_link($pg2idx); ?>"><?php fsmb_change_html($pg2ttl); ?></a></font><br>
<?php
				}
			}
		}
	}
}
?>
<?php
 }elseif(is_single()){
	////////// 投稿ページ //////////
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<?php if (have_posts()){ while (have_posts()) : the_post(); ?>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[12]; ?><?php the_title(); ?></font>
<hr color="#959fff" />
<br>
<font size="<?php fsmb_change_html($sizexx); ?>"><?php the_content(); ?></font>
<font size="<?php fsmb_change_html($sizexx); ?>">(<?php the_time('y/m/d G:i')?>)</font><br>
<br>
<?php endwhile; } ?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
}elseif(is_search()){
	////////// 検索ページ //////////
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>検索結果</b></font></td>
</tr>
</table>
<?php if (have_posts()){ while (have_posts()) : the_post(); ?>
<a href="<?php the_permalink() ?>"><font size="<?php fsmb_change_html($sizexx); ?>"><?php the_title(); ?></font></a><br>
<?php endwhile; ?>

<?php }else{ ?>
<font size="<?php fsmb_change_html($sizexx); ?>">見つかりませんでした。</font>
<?php } ?>
<br>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
}elseif(is_tag()){
	////////// タグページ //////////
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<?php if (have_posts()){ while (have_posts()) : the_post(); ?>
<font size="<?php fsmb_change_html($sizexx); ?>"><?php the_title(); ?></font>
<hr color="#959fff" />
<br>
<font size="<?php fsmb_change_html($sizexx); ?>"><?php the_content(); ?></font>
<br>
<?php endwhile; } ?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php fsmb_change_html($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php fsmb_change_html($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php } ?>
<br>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center">
<font size="<?php fsmb_change_html($sizexx); ?>" color="#ffffff"><b>(C) <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.<br>
All rights reserved.</b></font>
</td>
</tr>
</table>
</body>
</html>
<?php
	exit;
}
// the_contentカスタマイズ
function fsmb_the_content($htmlxx) {
	$amailx = fsmb_change_out_db(get_option('fsmb_auto_mail'),'text');
	$atelxx = fsmb_change_out_db(get_option('fsmb_auto_tel'),'text');
	$imgflg = fsmb_change_out_db(get_option('fsmb_image_flg'),'int');
	$imgszx = fsmb_change_out_db(get_option('fsmb_image_size'),'int');
	$imgqtx = fsmb_change_out_db(get_option('fsmb_image_quality'),'int');
	$htmlxx = str_replace("\t","",$htmlxx);
	if($imgflg > 0){
		$imgxxx = array();
		preg_match_all('/<img\s+[^>]*src=[\'"]([^>"]+)[\'"][^>]*\s*\/*>/i', $htmlxx, $imgxxx);
		for($i=0; $i<count($imgxxx[0]); $i++){
			$url1xx = sprintf("%s/%s",get_option('home'),get_option('upload_path'));
			$url2xx = sprintf("/%s",get_option('upload_path'));
			if(strncmp($imgxxx[1][$i],$url1xx,strlen($url1xx)) && strncmp($imgxxx[1][$i],$url2xx,strlen($url2xx))){
				$htmlxx = str_replace($imgxxx[0][$i],'',$htmlxx);
			}else{
				$finxxx = sprintf("%s/%s",get_option('upload_path'),basename($imgxxx[1][$i]));
				$foutxx = sprintf("%s/i%s",get_option('upload_path'),basename($imgxxx[1][$i]));
				if(file_exists($finxxx)){
					fsmb_thumbnail_image($finxxx,$foutxx,$imgszx,$imgszx,$imgqtx);
					$htmlxx = str_replace($imgxxx[0][$i],'<img src="/'.$foutxx.'">',$htmlxx);
				}else{
					$htmlxx = str_replace($imgxxx[0][$i],'',$htmlxx);
				}
			}
		}
	}
	$htmlxx = str_replace("</td>"," ",$htmlxx);
	$htmlxx = str_replace("</th>"," ",$htmlxx);
	$htmlxx = str_replace("<ul>","<br>\n",$htmlxx);
	$htmlxx = str_replace("</li>","<br>\n",$htmlxx);
	$htmlxx = str_replace("</tr>","<br>\n",$htmlxx);
	$htmlxx = str_replace("</p>","<br>\n",$htmlxx);
	if($imgflg > 0){
		$htmlxx = strip_tags($htmlxx,"<br><a><img>");
	}else{
		$htmlxx = strip_tags($htmlxx,"<br><a>");
	}
	if($amailx !=""){$htmlxx = str_replace($amailx,'<a href="mailto:'.$amailx.'">'.$amailx.'</a>',$htmlxx);}
	if($atelxx !=""){$htmlxx = str_replace($atelxx,'<a href="tel:'.$atelxx.'">'.$atelxx.'</a>',$htmlxx);}
	return $htmlxx;
}

//===================================================================
// 処理開始
//===================================================================
require_once('function.php');	// 共通関数
// イベント登録
register_activation_hook(__FILE__, 'fsmb_on_mobile'); 					// プラグインを有効にする
add_action('deactivate_'.plugin_basename(__FILE__), 'fsmb_off_mobile');	// プラグインを停止する
add_action('admin_menu', 'fsmb_add_menu_mobile'); 						// サブメニュー追加
add_action('template_redirect', 'fsmb_response_mobile',1);				// 携帯表示

?>