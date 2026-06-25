<?php
# -- BEGIN LICENSE BLOCK ---------------------------------------
# This file is part of Ductile, a theme for Dotclear
#
# Copyright (c) 2011 - Association Dotclear
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK -----------------------------------------

if (!defined('DC_RC_PATH')) { return; }

l10n::set(dirname(__FILE__).'/locales/'.dcCore::app()->lang.'/main');



# Access to twitter-player
\Dotclear\App::url()->register('twitterplayer', 'm', '^twitter-player(?:/(.+))?$', ['CPU15_url', 'twitterplayer']);
\Dotclear\App::url()->register('showshortcut', 'ex', '^([0-9]{1,4})$', ['CPU15_url', 'showshortcut']);



## TODO modifier dcUrlHandlers vers Dotclear\Core\Frontend\Url
class CPU15_url extends Dotclear\Core\Frontend\Url
{

	public static function twitterplayer($args) {
		if ($args === '') {
			# No entry was specified.
			self::p404();
		}

		dcCore::app()->blog->withoutPassword(false);
		$params = new ArrayObject([ 'post_url' => $args ]);
		dcCore::app()->callBehavior('publicPostBeforeGetPosts',$params,$args);

		dcCore::app()->ctx->posts = dcCore::app()->blog->getPosts($params);
		if (dcCore::app()->ctx->posts->isEmpty()) {
			# The specified entry does not exist.
			self::p404();
		}

		self::serveDocument('twitter-player.html');
	}	

	public static function showshortcut($args) {
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

		dcCore::app()->blog->withoutPassword(false);
		$params = new ArrayObject([
			'post_status' 	=> 1, 		# published
			'post_type'		=> 'post',
			'no_content' 	=> true, 		# no need to fetch contents
			'sql' 			=> ' and ( "post_title" like \'Ex'.$numero.'%\' )'

		]);
		$post = dcCore::app()->blog->getPosts($params);
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