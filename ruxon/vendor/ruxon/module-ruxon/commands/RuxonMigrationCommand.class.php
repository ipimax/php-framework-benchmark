<?php

namespace ruxon\modules\Ruxon\commands;

class RuxonMigrationCommand extends \ConsoleCommand
{
    public function actionExecute($params = array())
    {
        if (!empty($params['module']))
        {
            \Loader::import('Modules.'.$params['module']);

            $migrator = new MysqlDbMigrator($params['module']);
            $migrator->migrateTo('last');

            echo "Done!\n";
        }
        else
        {
            echo "Please specify module name!\n";
        }
    }
}