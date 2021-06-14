<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/humhub-modules-group-membership
 * @license https://github.com/cuzy-app/humhub-modules-group-membership/blob/main/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

use humhub\widgets\Button;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $groups humhub\modules\groupMembership\models\Group[] */
/* @var $groupsCanJoin humhub\modules\groupMembership\models\Group[] */
?>

<div class="panel panel-default groups">

    <div class="panel-heading">
        <strong><?= Yii::t('GroupMembershipModule.base', 'My Groups'); ?></strong>
    </div>

    <div class="panel-body">
        <h4><?= Yii::t('GroupMembershipModule.base', 'Groups of which I am a member'); ?></h4>

        <table class="table table-striped table-hover">
        <?php foreach ($groups as $group): ?>
            <tr>
                <td>
                    <?php if ($group->canSelfRemoveMembership()): ?>
                        <?= Button::danger(Yii::t('GroupMembershipModule.base', 'Cancel membership'))->link(['cancel-membership', 'groupId' => $group->id])->sm()->right()->confirm() ?>
                    <?php endif; ?>
                    <strong><?= Html::encode($group->name); ?></strong>
                    <br>
                    <span class="hint-block"><?= Html::encode($group->description); ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        <br>
        <h4><?= Yii::t('GroupMembershipModule.base', 'Others groups I can join'); ?></h4>

        <table class="table table-striped table-hover">
            <?php foreach ($groupsCanJoin as $group): ?>
                <tr>
                    <td>
                        <?= Button::success(Yii::t('GroupMembershipModule.base', 'Become member'))->link(['add-membership', 'groupId' => $group->id])->sm()->right()->confirm() ?>
                        <strong><?= Html::encode($group->name); ?></strong>
                        <br>
                        <span class="hint-block"><?= Html::encode($group->description); ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
