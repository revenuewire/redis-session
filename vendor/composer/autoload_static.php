<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2fc565295e900ab5f8332e6418e6d9b
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RW\\' => 3,
        ),
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RW\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2fc565295e900ab5f8332e6418e6d9b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2fc565295e900ab5f8332e6418e6d9b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
