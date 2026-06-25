<?php
# Adapted from https://dotclear.watch/Billet/Fichier-Frontend-d-un-module
# TEMPORAIRE cf https://forum.dotclear.org/viewtopic.php?pid=350354

namespace Dotclear\Theme\cpu26;

use dcCore;
use Dotclear\Core\Process;

class Frontend extends Process
{
	public static function init(): bool
	{
		return self::status(My::checkContext(My::FRONTEND));
	}

	public static function process(): bool
	{
		if (!self::status()) {
			return false;
		}

		// Only for test
		foreach ([
			'EntryURLsegment', 
			'CountEntriesInSeries',
			'EpisodeNumber',
			'EpisodeCountReset',

		] as $template) {
			dcCore::app()->tpl->addValue($template,	[FrontendTemplate::class,$template]);
		}

		foreach ([
			'Entry1stLevelCategory',
			'AttachmentsNo',
			'SeriesNotLostAndFound',
			'EpisodeCountLowerThan'
		] as $template) {
			dcCore::app()->tpl->addBlock($template,	[FrontendTemplate::class,$template]);
		}


		return true;
	}

}


