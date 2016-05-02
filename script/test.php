<?php
include dirname(__FILE__).'/script_init.php';

$retry = 3;
while ($retry-- > 0) {
    if ($retry >= 0) {
        println($retry);
    }
}
