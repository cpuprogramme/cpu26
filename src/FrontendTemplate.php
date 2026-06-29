<?php

namespace Dotclear\Theme\cpu26;

use ArrayObject;
use Dotclear\App;

class FrontendTemplate
{
	public static function AttachmentsNo($attr, $content) {
		return
		"<?php\n".
		'if (App::frontend()->context()->posts !== null && App::media()) {'."\n".
			'App::frontend()->context()->attachments = new ArrayObject(App::media()->getPostMedia(App::frontend()->context()->posts->post_id));'."\n".
		"?>\n".
		
		'<?php if (sizeof(App::frontend()->context()->attachments) === 0) ?>'.
		$content.
		
		"<?php } ?>\n";
	}

	public static function EntryURLsegment($attr) {
		return '<?php echo App::frontend()->context()->posts->post_url ; ?>';
	}

	public static function Entry1stLevelCategory($attr,$content) {
		return
		"<?php\n".
		'App::frontend()->context()->categories = App::blog()->getCategoryParents(App::frontend()->context()->posts->cat_id);'."\n".
		'App::frontend()->context()->categories->fetch();'.
		"\n".
		' if (App::frontend()->context()->categories !== null) { ?>'.
			"\n".
			$content.
			"\n".
		'<?php }'.
		"\n".
		' App::frontend()->context()->categories = null; ?>';
	}

	public static function CountEntriesInSeries($attr) 
	{
		$that = App::frontend()->template();
		$f = $that->getFilters($attr);
		$prefix = App::db()->con()->prefix();

		return 
			"<?php \n".
			'$sql = "SELECT count(*) FROM ".'.
			'    "'.$prefix.'meta as m," .'.
			'    "'.$prefix.'post as p ".'.
			'    " WHERE m.post_id = p.post_id " .'.
			'    " AND post_type = \'post\' ".'.
			'    " AND post_status = 1 ".'.
			'    " AND blog_id = \'" . App::blog()->id . "\'" .'.
			'	" AND meta_type = \'serie\' AND meta_id = \'".App::frontend()->context()->meta->meta_id."\' ;";'.
			'$rs = App::db()->con()->select($sql);'.
			'$_nb = $rs->f(0); ?>'.
			$that->displayCounter(
				sprintf($f, '$_nb'),
				array(
					'none' => '(prochainement)', 
					'one' => 'un épisode', 
					'more' => '%s épisodes', 
				),
				$attr
			);
	}

	public static function EpisodeNumber($attr) {
		return '<?php echo substr(App::frontend()->context()->posts->post_title, 2, 4); ?>';
	}

	public static function EpisodeCountReset(ArrayObject $attr) {
		# Ugly but faster
		return  '<?php $_EpisodeCountReset = 0; ?>';
	}

	public static function EpisodeCountLowerThan(ArrayObject $attr, string $content) {
		$number = (int) $attr['number'];
		return 
			'<?php if ( $_EpisodeCountReset++ < '.$number.' ) { ?>' . $content . '<?php }  ?>';
	}

	public static function SeriesNotLostAndFound($attr,$content) {
		return 
			'<?php if (App::frontend()->context()->meta->meta_id != "lost and found") { ?>' . $content . '<?php }  ?>';

	}
}