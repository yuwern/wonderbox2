<?php
$i = 0;
$sno = 1;
do {
    if (!empty($packageUsers)) {
        $data = array();
		foreach($packageUsers as $packageUser) {
			$name = (!empty($packageUser['User']['UserProfile']['first_name']) || !empty($packageUser['User']['UserProfile']['last_name']))? $packageUser['User']['UserProfile']['first_name'].' '.$packageUser['User']['UserProfile']['last_name'] :  $packageUser['User']['email'];
							
	        $data[]['packageUser'] = array(
            __l('HQ') => ' ',
            __l('ACC') => ' ',
            __l('SORT') => ' ',
            __l('Name') => $name,
            __l('ADD1') => !empty($packageUser['User']['UserShipping'][0]['address'])?$packageUser['User']['UserShipping'][0]['address']:' ',
            __l('ADD2') => !empty($packageUser['User']['UserShipping'][0]['address2'])?$packageUser['User']['UserShipping'][0]['address2']: ' ',
            __l('ADD3') => ' ',
            __l('POSCODE') => !empty($packageUser['User']['UserShipping'][0]['zip_code'])?$packageUser['User']['UserShipping'][0]['zip_code']:'',
            __l('STATE') => !empty($packageUser['User']['UserShipping'][0]['State']['name'])?$packageUser['User']['UserShipping'][0]['State']['name']:'',
			 __l('TEL') => !empty($packageUser['User']['UserShipping'][0]['contact_no'])?$packageUser['User']['UserShipping'][0]['contact_no']:'',
            __l('CONTACT') => !empty($packageUser['User']['email'])?$packageUser['User']['email']:'',
            __l('DEST') => ' ',
          	);
			$sno++;
        }
		 if (!$i) {
            $this->Csv->addGrid($data);
        } else {
            $this->Csv->addGrid($data, false);
        }
    }
    $i+= 20;
}
while (!empty($Users));
echo $this->Csv->render(true);
?>