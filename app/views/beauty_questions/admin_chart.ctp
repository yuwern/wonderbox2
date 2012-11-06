<h2> <?php echo __l('Beauty Profile Reports'); ?></h2> <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      function drawChart() {
	  <?php 
		for($i=1 ; $i<=15 ; $i++ ){
		$beautyProfile =  $this->Html->beautyProfileDetails($i);
		//print_r($beautyProfile);
	  ?>
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
		<?php if($i == 1): ?>
        data.addRows([
          ['Trendy', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Professional', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Sporty', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Low-Maintenance', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Natural', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Sophisticated', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ['Outgoing', <?php echo $beautyProfile[0]['Answer7']; ?>],
          ['Conservative', <?php echo $beautyProfile[0]['Answer8']; ?>],
          ['Formal', <?php echo $beautyProfile[0]['Answer9']; ?>],
        ]);
		<?php endif; ?>
		<?php if($i == 2): ?>
        data.addRows([
          ['Not Very Comfortable', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat Comfortable', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Very Comfortable', <?php echo $beautyProfile[0]['Answer3']; ?>],
        ]);
		<?php endif; ?>
		<?php if($i == 3): ?>
        data.addRows([
          ['Less then 15mins', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Between 15mins - 30mins', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Between 30mins - 45mins', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['About 1 hour', <?php echo $beautyProfile[0]['Answer4']; ?>],
        ]);
		<?php endif; ?>
	   	<?php if($i == 4): ?>
        data.addRows([
          ['Very Fair', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Very Dark', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Tan', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Yellow Undertone', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Dark', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Fair', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ['Olive', <?php echo $beautyProfile[0]['Answer7']; ?>],
        ]);
		<?php endif; ?>
	   	<?php if($i == 5): ?>
        data.addRows([
          ['None', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Pigmentation', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Blemishes', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Sensitivity', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Wrinkles / Texture', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Acne', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ['Rosacea', <?php echo $beautyProfile[0]['Answer7']; ?>],
        ]);
		<?php endif; ?>
		
			
	   	<?php if($i == 6): ?>
        data.addRows([
          ['Combination', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Oily', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Mature', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Normal', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Sensitive', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Dry', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ]);
		<?php endif; ?>
	
	   	<?php if($i == 7): ?>
        data.addRows([
          ['Cleanser', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Hair Care', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Trendy makeup color', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Fragrance', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Eye cream', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Lip Gloss', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ['Lipstick', <?php echo $beautyProfile[0]['Answer7']; ?>],
          ['Nail Colors', <?php echo $beautyProfile[0]['Answer8']; ?>],
          ['Body Lotion', <?php echo $beautyProfile[0]['Answer9']; ?>],
          ['Concealer', <?php echo $beautyProfile[0]['Answer10']; ?>],
          ['Foundation', <?php echo $beautyProfile[0]['Answer11']; ?>],
          ['Face cream', <?php echo $beautyProfile[0]['Answer12']; ?>],
          ]);
		<?php endif; ?>
	
	   	<?php if($i == 8): ?>
        data.addRows([
          ['Frizzy', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Dry', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Damaged/ broken', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Chemically treated', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Oily', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ['Thick', <?php echo $beautyProfile[0]['Answer6']; ?>],
          ['Normal', <?php echo $beautyProfile[0]['Answer7']; ?>],
          ['Curly', <?php echo $beautyProfile[0]['Answer8']; ?>],
          ['Fine', <?php echo $beautyProfile[0]['Answer9']; ?>],
          ]);
		<?php endif; ?>
	   	<?php if($i == 9): ?>
        data.addRows([
          ['Hair Colouring', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Hai Perming', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Hair Straightening', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Hair Treatment', <?php echo $beautyProfile[0]['Answer4']; ?>],
           ]);
		<?php endif; ?>
	   	<?php if($i == 10): ?>
        data.addRows([
          ['When I feel like it', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Once a month', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Once every 2 weeks', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Once a week', <?php echo $beautyProfile[0]['Answer4']; ?>],
           ]);
		<?php endif; ?>
	   	<?php if($i == 11): ?>
        data.addRows([
          ['Price', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Ease of Application', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Colour Selection', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Brand Name', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['How long does it last', <?php echo $beautyProfile[0]['Answer5']; ?>],
           ]);
		<?php endif; ?>
	   	<?php if($i == 12): ?>
        data.addRows([
          ['Less then RM200', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Between RM200 - RM499', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Between RM 200 - RM 1000', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Between RM 1000 - RM 2000', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['More then RM 2000', <?php echo $beautyProfile[0]['Answer5']; ?>],
           ]);
		<?php endif; ?>
		<?php if($i == 13): ?>
        data.addRows([
          ['Employed', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Self-employed', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['A homemaker', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['A student', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Retired', <?php echo $beautyProfile[0]['Answer5']; ?>],
           ]);
		<?php endif; ?>
		<?php if($i == 14): ?>
        data.addRows([
          ['Departmetal Store', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Mass Retailers', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Online Store', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Specialty Retailers', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Company-owned Store', <?php echo $beautyProfile[0]['Answer5']; ?>],
           ]);
		<?php endif; ?>

		<?php if($i == 15): ?>
        data.addRows([
          ['Below RM3,000 per month', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['RM3,000 - RM 5,000 per month', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['RM5,000 - RM 10,000 per month', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['RM10,000 - RM 20,000 per month', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Above RM20,000 per month', <?php echo $beautyProfile[0]['Answer5']; ?>],
           ]);
		<?php endif; ?>
      
        // Set chart options
        var options = {'title':"<?php echo $i .') '.$beautyProfile['BeautyQuestion']['name']; ?>",
                       'width':750,
                       'height':350};


		// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $i; ?>'));
        chart.draw(data, options);
		<?php } ?>
	
      }
    </script>
	  <?php for($i=1 ; $i<=15; $i++ ){ 	  ?>
    	<div id="chart_div<?php echo $i; ?>"></div>
	<?php } ?>
<h2> <?php echo __l('Product Survey Reports'); ?></h2> 	
	<script type="text/javascript">

      // Load the Visualization API and the piechart package.
   //   google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart1);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      function drawChart1() {
	  <?php 
		for($i=16 ; $i<=23 ; $i++ ){
		$beautyProfile =  $this->Html->productSuveryDetails($i);
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
          ['5 years or more', <?php echo $beautyProfile[0]['Answer5']; ?>],
        ]);
		<?php endif; ?>
		<?php if($i == 17): ?>
        data.addRows([
          ['Very likely', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat likely', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Neutral', <?php echo $beautyProfile[0]['Answer3']; ?>],
		  ['Somewhat unlikely', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Very unlikely', <?php echo $beautyProfile[0]['Answer5']; ?>],
        ]);
		<?php endif; ?>
		<?php if($i == 18): ?>
        data.addRows([
          ['Less then 2 times', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['More then 2 times', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['More then 5 times', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['More then 8 times', <?php echo $beautyProfile[0]['Answer4']; ?>],
        ]);
		<?php endif; ?>
	   	<?php if($i == 19): ?>
        data.addRows([
          ['Very Satisfied', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat Satisfied', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Neutral', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Somewhat Dissatisfied', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Very Dissatisfied', <?php echo $beautyProfile[0]['Answer5']; ?>],
         ]);
		<?php endif; ?>
	   	<?php if($i == 20): ?>
        data.addRows([
          ['Product Quality', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Product Sample Size', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Product Suitablity', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Product Packaging', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Product Retail Price', <?php echo $beautyProfile[0]['Answer5']; ?>],
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
          ['Never before', <?php echo $beautyProfile[0]['Answer7']; ?>],
          ]);
		<?php endif; ?>
	
	   	<?php if($i == 22): ?>
        data.addRows([
          ['Very likely', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Somewhat likely', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ['Neutral', <?php echo $beautyProfile[0]['Answer3']; ?>],
          ['Somewhat unlikely', <?php echo $beautyProfile[0]['Answer4']; ?>],
          ['Very unlikely', <?php echo $beautyProfile[0]['Answer5']; ?>],
          ]);
		<?php endif; ?>
	
	   	<?php if($i == 23): ?>
        data.addRows([
          ['Somewhat unlikely', <?php echo $beautyProfile[0]['Answer1']; ?>],
          ['Very unlikely', <?php echo $beautyProfile[0]['Answer2']; ?>],
          ]);
		<?php endif; ?>
        // Set chart options
        var options = {'title':"<?php echo $i .') '.$beautyProfile['BeautyQuestion']['name']; ?>",
                       'width':750,
                       'height':350};


		// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $i; ?>'));
        chart.draw(data, options);
		<?php } ?>
	
      }
    </script>
	  <?php for($i=16 ; $i<=23; $i++ ){ 	  ?>
    	<div id="chart_div<?php echo $i; ?>"></div>
	<?php } ?>