<h1>Create an account</h1>

<?php
// begin() output the form open tag and return an instance of Form
$form = \app\core\form\Form::begin('', 'post')
?>
  <?php echo ?>
<?php echo \app\core\form\Form::end() ?>
<form action="" method="post">
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label>Firstname</label>
        <input
          type="text"
          name="firstname"
          value="<?php echo $model->firstname ?>"
          class="form-control<?php echo $model->hasError('firstname') ? ' is-invalid' : '' ?>"
        >

        <div class="invalid-feedback">
          <?php echo $model->getFirstError('firstname') ?>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="mb-3">
        <label>Lastname</label>
        <input type="text" name="lastname" class="form-control">
      </div>  
    </div>
  </div>

  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
  </div>

  <div class="mb-3">
    <label>Confirm password</label>
    <input type="password" name="confirmPassword" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
