<?php

namespace ruxon\modules\Ruxon\components\FormView\classes;

class FormViewComponent extends \Component
{
    protected $sModuleAlias = 'Ruxon';
    protected $sComponentAlias = 'FormView';

    public function run()
    {
        $this->start();

		$aResult = array();        
        
        $aData = array();
        $oData = $this->getComponentRequest()->getData();
        $buttons = $this->getComponentRequest()->getButtons();

        foreach ($this->getComponentRequest()->getFields() as $alias => $header)
        {
            $sClassName = $this->sModuleAlias.'FormView'.$header['Type'].'Column';

            $aTmpParams2 = array(
                'Module' => $this->sModuleAlias,
                'Component' => $this->sComponentAlias,
                'Alias' => $alias,
                'Type'  => $header['Type'],
                'Help'  => isset($header['Help']) ? $header['Help'] : '',
                'Title'  => $header['Title'],
                'Required' => isset($header['Params']['Required']) ? $header['Params']['Required'] : false,
            );

            if (isset($header['Field']))
            {
                if (is_object($oData))
                {
                    $sGetter = 'get'.$header['Field'];
                    $aTmpParams2['Value'] = call_user_func(array($oData, $sGetter));
                }
                else if (is_array($oData))
                {
                    if (!empty($oData[$header['Field']]))
                    {
                        $aTmpParams2['Value'] = $oData[$header['Field']];
                    }
                    else
                    {
                        $aTmpParams2['Value'] = '';
                    }
                }
            }

            if (isset($header['Params']) && count($header['Params'])) {
                $aTmpParams2 = \ArrayHelper::merge($aTmpParams2, $header['Params']);
            }

            $aData[$alias] = new $sClassName($aTmpParams2);

        }

        $backLink = $this->getComponentRequest()->getBackLink();
        if ($backLink)
        {
            $aRs = array();
            if (preg_match_all("#:~(.*?)#isU", $backLink, $aRs)) 
            {
                foreach ($aRs[0] as $k => $it) 
                {
                    $backLink = str_replace($it, Toolkit::getInstance()->request->get($aRs[1][$k], Request::C_GET), $backLink);
                }
            }

            if (preg_match_all("#:(.*?)#isU", $backLink, $aRs)) 
            {
                foreach ($aRs[0] as $k => $it) 
                {
                    $sGetter = 'get'.$aRs[1][$k];
                    $backLink = str_replace($it, call_user_func(array($oData, $sGetter)), $backLink);
                }
            }
        }

        if (!empty($buttons)) {
            $aResult['Buttons'] = new \SimpleCollection();

            foreach ($buttons as $button) {
                $aResult['Buttons']->add(new \RuxonFormViewButton($button));
            }
        }
        
        
        $aResult['ElementId'] = is_object($oData) ? $oData->getId() : 0;
        $aResult['Title'] = $this->getComponentRequest()->getTitle();
        $aResult['Errors'] = $this->getComponentRequest()->getErrors();
        $aResult['BackLink'] = $backLink;
        $aResult['Data'] = new \SimpleCollection($aData);
        
        $this->end($aResult, true);
    }
}