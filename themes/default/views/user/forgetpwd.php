	<div class="user user_edit">		
		<h3><?php echo Yii::t('common','Find Pwd');?></h3>
		<?php 
			$form=$this->beginWidget('CActiveForm',
			array('id'=>'edit_form',
				'htmlOptions'=>array('name'=>'edit_form'),			
				)); 
		?>
			<table class="base_table">			
				<tr><th><?php echo $form->label($model,'username');?>：</th><td><?php echo $form->textField($model,'username');?></td></tr>
				<tr><th><?php echo $form->label($model,'email');?>：</th><td><?php echo $form->textField($model,'email');?></td></tr>
				<tr>
					<td></td>
					<td>
						<!-- 错误信息显示 -->
						<?php if (CHtml::errorSummary($model)):?>
						<div class="error_message">
						<?php foreach($model->geterrors() as $error):?>
						<em><i class="fa fa_error"></i><?php echo $error[0];?></em>
						<?php break;?>
						<?php endforeach;?>	
						</div>						
						<?php endif?>						
					</td>
				</tr>				
			</table>
			<div class="clear"></div>
			<input type="submit" class="submit" value="<?php echo Yii::t('common','Submit');?>" />
		<?php $this->endWidget();?>
	</div>