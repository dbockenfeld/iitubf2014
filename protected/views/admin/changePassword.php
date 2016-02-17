<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Change Password';
$this->breadcrumbs = array(
    'Login',
);
?>
<section class="content">
    <section class="content-body zero-font">
        <h2>IIT UBF Admin</h2>
        <section class="full-width event-page">
            <section class="item event-page-item">
                <section class="event-page-item-section pw-page">
                    <h3>Change Password</h3>

                    <div class="form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'pw-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>

                        <?php if (Yii::app()->user->hasFlash("error")) : ?>
                            <div class="admin-error">
                                <?php echo Yii::app()->user->getFlash("error"); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (Yii::app()->user->hasFlash("success")) : ?>
                            <div class="admin-success">
                                <?php echo Yii::app()->user->getFlash("success"); ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <?php echo CHtml::label("Current Password", "current"); ?>
                            <?php echo CHtml::passwordField("current"); ?>
                        </div>

                        <div class="row">
                            <?php echo CHtml::label("New Password", "new"); ?>
                            <?php echo CHtml::passwordField("new"); ?>
                        </div>

                        <div class="row">
                            <?php echo CHtml::label("Verfiy New Password", "verify_new"); ?>
                            <?php echo CHtml::passwordField("verify_new"); ?>
                        </div>

                        <div class="row buttons">
                            <?php echo CHtml::submitButton('Change'); ?>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div><!-- form -->  
                </section>
            </section>
        </section>
    </section>
</section>


