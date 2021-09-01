<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\controllers;

use humhub\modules\user\components\BaseAccountController;
use Yii;
use humhub\modules\groupMembership\models\User;
use humhub\modules\groupMembership\models\Group;
use yii\web\HttpException;


class UserController extends BaseAccountController
{
    /**
     * Renders the groups view for the module
     * @return string
     * @throws HttpException
     */
    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->id);
        if ($user === null) {
            throw new HttpException(404, 'User not found');
        }
        return $this->render('index', [
            'groups' => $user->groups,
            'groupsCanJoin' => $user->getGroupsCanJoin(),
        ]);
    }


    /**
     * @param $groupId
     * @return \yii\console\Response|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionAddMembership($groupId)
    {
        $group = Group::findOne($groupId);
        if ($group !== null && $group->canSelfBecomeMember()) {
            $group->addUser(Yii::$app->user->identity);
        }
        return $this->redirect(['index']);
    }


    /**
     * @param $groupId
     * @return \yii\console\Response|\yii\web\Response
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\StaleObjectException
     */
    public function actionCancelMembership($groupId)
    {
        $group = Group::findOne($groupId);
        if ($group !== null && $group->canSelfRemoveMembership()) {
            $group->removeUser(Yii::$app->user->identity);
        }
        return $this->redirect(['index']);
    }
}

