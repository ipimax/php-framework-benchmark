<h1><?php echo $this->t('Basic', 'Authorize')?></h1>

<p><?php echo $this->t('Basic', 'Enter your login and password')?></p>

<?php if (count($this->getErrors())):?>
    <div class="errors">
        <?php foreach ($this->getErrors() as $error):?>
            <p><?php echo $error?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>

<form action="<?php echo Toolkit::i()->getRequest()->getUrl()?>" method="post" enctype="multipart/form-data" class="form-horizontal">

    <div class="form-group">
        <label class="col-sm-2 control-label" for="login_field"><?php echo $this->getModel()->fieldTitle('Login')?></label>
        <div class="col-sm-10">
            <?php echo FormHelper::textbox('Login', $this->getModel()->Login)?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="password_field"><?php echo $this->getModel()->fieldTitle('Password')?></label>
        <div class="col-sm-10">
            <?php echo FormHelper::password('Password')?>
        </div>
    </div>

    <div class="form-group">
        <div class="controls">
            <div class="col-sm-offset-2 col-sm-10 checkbox-group">
                <label class="col-sm-10" for="field_RememberMe">
                    <?php echo FormHelper::checkbox('RememberMe')?>
                    <?php echo $this->getModel()->fieldTitle('RememberMe')?>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button class="btn btn-primary" type="submit"><?php echo $this->t('Basic', 'Enter')?></button>
        </div>
    </div>
</form>

<div class="alert alert-warning" role="alert"><?php echo $this->t('Basic', 'demo/demo - member, admin/admin - administrator')?></div>