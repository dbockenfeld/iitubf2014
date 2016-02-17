<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<section class="content">
    <section class="content-body zero-font">
        <h2>IIT UBF Admin Login</h2>
        <section class="full-width event-page">
            <section class="item event-page-item">
                <section class="event-page-item-section login-page">
                    <h3>Login</h3>

                    <div class="form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>

                        <p class="note">Fields with <span class="required">*</span> are required.</p>

                        <div class="row">
                            <?php echo $form->labelEx($model, 'username'); ?>
                            <?php echo $form->textField($model, 'username'); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>

                        <div class="row">
                            <?php echo $form->labelEx($model, 'password'); ?>
                            <?php echo $form->passwordField($model, 'password'); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>

                        <div class="row rememberMe">
                            <?php echo $form->checkBox($model, 'rememberMe'); ?>
                            <?php echo $form->label($model, 'rememberMe'); ?>
                            <?php echo $form->error($model, 'rememberMe'); ?>
                        </div>

                        <div class="row buttons">
                            <?php echo CHtml::submitButton('Login'); ?>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div><!-- form -->  
                </section>
            </section>
        </section>
    </section>
</section>


