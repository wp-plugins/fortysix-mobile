<?php
/* ===================================================================
 *  @function
 *  共通関数
 * ===================================================================
*/
function mb_req_check($valuex,$namexx,$typexx,$onxxxx,$maxlen,&$errcnt,&$errmsg){

	if(get_magic_quotes_gpc() == 1){
		$valuex = stripslashes($valuex);
	}
	if($onxxxx == true && $valuex == ''){
		$errmsg[] = sprintf('%sが未入力です。',$namexx);
		++$errcnt;
	}elseif($valuex != '' && $maxlen < mb_strlen($valuex)){
		$errmsg[] = sprintf('%sは%d文字以内を入力してください。',$namexx,$maxlen);
		++$errcnt;
	}elseif($valuex != ''){
		switch($typexx){
		case 'text':
			break;
		case 'int':
			if(is_numeric($valuex) == false || preg_match('/^[0-9]+$/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'int2':
			if(is_numeric($valuex) == false || preg_match('/^[0-9]+/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			if($valuex == 0){
				$errmsg[] = sprintf('%sは0以上を入力してください。',$namexx);
				++$errcnt;
			}
			break;
		case 'double':
			if(is_numeric($valuex) == false || preg_match('/^[0-9]+\.[0-9]+$/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'mail':
			if(preg_match('/^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([0-9a-zA-Z]+[-._+&])+[a-zA-Z]{2,6}$/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'password':
			if(mb_strlen($valuex) < 5){
				$errmsg[] = sprintf('%sは5文字以上を入力してください。',$namexx);
				++$errcnt;
			}
			if(preg_match('/^[0-9a-zA-Z]+$/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'phone':
			if(preg_match('/^0[0-9]+-[0-9]+-[0-9]+$/', $valuex) == false && preg_match('/^0[0-9]+$/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'post':
			$valuex = mb_convert_kana(mb_ereg_replace('―|ー|－|‐','-',$valuex),'n');
			if(preg_match('/^[0-9]+-[0-9]+$/', $valuex) == false && preg_match('/^[0-9]+$/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'address':
			$addrxx = array(
			'北海道',
			'青森県','岩手県','宮城県','秋田県','山形県','福島県',
			'茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県',
			'新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県',
			'三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県',
			'鳥取県','島根県','岡山県','広島県','山口県',
			'徳島県','香川県','愛媛県','高知県',
			'福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県',
			'沖縄県'
			);
			if(in_array($valuex,$addrxx) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'date':
			list($yearxx,$mthxxx,$dayxxx) = sscanf($valuex,'%04d-%02d-%02d');
			if(checkdate($mthxxx,$dayxxx,$yearxx) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			break;
		case 'money':
			if(is_numeric($valuex) == false || preg_match('/^[0-9]+/', $valuex) == false){
				$errmsg[] = sprintf('%sの入力に誤りがあります。',$namexx);
				++$errcnt;
			}
			if($valuex == 0){
				$errmsg[] = sprintf('%sは0以上を入力してください。',$namexx);
				++$errcnt;
			}
			break;
		default:
			$errmsg[] = 'mb_req_check error';
			++$errcnt;
		}
	}else{
	}
	return true;
}
function mb_req_escape($valuex,$typexx){

	$outxxx = '';
	if(get_magic_quotes_gpc() == 1){
		$valuex = stripslashes($valuex);
	}
	switch($typexx){
	case 'text':
		$outxxx = $valuex;
		break;
	case 'int':
		if(is_numeric($valuex) == true){
			$outxxx = sprintf('%d',intval($valuex));
		}
		break;
	case 'post':
		$valuex = mb_convert_kana(mb_ereg_replace('―|ー|－|‐','-',$valuex),'n');
		if(preg_match('/^[0-9]+-[0-9]+$/',$valuex) == true){
			$postxx = array();
			$postxx = explode('-',$valuex);
			$outxxx = sprintf('%03d-%04d',intval($postxx[0]),intval($postxx[1]));
		}else{
			$outxxx = sprintf('%03d-%04d',intval(mb_substr($valuex,0,3)),intval(mb_substr($valuex,3,4)));
		}
		break;
	case 'double':
		if(is_numeric($valuex) == true){
			$outxxx = sprintf('%s',doubleval($valuex));
		}
		break;
	default:
		$outxxx = 'mb_req_escape error';
	}
	return $outxxx;
}
function mb_html_escape($valuex,$typexx = 'text',$chrset = 'UTF-8'){

	$outxxx = '';
	if($valuex == ''){
		$outxxx = '';
	}elseif($valuex != ''){
		switch($typexx){
		case 'text':
			$outxxx = htmlspecialchars($valuex,ENT_QUOTES,$chrset);
			break;
		case 'textarea':
			$outxxx = nl2br(htmlspecialchars($valuex,ENT_QUOTES,$chrset));
			break;
		case 'html':
			$outxxx = htmlentities($valuex,ENT_QUOTES,$chrset);
			break;
		case 'free':
			$outxxx = $valuex;
			break;
		case 'freearea':
			$outxxx = nl2br($valuex);
			break;
		default:
			$outxxx = 'mb_html_escape error';
		}
	}
	return $outxxx;
}
function mb_db_escape($valuex,$typexx){

	$outxxx = '';
	$valuex = addslashes($valuex);
	switch ($typexx) {
	case 'text':
		if($valuex == ''){
			$outxxx = '';
		}else{
			$outxxx = $valuex;
		}
		break;
	case 'int':
		if(is_numeric($valuex) == false){
			$outxxx = '';
		}else{
			$outxxx = intval($valuex);
		}
		break;
	case 'double':
		if(is_numeric($valuex) == false){
			$outxxx = '';
		}else{
			$outxxx = doubleval($valuex);
		}
		break;
	case 'date' :
		if($valuex == ''){
			$outxxx = '';
		}else{
			$outxxx = $valuex;
		}
		break;
	case 'password' :
		if($valuex == ''){
			$outxxx = '';
		}else{
			$outxxx = md5($valuex);
		}
		break;
	default:
		$outxxx = 'function ms_db_escape() error';
	}
	return $outxxx;
}
function mb_image_ratio($inxxxx,$widmax,$heimax,$wid1xx,$hei1xx){

	if($widmax == '' || $heimax == ''){
		return false;
	}
	$sizexx = @getimagesize($inxxxx);
	if($sizexx == false){
		return false;
	}
	if($sizexx[0] > $widmax){
		$wid1xx = $widmax;
		$hei1xx = $widmax * $sizexx[1] / $sizexx[0];
		$hei1xx = (int)$hei1xx;
	}else{
		$wid1xx = $sizexx[0];
		$hei1xx = $sizexx[1];
	}
	if($hei1xx > $heimax){
		$hei1xx = $heimax;
		$wid1xx = $heimax * $sizexx[0] / $sizexx[1];
		$wid1xx = (int)$wid1xx;
	}
}
function mb_image_thumbnail($finxxx,&$foutxx,$widmax,$heimax,$qualxx){
	$sizexx = @getimagesize($finxxx);
	if($sizexx == false){return false;}
	$widxxx = 0;
	$heixxx = 0;
	if($sizexx[0] > $widmax){
		$widxxx = $widmax;
		$heixxx = $widmax * $sizexx[1] / $sizexx[0];
		$heixxx = (int)$heixxx;
	}else{
		$widxxx = $sizexx[0];
		$heixxx = $sizexx[1];
	}
	if($heixxx > $heimax){
		$heixxx = $heimax;
		$widxxx = $heimax * $sizexx[0] / $sizexx[1];
		$widxxx = (int)$widxxx;
	}
	switch ($sizexx[2]){
	case IMAGETYPE_GIF:
		$imginx = imagecreatefromgif($finxxx);
		if($imginx == false){return false;}
		break;
	case IMAGETYPE_PNG:
		$imginx = imagecreatefrompng($finxxx);
		if($imginx == false){return false;}
		break;
	case IMAGETYPE_JPEG:
		$imginx = imagecreatefromjpeg($finxxx);
		if($imginx == false){return false;}
		break;
	}
	$imgout = imagecreatetruecolor($widxxx,$heixxx);
	if($imgout == false){return false;}
	if(function_exists('imageantialias')) {
		imageantialias($imgout, true);
	}
	imagecopyresampled($imgout,$imginx,0,0,0,0,$widxxx,$heixxx,$sizexx[0],$sizexx[1]);
	imagedestroy($imginx);
	switch ($sizexx[2]) {
	case IMAGETYPE_GIF:
		$foutxx = preg_replace('|\.gif$|i', '.jpg', $foutxx);
		$result = imagejpeg($imgout, $foutxx,$qualxx);
		if($result == false){return false;}
		break;
	case IMAGETYPE_PNG:
		$foutxx = preg_replace('|\.png$|i', '.jpg', $foutxx);
		$result = imagejpeg($imgout, $foutxx,$qualxx);
		if($result == false){return false;}
		break;
	case IMAGETYPE_JPEG:
		$result = imagejpeg($imgout, $foutxx,$qualxx);
		if($result == false){return false;}
		break;
	}
	imagedestroy($imgout);
	chmod($foutxx,0666);
	return true;
}
?>