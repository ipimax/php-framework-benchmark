<?php

class RuxonFormViewListColumn extends RuxonFormViewColumn
{
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), array(
            'DataSource', 
            'TextFormat',
            'ValueField',
            'DefaultText',
            'DefaultValue',
            'Default',
            'IsTree',
            'OnChange'
        ));
    }
    
    public function defaultValues()
    {
        return ArrayHelper::merge(
            parent::defaultValues(), 
            array(
                'IsTree' => false, 
            )
        ); 
    }
    
    public function render()
    {
        $value = 0;
        $value_id = 0;
        
        $aDataSource = $this->getDataSource();
        if ($this->getIsTree())
        {
            $aDataSource[2]['Criteria']['ParentId'] = 0;
        }
        
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

		$aResult = $this->createRow($oData, $aResult);
        
        if ($this->getOnChange())
        {
            $tmpChange = $this->getOnChange();
            echo FormHelper::selectbox($this->getAlias(), $value_id, $aResult, array(
                'class' => 'selectbox ajax_response_list',
                'data-field' => $tmpChange[0],
                'data-id' => $this->getValue(),
                'id' => 'field_'.$this->getAlias()
            ));
            //$.post('/structure/page_backend/typeParams', {Id: $this->getValue()}, function (data) { /* response */ });
        } else {
        
            echo FormHelper::selectbox($this->getAlias(), $value_id, $aResult, array(
                'class' => 'selectbox',
                'id' => 'field_'.$this->getAlias()
            ));
        }
    }
    
    protected function createRow($items, $aData = array(), $level = 1)
    {
        if ($items->count())
        {
            foreach ($items as $itm) {
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
                
                if ($this->getIsTree() && $level > 1)
                {
                    $aResultTmp['Name'] =  str_repeat(" |-- ", $level-1).$aResultTmp['Name'];
                }
				
				$aData[] = $aResultTmp;
                
                if ($itm->hasChilds())
                {
                    $aData = $this->createRow($itm->getChilds(), $aData, $level + 1);
                }
			}
        }
        
        return $aData;
    }
}