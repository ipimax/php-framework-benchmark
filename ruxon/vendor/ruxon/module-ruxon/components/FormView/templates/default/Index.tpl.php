<div id="content_box" class="content_box form-tabs">
    <input type="hidden" id="admin_edit_element_id" value="<?php echo $this->getElementId()?>" />

    <h1><?php echo $this->getTitle()?></h1>
    
    <?php if ($this->getData()->at(0) && $this->getData()->at(0)->getFields()):?>
        <ul class="nav nav-tabs">
            <?php foreach ($this->getData() as $k => $tabs):?>
                <li><a href="#tabs-<?php echo $k?>"><?php echo $tabs->getTitle()?></a></li>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
    
    <form id="FormViewBox" action="<?php echo Toolkit::getInstance()->getRequest()->getUrl()?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <?php if (!$this->getData()->at(0)):?><div class="tab-content"><?php endif;?>
        <?php foreach ($this->getData() as $k => $tabs):?>

            <?php if ($this->getData()->at(0) && $this->getData()->at(0)->getFields()):?><div class="tab-content" id="tabs-<?php echo $k?>"><?php endif;?>
                <?php if ($tabs->getFields()):?>
                    <?php foreach ($tabs->getFields() as $field):?>
                        <div class="control-group">
                            <label class="control-label<?php if ($field->getHelp()):?> helper<?php endif;?>" for="field_<?php echo $field->getAlias()?>" <?php if ($field->getHelp()):?>title="<?php echo $field->getHelp()?>"<?php endif;?>><?php echo $field->getTitle()?><?php if($field->getRequired()):?><span class="required">*</span><?php endif;?></label>
                            <div class="controls">
                                <?php $field->render()?>
                            </div>
                            <br class="clear" />
                        </div>
                    <?php endforeach;?>
                <?php else:?>
                    <div class="control-group">
                        <label class="control-label<?php if ($tabs->getHelp()):?> helper<?php endif;?>" for="field_<?php echo $tabs->getAlias()?>" <?php if ($tabs->getHelp()):?>title="<?php echo $tabs->getHelp()?>"<?php endif;?>><?php echo $tabs->getTitle()?><?php if($tabs->getRequired()):?><span class="required">*</span><?php endif;?></label>
                        <div class="controls">
                            <?php $tabs->render()?>
                        </div>
                    </div>
                <?php endif;?>
            <?php if ($this->getData()->at(0) && $this->getData()->at(0)->getFields()):?></div><?php endif;?>
        <?php endforeach;?>
        <?php if (!$this->getData()->at(0)):?></div><?php endif;?>
        <div class="form-actions">
            <div class="buttons">
                <button class="btn" type="button" onclick="location.href='#!<?php echo $this->getBackLink()?>';">Вернуться</button>
                <button class="btn right" type="button" id="form_save_button_save">Сохранить</button>
                <button class="btn btn-primary right" type="button" id="form_save_button_saveback">Сохранить и вернуться</button>
            </div>
            <div class="ajax-loader wide"></div>
        </div>
    </form>
    
    
    
</div> 

<script>
    jQuery(document).ready(function(){
        
        Ruxon.FormView.nActiveTab = 0;
        
        oApp.setTitle('<?php echo $this->getTitle()?> :: Ruxon');

        $('#form_save_button_save').click(function () 
        {
            Ruxon.FormView.save($('#FormViewBox').attr('action'));
        });
        
        $('#form_save_button_saveback').click(function () 
        {
            Ruxon.FormView.save_back($('#FormViewBox').attr('action'), '<?php echo $this->getBackLink()?>');
        });
        
        $('.form-tabs').tabs();

    });
</script>