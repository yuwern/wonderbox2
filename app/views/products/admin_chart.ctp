<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<?php if(empty($this->request->params['named']['type']) && !empty($totalparticipants)): ?>
	<?php echo $this->Html->link(__l('Print'), array('controller' => 'products', 'action' => 'chart',$product['Product']['slug'],'type'=>'print'), array('title' => __l('Print'),'target'=>'_blank')); ?>
 <?php endif; ?>
			
<h2> <?php echo __l('Product Survey Report'); ?></h2> 	
<p> <?php echo __l('Product Name'); ?>: <?php echo $product['Product']['name']; ?></p>
<p> <?php echo __l('Survey Duration (days)'); ?>: <?php echo date('d F Y',strtotime($product['Product']['end_date'])); ?></p>
<p> <?php echo __l('Participants'); ?> : <?php echo $totalparticipants; ?></p>
<?php if(!empty($totalparticipants)): ?>
	<script type="text/javascript">

      // Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart1);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      function drawChart1() {
	  <?php 
		 $sno = 1;
		for($i=16 ; $i<=23 ; $i++ ){
		$beautyProfile =  $this->Html->productSuveryDetails($i,$product['Product']['id']);
		//print_r($beautyProfile);
	  ?>
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
		<?php if($i == 16): ?>
        data.addRows([
          ['First Time', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Less than 6 months', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['1 year to less than 3 years', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['3 years to less than 5 years', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['5 years or more', <?php echo $beautyProfile[0]['Answer5']; ?>]
        ]);
		<?php endif; ?>
		<?php if($i == 17): ?>
        data.addRows([
          ['Very likely', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat likely', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Neutral', <?php echo $beautyProfile[0]['Answer3']; ?>],
		  ['Somewhat unlikely', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Very unlikely', <?php echo $beautyProfile[0]['Answer5']; ?>]
        ]);
		<?php endif; ?>
		<?php if($i == 18): ?>
        data.addRows([
          ['Less then 2 times', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['More then 2 times', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['More then 5 times', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['More then 8 times', <?php echo $beautyProfile[0]['Answer4']; ?>]
        ]);
		<?php endif; ?>
	   	<?php if($i == 19): ?>
        data.addRows([
          ['Very Satisfied', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat Satisfied', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Neutral', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Somewhat Dissatisfied', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Very Dissatisfied', <?php echo $beautyProfile[0]['Answer5']; ?>]
         ]);
		<?php endif; ?>
	   	<?php if($i == 20): ?>
        data.addRows([
          ['Product Quality', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Product Sample Size', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Product Suitablity', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Product Packaging', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Product Retail Price', <?php echo $beautyProfile[0]['Answer5']; ?>]
        ]);
		<?php endif; ?>
		
			
	   	<?php if($i == 21): ?>
        data.addRows([
          ['Every week', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Every 2 - 3 weeks', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Every month', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Every 2 - 3 months', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Every 4 - 6 months', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Once or twice a year', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ['Never before', <?php echo $beautyProfile[0]['Answer7']; ?>]
          ]);
		<?php endif; ?>
	
	   	<?php if($i == 22): ?>
        data.addRows([
          ['Very likely', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat likely', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Neutral', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Somewhat unlikely', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Very unlikely', <?php echo $beautyProfile[0]['Answer5']; ?>]
          ]);
		<?php endif; ?>
	
	   	<?php if($i == 23): ?>
        data.addRows([
          ['Somewhat unlikely', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Very unlikely', <?php echo $beautyProfile[0]['Answer2']; ?>]
          ]);
		<?php endif; ?>
        // Set chart options
        var options = {'title':"<?php echo $sno .') '.$beautyProfile['BeautyQuestion']['name']; ?>",
                       'width':750,
                       'height':350};


		// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $i; ?>'));
        chart.draw(data, options);
		<?php $sno++; } ?>
	
      }
    </script>
	  <?php for($i=16 ; $i<=23; $i++ ){ 	  ?>
    	<div id="chart_div<?php echo $i; ?>"></div>
	<?php } ?>
	<?php else: ?>
		<p class="notice"><?php echo __l('No users is Participants'); ?></p>
	<?php endif; ?>

	<?php if(!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'print'): ?>
	<script>
         window.print();
    </script>
<?php endif; ?>