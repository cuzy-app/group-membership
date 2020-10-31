<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/tree/master/docs/LICENCE.md
 * @author [Marc Farre](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\permissions;

use Yii;
use humhub\modules\admin\components\BaseAdminPermission;

/**
 * ManageGlobalSurvey Permission allows to created, edit and delete global surveys
 */
class usersManageTheirMembership extends BaseAdminPermission
{
    /**
     * @inheritdoc
     */
    protected $id = 'users_manage_their_membership';

    /**
     * @inheritdoc
     */
    protected $moduleId = 'group-membership';


    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->title = Yii::t('GroupMembershipModule.permissions', 'Users manage their membership');
        $this->description = Yii::t('GroupMembershipModule.permissions', 'Users are allowed to become member of this group (or exit) themselves');
    }

}
