<?php if(!empty($answer_no)):
            if($question_id == 20):
				echo $this->Form->input('BeautyQuestion.sub_question_id1', array('label' => __l('Sub Questions'),'type'=>'select','options'=>$answers));
			else:
				echo $this->Form->input('BeautyQuestion.answer'.$answer_no, array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> $answers));
			endif;
				
	 else:
		echo $this->Form->input('BeautyQuestion.answer', array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> $answers)); 
	endif; ?>