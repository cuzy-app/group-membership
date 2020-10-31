<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/tree/master/docs/LICENCE.md
 * @author [Marc Farre](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace  humhub\modules\groupMembership;

use Yii;
use yii\helpers\Url;
use humhub\modules\ui\menu\MenuLink;

class Events
{
    public static function onDirectoryMenuInit($event)
    {
    	$menu = $event->sender;

        $directoryModule = Yii::$app->getModule('directory');

        if ($directoryModule->isGroupListingEnabled()) {

	        $menu->deleteItemByUrl(Url::to(['/directory/directory/groups']));

            $menu->addEntry(new MenuLink([
                'id' => 'directory-groups',
                'icon' => 'users',
                'label' => Yii::t('DirectoryModule.base', 'Groups'),
                'url' => ['/group-membership/directory/groups'],
                'sortOrder' => 100,
                'isActive' => MenuLink::isActiveState('group-membership', 'directory', 'groups')
            ]));
        }
    }
}
