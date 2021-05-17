<?php
/* @var $this \yii\web\View */
/* @var $groups humhub\modules\groupMembership\models\Group[] */

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\directory\widgets\GroupUsers;
?>

<div class="panel panel-default groups">

    <div class="panel-heading">
        <?= Yii::t('DirectoryModule.base', '<strong>Member</strong> Group Directory'); ?>
    </div>

    <div class="panel-body">
        <?php foreach ($groups as $group): ?>
            
            <?php if ($group->canSelfBecomeMember()): ?>
                <div class="pull-right">
                    <?= Html::a(
                        Yii::t('GroupMembershipModule.base', 'Become member'),
                        Url::to(['add-membership', 'groupId' => $group->id]),
                        [
                            'class' => 'btn btn-primary btn-sm',
                        ]
                    ) ?>
                </div>
            <?php endif; ?>

            <?php if ($group->canSelfRemoveMembership()): ?>
                <div class="pull-right">
                    <?= Html::a(
                        Yii::t('GroupMembershipModule.base', 'Cancel membership'),
                        Url::to(['cancel-membership', 'groupId' => $group->id]),
                        [
                            'class' => 'btn btn-info btn-sm',
                        ]
                    ) ?>
                </div>
            <?php endif; ?>

            <h1><?= Html::encode($group->name); ?></h1>

            <p class="hint-block">
                <?= Html::encode($group->description); ?>
            </p>
            <?= GroupUsers::widget(['group' => $group]); ?>
            <hr>
        <?php endforeach; ?>
    </div>

</div>
