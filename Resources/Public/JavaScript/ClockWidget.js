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
 * Module: TYPO3/CMS/ServerClock/ClockWidget
 * Show server clock widget
 */
define(['jquery'], function($) {
	ClockWidget = ClockWidget || {};
	var sec = 0;
	ClockWidget.drawClock = function() {
		(sec == 60 ) ? sec = 1 : sec++;
		ClockWidget.date.setSeconds(sec);
		$("#serverclock-clock").html(ClockWidget.date.format(ClockWidget.serverClockDateTimeFormat));
	};
	ClockWidget.checkTime = function(i) {
		if (i < 10) {i = "0" + i};
		return i;
	};
	$(function() {
		setInterval(ClockWidget.drawClock, 1000);
		ClockWidget.date = new Date(ClockWidget.serverClockStartTime);
		sec = ClockWidget.date.getSeconds();
		$(ClockWidget.queryElement).prepend("<li id='tutorboy-serverclock'><div id='serverclock-clock'></div><div id='serverclock-timezone'></div></li>");
		$("#serverclock-clock").html(ClockWidget.date.format(ClockWidget.serverClockDateTimeFormat));
		$("#serverclock-timezone").html(ClockWidget.serverClockTimeZone);
	});
	return ClockWidget;
});