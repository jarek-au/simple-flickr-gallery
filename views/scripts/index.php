<?php
/** 
 * View script
 */


/**
 * Display Error
 */
$error = $this->getParam('error');
if ($error !== null) { ?>
<div class="error">
    <?=$error;?>
</div>
<?php } ?>

<div class="panel">
    <form name="search-form" method="get" action="<?=$this->getParam('searchAction'); ?>">
        <input type="text" name="search" value="<?=$this->getParam('search'); ?>" size="100" />
        <input type="submit" value="Search" />
    </form>
</div>

<?php
/**
 * Display results
 */
if ($this->getParam('items') !== null) { ?>
    <div class="photos panel">
        <div class="info">
            <?=number_format($this->getParam('items')) . ' Result'
               . (($this->getParam('items') != 1) ? 's' : ''); ?>
        </div>
        <?php
        /**
         * Display photos
         */
        $photos = $this->getParam('photos', false);
        if (is_array($photos)) {
            foreach ($photos as $photo) { ?>
                <a class="photo" href="<?=$photo->getUrl();?>" target="_blank" title="<?=$this->escape($photo->getTitle());?>">
                    <img src="<?=$photo->getThumbUrl();?>" alt="<?=$photo->getId();?>" width="150" height="150" />
                </a>
            <?php }
        }

        /**
         * Display paginator
         */
        if ($this->getParam('pages') > 0) {
            echo $this->renderScript(
                'paginator.partial.php',
                array(
                    'url'          => $this->getParam('searchAction'),
                    'items'        => $this->getParam('items'),
                    'itemsPerPage' => $this->getParam('itemsPerPage'),
                    'range'        => $this->getParam('range'),
                    'page'         => $this->getParam('page'),
                    'pages'        => $this->getParam('pages'),
                    'maxItems'     => $this->getParam('maxItems'),
                    'search'       => $this->getParam('search')
                )
            );
        }
        ?>
    </div>
<?php }
