<?php

class RuxonFormViewAliasColumn extends RuxonFormViewColumn
{
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), array(
            'Auto', 
            'AutoFieldAlias'
        ));
    }
    
    public function render()
    {
        $sResult = FormHelper::textbox($this->getAlias(), $this->getValue(), array('class' => 'TextboxField', 'id' => 'field_'.$this->getAlias()));
        if ($this->getAuto())
        {
            $sResult .= '<script>$(document).ready(
                function()
                {
                    $(\'#field_'.$this->getAutoFieldAlias().'\').translit({alias_box: "field_'.$this->getAlias().'"});
                }
            );</script>';
        }
        
        echo $sResult;
    }
}