yii\imperavi\Widget::widget([
    // You can either use it for model attribute
    'model' => $my_model,
    'attribute' => 'my_field',

    // or just for input field
    'name' => 'my_input_name',

    // Some options, see http://imperavi.com/redactor/docs/
    'options' => [
        'toolbar' => false,
        'css' => 'wym.css',
    ],
]);