<?php

class RuxonFormViewAutoSuggestColumn extends RuxonFormViewColumn
{
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), array(
            'DataSource', 
            'TextFormat',
            'ValueField',
        ));
    }
    
    public function render()
    {
        $sResult = FormHelper::textbox('', $this->getValue(), array('class' => 'TextboxField', 'id' => 'field_'.$this->getAlias()));
        $sResult .= '<script>$(document).ready(
            function()
            {
                $(\'#field_'.$this->getAlias().'\').autoSuggest("http://mysite.com/path/to/script", {minChars: 2, matchCase: true, startText: "Введите текст", preFill: \''.$this->getValue().'\', asHtmlName: \''.$this->getAlias().'\'});
            }
        );</script>';
        
        echo $sResult;
        
    }
}