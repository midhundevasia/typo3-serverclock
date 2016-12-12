<?php
namespace Tutorboy\ServerClock\Hook;

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
 * ServerClock - Show server clock
 */

use TYPO3\CMS\Backend\Controller\BackendController;
use MT\Hotelsystem\Utility\OurUtility;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Hook for backend controller
 *
 * @package 	ServerClock
 * @subpackage 	Hook
 * @copyright 	(c) 2016 Midhun Devasia, Tutorboy.org
 * @author 		Midhun Devasia <hello@midhundevasia.com>
 */
class BackendControllerHook {

	/**
	 * Insert clock widget content
	 * @param array $configuration Configuration
	 * @param BackendController $backendController Backend controller
	 * @return void
	 */
	public function insertClockWidget(array $configuration, BackendController $backendController) {
		$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
		/** @var \TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility $configurationUtility */
		$configurationUtility = $this->objectManager->get('TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility');
		$extensionConfiguration = $configurationUtility->getCurrentConfiguration('server_clock');
		if (version_compare(TYPO3_branch, '8.0', '>=')) {
			$queryElement = '.scaffold-toolbar.t3js-scaffold-toolbar .toolbar.t3js-topbar-toolbar ul';
		}
		if (version_compare(TYPO3_branch, '7.0', '>=') && version_compare(TYPO3_branch, '8.0', '<')) {
			$queryElement = '#typo3-topbar-navigation .typo3-topbar-navigation-items';
		}
		if (version_compare(TYPO3_branch, '6.0', '>=') && version_compare(TYPO3_branch, '7.0', '<')) {
			$queryElement = 'typo3-toolbar';
		}
		$this->getPageRenderer()->addJsInlineCode('ServerClock', '
			var ClockWidget = ClockWidget || {};
			ClockWidget.serverClockTimeZone = "' . date_default_timezone_get() . '";
			ClockWidget.serverClockStartTime = "' . date('Y-m-d H:i:s') . '";
			ClockWidget.serverClockDateTimeFormat = "' . $extensionConfiguration['datetimeFormat']['value'] . '";
			ClockWidget.queryElement = "' . $queryElement . '";
		');

		// TYPO3 6 Compactibility
		if ($queryElement == 'typo3-toolbar') {
			$path = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('server_clock');
			$this->getPageRenderer()->addJsFile($path . 'Resources/Public/JavaScript/ClockWidget-T36Compact.js');
		} else {
			$this->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/ServerClock/ClockWidget');
		}

		$this->getPageRenderer()->addCssInlineBlock('ServerClockCss', '
			#tutorboy-serverclock {
				display: inline;
				padding: 4px 15px;
				height: 45px;
				float: left;
				text-align:right;
				color: #aaa;
				border-right: 1px solid #111111;
			}
			/*Only for TYPO3 6*/
			.t36-com {
				height: 30px !important;
			}
			#tutorboy-serverclock-inner {
				margin-top: -7px;
			}
		');
	}

	/**
	 * PageRenderer object
	 * @return PageRenderer
	 */
	protected function getPageRenderer() {
		return GeneralUtility::makeInstance(PageRenderer::class);
	}
}
