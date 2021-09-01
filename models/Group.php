<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\models;

use humhub\modules\user\models\User;
use Yii;

class Group extends \humhub\modules\user\models\Group
{
    /**
     * User is allowed to become member of this group himself
     * @param null $user
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
	public function canSelfBecomeMember ($user = null) {
        if ($user === null) {
            if (Yii::$app->user->isGuest) {
                return false;
            }
            $user = Yii::$app->user->identity;
        }

        if (!$this->usersManageTheirMembership()) {
        	return false;
        }

        // Can become member if not yet member
        return !$this->isMember($user);
	}

    /**
     * User is allowed to remove his membership himself of this group himself
     * @param null $user
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
	public function canSelfRemoveMembership ($user = null) {
        if ($user === null) {
            if (Yii::$app->user->isGuest) {
                return false;
            }
            $user = Yii::$app->user->identity;
        }
		
        if (!$this->usersManageTheirMembership()) {
        	return false;
        }

		if ($user === null) {
			$user = Yii::$app->user->identity;
		}

		// Cannot remove his membership if member of only this group
        if ($user->getGroups()->count() <= 1) {
        	return false;
        }

        // Can remove his membership if already member
        return $this->isMember($user);
	}

    /**
     * Users are allowed to manage their membership to this group
     * @return boolean
     * @throws \yii\base\InvalidConfigException
     */
	public function usersManageTheirMembership () {
        $permission = Yii::$app->user->permissionManager->getById('users_manage_their_membership', 'group-membership');
        return (bool)Yii::$app->user->permissionManager->getGroupState($this->id, $permission);
	}
}