<?php $site_link='https://www.hneu.edu.ua/'; ?>
<?php
	function gen_token(){
		$token = md5(rand(0, PHP_INT_MAX));
		return $token;
	}
	function calculate_age($birthday) {
  		$birthday_timestamp = strtotime($birthday);
  		$age = date('Y') - date('Y', $birthday_timestamp);
  		if (date('md', $birthday_timestamp) > date('md')) {
    		$age--;
  		}
  		return $age;
	}
	function get_data($smtp_conn)
	{
	  $data="";
	  while($str = fgets($smtp_conn,515)) 
	  {
	    $data .= $str;
	    if(substr($str,3,1) == " ") { break; }
	  }
	  return $data;
	}
	function shorten_text($text, $max_length = 140, $cut_off = '...', $keep_word = false)
{
    if(strlen($text) <= $max_length) {
        return $text;
    }

    if(strlen($text) > $max_length) {
        if($keep_word) {
            $text = substr($text, 0, $max_length + 1);

            if($last_space = strrpos($text, ' ')) {
                $text = substr($text, 0, $last_space);
                $text = rtrim($text);
                $text .=  $cut_off;
            }
        } else {
            $text = substr($text, 0, $max_length);
            $text = rtrim($text);
            $text .=  $cut_off;
        }
    }

    return $text;
}
function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight) {
    if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) {
        return false;
    }

    // Массив с поддерживаемыми типами изображений
    $lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png"); 
    
    // Получаем размеры и тип изображения в виде числа
    list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath); 
    
    if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
        return false;
    }
    $lImageExtension = $lAllowedExtensions[$lImageExtensionId];
    
    // Получаем название функции, соответствующую типу, для создания изображения
    $func = 'imagecreatefrom' . $lImageExtension; 
    // Создаём дескриптор исходного изображения
    $lInitialImageDescriptor = $func($aInitialImageFilePath);

    // Определяем отображаемую область
    $lCroppedImageWidth = 0;
    $lCroppedImageHeight = 0;
    $lInitialImageCroppingX = 0;
    $lInitialImageCroppingY = 0;
    if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
        $lCroppedImageWidth = floor($lInitialImageWidth);
        $lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
        $lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
    } else {
        $lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
        $lCroppedImageHeight = floor($lInitialImageHeight);
        $lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
    }
    
    // Создаём дескриптор для выходного изображения
    $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
    imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
    $func = 'image' . $lImageExtension;
    
    // сохраняем полученное изображение в указанный файл
    return $func($lNewImageDescriptor, $aNewImageFilePath);
}
?>