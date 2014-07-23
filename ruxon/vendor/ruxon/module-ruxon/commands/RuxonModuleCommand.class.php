<?php

namespace ruxon\modules\Ruxon\commands;

class RuxonModuleCommand extends \ConsoleCommand
{
    public function actionExecute($params = array())
    {
        if (!empty($params['module']) && !empty($params[0]))
        {
            $module = $params['module'];
            \Loader::import('Modules.'.$module);

            switch ($params[0])
            {
                // Установка модуля
                case 'install':
                    \Loader::import('Modules.'.$module);

                    $className = $module.'ModuleInstaller';
                    $classNameWithNamespaces = '\ruxon\modules\\'.$module.'\classes\\'.$className;

                    $mod = class_exists($classNameWithNamespaces) ? new $classNameWithNamespaces : new $className;
                    $mod->install();

                    echo "Module installed!\n";
                break;

                // Обновление
                case 'update':
                    \Loader::import('Modules.'.$module);

                    $className = $module.'ModuleInstaller';
                    $classNameWithNamespaces = '\ruxon\modules\\'.$module.'\classes\\'.$className;

                    $mod = class_exists($classNameWithNamespaces) ? new $classNameWithNamespaces : new $className;
                    $mod->update();

                    echo "Module updated!\n";
                break;

                // Удаление
                case 'uninstall':
                    \Loader::import('Modules.'.$module);

                    $className = $module.'ModuleInstaller';
                    $classNameWithNamespaces = '\ruxon\modules\\'.$module.'\classes\\'.$className;

                    $mod = class_exists($classNameWithNamespaces) ? new $classNameWithNamespaces : new $className;
                    $mod->uninstall();

                    echo "Module uninstalled!\n";
                break;
            }
        }
        else
        {
            echo "Please specify module name and action!\n";
        }
    }
}