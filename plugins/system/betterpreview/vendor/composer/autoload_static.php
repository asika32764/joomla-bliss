<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit39c772a53e9ac490da3a72c583727159
{
	public static $prefixLengthsPsr4 = array(
		'R' =>
			array(
				'RegularLabs\\BetterPreview\\' => 26,
			),
	);

	public static $prefixDirsPsr4 = array(
		'RegularLabs\\BetterPreview\\' =>
			array(
				0 => __DIR__ . '/../..' . '/src',
			),
	);

	public static function getInitializer(ClassLoader $loader)
	{
		return \Closure::bind(function () use ($loader)
		{
			$loader->prefixLengthsPsr4 = ComposerStaticInit39c772a53e9ac490da3a72c583727159::$prefixLengthsPsr4;
			$loader->prefixDirsPsr4    = ComposerStaticInit39c772a53e9ac490da3a72c583727159::$prefixDirsPsr4;
		}, null, ClassLoader::class);
	}
}
