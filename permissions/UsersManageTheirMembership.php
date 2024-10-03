<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/group-membership
 * @license https://github.com/cuzy-app/group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\permissions;

use humhub\libs\BasePermission;
use humhub\modules\user\models\User;
use Yii;

/**
 * UsersManageTheirMembership permission allows users to manage their membership to this group
 */
class UsersManageTheirMembership extends BasePermission
{
    /**
     * @inheritdoc
     */
    protected $id = 'users_manage_their_membership';

    /**
     * @inheritdoc
     */
    protected $moduleId = 'group-membership';

    /**
     * @inheritdoc
     */
    protected $fixedGroups = [
        User::USERGROUP_USER,
        User::USERGROUP_GUEST,
    ];

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->title = Yii::t('GroupMembershipModule.permissions', 'Users can become a member of this group');
        $this->description = Yii::t('GroupMembershipModule.permissions', 'Users are allowed to become a member of this group (or exit) themselves');
    }

}
