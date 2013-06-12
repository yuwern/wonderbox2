<div class="js-search-response">	  <?php echo $this->Form->create('BeautyQuestion', array('type' => 'post', 'class' => 'normal', 'action'=>'product_report')); ?>
<h2 class="bor-bot pad-none">SQL Statement</h2>
<div class="search-box-left">

							
							<?php echo $this->Form->input('count', array('type'=>'checkbox'));
								?>
							<?php  echo $this->Form->input('list', array('type'=>'checkbox')); ?>
							<div class="clear"></div>
							<div class="search-bg-box">
							<h1 class="lig-hei">Product Survey</h1>
							<div class="js-prodquestions">
							 <?php echo $this->Form->input('question_id1', array('label' => __l('Questions'),'empty'=>'Please select','options'=>$productQuestions)); ?>
							</div>
							   <div class="js-answer1s">
								<?php echo $this->Form->input('answer1', array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> $answers)); ?>
							</div>
							<div>
							 <?php echo $this->Form->input('product_id', array('label' => __l('List Product'),'empty'=>'Please select','options'=>$products)); ?>
							</div>
							<div>
							 <?php echo $this->Form->input('brand_id', array('label' => __l('List Brand'),'empty'=>'Please select','options'=>$brands)); ?>
							</div>

							</div>
                           
					
          
</div>

<div class="search-box-right">
							<br/>
							<br/>
							<div class="clear"></div>
<div class="search-bg-box">
<h1 class="lig-hei">Beauty Survey</h1>
							<div class="js-questions">
							<?php echo $this->Form->input('question_id', array('label' => __l('Questions'),'empty'=>'Please select','options'=>$beautyQuestions)); ?>
							</div>
							<div class="js-answers">
							<?php echo $this->Form->input('answer', array('label' => __l('Answers'),'type'=>'select','multiple' => true,'options'=> $answer2s)); ?>
							</div>
							<br/>
							<br/>
							<br/>
							<br/>
							<br/><br/>
							<br/>
							</div></div>
							<div class="clear"></div>

							<span class="js-show-statement"> SHOW/HIDE</span>
<div class="js-sql-query hide js-statment-query">No SQL statement avialable.</div>
<div class="clearfix"></div><?php echo $this->Form->submit(__l('Run Query'),array('class'=>'f-right'));?>
 <?php echo $this->Form->end(); ?>
</div>
     
<div class="clearfix"></div>

<?php if(!empty($this->request->data) && $this->request->data['BeautyQuestion']['list'] == 1 ):?>
<h2> <?php echo __l('Report Section'); ?></h2> 
<?php if(!empty($userIds)): 
	  $userIdbase64decode = base64_encode(implode('-',$userIds));?>
	<div class="clearfix add-block1">      <?php echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'users', 'action' => 'listing',$userIdbase64decode,'city' => 'malaysia', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export')); ?></div>
	   <?php
       echo $this->element('user-listing',array('userIdbase64decode'=>$userIdbase64decode)); ?>
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
<?php  if(!empty($productSurveys) ): 
?>
<br/><button id="js-print-button">Print All</button>
<button id="export">Download Image</button>
<?php  $chart_arr = array(); 
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
                text: "<?php echo $productSurveys['BeautyQuestion']['name']; ?>",
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
					if(!empty($responses)):
						$bk = 1;
						foreach($responses as $key => $Answer):
							if(!empty($Answer)):
								$value = number_format($Answer,2, '.', '');
								echo '["'.$key.'",'.$value.'],';
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
<?php if(!empty($beautyQuestion['BeautyQuestion'])): ?>
<?php    $beautyCategory = ' ';
		 $barchartCount = count($beautyQuestion['BeautyAnswer']);
	     foreach($beautyQuestion['BeautyAnswer'] as $key=> $beautyAnswer):
				 $beautyCategory .=  "'".$beautyAnswer['answer']."'";
				 $fieldName = 'Answer'.($key + 1);
					if($barchartCount!= ($key + 1))
						$beautyCategory .= ',';		
		 endforeach;
		 $barChartReport = '';
		 	 foreach($beauty_responses as $key => $beautyData){
			 $beautyResult = array();
				$barChartReport .= '{';
				$barChartReport  .= 'name: "'.$product_answer_fields[$key].' ",';
				$barChartReport  .= 'data: ['.implode(',',$beautyData[0]).']';
				$barChartReport	.= '},';
			
		 }
		// echo $barChartReport;
	?>
	<script type="text/javascript">	

			var barchart<?php echo $beautyQuestion['BeautyQuestion']['id'].$qkey; ?>;
			<?php
				 $chart_arr[] = 'barchart'.$beautyQuestion['BeautyQuestion']['id'].$qkey;
			?>
		    $(document).ready(function() {
	        barchart<?php echo $beautyQuestion['BeautyQuestion']['id'].$qkey; ?> = new Highcharts.Chart({
            chart: {
                renderTo: "barcontainer<?php echo $beautyQuestion['BeautyQuestion']['id'].$qkey; ?>",
                type: 'column'
            },
            title: {
                text: ' '
            },
             xAxis: {
                categories: [
					<?php echo $beautyCategory; ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' '
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' %';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
			 series: [<?php echo $barChartReport; ?> ]
        });
    });

	</script>
	<div id="barcontainer<?php echo $beautyQuestion['BeautyQuestion']['id'].$qkey; ?>" ></div>
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