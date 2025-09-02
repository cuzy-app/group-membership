<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/group-membership
 * @license https://github.com/cuzy-app/group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

use humhub\components\Event;
use humhub\components\View;
use humhub\widgets\bootstrap\Button;
use yii\helpers\Html;

/* @var $this View */
/* @var $groups humhub\modules\groupMembership\models\Group[] */
/* @var $groupsCanJoin humhub\modules\groupMembership\models\Group[] */
?>

<style>
    .gm-container-cards .card {
        background: transparent;
    }
</style>

<div id="user-groups-membership" class="panel panel-default">

    <div class="panel-heading">
        <strong><?= Yii::t('GroupMembershipModule.base', 'My Groups'); ?></strong>
    </div>

    <div class="panel-body">
        <h4><?= Yii::t('GroupMembershipModule.base', 'Groups of which I am a member'); ?></h4>

        <div class="container container-cards gm-container-cards">
            <div class="row cards">
                <?php foreach ($groups as $group): ?>
                    <div class="card col-xl-3 col-lg-4 col-md-6 col-12">
                        <div class="card-panel">
                            <div class="card-header">
                                <strong class="card-title"><?= Html::encode($group->name); ?></strong>
                            </div>
                            <div class="card-body">
                                <span class="hint-block"><?= Html::encode($group->description); ?></span>
                            </div>
                            <?php if ($group->canSelfRemoveMembership()): ?>
                                <div class="card-footer">
                                    <?= Button::danger(Yii::t('GroupMembershipModule.base', 'Cancel membership'))->link(['cancel-membership', 'groupId' => $group->id])->confirm() ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
        $evt = new Event();
        Event::trigger($this, 'groupMembershipViewAfterMyGroups', $evt);
        echo $evt->result;
        ?>

        <?php if ($groupsCanJoin): ?>
            <br>
            <h4><?= Yii::t('GroupMembershipModule.base', 'Others groups I can join'); ?></h4>

            <div class="container container-cards gm-container-cards">
                <div class="row cards">
                    <?php foreach ($groupsCanJoin as $group): ?>
                        <div class="card col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="card-panel">
                                <div class="card-header">
                                    <strong class="card-title"><?= Html::encode($group->name) ?></strong>
                                </div>
                                <div class="card-body">
                                    <span class="hint-block"><?= Html::encode($group->description) ?></span>
                                </div>
                                <div class="card-footer">
                                    <?= Button::success(Yii::t('GroupMembershipModule.base', 'Become member'))->link(['add-membership', 'groupId' => $group->id])->confirm() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
