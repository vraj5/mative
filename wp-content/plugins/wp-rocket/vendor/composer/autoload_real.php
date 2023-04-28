<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit02f428c9a20c4bbfd2460188ae5962a8
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit02f428c9a20c4bbfd2460188ae5962a8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit02f428c9a20c4bbfd2460188ae5962a8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit02f428c9a20c4bbfd2460188ae5962a8::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
