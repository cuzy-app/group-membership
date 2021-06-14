<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace  humhub\modules\groupMembership;

use Yii;
use yii\base\Event;
use humhub\modules\ui\menu\MenuLink;

class Events
{
    /**
     * Remove some entries in the user account menu
     * @param Event $event
     */
    public static function onUserAccountMenuInit(Event $event)
    {
        /** @var \humhub\modules\user\widgets\AccountMenu $menu */
        $menu = $event->sender;

        $menu->addEntry(new MenuLink([
            'id' => 'directory-groups',
            'icon' => 'users',
            'label' => Yii::t('GroupMembershipModule.base', 'My groups'),
            'url' => ['/group-membership/user/index'],
            'sortOrder' => 1000,
            'isActive' => MenuLink::isActiveState('group-membership', 'user')
        ]));
    }
}
