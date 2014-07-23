<?php

class RuxonFormViewColumn extends SimpleObject
{
    public function __construct($aData = array()) 
    {
        $this->init();
        $this->import($aData);
    }
    
    public function init() {}
    
    public function fields()
    {
        return array('Title', 'Help', 'Value', 'Value2', 'Alias', 'Required', 'Module', 'Component', 'HtmlOptions', 'RowHtmlOptions', 'ShowWhen');
    }
    
    public function defaultValues()
    {
        return array('Title' => '', 'Required' => false, 'HtmlOptions' => array(), 'RowHtmlOptions' => array(), 'ShowWhen' => '');
    }
    
    public function renderHeader()
    {
        echo $this->getTitle();
    }
    
    public function render()
    {
        echo $this->getValue();
    }
    
    public function renderPartial($template, $data = array()) 
    {
        $template = new ComponentTemplate($this->getModule(), $this->getComponent(), $template, $data);
        
        echo $template->fetch();
    }
}