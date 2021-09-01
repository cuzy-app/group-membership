<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\models;

class User extends \humhub\modules\user\models\User
{
    /**
     * @inerhitdoc
     * Adds ordering
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])
            ->via('groupUsers')
            ->orderBy([
                'group.sort_order' => SORT_ASC,
                'group.name' => SORT_ASC,
            ]);
    }


    /**
     * @return Group[]
     */
    public function getGroupsCanJoin()
    {
        // Search for groups shown in directory
        $query = Group::find()
            ->where(['show_at_directory' => '1'])
            ->orderBy([
                'group.sort_order' => SORT_ASC,
                'group.name' => SORT_ASC,
            ]);
        $groupsCanJoin = [];
        foreach ($query->all() as $group) {
            if ($group->canSelfBecomeMember()) {
                $groupsCanJoin[] = $group;
            }
        }
        return $groupsCanJoin;
    }
}