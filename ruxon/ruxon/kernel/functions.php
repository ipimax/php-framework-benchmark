<?php

/**
 * Autoload
 *
 * @param string $sName Путь к файлу
 * @return boolean
 */
function rx_autoload($sName)
{
	if (isset($_ENV['RUXON_AUTOLOAD_CLASSES'][$sName])) {
		$sPath = $_ENV['RUXON_AUTOLOAD_CLASSES'][$sName];

		if (!include_once($sPath)) {
			throw new RxException('Файл "'.$sPath.'" не может быть загружен.');
		}
    }

	return true;
}

/**
 * Выводит неперехваченное исключение
 *
 * @param object $oException Исключение
 */
function rx_exception_handler($oException)
{
    if (RUXON_DEBUG)
    {
        $title = 'Ruxon CMS: Неперехваченное исключение';
        $content = 'Неперехваченное исключение: '.$oException->getMessage().'<br />'
        . 'В файле: '.$oException->getFile().'<br />'
        . 'В строке: '.$oException->getLine().'<br />'	
        . '<pre>'
        . $oException->getTraceAsString()
        . '</pre>';
    }
    else 
    {
        $title = 'Ruxon CMS: Ошибка';
        $content = $oException->getMessage();
    }
    
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>'.$title.'</title>
        </head>
        <body>
    '.$content.'</body></html>';
}

/**
 * Выводит исключение
 *
 * @param object $oException Исключение
 */
function rx_exception($oException)
{
    if (RUXON_DEBUG)
    {
        $title = 'Ruxon CMS: Исключение';
        $content = 'Исключение: '.$oException->getMessage().'<br />'
        . 'В файле: '.$oException->getFile().'<br />'
        . 'В строке: '.$oException->getLine().'<br />'	
        . '<pre>'
        . $oException->getTraceAsString()
        . '</pre>';
    }
    else 
    {
        $title = 'Ruxon CMS: Ошибка';
        $content = $oException->getMessage();
    }
    
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>'.$title.'</title>
        </head>
        <body>
    '.$content.'</body></html>';
}

/**
 * Возвращает список файлов в
 * директории и в поддиректориях
 *
 * @param string $sPath Путь к директории
 * @return array Массив найденных файлов
 */
function rx_glob($sPath)
{
	$aResult = array();
    $iterator = rec_listFiles(RX_PATH . '/' . $sPath);
    if (is_array($iterator) && count($iterator)) {
        foreach ($iterator as $file) {
            if (strrpos($file, ".class.php") === strlen($file) - 10 || strrpos($file, ".interface.php") === strlen($file) - 14  || strrpos($file, ".trait.php") === strlen($file) - 10 ) {
                $aResult[] = $file;
            }
        }
    }
    
	return $aResult;
}

function rx_dir_list($sPath)
{
	$aResult = array();
    
    if(is_dir($sPath) && $dh = opendir($sPath))
    {
        while( false !== ($file = readdir($dh)))
        {
            // Skip '.' and '..'
            if( $file == '.' || $file == '..' || $file == '.svn')
                continue;
            $path = $sPath . '/' . $file;
            if( is_dir($path)) 
            {
                $aResult[] = $file;
            }
        }
        closedir($dh);
    }
    
	return $aResult;
}

function rec_listFiles($from = '.', $files = array())
{
    if(!is_dir($from))
        return false;
   
    if($dh = opendir($from))
    {
        while( false !== ($file = readdir($dh)))
        {
            // Skip '.' and '..'
            if( $file == '.' || $file == '..' || $file == '.svn')
                continue;
            $path = $from . '/' . $file;
            if( is_dir($path))
                $files += rec_listFiles($path, $files);
            else
                $files[] = $path;
        }
        closedir($dh);
    }
    
    return $files;
}

 function rrmdir($dir, $with_parent = true) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     
     if ($with_parent)
        rmdir($dir);
   }
 }
 
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 