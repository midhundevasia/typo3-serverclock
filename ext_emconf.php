<?php
/*
 * This file is part of the ServerClock project.
 * Copyright (C) 2016  Midhun Devasia <hello@midhundevasia.com>
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * ServerClock - Shows server clock
 */
$EM_CONF[$_EXTKEY] = [
	'title' => 'Server Clock: Server Time and Timezone',
	'description' => 'A Clock which shows server time and timezone in backend',
	'category' => 'services',
	'author' => 'Midhun Devasia',
	'author_email' => 'hello@midhundevasia.com',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '1.0.0',
	'constraints' => [
		'depends' => [
			'typo3' => '7.6.0-8.9.99',
		],
		'conflicts' => [],
		'suggests' => [],
	],
];