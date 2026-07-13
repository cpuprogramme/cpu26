<?php

namespace Dotclear\Theme\cpu26;

use Dotclear\Core\Process;

class Install extends Process
{
	public static function init(): bool
	{
		return self::status(My::checkContext(My::INSTALL));
	}

	public static function process(): bool
	{
		if (!self::status()) {
			return false;
		}

		My::settings()->put('active', false, 'boolean', 'Enable plugin', false, true);
		
		return true;
	}
}