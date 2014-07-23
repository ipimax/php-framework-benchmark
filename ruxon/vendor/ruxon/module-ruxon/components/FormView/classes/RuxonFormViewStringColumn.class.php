<?php

class RuxonFormViewStringColumn extends RuxonFormViewColumn
{
    public function render()
    {
        echo FormHelper::textbox($this->getAlias(), htmlentities($this->getValue(), ENT_QUOTES, "utf-8"), \ArrayHelper::merge(array('class' => 'TextboxField', 'id' => 'field_'.$this->getAlias()), $this->getHtmlOptions()));
    }
}