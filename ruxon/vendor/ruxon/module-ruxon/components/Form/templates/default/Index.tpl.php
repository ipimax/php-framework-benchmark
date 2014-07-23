<?php if (count($this->getErrors())):?>
    <div class="errors">
        <?php foreach ($this->getErrors() as $error):?>
            <p><?php echo $error?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>

<form action="<?php echo Toolkit::getInstance()->getRequest()->getUrl()?>" method="post" enctype="multipart/form-data" class="form-horizontal">

    <?php foreach ($this->getData() as $field):?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="field_<?php echo $field->getAlias()?>"><?php echo $field->getTitle()?><?php if($field->getRequired()):?><span class="required">*</span><?php endif;?></label>
            <div class="col-sm-10">
                <?php $field->render()?>
            </div>
        </div>
    <?php endforeach;?>

    <?php if ($this->getButtons()):?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php foreach ($this->getButtons() as $button):?>
                    <?php $button->render();?>
                <?php endforeach;?>
            </div>
        </div>
    <?php endif;?>
    
</form>
