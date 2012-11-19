<?php
$i = 0;
$sno = 1;
do {
    if (!empty($participants)) {
        $data = array();
        foreach($participants as $participant) {
	        $data[]['User'] = array(
            __l('S.No') => $sno,
            __l('Email') => $participant['User']['email'],
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