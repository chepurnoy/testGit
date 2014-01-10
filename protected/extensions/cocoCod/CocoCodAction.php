<?php

/**
 * CocoCodAction
 * @author Orlov Alexey <Orlov.Alexey@zfort.net>
 * @version $Id$
 * @package extensions
 * @since 1.0
 */
Yii::import('application.extensions.cocoCod.coco.*');
class CocoCodAction extends CocoAction
{

    /**
     * this action invokes the appropiated handler referenced by a 'classname' url attribute.
     * the specified classname must implements: EYuiActionRunnable.php
     */
    public function run()
    {
        //Yii::log('ACTION CALLED','info');
        $inst = new CocoCodWidget();
        $inst->runAction($_GET['action'], $_GET['data']);
    }

}

