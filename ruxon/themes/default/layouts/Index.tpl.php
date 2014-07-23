<?php if (!defined('RUXON_VALID')) die("Access Denied!");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo $this->getMetaKeywords()?>" />
    <meta name="description" content="<?php echo $this->getMetaDescription()?>" />
    <title><?php echo $this->getMetaTitle()?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php echo Core::app()->client()->renderAll();?>

    <script src="<?php echo $this->getUrl()?>/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->getUrl()?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->getUrl()?>/css/custom.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item<?php if (Toolkit::i()->request->getUrl() == '/'):?> active<?php endif;?>" href="/"><?php echo $this->t('Theme', 'Home')?></a>
            <a class="blog-nav-item<?php if (Toolkit::i()->request->getUrl() == '/app/index/about'):?> active<?php endif;?>" href="<?php echo Toolkit::i()->urlManager->createUrl('app/index/about')?>"><?php echo $this->t('Theme', 'About')?></a>
        </nav>
        <nav class="blog-nav right-nav">
            <?php if (Toolkit::i()->auth->isAuth()):?>
                <a class="blog-nav-item" href="<?php echo Toolkit::i()->urlManager->createUrl('app/user/logout')?>"><?php echo $this->t('Theme', 'Logout')?> (<?php echo Toolkit::i()->auth->getUser()['login']?>)</a>
            <?php else:?>
                <a class="blog-nav-item" href="<?php echo Toolkit::i()->urlManager->createUrl('app/user/login')?>"><?php echo $this->t('Theme', 'Login')?></a>
            <?php endif;?>
        </nav>
    </div>
</div>

<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">Ruxon Framework App</h1>
        <p class="lead blog-description">Приложение на Ruxon Framework.</p>
    </div>

    <div class="row">

        <div class="col-sm-12 blog-main">

            <?php echo $this->getContent()?>

        </div><!-- /.blog-main -->

    </div><!-- /.row -->

</div><!-- /.container -->

<div class="blog-footer">
    <p>
        <a href="#"><?php echo $this->t('Theme', 'Back to top')?></a>
    </p>
</div>


</body>
</html>