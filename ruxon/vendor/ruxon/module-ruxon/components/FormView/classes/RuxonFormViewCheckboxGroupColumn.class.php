<?php

class RuxonFormViewCheckboxGroupColumn extends RuxonFormViewColumn
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
        
        $oDataProvider = new DataProvider($this->getDataSource());
        $oData = $oDataProvider->execute();
        
        //echo '<pre>', print_r($oData, true), '</pre>'; die();
        
		$aResult = array();
        /*$aResult[] = array(
            'Name' => $this->getDefaultText(),
            'Value' => $this->getDefaultValue()
        ); */
        
        if ($this->getDefault())
        {
            $aRs = array();
            if (preg_match("#:(.*?)#isU", $this->getDefault(), $aRs)) 
            {
                $value = Toolkit::getInstance()->request->get($aRs[1], Request::C_GET);
            }
        }
        
        //echo 'val:', print_r($this->getValue()->toSimpleArray(), true);
        
        if ($this->getValue())
        {
            $value_id = $this->getValue()->toSimpleArray();
        }

		if ($oData->count() > 0) {
			foreach ($oData as $itm) {
                $getter = 'get'.$this->getValueField();
                
				$aResultTmp = array(
					'Value' => call_user_func(array($itm, $getter)),
					'Name' => $this->getTextFormat()
				);

				$aRs = array();
				if (preg_match_all("/:(.*):/iU", $aResultTmp['Name'], $aRs)) 
                {
					foreach ($aRs[1] as $k => $val) 
                    {
                        $value = $itm;
                        
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

				/*if (isset($aContainer['IsTree']) && $aContainer['IsTree'] == true) {
					$aResultTmp['Name'] = str_repeat(' |-- ', $itm->getTreeLevel() - 1).$aResultTmp['Name'];
				}*/
				
				$aResult[] = $aResultTmp;
			}
		}
        
        $sResult = FormHelper::checkboxGroup($this->getAlias().'[]', $value_id, $aResult, array('class' => 'multiselect', 'id' => 'field_'.$this->getAlias()));
        
        echo $sResult;
        
    }
}