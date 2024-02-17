<?php 
/** @var $model \app\models\User */
?>
<h1>Create an account</h1>

<?php $form = app\core\form\Form::begin('', 'post'); ?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'first_name'); ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'last_name'); ?>
    </div>
</div>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordField(); ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField(); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end(); ?>


<!-- <form action="" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form> -->