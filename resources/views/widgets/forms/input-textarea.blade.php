{{ Form::textarea( $name, old($name), ['class' => 'form-control', 'size' => '20x3','style' => 'resize: vertical'] + (isset($options)?$options:[]) )}}
