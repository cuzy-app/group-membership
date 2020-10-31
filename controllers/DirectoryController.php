<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/tree/master/docs/LICENCE.md
 * @author [Marc Farre](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

namespace humhub\modules\groupMembership\controllers;

use Yii;
use yii\base\Event;
use humhub\modules\user\models\Group;
use humhub\modules\directory\components\Controller;
use humhub\modules\directory\widgets\Sidebar;
use humhub\modules\directory\widgets\GroupStatistics;


class DirectoryController extends Controller
{
    public function actionAddMembership($groupId)
    {
        $group = Group::findOne($groupId);
        if ($group !== null) {
            $group->addUser(Yii::$app->user->identity);
        }
        return $this->redirect(['groups']);
    }


    public function actionCancelMembership($groupId)
    {
        $group = Group::findOne($groupId);
        if ($group !== null) {
            $group->removeUser(Yii::$app->user->identity);
        }
        return $this->redirect(['groups']);
    }


    /**
     * Renders the groups view for the module
     *
     * @return string
     */
    public function actionGroups()
    {
        $directoryModule = Yii::$app->getModule('directory');

        if (!$directoryModule->isGroupListingEnabled()) {
            return $this->redirect(['/directory/directory/members']);
        }

        $groups = Group::getDirectoryGroups();

        Event::on(Sidebar::class, Sidebar::EVENT_INIT, function ($event) {
            $event->sender->addWidget(GroupStatistics::class, [], ['sortOrder' => 10]);
        });

        return $this->render('groups', [
            'groups' => $groups,
        ]);
    }

}

