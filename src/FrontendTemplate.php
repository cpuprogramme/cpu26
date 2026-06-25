<?php

namespace Dotclear\Theme\cpu26;

use ArrayObject;
use dcCore;

class FrontendTemplate
{
	public static function AttachmentsNo($attr, $content) {
		return
		"<?php\n".
		'if (dcCore::app()->ctx->posts !== null && dcCore::app()->media) {'."\n".
			'dcCore::app()->ctx->attachments = new ArrayObject(dcCore::app()->media->getPostMedia(dcCore::app()->ctx->posts->post_id));'."\n".
		"?>\n".
		
		'<?php if (sizeof(dcCore::app()->ctx->attachments) === 0) ?>'.
		$content.
		
		"<?php } ?>\n";
	}

	public static function EntryURLsegment($attr) {
		return '<?php echo dcCore::app()->ctx->posts->post_url ; ?>';
	}

	public static function Entry1stLevelCategory($attr,$content) {
		return
		"<?php\n".
		'dcCore::app()->ctx->categories = dcCore::app()->blog->getCategoryParents(dcCore::app()->ctx->posts->cat_id);'."\n".
		'dcCore::app()->ctx->categories->fetch();'.
		"\n".
		' if (dcCore::app()->ctx->categories !== null) { ?>'.
			"\n".
			$content.
			"\n".
		'<?php }'.
		"\n".
		' dcCore::app()->ctx->categories = null; ?>';
	}

	public static function CountEntriesInSeries($attr) 
	{
		$that = dcCore::app()->tpl;
		$f = $that->getFilters($attr);

		return 
			"<?php \n".
			'$sql = "SELECT count(*) FROM ".'.
			'    dcCore::app()->prefix . "meta as m," .'.
			'    dcCore::app()->prefix . "post as p ".'.
			'    " WHERE m.post_id = p.post_id " .'.
			'    " AND post_type = \'post\' ".'.
			'    " AND post_status = 1 ".'.
			'    " AND blog_id = \'" . dcCore::app()->blog->id . "\'" .'.
			'	" AND meta_type = \'serie\' AND meta_id = \'".dcCore::app()->ctx->meta->meta_id."\' ;";'.
			'$rs = dcCore::app()->con->select($sql);'.
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
		return '<?php echo substr(dcCore::app()->ctx->posts->post_title, 2, 4); ?>';
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
			'<?php if (dcCore::app()->ctx->meta->meta_id != "lost and found") { ?>' . $content . '<?php }  ?>';

	}
}