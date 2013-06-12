<?php if(!empty($answer_no)):
		echo $this->Form->input('BeautyQuestion.answer'.$answer_no, array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> $answers));
	 else:
		echo $this->Form->input('BeautyQuestion.answer', array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> $answers)); 
	endif; ?>