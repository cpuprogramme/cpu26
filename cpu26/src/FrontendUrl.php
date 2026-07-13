<?php

/**
 * @package     Dotclear
 *
 * @copyright   Olivier Meunier & Association Dotclear
 * @copyright   AGPL-3.0
 */
declare(strict_types=1);

namespace Dotclear\Theme\cpu26;

use Dotclear\App;
use Dotclear\Core\Url;
use ArrayObject;

/**
 * @brief   The module frontend URL.
 * @ingroup tags
 */
class FrontendUrl extends Url
{

	public static function TwitterPlayer(?string $args): void {
		if ($args === '') {
			# No entry was specified.
			self::p404();
		}

		App::blog()->withoutPassword(false);
		$params = new ArrayObject([ 'post_url' => $args ]);
		App::behavior()->callBehavior('publicPostBeforeGetPosts',$params,$args);

		App::frontend()->context()->posts = App::blog()->getPosts($params);
		if (App::frontend()->context()->posts->isEmpty()) {
			# The specified entry does not exist.
			self::p404();
		}

		self::serveDocument('twitter-player.html');
	}	

	public static function ShowShortcut(?string $args): void  {
		if ($args === '') {
			# No entry was specified.
			self::p404();
		}

		$numero_number = intval($args, 10);

		if ($numero_number < 1) {
			# uncorrect number ?
			self::p404();
		}

		$numero = str_pad(strval($numero_number), 4, '0', STR_PAD_LEFT);

		App::blog()->withoutPassword(false);
		$params = new ArrayObject([
			'post_status' 	=> 1, 		# published
			'post_type'		=> 'post',
			'no_content' 	=> true, 		# no need to fetch contents
			'sql' 			=> ' and ( "post_title" like \'Ex'.$numero.'%\' )'

		]);
		$post = App::blog()->getPosts($params);
		if ($post->isEmpty()) {
			# The specified entry does not exist.
			self::p404();
		}

		$redirect = '/post/'.$post->post_url;
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$redirect);
		header('Content-Type: text/html; charset=UTF-8');
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>
				<head>
					<title>Ce document est à une autre adresse - This document is at another location</title>
					<meta http-equiv="refresh" content="0;url='.$redirect.'" />
					<link rel="top" href="/" />
					<link rel="canonical" href="'.$redirect.'" />
				</head><body>
					<p lang="fr"><a href="'.$redirect.'">Ce document est en fait à une autre adresse, canonique&nbsp;: '.$redirect.'</a></p>
					<p lang="en"><a href="'.$redirect.'">This document is actually at this canonical address&nbsp;: '.$redirect.'</a></p>
				</body>
				</html>';

		exit;
	}
}
