<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership;

use Yii;
use yii\helpers\Url;


class Module extends \humhub\components\Module
{
    public $resourcesPath = 'resources';


    public function getName()
    {
        return Yii::t('GroupMembershipModule.base', 'Group membership');
    }

    public function getDescription()
    {
        return Yii::t('GroupMembershipModule.base', 'Adds the possibility for certain groups to allow users to become member themselves');
    }

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/group-membership/config']);
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        if ($contentContainer === null) {
            return [
                new permissions\UsersManageTheirMembership,
            ];
        }
        return [];
    }
}
