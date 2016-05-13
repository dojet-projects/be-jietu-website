<?php

Dispatcher::loadRoute(
    array(
        '/^$/' => UI.'HomeAction',
        '/^tu$/' => UI.'TuAction',
        '/^wechat$/' => UI.'WeChatAction',
    )
);
