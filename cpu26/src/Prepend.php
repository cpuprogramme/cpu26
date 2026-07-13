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
use Dotclear\Helper\Process\TraitProcess;
use Dotclear\Helper\L10n;

/**
 * @brief   The module prepend process.
 * @ingroup tags
 */
class Prepend
{
    use TraitProcess;

    public static function init(): bool
    {
        return self::status(My::checkContext(My::PREPEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        l10n::set(dirname(__FILE__).'/locales/'.App::lang()->getLang().'/main');

        # Access to twitter-player
        App::url()->register('twitterplayer', 'm', '^twitter-player(?:/(.+))?$', FrontendUrl::TwitterPlayer(...));
        App::url()->register('showshortcut', 'ex', '^([0-9]{1,4})$', FrontendUrl::ShowShortcut(...));


        return true;
    }
}
