<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogLogin',
    'htmlOptions'=>array('class'=>'hide'),
    'events'=>array(
        'show'=>"js:function() { console.log('dialogLogin show.'); }",
        'shown'=>"js:function() { console.log('dialogLogin shown.'); }",
        'hide'=>"js:function() { console.log('dialogLogin hide.'); }",
        'hidden'=>"js:function() { console.log('dialogLogin hidden.'); }",
    ),
)); ?>
<div id="modal_login" class="divForForm"></div>
<?php $this->endWidget(); ?> 
<script>
function getLogin(){
  <?php echo CHtml::ajax(array(
            'url'=>array('/site/login'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'render')
                {
                    $('#modal_login').html(data.div );
                          // Here is the trick: on submit-> once again this function!
                    $('#dialogLogin div.divForForm form').submit(getLogin);
                }
                else
                {  /* $('#dialogLogin').modal('close') */
                    $('#dialogLogin div.succesDiv').html(data.div);
                }
 
            }",
            )); ?>
}

$("#loginButton").click(function(){
getLogin();
$('#dialogLogin').modal('show');
return false; 
});
</script>
<!-- end login -->
