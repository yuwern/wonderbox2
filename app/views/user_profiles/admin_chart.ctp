<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Pie Chart report</h3>
						</div>
						<div class="box-content">
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
<?php 
	$answer = array();
	if(!empty($ageGroups)):
	foreach($ageGroups as $key => $ageGroup):
		$answer[$ageGroup ] = $this->Html->getAgeReport($key);
	endforeach;
?>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container1',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: "Report for Age Groups"
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
                               return '<b>'+ this.point.name +'</b>: '+ this.y + ' ('+ Highcharts.numberFormat(this.percentage,1, '.')  +' % )';
                        }
                    },
					 showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: ' ',
                data: [
				<?php if(!empty($answer)):
						foreach($answer as $key => $val):
						if(!empty($val)):
							$value = number_format($val,2);
							echo '["'.$key.'",'.$value.'],';
						endif;
						endforeach;
					endif; 
					?>                   
                ]
            }]
        });
    });
    
});
		</script>
				<div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto" ></div>	
				<?php else: ?>
					<p> No data is avialable</p>
				<?php endif; ?>
				
				</div>
					</div>
				</div>