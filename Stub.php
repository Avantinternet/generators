<?php

namespace Avantinternet\Generators;

class Stub extends \Avantinternet\Support\Stub
{
	/**
	 * Get base path.
	 * 
	 * @return string
	 */
	public static function getBasePath()
	{
        return str_finish(config('generators.template_path', __DIR__.'/Stubs/'), '/');
	}
}
