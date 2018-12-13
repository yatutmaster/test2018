<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
$this->title = 'Тестовое задание';

// print_r($model->toArray());

$provider = new ArrayDataProvider([
    'allModels' => $notes,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => ['id', 'title'],
    ],
]);

?>

 <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'notes-form','action'=>Url::to(['site/addnote'])]); ?>

                    <?= $form->field($model, 'title')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Создать запись', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>


<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'id',
        'title',
        ['attribute'=>'status',
            'content'=>function($data){
                return ($data['status'] == 1)?'Активна':'Удалена';
            }],
        ['attribute'=>'action',
            'content'=>function($data){
                
                $setStatus = ($data['status']== 1)?0:1;

                return ($setStatus == 0?
                "<a href='".Url::to(['site/changenote','id'=>$data['id'],'status'=> $setStatus])."' >Удалить?</a>"
                :"<a href='".Url::to(['site/changenote','id'=>$data['id'],'status'=> $setStatus])."' >Восстановить?</a>");
                
            }]
    ],
]) ?>
