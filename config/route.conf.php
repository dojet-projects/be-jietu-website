<?php

Dispatcher::loadRoute(
    array(
        '/^$/' => UI.'HomeAction',
        '/^tu$/' => UI.'TuAction',
    )
);
