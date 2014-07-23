<?php if ($this->getPages()):?>
    <ul class="pagination">
        <?php foreach($this->getPages() as $page):?>
            <?php if ($page['active'] == true):?>
                <li class="active"><span><?php echo $page['title']?></span></li>
            <?php else:?>
                <li><a href="<?php echo $page['url']?>"><?php echo $page['title']?></a></li>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
<?php endif;?>