<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gravatar Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the Gravatar connections setup for your application.
    | See https://gravatar.com/site/implement/images/ for details.
    |
    | Possible Keys:
    |
    | url           The base URL:
    |                   https://secure.gravatar.com/avatar         (Default)
    |                   https://gravatar.cat.net/avatar            (China Mirror)
    |                   https://v2ex.assets.uxengine.net/gravatar  (China Mirror)
    | size / s      Avatar size in pixel, default is 80.
    | default / d   The default avatar image:
    |                   404, mm, identicon, monsterid, wavatar, retro,
    |                   robohash, blank, http://image/url
    | rating / r    The highest avatar rating, default is "g": g, pg, r, x.
    | forcedefault / f  If for some reason you wanted to force the default image
    |                   to always load, set this value to "y".
    |
    */

    'default' => [
        'url' => 'https://gravatar.cat.net/avatar',
        'size' => 120,
    ],

    'small' => [
        'url' => 'https://gravatar.cat.net/avatar',
        'd' => 'wavatar',
        'size' => 40,
    ],

    'large' => [
        'url' => 'https://gravatar.cat.net/avatar',
        'size' => 460,
    ],

    /*
     * // 为 email 生成头像地址，使用 "default" 连接配置
        gravatar('foo@example.com');

        // 为 email 的 MD5 哈希值生成头像地址，使用 "default" 连接配置
        gravatar('b48def645758b95537d4424c84d1a9ff');

        // 使用 "large" 连接配置
        gravatar($email, 'large');

        // 使用 "default" 连接配置，并覆盖 size 参数为 100
        gravatar($email, 100);

        // 使用 "avatar" 连接配置，并覆盖 size 参数为 100
        gravatar($email, 'avatar', 100);
        // 或者：
        gravatar($email, 100, 'avatar');
     */

];
