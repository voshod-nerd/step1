<?php
use yii\widgets\ActiveForm;

//var_dump($data);
?>


<h1>Все добавленные заметки</h1>
<ul>
<?php foreach ($data as &$element): ?>
    <li>
    	<?php echo $element[subject]; ?>
       	<?php echo $element[destription]; ?>
        <?php echo $element[filename]; ?>
       	<?php echo $element[path]; ?>
        <?php echo $element[dateadd]; ?>
    </li>
<?php endforeach; ?>
</ul>


<?php
$items = ['Сапромат','Матан','Химия','AЦВУ'];

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>



<?= $form->field($model, 'subject')->dropDownList($items); ?>
<?= $form->field($model, 'destription')->textArea(['rows' => 2]) ?>
<?= $form->field($model, 'file[]')->fileInput(['multiple' => true]) ?>

    <button>Добавить материал</button>

<?php ActiveForm::end(); ?>