<?php
# -- BEGIN LICENSE BLOCK ---------------------------------------
# This file is part of Currywurst, a theme for Dotclear
#
# Copyright (c) Association Dotclear
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK -----------------------------------------

if (!defined('DC_RC_PATH')) { return; }


$this->registerModule(
	/* Name */				"CPU 2026",
	/* Description*/		"D'après le thème Berlin, par défaut de Dotclear 2.38",
	/* Author */			"Dotclear Team, remixé par Dascritch",
	/* Version */			'2.0',
	/* Properties */		[
								'type' => 'theme',
								'requires' => [
									['core', '2.38'],
									// ['cpuAudioPublic', '3.1'] // n'arrive ps à le détecter ??? du coup désactive systématiquement le thème
								],
								# Widget rendering
								'widgetcontainerformat' => '<details class="%1$s" %2$s>%3$s</details>',
								'widgettitleformat' => '<summary><h3>%s</h3></summary>', # Needed to force widgets to use h3 
								'widgetsubtitleformat'  => '<summary><h3>%s</h3></summary>',
/*
        'widgettitleformat'     => '', // formatage de widget (optionnel)
        'widgetsubtitleformat'  => '', // formatage de widget (optionnel)
        'widgetcontainerformat' => '', // formatage de widget (optionnel)
        */

							]
);
