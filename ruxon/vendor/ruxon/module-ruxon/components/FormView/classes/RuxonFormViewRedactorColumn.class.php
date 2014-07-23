<?php

class RuxonFormViewRedactorColumn extends RuxonFormViewColumn
{
    public function render()
    {
        $sResult = FormHelper::textarea($this->getAlias(), $this->getValue(), array('class' => 'redactor_content', 'id' => 'field_'.$this->getAlias()));
        
        $sResult .= '<script>$(document).ready(
            function()
            {
                $( \'#field_'.$this->getAlias().'\' ).ckeditor();
            }
        );</script>';
        
        echo $sResult;
    }
}