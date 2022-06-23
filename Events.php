<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership;

use humhub\modules\ui\menu\MenuLink;
use humhub\modules\user\widgets\AccountMenu;
use Yii;
use yii\base\Event;

class Events
{
    /**
     * Remove some entries in the user account menu
     * @param Event $event
     */
    public static function onUserAccountMenuInit(Event $event)
    {
        /** @var AccountMenu $menu */
        $menu = $event->sender;

        $menu->addEntry(new MenuLink([
            'id' => 'directory-groups',
            'icon' => 'users',
            'label' => Yii::t('GroupMembershipModule.base', 'My groups'),
            'url' => ['/group-membership/user/index'],
            'sortOrder' => 1000,
            'isActive' => MenuLink::isActiveState('group-membership', 'user'),
            'isVisible' => true,
        ]));
    }
}
