<script src="<?php echo AGENT_JS_PATH; ?>highcharts.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_URL;?>js/jquery-birthday-picker.min.js"></script>
<div class="page-content">
<h3 class="page-title">Reports</h3>
<?=$property_header?>
  <div class="portlet light">
    <div class="row">
      <div class="col-sm-12">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption"> Reports</div>
          </div>
          <div class="portlet-body">
            <?=$tabs?>
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
            <div class="page-content room-details">
              <h3 class="page-title">Reports</h3>
              <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
              <!--END TITLE & BREADCRUMB PAGE--> 
              <!--BEGIN CONTENT-->
              <div class="portlet light">
                <div id="table-action" class="row">
                  <div class="col-lg-12">
                    <div id="tableactionTabContent" class="tab-content">
                      <div id="table-table-tab" class="tab-pane fade in active"> 
                        <!-- Start : main content loads from here -->
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="table-container">
                              <form name="perPageFrm" id="perPageFrm" method="post" action="">
                                <div class="row mbl cusTab">
                                  <div class="col-lg-12">
                                    <div class="input-group input-group-sm mbs"> 
                                      <!-- <div class="container">--> 
                                      <div class="fromTo fromToNew">
                                      <h3>From</h3>
                                      <div id="default-settings"></div>
                                      <h3>To</h3>
                                      <div id="default-settings1"></div>
                                      <input type="hidden" name="from_dt" id="from_dt" value="">
                                      <input type="hidden" name="to_dt" id="to_dt" value="">
                                      <!--</div>-->
                                      <input type="button" value="Go" id="search" name="search">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <div id="no-more-tables">
				<div id="container"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--	MODAL IMAGE    --> 
            </div>
            <!--END CONTENT--> 
            <!--BEGIN CONTENT QUICK SIDEBAR--> 
            
            <!--END CONTENT QUICK SIDEBAR--> </div>
        </div>
      </div>
    </div>
    <!-- BEGIN DASHBOARD STATS --> 
    <!-- END DASHBOARD STATS --> 
    
  </div>
</div>

<script>
$("#default-settings").birthdayPicker();
$("#default-settings1").birthdayPicker();
$('.birthDate').hide();

$( document ).ready(function() {
   <?php
   $from1 = explode('-',$from);
   $to1 = explode('-',$to);
   if(is_array($from1) && $from != ''){
   ?>
   $('#default-settings .birthMonth option:eq(<?php echo $from1[1]; ?>)').attr('selected', 'selected');
   $('#default-settings .birthDate option:eq(<?php echo $from1[2]; ?>)').attr('selected', 'selected');
   $('#default-settings .birthYear').find('option[value="' + <?php echo $from1[0]; ?> + '"]').attr("selected", "selected");
   <?php }
    if(is_array($to1) && $to != ''){?>
   $('#default-settings1 .birthMonth option:eq(<?php echo $to1[1]; ?>)').attr('selected', 'selected');
   $('#default-settings1 .birthDate option:eq(<?php echo $to1[2]; ?>)').attr('selected', 'selected');
   $('#default-settings1 .birthYear').find('option[value="' + <?php echo $to1[0]; ?> + '"]').attr("selected", "selected");
   <?php } ?>
  getChartData();
});

$('#search').click(function(){
  getChartData();
});

function getChartData()
{
  var baseurl	 = '<?php echo FRONTEND_URL;?>';
  var from_month = parseInt($('#default-settings > .birthdayPicker > .birthMonth').val());
  var from_year  = parseInt($('#default-settings > .birthdayPicker > .birthYear').val());
  var to_month 	 = parseInt($('#default-settings1 > .birthdayPicker > .birthMonth').val());
  var to_year 	 = parseInt($('#default-settings1 > .birthdayPicker > .birthYear').val());
  
  Highcharts.theme = {
   colors: ["#7DDD9C",'#7FA2DC'],

   xAxis: {
      gridLineWidth: 0,
      lineColor: '#000000',
      tickColor: '#000000',
      labels: {
         style: {
            color: '#000000',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#000000',
            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }
      }
   },
   yAxis: {
      alternateGridColor: null,
      minorTickInterval: null,
      gridLineColor: '#000000',
      minorGridLineColor: '#000000',
      lineWidth: 0,
      tickWidth: 0,
      labels: {
         style: {
            color: '#000000',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#AAA',
            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         color: '#CCC'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#333'
      }
   },
   labels: {
      style: {
         color: '#CCC'
      }
   },
   tooltip: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
         stops: [
            [0, 'rgba(96, 96, 96, .8)'],
            [1, 'rgba(16, 16, 16, .8)']
         ]
      },
      borderWidth: 0,
      style: {
         color: '#FFF'
      }
   },
   plotOptions: {
      series: {
         nullColor: '#444444'
      },
      line: {
         dataLabels: {
            color: '#CCC'
         },
         marker: {
            lineColor: '#333'
         }
      },
      spline: {
         marker: {
            lineColor: '#333'
         }
      },
      scatter: {
         marker: {
            lineColor: '#333'
         }
      },
      candlestick: {
         lineColor: 'white'
      }
   },
   toolbar: {
      itemStyle: {
         color: '#CCC'
      }
   },
   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         hoverSymbolStroke: '#FFFFFF',
         theme: {
            fill: {
               linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
               stops: [
                  [0.4, '#606060'],
                  [0.6, '#333333']
               ]
            },
            stroke: '#000000'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
         stroke: '#000000',
         style: {
            color: '#CCC',
            fontWeight: 'bold'
         },
         states: {
            hover: {
               fill: {
                  linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                  stops: [
                     [0.4, '#BBB'],
                     [0.6, '#888']
                  ]
               },
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: {
                  linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                  stops: [
                     [0.1, '#000'],
                     [0.3, '#333']
                  ]
               },
               stroke: '#000000'
            }
         }
      },
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(16, 16, 16, 0.5)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      }
   },

   scrollbar: {
      barBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
      barBorderColor: '#CCC',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
      buttonBorderColor: '#CCC',
      rifleColor: '#FFF',
      trackBackgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
         stops: [
            [0, '#000'],
            [1, '#333']
         ]
      },
      trackBorderColor: '#666'
   },

   // special colors for some of the demo examples
   legendBackgroundColor: 'rgba(48, 48, 48, 0.8)',
   background2: 'rgb(70, 70, 70)',
   dataLabelsColor: '#444',
   textColor: '#E0E0E0',
   maskColor: 'rgba(255,255,255,0.3)'
};
  Highcharts.setOptions(Highcharts.theme);
   
  var dataString          = 'from_year=' + encodeURIComponent(from_year) + '&to_year=' + encodeURIComponent(to_year) + '&from_month=' + encodeURIComponent(from_month) + '&to_month=' + encodeURIComponent(to_month)+ '&property_id=' + <?php echo $this->uri->segment(3);?> ;
    $.ajax({
      type: 'post',
      data: dataString,
      url: baseurl + 'agent/reports/getData/',
      success: function(data){
	var total_arr 	= jQuery.parseJSON(data);
	var booking_arr = total_arr['paymentArr'];
	var rank_arr 	= total_arr['change_in_rank'];
	var booking_str = '[';
	for(var i=0;i< booking_arr.length;i++)
	{
	  if (i == (booking_arr.length-1))
	    booking_str = booking_str+ '['+Date.UTC(booking_arr[i][0],(booking_arr[i][2]-1),booking_arr[i][3])+','+booking_arr[i][1]+']';
	  else
	    booking_str = booking_str+ '['+Date.UTC(booking_arr[i][0],(booking_arr[i][2]-1),booking_arr[i][3])+','+booking_arr[i][1]+'],';
	}
	booking_str = booking_str+']';
	var ranking_str = '[';
	for(var i=0;i< rank_arr.length;i++)
	{
	  if (i == (rank_arr.length-1))
	    ranking_str = ranking_str+ '['+Date.UTC(rank_arr[i][0],(rank_arr[i][2]-1),rank_arr[i][3])+','+rank_arr[i][1]+']';
	  else
	    ranking_str = ranking_str+ '['+Date.UTC(rank_arr[i][0],(rank_arr[i][2]-1),rank_arr[i][3])+','+rank_arr[i][1]+'],';
	}
	ranking_str = ranking_str+']';
        $('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Hostelworld bookings / search rank position'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Bookings / Ranks'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
            series: [{
                type: 'area',
		color: '#7CDE9B',
                name: 'Booking',
		pointPadding: 0.3,
                data: jQuery.parseJSON(booking_str)
            }, {
	    type: 'area',
            name: 'Rank',
            color: '#7EA3DB',
	    pointPadding: 0.3,
            data: jQuery.parseJSON(ranking_str)
        }]
        });
      }
  });
    
      setTimeout(function(){ $('text:contains("Highcharts.com")').css('display','none'); }, 500);
      ;
      
      
}
</script>