<?php

class RuxonFormViewTextColumn extends RuxonFormViewColumn
{
    public function render()
    {
        echo FormHelper::textarea($this->getAlias(), $this->getValue(), \ArrayHelper::merge(array('class' => 'TextboxField', 'id' => 'field_'.$this->getAlias()), $this->getHtmlOptions()));
    }
}