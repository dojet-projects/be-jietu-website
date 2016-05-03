<?php
/**
 *
 * Filename: TuAction.class.php
 *
 * @author liyan
 * @since 2016 5 3
 */
class TuAction extends XBaseAction {

    protected $chat_y;
    protected $bg;

    function __construct() {
        $this->chat_y = 40 + 88 + 88;
    }

    public function execute() {
        $this->bg = new MImage(DATA.'image/1-1.png');
        $avatar = new MImage(DATA.'image/avatar.jpg');
        $this->setCarrier('中国移动');
        $this->addChat($avatar, 'hello', false);
        $this->setSignal(2);
        $this->setNetwork('wifi', 3);
        $this->setTime('16:09');
        // $bg->copy($img2, 100, 100, 0, 0, 100, 100);

        $this->bg->display();
    }

    public function setSignal($n = 5) {
        $path = sprintf(DATA.'image/signal-%s.png', $n);
        $img = new MImage($path);
        $this->bg->copy($img, 0, 0, 0, 0, 88, 40);
    }

    public function setNetwork($network, $n) {
        $path = sprintf(DATA.'image/network-%s-%s.png', $network, $n);
        $img = new MImage($path);
        $this->bg->copy($img, 190, 0, 0, 0, 32, 40);
    }

    public function setCarrier($carrier) {
        $this->bg->ttftext($carrier, DATA.'font/simhei.ttf', 18, 88, 29, 0, 0xffffff);
    }

    public function setTime($time) {
        $this->bg->ttftext($time, DATA.'font/simhei.ttf', 18, 285, 69, 0, 0xffffff);
    }

    public function addChat(MImage $avatar, $text, $isMe) {
        $avatar->resize(80, 80);
        $a_x = 20;
        $this->bg->copy($avatar, $a_x, $this->chat_y, 0, 0, 80, 80);
    }

}
