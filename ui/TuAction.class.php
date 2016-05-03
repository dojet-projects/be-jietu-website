<?php
/**
 *
 * Filename: TuAction.class.php
 *
 * @author liyan
 * @since 2016 5 3
 */
class TuAction extends XBaseAction {

    public function execute() {
        $img1 = new MImage(DATA.'image/1.png');
        $img2 = new MImage(DATA.'image/2.png');
        $this->addText($img1, $img2, 'hello', true);
        // $img1->copy($img2, 100, 100, 0, 0, 100, 100);

        $img1->display();
    }

    public function addText(MImage $img, MImage $avatar, $text, $isMe) {
        $img->ttftext('中国移动', DATA.'font/simhei.ttf', 18, 88, 29, 0, 0xffffff);
    }

}
