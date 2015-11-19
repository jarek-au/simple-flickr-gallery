<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?=$this->renderTitle();?>
        <?=$this->renderMeta();?>
        <?=$this->renderStyles();?>
    </head>

    <body>
        <div id="wrapper">
            <h1><?=$this->getTitle();?></h1>

            <div id="content">
                <?=$this->getContent();?>
            </div>
        </div>
    </body>
</html>    
