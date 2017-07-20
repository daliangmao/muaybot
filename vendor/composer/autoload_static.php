<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4b173fc86e23608614ce9214545f0cec
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '72579e7bd17821bb1321b87411366eae' => __DIR__ . '/..' . '/illuminate/support/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'L' => 
        array (
            'LINE\\' => 5,
        ),
        'I' => 
        array (
            'Illuminate\\Support\\' => 19,
            'Illuminate\\Contracts\\' => 21,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
            'GuzzleHttp\\' => 11,
        ),
        'F' => 
        array (
            'Firebase\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
        'Illuminate\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/support',
        ),
        'Illuminate\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/contracts',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Firebase\\' => 
        array (
            0 => __DIR__ . '/..' . '/eelkevdbos/firebase-php/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Doctrine\\Common\\Inflector\\' => 
            array (
                0 => __DIR__ . '/..' . '/doctrine/inflector/lib',
            ),
        ),
    );

    public static $classMap = array (
        'BeforeValidException' => __DIR__ . '/..' . '/firebase/php-jwt/Exceptions/BeforeValidException.php',
        'ExpiredException' => __DIR__ . '/..' . '/firebase/php-jwt/Exceptions/ExpiredException.php',
        'JWT' => __DIR__ . '/..' . '/firebase/php-jwt/Authentication/JWT.php',
        'SignatureInvalidException' => __DIR__ . '/..' . '/firebase/php-jwt/Exceptions/SignatureInvalidException.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4b173fc86e23608614ce9214545f0cec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4b173fc86e23608614ce9214545f0cec::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit4b173fc86e23608614ce9214545f0cec::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit4b173fc86e23608614ce9214545f0cec::$classMap;

        }, null, ClassLoader::class);
    }
}
