<?php

class RuxonFormViewCheckboxColumn extends RuxonFormViewColumn
{
    public function fields()
    {
        return ArrayHelper::merge(
                parent::fields(), 
                array('Checked')
        );
    }
    
    public function defaultValues()
    {
        return ArrayHelper::merge(
                parent::defaultValues(), 
                array(
                    'Checked' => false, 
                    'ColumnClass' => 'check'
                )
        ); 
    }
    
    public function render()
    {
        $sName = $this->getAlias();
        
        echo FormHelper::checkbox($sName, $this->getValue(), array('id' => 'field_'.$this->getAlias()));
    }
}