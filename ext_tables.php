<?php

defined('TYPO3_MODE') or die();
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['constructPostProcess'][] = 'Tutorboy\\ServerClock\\Hook\\BackendControllerHook->insertClockWidget';
