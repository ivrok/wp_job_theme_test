<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 15.09.2017
 * Time: 1:54
 */
class Autoloader
{
    public static function loadPackages($className)
    {
        $filePath = array();
        $pathParts = explode('\\', $className);
        $filePath[] = get_template_directory() . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';
        $filePath[] = get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $className . '.php';
        foreach ($filePath as $fp) {
            if (is_file($fp)) {
                require_once($fp);
                return true;
            }

        }
    }
}
spl_autoload_register(array('Autoloader', 'loadPackages'));