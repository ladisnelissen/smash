<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9ce64476e71b50c8551f94372b3e172
{
    public static $classMap = array (
        'Api' => __DIR__ . '/../..' . '/classes/Api.php',
        'Comment' => __DIR__ . '/../..' . '/classes/Comment.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Db' => __DIR__ . '/../..' . '/classes/Db.php',
        'Follower' => __DIR__ . '/../..' . '/classes/Follower.php',
        'Like' => __DIR__ . '/../..' . '/classes/Like.php',
        'Mailer' => __DIR__ . '/../..' . '/classes/Mailer.php',
        'Post' => __DIR__ . '/../..' . '/classes/Post.php',
        'Report' => __DIR__ . '/../..' . '/classes/Report.php',
        'Smashed' => __DIR__ . '/../..' . '/classes/Smashed.php',
        'Tag' => __DIR__ . '/../..' . '/classes/Tag.php',
        'Upload' => __DIR__ . '/../..' . '/classes/Upload.php',
        'User' => __DIR__ . '/../..' . '/classes/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitb9ce64476e71b50c8551f94372b3e172::$classMap;

        }, null, ClassLoader::class);
    }
}