<?php
class html_helpers{
	public static function url($options=null) {
		if($options=='/')
			return 'index.php';
		global $cn, $app;
		if(!isset($options['ctl'])) {
			$options['ctl'] = $cn;
			//$options['ctl'] = $app['ctl'];
		}
		$act = '';
		if(isset($options['act'])) {
			$act = '&act='.$options['act'];
			//$options['act'] = $app['act'];
		}
		$params = '';
		if(isset($options['params']) and $options['params']) {
			foreach($options['params'] as $k=>$v) {
				$params .= '&'.$k.'='.$v;
			}
		}
		return 'index.php?ctl='.$options['ctl'].$act.$params;
	}

	public static function _media($buffer) {
		global $obMediaFiles;

		$content = $buffer;

		$cssFiles = "";
		if(isset($obMediaFiles['css']) && count($obMediaFiles['css'])) {
			foreach( $obMediaFiles['css'] as $css) {
				$cssFiles .= '<link href="'.$css.'" rel="stylesheet">';
			}
		}
		$content = str_replace("CSSABOVE", $cssFiles, $content);

		$jsFiles = "";
		if(isset($obMediaFiles['js']) && count($obMediaFiles['js'])) {
			foreach( $obMediaFiles['js'] as $js) {
				$jsFiles .= '<script src="'.$js.'"></script>';
			}
		}
		$content = str_replace("JSBOTTOM", $jsFiles, $content);

		return $content;
	}

	public static function utf8tourl($text){
        $text = strtolower(self::utf8convert($text));
        $text = str_replace( "ß", "ss", $text);
        $text = str_replace( "%", "", $text);
        $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
        $text = str_replace(array('%20', ' '), '-', $text);
        $text = str_replace("----","-",$text);
        $text = str_replace("---","-",$text);
        $text = str_replace("--","-",$text);
        $text = str_replace(":","",$text);
        $text = str_replace("'","",$text);
        $text = preg_replace("/(\')/","",$text);

		return $text;
	}

	public static function utf8convert($str) {
		if(!$str) return false;
		$utf8 = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'd'=>'đ|Đ',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ');
		foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
		return $str;
	}

	public static function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\:|\')/", '', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}

	public static function cssHeader() {
		global $mediaFiles;
		$cssFiles = "";
		if(isset($mediaFiles['css']) && count($mediaFiles['css'])) {
			foreach( $mediaFiles['css'] as $css) {
				$cssFiles .= '<link href="'.$css.'" rel="stylesheet">';
			}
		}
		return $cssFiles;
	}

	public static function jsFooter() {
		global $mediaFiles;

		$jsFiles = "";
		if(isset($mediaFiles['js']) && count($mediaFiles['js'])) {
			foreach( $mediaFiles['js'] as $js) {
				$jsFiles .= '<script src="'.$js.'"></script>';
			}
		}
		return $jsFiles;
	}

	public static function header($layout, $options=null) {
		include_once 'views/layout/'.$layout.'header.php';
	}

	public static function footer($layout, $options=null) {
		include_once 'views/layout/'.$layout.'footer.php';
	}
}
?>
