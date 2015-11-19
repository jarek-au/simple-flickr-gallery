<?php
/**
 * Partial View script for Paginator
 */

$params = array('search' => $this->getParam('search'));
?>
<div class="paginator">
    <?php
    if ($this->getParam('pages') > 1) {
        if ($this->getParam('page') > 0) {
            $range = floor($this->getParam('range') / 2);
            $min = max(1, $this->getParam('page') - $range);
            $max = min($this->getParam('pages'), $this->getParam('page') + $range);

            ?>
            <div class="pages">
                <?php
                // First & Previous page link
                if ($this->getParam('page') > 1) { 
                    $params['page'] = 1; ?>
                    <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>">&lt;&lt;</a>

                    <?php
                    $params['page'] = $this->getParam('page') - 1; ?>
                    <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>">&lt;</a>
                <?php }
                
                // Fast rewind page link
                $page = $this->getParam('page') - pow($this->getParam('range'), 4);
                if ($page > 1) {                    
                    $params['page'] = $page; ?>
                    <span>..</span> <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>"><?=$page;?></a> <span>..</span>
                <?php }

                // Fast rewind page link
                $page = $this->getParam('page') - pow($this->getParam('range'), 3);
                if ($page > 1) {                    
                    $params['page'] = $page; ?>
                    <span>..</span> <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>"><?=$page;?></a> <span>..</span>
                <?php }
                
                // Fast rewind page link
                $page = $this->getParam('page') - pow($this->getParam('range'), 2);
                if ($page > 1) {                    
                    $params['page'] = $page; ?>
                    <span>..</span> <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>"><?=$page;?></a> <span>..</span>
                <?php }

                // Numbered page links
                for ($page = $min; $page <= $max; $page++) {
                    if ($page != $this->getParam('page')) { 
                        $params['page'] = $page; ?>
                        <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>">
                            <?=$page; ?>
                        </a>
                    <?php } else { ?>
                        <span class="active"><?=$page; ?></span>
                    <?php }
                }
                
                // Fast forward page link
                $page = $this->getParam('page') + pow($this->getParam('range'), 2);
                if ($page < $this->getParam('pages')) {                    
                    $params['page'] = $page; ?>
                    <span>..</span> <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>"><?=$page;?></a> <span>..</span>
                <?php }
                
                // Fast forward page link
                $page = $this->getParam('page') + pow($this->getParam('range'), 3);
                if ($page < $this->getParam('pages')) {                    
                    $params['page'] = $page; ?>
                    <span>..</span> <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>"><?=$page;?></a> <span>..</span>
                <?php }

                // Fast forward page link
                $page = $this->getParam('page') + pow($this->getParam('range'), 4);
                if ($page < $this->getParam('pages')) {                    
                    $params['page'] = $page; ?>
                    <span>..</span> <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>"><?=$page;?></a> <span>..</span>
                <?php }

                // Next & last page link
                if ($this->getParam('page') < $this->getParam('pages')) {
                    $params['page'] = $this->getParam('page') + 1; ?>
                    <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>">&gt;</a>

                    <?php
                    $params['page'] = $this->getParam('pages'); ?>
                    <a href="<?=$this->getParam('url') . '?' . http_build_query($params, '', '&amp;'); ?>">&gt;&gt;</a>
                <?php } ?>                    
            </div>
        <?php }
    }
    ?>
    <div class="info">
        Page <?=number_format($this->getParam('page'));?>
        of <?=number_format($this->getParam('pages'));?>
        <?php
        if ($this->getParam('maxItems') > 0) {
            echo '<br>Please note that Flickr will return at most the first '
                 . number_format($this->getParam('maxItems'))
                 . ' results for any given search query';
        }
        ?>
    </div>
</div>
