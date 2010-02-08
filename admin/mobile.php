<?php
/* ===================================================================
 *  @class FsMb_Home
 *  携帯設定画面処理
 * ==================================================================
*/
if ( ! class_exists('FsMb_Mobile') ) {

	class FsMb_Mobile
	{
		function edit_mobile()
		{
			$ctheme = get_current_theme();
			if (isset($_POST['btnxxx']) == false) {
				// 初期
				$allszx = get_option('fsmb_all_size');
				$atelxx = get_option('fsmb_auto_tel');
				$amailx = get_option('fsmb_auto_mail');
				$ipagex = get_option('fsmb_inquiry_page');
				$imailx = get_option('fsmb_inquiry_mail');
				$mntopx = get_option('fsmb_menu_top');
				$mnsubx = get_option('fsmb_menu_sub');
				$mnoff1 = get_option('fsmb_menu_off1');
				$mnoff2 = get_option('fsmb_menu_off2');
				$mnoff3 = get_option('fsmb_menu_off3');
				$mnoff4 = get_option('fsmb_menu_off4');
				$mnoff5 = get_option('fsmb_menu_off5');
				$imgflg = get_option('fsmb_image_flg');
				$imgszx = get_option('fsmb_image_size');
				$imgqtx = get_option('fsmb_image_quality');
				$ns1flg = get_option('fsmb_news1_flg');
				$ns1ttl = get_option('fsmb_news1_title');
				$ns1cnt = get_option('posts_per_page');
				$ns1cat = get_option('fsmb_news1_category');
				$ns2flg = get_option('fsmb_news2_flg');
				$ns2ttl = get_option('fsmb_news2_title');
				$ns2cnt = get_option('fsmb_news2_cnt');
				$ns2cat = get_option('fsmb_news2_category');
				$gposxx = get_option('fsmb_google_map_markers');
				$gzoomx = get_option('fsmb_google_map_zoom');
				$gszxxx = get_option('fsmb_google_map_size');
				$gkeyxx = get_option('fsmb_google_map_key');
				$gpagex = get_option('fsmb_google_map_page');
			}else{
				// 設定
				global $wpdb;
				if($_FILES[logoxx][name] != ''){
					$idxxxx = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid LIKE %s", '%uploads/irogo.gif'));
					if($idxxxx > 0){wp_delete_attachment($idxxxx);}
					media_handle_upload('logoxx','');
				}
				$errct1 = 0;
				$errmg1 = array();
				mb_req_check($_POST['allszx'],'サイト全体のフォントのサイズ','int2',true,1,$errct1,$errmg1);
				mb_req_check($_POST['mntopx'],'トップページのメニュー階層','int',true,1,$errct1,$errmg1);
				mb_req_check($_POST['mnsubx'],'各ページのメニュー階層','int',true,1,$errct1,$errmg1);
				mb_req_check($_POST['imgflg'],'画像を表示する','int2',false,1,$errct1,$errmg1);
				mb_req_check($_POST['imgszx'],'表示する画像の最大サイズ','int2',true,3,$errct1,$errmg1);
				mb_req_check($_POST['imgqtx'],'表示する画質','int2',false,3,$errct1,$errmg1);
				mb_req_check($_POST['ns1flg'],'利用する(ニュース1)','int2',false,1,$errct1,$errmg1);
				if($_POST['ns1flg'] == ''){
					mb_req_check($_POST['ns1ttl'],'表示するタイトル(ニュース1)','text',false,30,$errct1,$errmg1);
					mb_req_check($_POST['ns1cnt'],'表示する件数(ニュース1)','int2',false,2,$errct1,$errmg1);
					mb_req_check($_POST['ns1cat'],'表示するカテゴリー(ニュース1)','int',true,5,$errct1,$errmg1);
				}else{
					mb_req_check($_POST['ns1ttl'],'表示するタイトル(ニュース1)','text',true,30,$errct1,$errmg1);
					mb_req_check($_POST['ns1cnt'],'表示する件数(ニュース1)','int2',true,2,$errct1,$errmg1);
					mb_req_check($_POST['ns1cat'],'表示するカテゴリー(ニュース1)','int',true,5,$errct1,$errmg1);
				}
				mb_req_check($_POST['ns2flg'],'利用する(ニュース2)','int2',false,1,$errct1,$errmg1);
				if($_POST['ns2flg'] == ''){
					mb_req_check($_POST['ns2ttl'],'表示するタイトル(ニュース2)','text',false,30,$errct1,$errmg1);
					mb_req_check($_POST['ns2cnt'],'表示する件数(ニュース2)','int2',false,2,$errct1,$errmg1);
					mb_req_check($_POST['ns2cat'],'表示するカテゴリー(ニュース2)','int',true,5,$errct1,$errmg1);
				}else{
					mb_req_check($_POST['ns2ttl'],'表示するタイトル(ニュース2)','text',true,30,$errct1,$errmg1);
					mb_req_check($_POST['ns2cnt'],'表示する件数(ニュース2)','int2',true,2,$errct1,$errmg1);
					mb_req_check($_POST['ns2cat'],'表示するカテゴリー(ニュース2)','int',true,5,$errct1,$errmg1);
				}
				mb_req_check($_POST['atelxx'],'電話番号','phone',false,20,$errct1,$errmg1);
				mb_req_check($_POST['amailx'],'メールアドレス','mail',false,100,$errct1,$errmg1);
				mb_req_check($_POST['ipagex'],'設定するページ','int',false,5,$errct1,$errmg1);
				mb_req_check($_POST['imailx'],'お問い合わせメールアドレス','mail',false,100,$errct1,$errmg1);
				mb_req_check($_POST['gposxx'],'位置情報','text',false,40,$errct1,$errmg1);
				mb_req_check($_POST['gzoomx'],'倍率','int2',false,2,$errct1,$errmg1);
				mb_req_check($_POST['gszxxx'],'表示する画像のサイズ','int2',true,3,$errct1,$errmg1);
				mb_req_check($_POST['gkeyxx'],'GoogleマップのAPIキー','text',false,200,$errct1,$errmg1);
				mb_req_check($_POST['gpagex'],'表示するページ','int2',true,5,$errct1,$errmg1);
				mb_req_check($_POST['mnoff1'],'表示しないページ1','int',true,5,$errct1,$errmg1);
				mb_req_check($_POST['mnoff2'],'表示しないページ2','int',true,5,$errct1,$errmg1);
				mb_req_check($_POST['mnoff3'],'表示しないページ3','int',true,5,$errct1,$errmg1);
				mb_req_check($_POST['mnoff4'],'表示しないページ4','int',true,5,$errct1,$errmg1);
				mb_req_check($_POST['mnoff5'],'表示しないページ5','int',true,5,$errct1,$errmg1);
				$allszx = mb_req_escape($_POST['allszx'],'int');
				$mntopx = mb_req_escape($_POST["mntopx"],'int');
				$mnsubx = mb_req_escape($_POST["mnsubx"],'int');
				$imgflg = mb_req_escape($_POST['imgflg'],'int');
				$imgszx = mb_req_escape($_POST['imgszx'],'int');
				$imgqtx = mb_req_escape($_POST['imgqtx'],'int');
				$ns1flg = mb_req_escape($_POST['ns1flg'],'text');
				$ns1ttl = mb_req_escape($_POST['ns1ttl'],'text');
				$ns1cnt = mb_req_escape($_POST['ns1cnt'],'int');
				$ns1cat = mb_req_escape($_POST['ns1cat'],'int');
				$ns2flg = mb_req_escape($_POST['ns2flg'],'text');
				$ns2ttl = mb_req_escape($_POST['ns2ttl'],'text');
				$ns2cnt = mb_req_escape($_POST['ns2cnt'],'int');
				$ns2cat = mb_req_escape($_POST['ns2cat'],'int');
				$atelxx = mb_req_escape($_POST['atelxx'],'text');
				$amailx = mb_req_escape($_POST["amailx"],'text');
				$ipagex = mb_req_escape($_POST["ipagex"],'int');
				$imailx = mb_req_escape($_POST["imailx"],'text');
				$gposxx = mb_req_escape($_POST['gposxx'],'text');
				$gzoomx = mb_req_escape($_POST['gzoomx'],'int');
				$gszxxx = mb_req_escape($_POST['gszxxx'],'int');
				$gkeyxx = mb_req_escape($_POST['gkeyxx'],'text');
				$gpagex = mb_req_escape($_POST['gpagex'],'int');
				$mnoff1 = mb_req_escape($_POST["mnoff1"],'int');
				$mnoff2 = mb_req_escape($_POST["mnoff2"],'int');
				$mnoff3 = mb_req_escape($_POST["mnoff3"],'int');
				$mnoff4 = mb_req_escape($_POST["mnoff4"],'int');
				$mnoff5 = mb_req_escape($_POST["mnoff5"],'int');
				if($errct1 == 0){
					// 更新
					update_option('fsmb_all_size', mb_db_escape($allszx,'int'));
					update_option('fsmb_menu_top', mb_db_escape($mntopx,'int'));
					update_option('fsmb_menu_sub', mb_db_escape($mnsubx,'int'));
					update_option('fsmb_image_flg', mb_db_escape($imgflg,'int'));
					update_option('fsmb_image_size', mb_db_escape($imgszx,'int'));
					update_option('fsmb_image_quality', mb_db_escape($imgqtx,'int'));
					update_option('fsmb_news1_flg', mb_db_escape($ns1flg,'int'));
					update_option('fsmb_news1_title', mb_db_escape($ns1ttl,'text'));
					update_option('posts_per_page', mb_db_escape($ns1cnt,'int'));
					update_option('fsmb_news1_category', mb_db_escape($ns1cat,'int'));
					update_option('fsmb_news2_flg', mb_db_escape($ns2flg,'int'));
					update_option('fsmb_news2_title', mb_db_escape($ns2ttl,'text'));
					update_option('fsmb_news2_cnt', mb_db_escape($ns2cnt,'int'));
					update_option('fsmb_news2_category', mb_db_escape($ns2cat,'int'));
					update_option('fsmb_auto_tel', mb_db_escape($atelxx,'text'));
					update_option('fsmb_auto_mail', mb_db_escape($amailx,'text'));
					update_option('fsmb_inquiry_page', mb_db_escape($ipagex,'int'));
					update_option('fsmb_inquiry_mail', mb_db_escape($imailx,'text'));
					update_option('fsmb_google_map_markers', mb_db_escape($gposxx,'text'));
					update_option('fsmb_google_map_zoom', mb_db_escape($gzoomx,'int'));
					update_option('fsmb_google_map_size', mb_db_escape($gszxxx,'int'));
					update_option('fsmb_google_map_key', mb_db_escape($gkeyxx,'text'));
					update_option('fsmb_google_map_page', mb_db_escape($gpagex,'int'));
					update_option('fsmb_menu_off1', mb_db_escape($mnoff1,'int'));
					update_option('fsmb_menu_off2', mb_db_escape($mnoff2,'int'));
					update_option('fsmb_menu_off3', mb_db_escape($mnoff3,'int'));
					update_option('fsmb_menu_off4', mb_db_escape($mnoff4,'int'));
					update_option('fsmb_menu_off5', mb_db_escape($mnoff5,'int'));
				}
			}
			// カテゴリ情報取得
			$categories = get_terms('category', 'orderby=ID&order=ASC');
			$rows1 = 0;
			$i = 0;
			$data1 = array();
			foreach ($categories as $category) {
				$data1[$i]['idxxxx'] = $category->term_id;
				$data1[$i]['namexx'] = $category->name;
				$i++;
			}
			$rows1 = $i;
			// ページ情報取得
			$pages = get_pages('sort_column=menu_order&sort_order=asc');
			$rows2 = 0;
			$i = 0;
			$data2 = array();
			foreach ($pages as $page) {
				$data2[$i]['idxxxx'] = $page->ID;
				$data2[$i]['namexx'] = $page->post_title;
				$i++;
			}
			$rows2 = $i;
?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"><br/></div>
	<h2>携帯の設定</h2>
<?php if ( $errct1 > 0 ) { ?>
	<div id="message" class="updated fade" style="background-color: rgb(255, 230, 230);border-color: rgb(200, 0, 0);">
		<p><strong>入力に誤りがあります</strong></p>
		<ul>
		<?php for($i=0; !empty($errmg1[$i]); $i++){ ?>
		<li><?php echo wp_specialchars($errmg1[$i]); ?></li>
		<?php } ?>
		</ul>
	</div>
<?php } elseif ( isset($_POST['btnxxx']) ) { ?>
	<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
		<p><strong>設定を保存しました</strong></p>
	</div>
<?php } ?>
	<form method="post" action="<?php echo attribute_escape($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
		<input type="hidden" name="action" value="update" />
		現在のテーマ <b><?php echo wp_specialchars($ctheme); ?></b> の携帯を設定します。<br>
		<h3>基本設定</h3>
		※会社ロゴの画像ファイルは()内のファイル名に変更してから選択してください。<br>
		幅250pixcel以内を推奨します。<br>
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="logoxx">会社ロゴ(携帯用)<br>(irogo.gif)</label></th>
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
			<td><input id="ns1ttl" class="regular-text" type="text" size="40" maxlength="30" value="<?php echo attribute_escape($ns1ttl); ?>" name="ns1ttl"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns1cnt">表示する件数</label></th>
			<td><input id="ns1cnt" class="small-text" type="text" size="3" maxlength="2" value="<?php echo attribute_escape($ns1cnt); ?>" name="ns1cnt"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns1cat">表示するカテゴリー</label></th>
			<td>
			<select id="ns1cat" class="postform" name="ns1cat">
			<option class="level-0" value="0">すべて</option>
			<?php for($i=0; $i<$rows1; $i++){ ?>
			<option class="level-0" <?php if($data1[$i]['idxxxx'] == $ns1cat){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data1[$i]['idxxxx']);?>"><?php echo wp_specialchars($data1[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		</tbody>
		</table>
		<h3>コラムの設定</h3>
		※トップページのコラムをカテゴリ指定で表示できます。<br />
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="ns2flg">利用する</label></th>
			<td><fieldset><input id="ns2flg" type="checkbox" value="1"<?php if ($ns2flg){ ?> checked="checked"<?php } ?> name="ns2flg" /></fieldset></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns2ttl">表示するタイトル</label></th>
			<td><input id="ns2ttl" class="regular-text" type="text" size="40" maxlength="30" value="<?php echo attribute_escape($ns2ttl); ?>" name="ns2ttl"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns2cnt">表示する件数</label></th>
			<td><input id="ns2cnt" class="small-text" type="text" size="3" maxlength="2" value="<?php echo attribute_escape($ns2cnt); ?>" name="ns2cnt"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="ns2cat">表示するカテゴリー</label></th>
			<td>
			<select id="ns2cat" class="postform" name="ns2cat">
			<option class="level-0" value="0">すべて</option>
			<?php for($i=0; $i<$rows1; $i++){ ?>
			<option class="level-0" <?php if($data1[$i]['idxxxx'] == $ns2cat){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data1[$i]['idxxxx']);?>"><?php echo wp_specialchars($data1[$i]['namexx']);?></option>
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
			<td><input id="atelxx" class="regular-text" type="text" size="40" maxlength="20" value="<?php echo attribute_escape($atelxx); ?>" name="atelxx"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="amailx">メールアドレス</label></th>
			<td><input id="amailx" class="regular-text" type="text" size="40" maxlength="100" value="<?php echo attribute_escape($amailx); ?>" name="amailx"/></td>
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
			<option <?php if($data2[$i]['idxxxx'] == $ipagex){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="imailx">お問い合わせメールアドレス</label></th>
			<td><input id="imailx" class="regular-text" type="text" size="40" maxlength="100" value="<?php echo attribute_escape($imailx); ?>" name="imailx"/></td>
		</tr>
		</table>
		<h3>Google マップの設定</h3>
		※携帯用Googleマップを表示できます。<br>
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="gposxx">位置情報</label></th>
			<td><input id="gposxx" class="regular-text" type="text" size="40" maxlength="40" value="<?php echo attribute_escape($gposxx); ?>" name="gposxx"/></td>
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
			<td><input id="gkeyxx" class="regular-text" type="text" size="40" maxlength="200" value="<?php echo attribute_escape($gkeyxx); ?>" name="gkeyxx"/></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="gpagex">表示するページ</label></th>
			<td>
			<select id="gpagex" class="postform" name="gpagex">
			<?php for($i=0; $i<$rows2; $i++){ ?>
			<option <?php if($data2[$i]['idxxxx'] == $gpagex){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
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
			<option <?php if($data2[$i]['idxxxx'] == $mnoff1){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
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
			<option <?php if($data2[$i]['idxxxx'] == $mnoff2){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
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
			<option <?php if($data2[$i]['idxxxx'] == $mnoff3){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
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
			<option <?php if($data2[$i]['idxxxx'] == $mnoff4){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
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
			<option <?php if($data2[$i]['idxxxx'] == $mnoff5){ ?>selected="selected"<?php } ?> value="<?php echo attribute_escape($data2[$i]['idxxxx']);?>"><?php echo wp_specialchars($data2[$i]['namexx']);?></option>
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

	}
}
?>