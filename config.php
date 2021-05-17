<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

use humhub\modules\groupMembership\Events;
use humhub\modules\ui\menu\widgets\Menu;
use humhub\modules\directory\controllers\DirectoryController;

return [
	'id' => 'group-membership',
	'class' => 'humhub\modules\groupMembership\Module',
	'namespace' => 'humhub\modules\groupMembership',
	'events' => [
        [
        	'humhub\modules\directory\widgets\Menu',
        	Menu::EVENT_INIT,
        	[Events::class, 'onDirectoryMenuInit']
        ],
        [
        	DirectoryController::class,
        	DirectoryController::EVENT_BEFORE_ACTION,
        	[Events::class, 'onDirectoryBeforeAction']
        ],
	],
];
