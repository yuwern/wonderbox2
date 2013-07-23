<div class="js-search-response">	  <?php echo $this->Form->create('BeautyQuestion', array('type' => 'post', 'class' => 'normal', 'action'=>'beauty_report')); ?>
<h2 class="bor-bot pad-none">SQL Statement</h2>
<div class="search-box-left">

							
							<?php echo $this->Form->input('count', array('type'=>'checkbox'));
								?>
							<?php  echo $this->Form->input('list', array('type'=>'checkbox')); ?>
							<div class="clear"></div>
							<div class="search-bg-box">
							<h1 class="lig-hei">Beauty Survey</h1>
							<div class="js-questions">
							 <?php echo $this->Form->input('question_id', array('label' => __l('Questions'),'empty'=>'Please select','options'=>$beautyQuestions)); ?>
							</div>
                           <div class="js-answers">
							<?php echo $this->Form->input('answer', array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> empty($answers)?'':$answers)); ?>
							</div>
							<?php echo $this->Form->input('age_group_id', array('label' => __l('Age Group'), 'empty'=>'Please Select')); ?>
							<?php echo $this->Form->input('state_id', array('label' => __l('State'), 'empty'=>'Please Select')); ?>
							</div>
                           
					
          
</div>

<div class="search-box-right">
					<?php //echo $this->Form->input('and', array('type'=>'checkbox','label'=>__l('AND')));?>
							<?php  //echo $this->Form->input('or', array('type'=>'checkbox','label'=>__l('OR'))); ?>
							<br/>
							<br/>
							<div class="clear"></div>
<div class="search-bg-box">
<h1 class="lig-hei">Beauty Survey</h1>
<div class="js-questions">
							<?php echo $this->Form->input('question_id1', array('label' => __l('Questions'),'empty'=>'Please select','options'=>$beautyQuestion1s)); ?>
							</div>
							<div class="js-answer1s">
							<?php echo $this->Form->input('answer1', array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> empty($answer1s)?'':$answer1s)); ?>
							</div>
							<?php echo $this->Form->input('age_group_id', array('label' => __l('Age Group'), 'empty'=>'Please Select')); ?>
							<?php echo $this->Form->input('state_id', array('label' => __l('State'), 'empty'=>'Please Select')); ?>

							
							</div></div>
							<div class="clear"></div>

							<span class="js-show-statement"> SHOW/HIDE</span>
<div class="hide js-statment-query">
<div class="js-sql-query">No SQL statement avialable.
</div>
<div id="js-sql-query1"></div>
</div>
<div class="clearfix"></div><?php echo $this->Form->submit(__l('Run Query'),array('class'=>'f-right'));?>
 <?php echo $this->Form->end(); ?>
</div>
     
<div class="clearfix"></div>

<?php if(!empty($this->request->data) && $this->request->data['BeautyQuestion']['list'] == 1 ):?>
<h2> <?php echo __l('Report Section'); ?></h2> 
<?php if(!empty($userCount1Conditions) && !empty($userCountConditions)): 
	  $conditions1 = base64_encode(serialize($userCountConditions));
	  $conditions2 = base64_encode(serialize($userCount1Conditions));
	  ?>
	<div class="clearfix add-block1">      <?php echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'users', 'action' => 'listing',$conditions1, $conditions2,'city' => 'malaysia', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export')); ?></div>
	   <?php
       echo $this->element('user-listing',array('conditions1'=>$conditions1, 'conditions2'=>$conditions2)); ?>
<?php else: ?>
	<p> <?php echo __l('No users avialable'); ?></p>
<?php endif; ?>

<?php endif; ?>
<?php if(!empty($this->request->data) && $this->request->data['BeautyQuestion']['count'] == 1 ): ?>
<h2 class="pad-none bor-bot"> <?php echo __l('Report Section'); ?></h2> 
<script  type="text/javascript">
Highcharts.theme = {
   colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
   chart: {
      borderWidth: 0,
      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
      plotShadow: false,
      plotBorderWidth: 1
   },
   title: {
      style: {
         color: '#000',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      lineColor: '#000',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      lineColor: '#000',
      lineWidth: 1,
      tickWidth: 1,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
</script>
<?php  if(!empty($beautyQuestion['BeautyQuestion']) ): 
?>
<br/><button id="js-print-button">Print All</button>
<button id="export">Download Image</button>
<?php  $chart_arr = array(); 
				$data = array();
				if(!empty($answer_no_order)):
  				$data =  $this->Html->beautyProfileReports($beautyQuestion['BeautyQuestion']['id'],$answer_no_order);
				else:
				$data =  $this->Html->beautyProfileDetails($beautyQuestion['BeautyQuestion']['id']);
				endif;
				$qkey = 1;
				?>
				<script type="text/javascript">

		 var chart<?php echo $qkey; ?>;
		 <?php
		 $chart_arr[] = 'chart'.$qkey;
		 ?>

	 $(document).ready(function() {
        chart<?php echo $qkey; ?> = new Highcharts.Chart({
            chart: {
                renderTo: "container<?php echo $qkey; ?>",
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: "<?php echo $beautyQuestion['BeautyQuestion']['name']; ?>",
				style: {
						font: 'bold 11px "Trebuchet MS", Verdana, sans-serif'
		        }
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b> {point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y + ' ('+ Highcharts.numberFormat(this.percentage,1, '.')  +' % )';
                        }
                    },
					 showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
					<?php 
					if(!empty($answers)):
						$bk = 1;
						foreach($answers as $key => $Answer):
						if( $Answer != 'All') :
							$fields = 'Answer'.$bk;
							$bk++;
							if(!empty($data[0][$fields])):
								$value = number_format($data[0][$fields],2, '.', '');
								echo '["'.$Answer.'",'.$value.'],';
							endif;
						endif;
						endforeach;
					endif;  
					?>
                ]
            }]
        });
    });
	</script>

	<div id="container<?php echo $qkey; ?>" style="min-width: 400px; height: 400px; margin: 0 auto" ></div>
<?php  if(!empty($beautyQuestion1['BeautyQuestion']) ): 
?>
	<?php  //$chart_arr = array(); 
				$data1 = array();
				if(!empty($answer_no_order1)):
  				$data1 =  $this->Html->beautyProfileReports($beautyQuestion1['BeautyQuestion']['id'],$answer_no_order1);
				else:
				$data1 =  $this->Html->beautyProfileDetails($beautyQuestion1['BeautyQuestion']['id']);
				endif;
				$qkey1 = 2;
				?>
		<script type="text/javascript">
		 var chart<?php echo $qkey1; ?>;
		 <?php
		 $chart_arr[] = 'chart'.$qkey1;
		 $fields = '';
		 ?>
	 $(document).ready(function() {
        chart<?php echo $qkey1; ?> = new Highcharts.Chart({
            chart: {
                renderTo: "container<?php echo $qkey1; ?>",
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: "<?php echo $beautyQuestion1['BeautyQuestion']['name']; ?>",
				style: {
						font: 'bold 11px "Trebuchet MS", Verdana, sans-serif'
		        }
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b> {point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y + ' ('+ Highcharts.numberFormat(this.percentage,1, '.')  +' % )';
                        }
                    },
					 showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
					<?php 
					if(!empty($answer1s)):
						$bk1 = 1;
						foreach($answer1s as $key => $Answer):
						if( $Answer != 'All') :
							$fields = 'Answer'.$bk1;
							$bk1++;
							if(!empty($data1[0][$fields])):
								$value = number_format($data1[0][$fields],2, '.', '');
								echo '["'.$Answer.'",'.$value.'],';
							endif;
						endif;
						endforeach;
					endif;  
					?>
                ]
            }]
        });
    });
	</script>

	<div id="container<?php echo $qkey1; ?>" style="min-width: 400px; height: 400px; margin: 0 auto" ></div>
	<?php endif; ?>
	<script type="text/javascript">
	 $(document).ready(function() {
		  function printCharts(charts) {

                var origDisplay = [],
                    origParent = [],
                    body = document.body,
                    childNodes = body.childNodes;

                // hide all body content
                Highcharts.each(childNodes, function (node, i) {
                    if (node.nodeType === 1) {
                        origDisplay[i] = node.style.display;
                        node.style.display = "none";
                    }
                });

                // put the charts back in
                $.each(charts, function (i, chart) {
                    origParent[i] = chart.container.parentNode;
                    body.appendChild(chart.container);
                });

                // print
                window.print();

                // allow the browser to prepare before reverting
                setTimeout(function () {
                    // put the chart back in
                    $.each(charts, function (i, chart) {
                        origParent[i].appendChild(chart.container);
                    });

                    // restore all body content
                    Highcharts.each(childNodes, function (node, i) {
                        if (node.nodeType === 1) {
                            node.style.display = origDisplay[i];
                        }
                    });
                }, 500);
            }

		$('#js-print-button').click(function() {
			    printCharts([<?php echo implode(',',$chart_arr); ?>]);
		});
				/**
 * Create a global getSVG method that takes an array of charts as an argument
 */
Highcharts.getSVG = function(charts) {
    var svgArr = [],
        top = 0,
        width = 0;

    $.each(charts, function(i, chart) {
        var svg = chart.getSVG();
        svg = svg.replace('<svg', '<g transform="translate(0,' + top + ')" ');
        svg = svg.replace('</svg>', '</g>');

        top += chart.chartHeight;
        width = Math.max(width, chart.chartWidth);

        svgArr.push(svg);
    });

    return '<svg height="'+ top +'" width="' + width + '" version="1.1" xmlns="http://www.w3.org/2000/svg">' + svgArr.join('') + '</svg>';
};

/**
 * Create a global exportCharts method that takes an array of charts as an argument,
 * and exporting options as the second argument
 */
	Highcharts.exportCharts = function(charts, options) {
		var form
			svg = Highcharts.getSVG(charts);

		// merge the options
		options = Highcharts.merge(Highcharts.getOptions().exporting, options);

		// create the form
		form = Highcharts.createElement('form', {
			method: 'post',
			action: options.url
		}, {
			display: 'none'
		}, document.body);

		// add the values
		Highcharts.each(['filename', 'type', 'width', 'svg'], function(name) {
			Highcharts.createElement('input', {
				type: 'hidden',
				name: name,
				value: {
					filename: options.filename || 'chart',
					type: options.type,
					width: options.width,
					svg: svg
				}[name]
			}, null, form);
		});
		//console.log(svg); return;
		// submit
		form.submit();

		// clean up
		form.parentNode.removeChild(form);
	};

	$('#export').click(function() {
		Highcharts.exportCharts([<?php echo implode(',',$chart_arr); ?>]);
	});
        });
</script>
<?php else: ?>
<br/>
<p class="notice"> <?php echo __l('No Chart is avialable'); ?> </p>
<?php endif; ?>
				<?php endif; ?>