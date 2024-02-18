<?php
/** @var \app\core\View $this */
/** @var \app\models\ContactForm $model */

use app\core\form\TextAreaField;

$this->title = 'Contact';
?>

<h1>Contact Form</h1>

<?php $form = app\core\form\Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextAreaField($model, 'body'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end(); ?>

<!-- <form action="" method="post">
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form> -->