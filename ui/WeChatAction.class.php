<?php
/**
 * Homepage
 *
 * Filename: WeChatAction.class.php
 *
 * @author setimouse@gmail.com
 * @since 2014 3 14
 */
class WeChatAction extends XBaseAction {

    public function execute() {
        $this->displayTemplate('wechat.tpl.php');
    }

}
