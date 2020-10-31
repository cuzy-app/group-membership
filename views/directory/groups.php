<?php
/* @var $this \yii\web\View */
/* @var $groups humhub\modules\user\models\Group[] */

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\directory\widgets\GroupUsers;
?>

<div class="panel panel-default groups">

    <div class="panel-heading">
        <?= Yii::t('DirectoryModule.base', '<strong>Member</strong> Group Directory'); ?>
    </div>

    <div class="panel-body">
        <?php foreach ($groups as $group) : ?>
            <?php
            $permission = Yii::$app->user->permissionManager->getById('users_manage_their_membership', 'group-membership');
            $canManageHisMembership = Yii::$app->user->permissionManager->getGroupState($group->id, $permission);
            ?>

            <?php if ($canManageHisMembership): ?>
                <div class="pull-right">

                    <?php if ($group->isMember(Yii::$app->user->identity)): ?>
                        <?= Html::a(
                            Yii::t('GroupMembershipModule.base', 'Cancel membership'),
                            Url::to(['cancel-membership', 'groupId' => $group->id]),
                            [
                                'class' => 'btn btn-info btn-sm',
                            ]
                        ) ?>
                    <?php else: ?>
                        <?= Html::a(
                            Yii::t('GroupMembershipModule.base', 'Become member'),
                            Url::to(['add-membership', 'groupId' => $group->id]),
                            [
                                'class' => 'btn btn-primary btn-sm',
                            ]
                        ) ?>
                    <?php endif ?>

                </div>
            <?php endif ?>

            <h1><?= Html::encode($group->name); ?></h1>

            <p class="hint-block">
                <?= Html::encode($group->description); ?>
            </p>
            <?= GroupUsers::widget(['group' => $group]); ?>
            <hr>
        <?php endforeach; ?>
    </div>

</div>
