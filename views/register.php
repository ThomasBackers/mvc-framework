<h1>Create an account</h1>

<?php
// begin() output the form open tag and return an instance of Form
$form = \app\core\form\Form::begin('', 'post')
?>
  <div class="row">
    <div class="col">
      <?php echo $form->field($model, 'firstname') ?>
    </div>

    <div class="col">
      <?php echo $form->field($model, 'lastname') ?>
    </div>
  </div>

  <?php echo $form->field($model, 'email') ?>
  <?php
  // $form->field return a field object, and we access the passwordField method
  // so we receive a field with the correct type
  echo $form->field($model, 'password')->passwordField()
  ?>
  <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>
<?php echo \app\core\form\Form::end() ?>
