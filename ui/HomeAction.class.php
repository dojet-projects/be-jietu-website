<?php
/**
 * Homepage
 *
 * Filename: HomeAction.class.php
 *
 * @author setimouse@gmail.com
 * @since 2014 3 14
 */
class HomeAction extends XBaseAction {

    public function execute() {
        $this->displayTemplate('home.tpl.php');
        // $this->displayJson(new MJson(array('a', 'b')));
    }

}
