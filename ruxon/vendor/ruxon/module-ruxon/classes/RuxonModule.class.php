<?php

namespace ruxon\modules\Ruxon\classes;

class RuxonModule extends \BaseModule
{
    public function publishAssets()
    {
        $localPath = dirname(__FILE__) . "/../assets";
        return \Toolkit::i()->assetManager->publish($localPath);
    }

    public function pathAssets()
    {
        $localPath = dirname(__FILE__) . "/../assets";
        return \Toolkit::i()->assetManager->getBasePath().'/'.\Toolkit::i()->assetManager->generatePath($localPath);
    }
}