<?php

class RuxonFormViewImageColumn extends RuxonFormViewColumn
{
    public function defaultValues()
    {
        return ArrayHelper::merge(parent::defaultValues(), array('BucketName' => 'images'));
    }
    
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), array('UploadUrl', 'BucketName'));
    }
    
    public function render()
    {
        if ($this->getValue()) {
            $file = Toolkit::i()->fileStorage->bucket($this->getBucketName())->getImage($this->getValue());

            echo '<img src="'.$file->getThumbUrl(100).'" alt="" />';

            echo '<br />';
            echo FormHelper::checkbox($this->getAlias().'_delete', false, [
                'id' => $this->getAlias().'_delete'
            ]);
            echo ' '. FormHelper::labelFor($this->getAlias().'_delete', 'Удалить');
        }

        echo FormHelper::file($this->getAlias(), $this->getValue(), array('id' => 'field_'.$this->getAlias()));
    }
}