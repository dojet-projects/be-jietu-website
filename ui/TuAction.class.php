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
        $this->chat_y = 88 + 40;
    }

    public function execute() {
        $this->bg = MImage::imageFromFile(DATA.'image/bg.png');

        $this->setCarrier('中国联通');
        $this->setSignal(2);
        $this->setNetwork('wifi', 3);
        $this->setTime('20:40');
        $this->setTitle('周波');
        $this->setBattery(100);

        $avatar = MImage::imageFromFile(DATA.'image/avatar.jpg');
        $this->taSay($avatar, '对了，我们产品基本稳定，5月份研发包括设计、iOS、服务端有闲置人力，有朋友最近在找APP外包的吗');
        $this->iSay($avatar, '我问问吧，要是有给你介绍');
        $this->addChatTime('11:46');
        $this->taSay($avatar, 'OK!');

        $this->bg->copyfull(MImage::imageFromFile(DATA.'image/speak.png'), 0, 1036);
        $this->bg->display();
    }

    public function setBattery($battery) {
        $x = 640;

        $img = MImage::imageFromFile(DATA.'image/battery.png');
        $x-= 8;
        $x-= $img->width();
        $len = $battery / 100 * 41;
        if ($len < 2) {
            $len = 0;
        } elseif ($len < 41) {
            $len = min($len, 39);
        } else {
            $len = 39;
            $img->setpixel(45, 13, 0x9a999c)
                ->line(45, 14, 45, 26, 0xffffff)
                ->setpixel(45, 27, 0x9a999c);
        }
        $img->filledrect(6, 13, 6 + $len, 27, 0xffffff);
        $this->bg->copyfull($img, $x, 0);

        $fontfile = DATA.'font/sf.ttf';
        $fontsize = 17;
        $rect = $this->getFontRect($battery, $fontsize, $fontfile);
        list(, , $rw) = $rect;
        $x-= $rw + 22;
        $this->bg->ttftext($battery, $fontfile, $fontsize, $x, 29, 0, 0xffffff);
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
        $fontfile = DATA.'font/sf-bold.ttf';
        $fontsize = 17;
        $rect = $this->getFontRect($time, $fontsize, $fontfile);
        list($rx, $ry, $rw, $rh) = $rect;
        $x = (640 - $rw) / 2;
        $this->bg->ttftext($time, $fontfile, $fontsize, $x, 28, 0, 0xffffff);
    }

    public function setTitle($title) {
        $fontsize = 30;
        $formatTitleText = $this->formatTitleText($title, $fontsize);
        $rect = $this->getFontRect($formatTitleText, $fontsize, DATA.'font/simhei.ttf');
        list($rx, $ry, $rw, $rh) = $rect;

        $x = (640 - $rw) / 2;
        $this->bg->ttftext($formatTitleText, DATA.'font/simhei.ttf', $fontsize, $x, 98, 0, 0xffffff);
    }

    public function addChatTime($text) {
        $this->chat_y += 20;
        $fontsize = 20;

        list($tx, $ty, $tw, $th) = $this->getFontRect($text, $fontsize, DATA.'font/simhei.ttf');

        $timebox = MImage::imageFromFile(DATA.'image/chattime.png');
        $timebox->resize9($tw + 40, 40, 15, 15, 62, 10);
        $x = ($timebox->width() - $tw) / 2;
        $y = 20 + $th / 2;
        $timebox->ttftext($text, DATA.'font/simhei.ttf', $fontsize, $x, $y, 0, 0xffffff);

        $this->bg->copyfull($timebox, (640 - $timebox->width()) / 2, $this->chat_y);

        $this->chat_y += $timebox->height() + 20;
    }

    public function iSay(MImage $avatar, $text) {
        $this->chat_y += 20;
        $fontsize = 27;
        $avatar->resize(80, 80);
        $this->bg->copy($avatar, 540, $this->chat_y, 0, 0, 80, 80);

        $formatChatText = $this->formatChatText($text, $fontsize);
        $rect = $this->getFontRect($formatChatText, $fontsize, DATA.'font/simhei.ttf');
        list($rx, $ry, $rw, $rh) = $rect;

        $chatbox = MImage::imageFromFile(DATA.'image/chat-me.png');
        $chatbox->resize9($rw + 70, $rh + 50, 30, 60, 180, 10);
        $chatbox->ttftext($formatChatText, DATA.'font/simhei.ttf', $fontsize, 34 + $rx, 25 - $ry);

        $this->bg->copy($chatbox, 530 - $chatbox->width(), $this->chat_y, 0, 0, $chatbox->width(), $chatbox->height());

        $this->chat_y += max($avatar->height(), $chatbox->height()) + 20;
    }

    public function taSay(MImage $avatar, $text) {
        $this->chat_y += 20;
        $fontsize = 27;
        $avatar->resize(80, 80);
        $this->bg->copy($avatar, 20, $this->chat_y, 0, 0, 80, 80);

        $formatChatText = $this->formatChatText($text, $fontsize);
        $rect = $this->getFontRect($formatChatText, $fontsize, DATA.'font/simhei.ttf');
        list($rx, $ry, $rw, $rh) = $rect;

        $chatbox = MImage::imageFromFile(DATA.'image/chat-ta.png');
        $chatbox->resize9($rw + 70, $rh + 50, 60, 60, 180, 10);
        $chatbox->ttftext($formatChatText, DATA.'font/simhei.ttf', $fontsize, 34 + $rx, 25 - $ry);

        $this->bg->copy($chatbox, 110, $this->chat_y, 0, 0, $chatbox->width(), $chatbox->height());

        $this->chat_y += max($avatar->height(), $chatbox->height()) + 20;
    }

    private function formatTitleText($text, $size) {
        $maxwidth = 370;
        $font = DATA.'font/simhei.ttf';
        $words = '';
        foreach (preg_split('/(?<!^)(?!$)/u', $text) as $c) {
            $r = imagettfbbox($size, 0, $font, $words.$c);
            if (abs($r[0] - $r[2]) > $maxwidth) {
                $words.= "...";
                break;
            }
            $words.= $c;
        }
        return $words;
    }

    private function formatChatText($text, $size) {
        $maxwidth = 400;
        $words = '';
        $array = preg_split('/(?<!^)(?!$)/u', $text);
        $font = DATA.'font/simhei.ttf';
        foreach ($array as $c) {
            $r = imagettfbbox($size, 0, $font, $words.$c);
            if (abs($r[0] - $r[2]) > $maxwidth) {
                $words.= "\n";
            }
            $words.= $c;
        }
        return $words;
    }

    private function getFontRect($text, $size, $fontfile) {
        $r = imagettfbbox($size, 0, $fontfile, $text);
        return array($r[6], $r[7], abs($r[0] - $r[2]), abs($r[1] - $r[7]));
    }

}
