<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb839a13f5f0900ceb6def6bb6c84eeb7
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'Jenssegers\\ImageHash\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Jenssegers\\ImageHash\\' => 
        array (
            0 => __DIR__ . '/..' . '/jenssegers/imagehash/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb839a13f5f0900ceb6def6bb6c84eeb7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb839a13f5f0900ceb6def6bb6c84eeb7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
