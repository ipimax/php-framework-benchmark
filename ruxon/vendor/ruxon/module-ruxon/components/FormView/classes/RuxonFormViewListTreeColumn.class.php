<?php

class RuxonFormViewListTreeColumn extends RuxonFormViewColumn
{
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), array(
            'DataSource', 
            'TextFormat',
            'ValueField',
            'DefaultText',
            'DefaultValue',
            'Default'
        ));
    }
    
    public function render()
    {
        $value = 0;
        $value_id = 0;
        
        $aDataSource = $this->getDataSource();
        $aDataSource[2]['Criteria']['ParentId'] = 0;
        
        $oDataProvider = new DataProvider($aDataSource);
        $oData = $oDataProvider->execute();
        
        //echo '<pre>', print_r($oData, true), '</pre>'; die();
        
		$aResult = array();
        $aResult[] = array(
            'Name' => $this->getDefaultText(),
            'Value' => $this->getDefaultValue()
        ); 
        
        if ($this->getDefault())
        {
            $aRs = array();
            if (preg_match("#:(.*?)#isU", $this->getDefault(), $aRs)) 
            {
                $value = Toolkit::getInstance()->request->get($aRs[1], Request::C_GET);
            }
        }
        
        if ($this->getValue())
        {
            $value_id = $this->getValue();
        }

		if ($oData->count() > 0) {
			$aResult = $this->getChilds($oData, 1, $aResult);
		}
        
        echo FormHelper::selectbox($this->getAlias(), $value_id, $aResult, array('class' => 'selectbox', 'id' => 'field_'.$this->getAlias()));
    }
    
    public function getChilds($childs, $level, $res = array())
    {
        foreach ($childs as $ch) 
        {
            $getter = 'get'.$this->getValueField();

            $aResultTmp = array(
                'Value' => call_user_func(array($ch, $getter)),
                'Name' => $this->getTextFormat()
            );

            $aRs = array();
            if (preg_match_all("/:(.*):/iU", $aResultTmp['Name'], $aRs)) 
            {
                foreach ($aRs[1] as $k => $val) 
                {
                    $value = $ch;

                    if (strpos($val, "-") !== false)
                    {
                        $xVal = explode("-", $val);
                        foreach ($xVal as $_val)
                        {
                            $sGetter = 'get'.$_val;
                            $value = call_user_func(array($value, $sGetter));
                        }
                    } 
                    else
                    {
                        $sGetter = 'get'.$val;
                        $value = call_user_func(array($value, $sGetter));
                    }

                    $aResultTmp['Name'] = str_replace($aRs[0][$k], $value, $aResultTmp['Name']);
                }
            }
            
            $aResultTmp['Name'] = str_repeat(' |-- ', $level - 1).$aResultTmp['Name'];
            
            $res[] = $aResultTmp;
            
            if ($ch->hasChilds()) 
            {
                $res = $this->getChilds($ch->getChilds(), $level + 1, $res);
            }
        }
        
        return $res;
    }
}