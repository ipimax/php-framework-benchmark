<?php

class RuxonFormViewReadonlyColumn extends RuxonFormViewColumn
{
    public function render()
    {
        echo $this->getValue();
    }
}