<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

use humhub\modules\groupMembership\Events;
use humhub\modules\user\widgets\AccountMenu;

return [
	'id' => 'group-membership',
	'class' => 'humhub\modules\groupMembership\Module',
	'namespace' => 'humhub\modules\groupMembership',
	'events' => [
        [
            'class' => AccountMenu::class,
            'event' => AccountMenu::EVENT_INIT,
            'callback' => [Events::class, 'onUserAccountMenuInit']
        ],
	],
];
