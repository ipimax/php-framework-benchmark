<?php

class RuxonFormViewButton extends SimpleObject
{
    public function fields()
    {
        return ['Title', 'Value', 'Alias', 'Type', 'HtmlOptions'];
    }

    public function defaultValues()
    {
        return ['Title' => '', 'HtmlOptions' => array(), 'Type' => 'Submit'];
    }

    public function render()
    {
        echo HtmlHelper::formButton($this->getType(), $this->getTitle(), $this->getHtmlOptions());
    }
}