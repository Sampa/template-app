<?php
	$this->beginWidget('bootstrap.widgets.BootModal', 
	array(
		'id'=>'dialogReg',
		'htmlOptions'=>array('class'=>'hide'),
		'events'=>array(
			'show'=>"js:function() { console.log('dialogReg show.'); }",
			'shown'=>"js:function() { console.log('dialogReg shown.'); }",
			'hide'=>"js:function() { console.log('dialogReg hide.'); }",
			'hidden'=>"js:function() { console.log('dialogReg hidden.'); }",
		),
	)); 
?>
<div id="modal_registration" class="divForForm"></div>
<script>
function getReg(){
  <?php echo CHtml::ajax(array(
            'url'=>array('/user/register'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'render')
                {
                    $('#modal_registration').html(data.div );
                          // Here is the trick: on submit-> once again this function!
                    $('#dialogReg div.divForForm form').submit(getReg);
                }
                else
                {  /* $('#dialogStep').bootModal('close') */
                    $('#dialogReg div.succesDiv').html(data.div);
                }
 
            }",
            )); ?>
}
</script>

<?php $this->endWidget(); ?> 
<script>

$("#regButton").click(function(){
getReg();
$('#dialogReg').modal('show');
return false; 
});
</script>
<!-- end login -->
