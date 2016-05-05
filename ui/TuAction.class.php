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
        $this->bg = MImage::imageFromFile(DATA.'image/1-1.png');
        $avatar = MImage::imageFromFile(DATA.'image/avatar.jpg');
        $this->setCarrier('中国移动');
        $this->addChat($avatar, 'hello', true);
        $this->setSignal(2);
        $this->setNetwork('wifi', 3);
        $this->setTime('16:09');
        // $bg->copy($img2, 100, 100, 0, 0, 100, 100);

        $this->bg->display();
    }

    public function setSignal($n = 5) {
        $path = sprintf(DATA.'image/signal-%s.png', $n);
        $img = MImage::imageFromFile($path);
        $this->bg->copy($img, 0, 0, 0, 0, 88, 40);
    }

    public function setNetwork($network, $n) {
        $path = sprintf(DATA.'image/network-%s-%s.png', $network, $n);
        $img = MImage::imageFromFile($path);
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
        if ($isMe) {
            $a_x = 540;
            $chatbox_img = DATA.'image/chat-me.png';
            $arrow_img = DATA.'image/chat-me-arrow.png';
            $img = MImage::imageFromFile($arrow_img);
            $cb_x = 20;
            $cb_w = 500;
            $cb_h = 300;
            $arrow_x = $cb_w - $img->width();
        } else {
            $a_x = 20;
            $chatbox_img = DATA.'image/chat-ta.png';
            $arrow_img = DATA.'image/chat-ta-arrow.png';
            $cb_x = 120;
            $cb_w = 500;
            $cb_h = 300;
            $arrow_x = 0;
        }
        $this->bg->copy($avatar, $a_x, $this->chat_y, 0, 0, 80, 80);

        $chatbox = MImage::imageFromFile($chatbox_img);
        $chatbox->resize9(500, 300, 40, 20, 180, 32);

        $arrow = MImage::imageFromFile($arrow_img);
        $chatbox->copy($arrow, $arrow_x, 0, 0, 0, $arrow->width(), $arrow->height());

        $this->bg->copy($chatbox, $cb_x, $this->chat_y, 0, 0, $chatbox->width(), $chatbox->height());
    }

}
