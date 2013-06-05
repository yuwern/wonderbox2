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
</script><?php if(empty($this->request->params['named']['type']) && !empty($totalparticipants)): ?>
<button id="js-print-button">Print All</button>
<button id="export">Download Image</button>
 <?php endif; ?>	
 <?php  $brand =  $this->Html->getBrandLogo($product['Product']['brand_id']); ?>

<p> <?php echo __l('Product Name'); ?>: <?php echo $product['Product']['name']; ?></p>
<p> <?php echo __l('Survey Duration (days)'); ?>: <?php echo date('d F Y',strtotime($product['Product']['end_date'])); ?></p>
<p> <?php echo __l('Participants'); ?> : <?php echo $totalparticipants; ?></p>

<?php if(!empty($totalparticipants)): ?>
<?php  if(!empty($productQuestions)):
?>

<pre>
<?php foreach($productQuestions as $qkey => $productQuestion): 
	$data =  $this->Html->productSuveryDetails($productQuestion['BeautyQuestion']['id'],$product['Product']['id']);
	$response_data = array();
	if(!empty($productQuestion['BeautyAnswer'])):
			foreach($productQuestion['BeautyAnswer'] as $key => $Answer):
				$fields = 'Answer'.($key+1);
					$response_data[$Answer['answer']] = $data[0][$fields]	;					
			endforeach;
	endif; 		
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
                text: "<?php echo ($qkey+1).') '.$productQuestion['BeautyQuestion']['name']; ?>"
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
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
                            return '<b>'+ this.point.name +'</b>: '+  Highcharts.numberFormat(this.percentage,1, '.')  +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
					<?php 
					if(!empty($productQuestion['BeautyAnswer'])):
						$count = count($productQuestion['BeautyAnswer']);
						$tcount = 1;
						foreach($productQuestion['BeautyAnswer'] as $key => $Answer):
						$fields = 'Answer'.($key+1);
						if(!empty($data[0][$fields])):
							$value = number_format($data[0][$fields],2);
							echo '["'.$Answer['answer'].'",'.$value.']';
							if($count != $tcount)
								echo ',';
						endif;
						$tcount++;	
						endforeach;
					endif; 
					?>
                ]
            }]
        });
    });
	</script>
	<div id="container<?php echo $qkey; ?>" ></div>
	<?php foreach($beautyQuestions as $beautyQuestion): 
			 $barchartCount = count($beautyQuestion['BeautyAnswer']);
			 $beautydata =  $this->Html->beautyProfileDetails($beautyQuestion['BeautyQuestion']['id']);
			 $beautyCategory = ' ';
			 $beautyDataResponse = array();
		     foreach($beautyQuestion['BeautyAnswer'] as $key=> $beautyAnswer):
				
				 $beautyCategory .=  "'".$beautyAnswer['answer']."'";
				 $fieldName = 'Answer'.($key + 1);
					if($barchartCount!= ($key + 1))
						$beautyCategory .= ',';
				$beautyDataResponse[$beautyAnswer['answer']] = $beautydata[0][$fieldName];
				
			 endforeach;
				if(!empty($response_data)):
				$barChartReport ='';

				foreach($response_data as $rkey => $response_data2):
						$barChartReport .='{';
						$barChartReport .='name:'."'".$rkey."',";
						$barChartReport .='data:'."[";
						$bary = 1;
						foreach($beautyDataResponse as $ykey => $beautyDataResponse1):
						$barChartReport .= ($beautyDataResponse1 == 0)? 0:($response_data2/$beautyDataResponse1);
						if(count($beautyDataResponse) != $bary)
						$barChartReport .=',';
						$bary++;
						endforeach;
						$barChartReport .="]}";
						if(count($response_data) != $rkey)
						$barChartReport .=',';

				endforeach;
	
//				echo $barChartReport;
	
			endif;
//			echo "Y";
//		print_r($beautyDataResponse);
//						echo "X";
//			 print_r($response_data);
//			 echo $beautyQuestion['BeautyQuestion']['id'];
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
                categories: [<?php echo $beautyCategory; ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' '
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
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
            series: [<?php 		echo $barChartReport; ?>]
        });
    });

	</script>
	<div id="barcontainer<?php echo $beautyQuestion['BeautyQuestion']['id'].$qkey; ?>" ></div>
	<?php endforeach; ?>
<?php endforeach; 

//print_r($chart_arr);
?>
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
<?php endif; ?>
<?php else: ?>
	<p class="notice"><?php echo __l('No users is Participants'); ?></p>
<?php endif; ?>