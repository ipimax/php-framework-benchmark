<?php

class RuxonFormViewPasswordColumn extends RuxonFormViewColumn
{
    public function render()
    {
        echo FormHelper::password($this->getAlias(), $this->getValue(), array('class' => 'TextboxField', 'id' => 'field_'.$this->getAlias()));
    }
}