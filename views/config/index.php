<?php
/**
 * Group membership
 * @link https://github.com/cuzy-app/group-membership
 * @license https://github.com/cuzy-app/group-membership/blob/master/docs/LICENCE.md
 * @author [Marc FARRE](https://marc.fun) for [CUZY.APP](https://www.cuzy.app)
 */

/* @var $this View */

use humhub\components\View;
use humhub\modules\groupMembership\Module;

/** @var Module $module */
$module = Yii::$app->getModule('group-membership');
?>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= $module->getName() ?></strong>
            <div class="text-body-secondary"><?= $module->getDescription() ?></div>
        </div>

        <div class="panel-body">

            <div class="alert alert-info cuzy-free-module-info" role="alert">
                This module was created and is maintained by
                <a href="https://www.cuzy.app/"
                   target="_blank">CUZY.APP (view other modules)</a>.
                <br>
                It's free, but it's the result of a lot of design and maintenance work over time.
                <br>
                If it's useful to you, please consider
                <a href="https://www.cuzy.app/checkout/donate/"
                   target="_blank">making a donation</a>
                or
                <a href="https://github.com/cuzy-app/group-membership"
                   target="_blank">participating in the code</a>.
                Thanks!
            </div>

            <div>
                To allow users to become member of a group themselves, go to
                "Administration" -> "Users" -> "Groups" -> Menu of the group -> "Permissions".
            </div>

            <div>
                Users can manage their groups in their "User account" -> "My groups".
            </div>
        </div>
    </div>
</div>
