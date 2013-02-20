<div class="purchase-conf">
<div class="head"><h1> Confirmation Payment details</h1> </div>
<p class="info"> Click the confirm payment button to continue the payment </p>
 <?php  

            echo $this->Form->create('Package',array('type' => 'post', 'action' => 'confirm_checkout')); 
            //all shipping info contained in $result display it here and ask user to confirm.
			echo $this->Form->input('token',array('type'=>'hidden','value'=> $payment_response['TOKEN'],'READONLY' => 'readonly'));
			echo $this->Form->input('payid',array('type'=>'hidden','value'=> $_REQUEST['PayerID'],'READONLY' => 'readonly'));
			echo $this->Form->input('slug',array('type'=>'hidden','value'=> $slug,'READONLY' => 'readonly'));
			echo $this->Form->submit(__l('Confirm Payment'),array('class'=>'btn1'));
            echo $this->Form->end();
      
?>
</div>