<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/group-membership
 * @license https://github.com/cuzy-app/group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership;

use humhub\helpers\ControllerHelper;
use humhub\modules\ui\menu\MenuLink;
use humhub\modules\user\widgets\AccountMenu;
use Yii;
use yii\base\Event;

class Events
{
    /**
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
            'isActive' => ControllerHelper::isActivePath('group-membership', 'user'),
            'isVisible' => true,
        ]));
    }
}
