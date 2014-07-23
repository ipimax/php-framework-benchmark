<?php

class RuxonFormViewDateTimeColumn extends RuxonFormViewColumn
{
    
    public function render()
    {
        $sResult = FormHelper::textbox($this->getAlias(), htmlentities($this->getValue(), ENT_QUOTES, "utf-8"), \ArrayHelper::merge(array('class' => 'TextboxField', 'id' => 'field_'.$this->getAlias()), $this->getHtmlOptions()));
        $sResult .= '<script type="text/javascript">
            $(document).ready(function() {
                $(\'#field_'.$this->getAlias().'\').datetimepicker();
            });
            </script>';
        
        echo $sResult;
        
    }
}