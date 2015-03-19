<?php
namespace Dwoo\Plugins\Functions;

use Dwoo\Compiler;
use Dwoo\ICompilable;
use Dwoo\Plugin;

/**
 * Counts the words in a string
 * <pre>
 *  * value : the string to process
 * </pre>
 * This software is provided 'as-is', without any express or implied warranty.
 * In no event will the authors be held liable for any damages arising from the use of this software.
 *
 * @author     David Sanchez <david38sanchez@gmail.com>
 * @copyright  Copyright (c) 2014, David Sanchez
 * @license    http://dwoo.org/LICENSE GNU Lesser General Public License v3.0
 * @link       http://dwoo.org/
 * @version    2.0
 * @date       2014-02-24
 * @package    Dwoo
 */
class FunctionCountWords extends Plugin implements ICompilable {

	public static function compile(Compiler $compiler, $value) {
		return 'preg_match_all(strcasecmp($this->charset, \'utf-8\')===0 ? \'#[\w\pL]+#u\' : \'#\w+#\', ' . $value . ', $tmp)';
	}
}

