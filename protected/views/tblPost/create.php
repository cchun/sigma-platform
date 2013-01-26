<?php
/* @var $this TblPostController */
/* @var $model TblPost */

$this->breadcrumbs=array(
	'Tbl Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblPost', 'url'=>array('index')),
	array('label'=>'Manage TblPost', 'url'=>array('admin')),
);
?>

<h1>Create TblPost</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>