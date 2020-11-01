<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc Farre](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\models;

use Yii;

class Group extends \humhub\modules\user\models\Group
{
	/**
	 * User is allowed to become member of this group himself
	 */
	public function canSelfBecomeMember ($user = null) {
        if (!$this->usersManageTheirMembership()) {
        	return false;
        }

        // Can become member if not yet member
        return !$this->isMember(($user === null) ? Yii::$app->user->identity : $user);
	}

	/**
	 * User is allowed to remove his membership himself of this group himself
	 */
	public function canSelfRemoveMembership ($user = null) {
        if (!$this->usersManageTheirMembership()) {
        	return false;
        }

		if ($user === null) {
			$user = Yii::$app->user->identity;
		}

		// Cannot remove his membership if member of only this group
        if (count($user->groups) == 1) {
        	return false;
        }

        // Can remove his membership if already member
        return $this->isMember($user);
	}

	/**
	 * Users are allowed to manage their membership to this group
	 */
	public function usersManageTheirMembership () {
        $permission = Yii::$app->user->permissionManager->getById('users_manage_their_membership', 'group-membership');
        return Yii::$app->user->permissionManager->getGroupState($this->id, $permission);
	}
}