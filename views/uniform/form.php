<?php defined('SYSPATH') or die('No direct script access.');

echo $form->open();

echo $form->render_fields();
echo Form::submit($form->submit_name, "Abschicken");

echo Form::close();