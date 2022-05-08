<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8974a86a7b37e4ed764a73e61011bbc4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'SimpleXLS' => __DIR__ . '/..' . '/shuchkin/simplexls/src/SimpleXLS.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8974a86a7b37e4ed764a73e61011bbc4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8974a86a7b37e4ed764a73e61011bbc4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8974a86a7b37e4ed764a73e61011bbc4::$classMap;

        }, null, ClassLoader::class);
    }
}
