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

/**
 * TYPO3 6 Compactibility
 * Show server clock widget
 */
var ClockWidget = ClockWidget || {};
var sec = 0;

ClockWidget.drawClock = function() {
	(sec == 60 ) ? sec = 1 : sec++;
	ClockWidget.date.setSeconds(sec);
	document.getElementById("serverclock-clock").innerHTML = ClockWidget.date.format(ClockWidget.serverClockDateTimeFormat);
};

ClockWidget.checkTime = function(i) {
	if (i < 10) {i = "0" + i};
	return i;
};

Ext.onReady(function() {
	setInterval(ClockWidget.drawClock, 1000);
	ClockWidget.date = new Date(ClockWidget.serverClockStartTime);
	sec = ClockWidget.date.getSeconds();
	var liNode = document.createElement("li");
	liNode.id = 'tutorboy-serverclock';
	liNode.className = 't36-com separator';
	liNode.innerHTML = "<div id='tutorboy-serverclock-inner'><div id='serverclock-clock'></div><div id='serverclock-timezone'></div></div>";
	document.getElementById(ClockWidget.queryElement).prepend(liNode);
	document.getElementById("serverclock-clock").innerHTML = ClockWidget.date.format(ClockWidget.serverClockDateTimeFormat);
	document.getElementById("serverclock-timezone").innerHTML = ClockWidget.serverClockTimeZone;
});