<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/group-membership
 * @license https://github.com/cuzy-app/group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\controllers;

use humhub\modules\groupMembership\models\Group;
use humhub\modules\groupMembership\models\User;
use humhub\modules\user\components\BaseAccountController;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\HttpException;
use yii\web\Response;


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
     * @return \yii\console\Response|Response
     * @throws InvalidConfigException
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
     * @return \yii\console\Response|Response
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws StaleObjectException
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
