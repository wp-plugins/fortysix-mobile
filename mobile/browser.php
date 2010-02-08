<?php
/* ===================================================================
 *  @class FsMb_Browser
 *  携帯表示処理
 * ===================================================================
*/
if ( ! class_exists('FsMb_Browser') ){

	class FsMb_Browser extends FsMb_Initial
	{
		
		function response_html()
		{
			switch ( $this->is_mobile ) {
			case 'DOCOMO':
				$emoji = array(
								'&#xE6EB;','&#xE6E2;','&#xE6E3;','&#xE6E4;','&#xE6E5;',
								'&#xE6E6;','&#xE6E7;','&#xE6E8;','&#xE6E9;','&#xE6EA;',
								'&#xE683;','&#xE663;','&#xE71A;','&#xE6D3;'
								);
				break;
			case 'SOFTBANK':
				$emoji = array(
								'$FE','$F<','$F=','$F>','$F?',
								'$F@','$FA','$FB','$FC','$FD',
								'$Eh','$GV','$E.','$E#'
								);
				break;
			case 'KDDI':
				$emoji = array(
								'&#xE5AC;','&#xE522;','&#xE523;','&#xE524;','&#xE525;',
								'&#xE526;','&#xE527;','&#xE528;','&#xE529;','&#xE52A;',
								'&#xE49F;','&#xE4AB;','&#xE5C9;','&#xE521;');
				break;
			default:
				exit;
			}

			add_filter('the_content',  array($this, 'the_content'), 46);

			$ctheme = get_current_theme();
			$sizexx = get_option('fsmb_all_size');

			mb_http_output("sjis-win");
			ob_start("mb_output_handler");
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS" />
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo(''); ?></title>
<body>
<?php
if(is_home()){ 
	////////// トップページ //////////
	if($_POST['search'] != ''){
		$search = mb_req_escape($_POST['search'],'text');
		$wordxx = mb_convert_encoding($search, 'UTF-8','sjis-win');
		header("HTTP/1.1 301 Moved Permanently"); 
		header(sprintf("Location: %s/?s=%s",get_option('home'),$wordxx)); 
		exit;
	}
?>
<center>
<a href="<?php bloginfo('home'); ?>/"><img src="/wp-content/uploads/irogo.gif" alt="<?php bloginfo('name'); ?>" border="0"></a><br>
<form action="/" method="post">
<input type="text" name="search" size="15" value=""/>
<input type="submit" value="検索"/>
</form>
<br>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>タグで検索</b></font></td>
</tr>
</table>
<?php
	$tags = get_tags();
	foreach($tags as $tag){
		$tgidxx = $tag->term_id;
		$tagnmx = $tag->name;
?>
<a href="<?php echo attribute_escape(get_tag_link($tgidxx)) ?>"><font size="<?php echo attribute_escape($sizexx); ?>"><?php echo wp_specialchars($tag->name); ?></font></a> 
<?php
	}
?>
</center>
<br>
<!-- news1 -->
<?php 
	if (have_posts()){
		$flgxxx = get_option('fsmb_news1_flg');
		if($flgxxx > 0){
			$titlex = get_option('fsmb_news1_title');
			if($titlex !=''){?>
<table cellspacing="0" border="0" bgcolor="#ff9900" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b><?php echo wp_specialchars($titlex); ?></b></font></td>
</tr>
</table>
<?php
			}
			$catcdx = get_option('fsmb_news1_category');
			$cntxxx = get_option('posts_per_page');
			if($catcdx > 0){
				$data = new WP_Query("cat=$catcdx&showposts=-1&offset=0&orderby=date&order=DESC"); // カテゴリー指定あり
			}else{
				$data = new WP_Query("showposts=-1&offset=0&orderby=date&order=DESC"); // すべて
			}
			$ns1max = count($data->posts);
			if(isset($_GET['ns1pgx']) == false){
				$ns1pgx = 1;
				$offset = 0;
			}else{
				$ns1pgx = mb_req_escape($_GET['ns1pgx'],'int');
				$offset = ($ns1pgx - 1) * $cntxxx;
			}
			$ns2pgx = mb_req_escape($_GET['ns2pgx'],'int');
			$data = new WP_Query("cat=$catcdx&showposts=$cntxxx&offset=$offset&orderby=date&order=DESC");
?>
<?php while ($data->have_posts()) : $data->the_post(); ?>
<font size="<?php echo attribute_escape($sizexx); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>(<?php the_time('y/m/d')?>)</font><br>
<?php endwhile; ?>
<?php if($ns1pgx > 1){$pagexx = $ns1pgx - 1; ?><a href="./?ns1pgx=<?php echo attribute_escape($pagexx); ?><?php if($ns2pgx > 0){echo attribute_escape(sprintf("&ns2pgx=%d",$ns2pgx)); } ?>"><font size="<?php echo attribute_escape($sizexx); ?>">新しい記事を読む</font></a><br><?php } ?>
<?php if(($offset + $cntxxx) < $ns1max){$pagexx = $ns1pgx + 1; ?><a href="./?ns1pgx=<?php echo attribute_escape($pagexx); ?><?php if($ns2pgx > 0){echo attribute_escape(sprintf("&ns2pgx=%d",$ns2pgx)); } ?>"><font size="<?php echo attribute_escape($sizexx); ?>">過去の記事を読む</font></a><br><?php } ?>
<?php
		}
	}
?>
<!-- news1 end -->
<br>
<!-- news2 -->
<?php 
	if (have_posts()){
		$flgxxx = get_option('fsmb_news2_flg');
		if($flgxxx > 0){
			$titlex = get_option('fsmb_news2_title');
			if($titlex !=''){?>
<table cellspacing="0" border="0" bgcolor="#ff9900" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b><?php echo wp_specialchars($titlex); ?></b></font></td>
</tr>
</table>
<?php
			}
			$catcdx = get_option('fsmb_news2_category');
			$cntxxx = get_option('fsmb_news2_cnt');
			if($catcdx > 0){
				$data = new WP_Query("cat=$catcdx&showposts=-1&offset=0&orderby=date&order=DESC"); // カテゴリー指定あり
			}else{
				$data = new WP_Query("showposts=-1&offset=0&orderby=date&order=DESC"); // すべて
			}
			$ns2max = count($data->posts);
			if(isset($_GET['ns2pgx']) == false){
				$ns2pgx = 1;
				$offset = 0;
			}else{
				$ns2pgx = mb_req_escape($_GET['ns2pgx'],'int');
				$offset = ($ns2pgx - 1) * $cntxxx;
			}
			$data = new WP_Query("cat=$catcdx&showposts=$cntxxx&offset=$offset&orderby=date&order=DESC");
?>
<?php while ($data->have_posts()) : $data->the_post(); ?>
<font size="<?php echo attribute_escape($sizexx); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>(<?php the_time('y/m/d')?>)</font><br>
<?php endwhile; ?>
<?php if($ns2pgx > 1){$pagexx = $ns2pgx - 1; ?><a href="./?ns2pgx=<?php echo attribute_escape($pagexx); ?><?php if($ns1pgx > 0){echo attribute_escape(sprintf("&ns1pgx=%d",$ns1pgx)); } ?>"><font size="<?php echo attribute_escape($sizexx); ?>">新しい記事を読む</font></a><br><?php } ?>
<?php if(($offset + $cntxxx) < $ns2max){$pagexx = $ns2pgx + 1; ?><a href="./?ns2pgx=<?php echo attribute_escape($pagexx); ?><?php if($ns1pgx > 0){echo attribute_escape(sprintf("&ns1pgx=%d",$ns1pgx)); } ?>"><font size="<?php echo attribute_escape($sizexx); ?>">過去の記事を読む</font></a><br><?php } ?>
<?php
		}
	}
?>
<!-- news2 end -->
<br>
<!-- menu -->
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
$mntopx = get_option('fsmb_menu_top');
$mnoff1 = get_option('fsmb_menu_off1');
$mnoff2 = get_option('fsmb_menu_off2');
$mnoff3 = get_option('fsmb_menu_off3');
$mnoff4 = get_option('fsmb_menu_off4');
$mnoff5 = get_option('fsmb_menu_off5');

if($mntopx == 0){
	$pages1 = get_pages('sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = intval($page1x->ID);
		$pg1ttl = $page1x->post_title;
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo clean_url(get_page_link($pg1idx)); ?>"><font size="<?php echo attribute_escape($sizexx); ?>"><?php echo wp_specialchars($pg1ttl); ?></font></a><br>
<?php
		}
	}
}elseif($mntopx == 1){
	$pages1 = get_pages('parent=0&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = intval($page1x->ID);
		$pg1ttl = $page1x->post_title;
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo clean_url(get_page_link($pg1idx)); ?>"><font size="<?php echo attribute_escape($sizexx); ?>"><?php echo wp_specialchars($pg1ttl); ?></font></a><br>
<?php
		}
	}
}elseif($mntopx == 2){
	$pages1 = get_pages('parent=0&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = intval($page1x->ID);
		$pg1ttl = $page1x->post_title;
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo clean_url(get_page_link($pg1idx)); ?>"><font size="<?php echo attribute_escape($sizexx); ?>"><?php echo wp_specialchars($pg1ttl); ?></font></a><br>
<?php
			$pages2 = get_pages('child_of='.$pg1idx.'&sort_column=menu_order&sort_order=asc');
			foreach($pages2 as $page2x) {
				$pg2idx = intval($page2x->ID);
				$pg2ttl = $page2x->post_title;
				if ($page2x->post_parent != $pg1idx) continue;
				if($pg2idx != $mnoff1 && $pg2idx != $mnoff2 && $pg2idx != $mnoff3 && $pg2idx != $mnoff4 && $pg2idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■</font><a href="<?php echo clean_url(get_page_link($pg2idx)); ?>"><font size="<?php echo attribute_escape($sizexx); ?>"><?php echo wp_specialchars($pg2ttl); ?></font></a><br>
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
	$gposxx = get_option('fsmb_google_map_markers');
	$gzoomx = get_option('fsmb_google_map_zoom');
	$gszxxx = get_option('fsmb_google_map_size');
	$gkeyxx = get_option('fsmb_google_map_key');
	$gpagex = get_option('fsmb_google_map_page');
	$ipagex = get_option('fsmb_inquiry_page');
	$mnoff1 = get_option('fsmb_menu_off1');
	$mnoff2 = get_option('fsmb_menu_off2');
	$mnoff3 = get_option('fsmb_menu_off3');
	$mnoff4 = get_option('fsmb_menu_off4');
	$mnoff5 = get_option('fsmb_menu_off5');
	$imailx = get_option('fsmb_inquiry_mail');
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<?php if (have_posts()){ while (have_posts()) : the_post(); global $id; $id = intval($id); ?>
<? 
if($id == $ipagex && $ipagex > 0 && $imailx !=''){?>
<a href="mailto:<?php echo attribute_escape($imailx); ?>"><font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[13]; ?><?php echo wp_specialchars($imailx); ?></font></a><br>
<? }elseif(($id == $mnoff1 && $mnoff1 > 0) || ($id == $mnoff2 && $mnoff2 > 0) || ($id == $mnoff3 && $mnoff3 > 0) || ($id == $mnoff4 && $mnoff4 > 0) || ($id == $mnoff5 && $mnoff5 > 0)){ ?>
<font size="<?php echo attribute_escape($sizexx); ?>">携帯で表示できません。</font><br>
<? }else{ ?>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[12]; ?><?php the_title(); ?></font>
<hr color="#959fff" />
<br>
<font size="<?php echo attribute_escape($sizexx); ?>"><?php the_content(); ?></font>
<?php if($id == $gpagex && $gposxx != '' && $gkeyxx != ''){ ?>
<img src="http://maps.google.com/staticmap?markers=<?php echo attribute_escape($gposxx); ?>,red&zoom=<?php echo attribute_escape($gzoomx); ?>&size=<?php echo attribute_escape($gszxxx); ?>x<?php echo attribute_escape($gszxxx); ?>&maptype=mobile&key=<?php echo attribute_escape($gkeyxx); ?>"><br>
<?php } ?>
<?php } ?>
<br>
<?php endwhile; } ?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
$mntopx = get_option('fsmb_menu_top');
$mnsubx = get_option('fsmb_menu_sub');
$mnoff1 = get_option('fsmb_menu_off1');
$mnoff2 = get_option('fsmb_menu_off2');
$mnoff3 = get_option('fsmb_menu_off3');
$mnoff4 = get_option('fsmb_menu_off4');
$mnoff5 = get_option('fsmb_menu_off5');

if($mnsubx == 0){
	$pages1 = get_pages('child_of='.$id.'&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = intval($page1x->ID);
		$pg1ttl = $page1x->post_title;
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■<a href="<?php echo clean_url(get_page_link($pg1idx)); ?>"><?php echo wp_specialchars($pg1ttl); ?></a></font><br>
<?php
		}
	}
}elseif($mnsubx == 1){
	$pages1 = get_pages('child_of='.$id.'&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = intval($page1x->ID);
		$pg1ttl = $page1x->post_title;
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■<a href="<?php echo clean_url(get_page_link($pg1idx)); ?>"><?php echo wp_specialchars($pg1ttl); ?></a></font><br>
<?php
		}
	}
}elseif($mnsubx == 2){
	$pages1 = get_pages('child_of='.$id.'&sort_column=menu_order&sort_order=asc');
	foreach($pages1 as $page1x) {
		$pg1idx = intval($page1x->ID);
		$pg1ttl = $page1x->post_title;
		if($pg1idx != $mnoff1 && $pg1idx != $mnoff2 && $pg1idx != $mnoff3 && $pg1idx != $mnoff4 && $pg1idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■<a href="<?php echo clean_url(get_page_link($pg1idx)); ?>"><?php echo wp_specialchars($pg1ttl); ?></a></font><br>
<?php
			$pages2 = get_pages('child_of='.$pg1idx.'&sort_column=menu_order&sort_order=asc');
			foreach($pages2 as $page2x) {
				$pg2idx = intval($page2x->ID);
				$pg2ttl = $page2x->post_title;
				if ($page2x->post_parent != $pg1idx) continue;
				if($pg2idx != $mnoff1 && $pg2idx != $mnoff2 && $pg2idx != $mnoff3 && $pg2idx != $mnoff4 && $pg2idx != $mnoff5){
?>
<font size="<?php echo attribute_escape($sizexx); ?>" color="#959FFF">■<a href="<?php echo clean_url(get_page_link($pg2idx)); ?>"><?php echo wp_specialchars($pg2ttl); ?></a></font><br>
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
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<?php if (have_posts()){ while (have_posts()) : the_post(); ?>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[12]; ?><?php the_title(); ?></font>
<hr color="#959fff" />
<br>
<font size="<?php echo attribute_escape($sizexx); ?>"><?php the_content(); ?></font>
<font size="<?php echo attribute_escape($sizexx); ?>">(<?php the_time('y/m/d G:i')?>)</font><br>
<br>
<?php endwhile; } ?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
}elseif(is_search()){
	////////// 検索ページ //////////
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>検索結果</b></font></td>
</tr>
</table>
<?php if (have_posts()){ while (have_posts()) : the_post(); ?>
<a href="<?php the_permalink() ?>"><font size="<?php echo attribute_escape($sizexx); ?>"><?php the_title(); ?></font></a><br>
<?php endwhile; ?>

<?php }else{ ?>
<font size="<?php echo attribute_escape($sizexx); ?>">見つかりませんでした。</font>
<?php } ?>
<br>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
}elseif(is_tag()){
	////////// タグページ //////////
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<?php if (have_posts()){ while (have_posts()) : the_post(); ?>
<font size="<?php echo attribute_escape($sizexx); ?>"><?php the_title(); ?></font>
<hr color="#959fff" />
<br>
<font size="<?php echo attribute_escape($sizexx); ?>"><?php the_content(); ?></font>
<br>
<?php endwhile; } ?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php
}elseif(is_category()){
	////////// カテゴリーページ //////////
?>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center"><a href="<?php bloginfo('home'); ?>/"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><b><?php bloginfo('name'); ?></b></font></a></td>
</tr>
</table>
<br>
<table cellspacing="0" border="0" bgcolor="#ff9900" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b><?php echo wp_specialchars(single_cat_title()); ?></b></font></td>
</tr>
</table>
<?php 
	if (have_posts()){
		$cntxxx = get_option('fsmb_category_cnt');
		$catcdx = intval(get_query_var('cat'));
		if($catcdx > 0){
			$data1 = new WP_Query("cat=$catcdx&showposts=-1&offset=0&orderby=date&order=DESC"); // カテゴリー指定あり
		}else{
			$data1 = new WP_Query("showposts=-1&offset=0&orderby=date&order=DESC"); // すべて
		}
		$ns1max = count($data1->posts);
		if(isset($_GET['ns1pgx']) == false){
			$ns1pgx = 1;
			$offset = 0;
		}else{
			$ns1pgx = mb_req_escape($_GET['ns1pgx'],'int');
			$offset = ($ns1pgx - 1) * $cntxxx;
		}
		$data = new WP_Query("cat=$catcdx&showposts=$cntxxx&offset=$offset&orderby=date&order=DESC");
?>
<?php while ($data->have_posts()) : $data->the_post(); ?>
<font size="<?php echo attribute_escape($sizexx); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>(<?php the_time('y.m.d')?>)</font><br>
<?php endwhile; ?>
<?php if($ns1pgx > 1){$pagexx = $ns1pgx - 1; ?><a href="./?ns1pgx=<?php echo attribute_escape($pagexx); ?>">新しい記事を読む</a><br><?php } ?>
<?php if(($offset + $cntxxx) < $ns1max){$pagexx = $ns1pgx + 1; ?><a href="./?ns1pgx=<?php echo attribute_escape($pagexx); ?>">過去の記事を読む</a><br><?php } ?>
<br>
<?php
		}
?>
<table cellspacing="0" border="0" bgcolor="#00cc00" width="100%">
<tr>
<td height="25"><font size="<?php echo attribute_escape($sizexx+1); ?>" color="#ffffff"><?php echo $emoji[10]; ?><b>メニュー</b></font></td>
</tr>
</table>
<font size="<?php echo attribute_escape($sizexx+1); ?>"><?php echo $emoji[11]; ?><a href="<?php bloginfo('url') ?>"><b>Home</b></a></font><br>
<?php } ?>
<br>
<table cellspacing="0" border="0" bgcolor="#959fff" width="100%">
<tr>
<td height="40" align="center">
<font size="<?php echo attribute_escape($sizexx); ?>" color="#ffffff"><b>(C) <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.<br>
All rights reserved.</b></font>
</td>
</tr>
</table>
</body>
</html>
<?php
			exit;
		}
		function the_content($htmlxx)
		{
			$amailx = get_option('fsmb_auto_mail');
			$atelxx = get_option('fsmb_auto_tel');
			$imgflg = get_option('fsmb_image_flg');
			$imgszx = get_option('fsmb_image_size');
			$imgqtx = get_option('fsmb_image_quality');
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
							mb_image_thumbnail($finxxx,$foutxx,$imgszx,$imgszx,$imgqtx);
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
	}
}
?>