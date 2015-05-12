<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor; 


use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditorInline; 
?>


<h1>Все добавленные заметки</h1>
<ul>
<?php foreach ($listpost as $element): ?>
    <li>
        <?= 
             $element->content;  
        
        ?>
       
    </li>
<?php endforeach; ?>
</ul>


<?php 





 $form = new ActiveForm();
 $form = ActiveForm::begin(); 

//use dosamigos\ckeditor\CKEditor;
?>

<?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) 
    ?>
<?php 

 ActiveForm::end(); 


?>

