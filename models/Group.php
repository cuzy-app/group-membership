<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\models;

use humhub\modules\user\models\User;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;

class Group extends \humhub\modules\user\models\Group
{
    /**
     * User is allowed to become member of this group himself
     * @param null|User $user
     * @return bool
     */
    public function canSelfBecomeMember($user = null)
    {
        if ($user === null) {
            if (Yii::$app->user->isGuest) {
                return false;
            }
            $user = Yii::$app->user->identity;
        }

        if (!$this->usersManageTheirMembership()) {
            return false;
        }

        // Can become member if not yet a member
        return !$this->isMember($user);
    }

    /**
     * Users are allowed to manage their membership to this group
     * @return bool
     */
    public function usersManageTheirMembership()
    {
        try {
            $permission = Yii::$app->user->getPermissionManager()->getById('users_manage_their_membership', 'group-membership');
            return (bool)Yii::$app->user->getPermissionManager()->getGroupState($this->id, $permission);
        } catch (InvalidConfigException|Throwable $e) {
            return false;
        }
    }

    /**
     * User is allowed to remove his membership himself of this group himself
     * @param null|User $user
     * @return bool
     * @throws InvalidConfigException
     */
    public function canSelfRemoveMembership($user = null)
    {
        if ($user === null) {
            if (Yii::$app->user->isGuest) {
                return false;
            }
            $user = Yii::$app->user->identity;
        }

        if (!$this->usersManageTheirMembership()) {
            return false;
        }

        // Cannot remove his membership if member of only this group
        if ((int)$user->getGroups()->count() <= 1) {
            return false;
        }

        // Can remove his membership if already a member
        return $this->isMember($user);
    }
}
