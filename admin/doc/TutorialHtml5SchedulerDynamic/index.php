<!DOCTYPE html>
<html>
<head>
    <title>HTML5 Scheduler with Dynamic Event Loading (DayPilot Pro for JavaScript)</title>
	<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />    

	<!-- helper libraries -->
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	<!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	
        <!-- daypilot themes -->
	<link type="text/css" rel="stylesheet" href="themes/scheduler_8.css" />    
</head>
<body>
        <div id="header">
            <div class="bg-help">
                <div class="inBox">
                    <h1 id="logo"><a href='http://code.daypilot.org/85715/html5-scheduler-with-dynamic-event-loading'>HTML5 Scheduler with Dynamic Event Loading</a></h1>
                    <p id="claim"><a href="http://javascript.daypilot.org/">DayPilot for JavaScript</a> - AJAX Calendar/Scheduling Widgets for JavaScript/HTML5/jQuery</p>
                    <hr class="hidden" />
                </div>
            </div>
        </div>
        <div class="shadow"></div>
        <div class="hideSkipLink">
        </div>
        <div class="main">
            
            <div class="space"></div>
                
            <div id="dp"></div>

            <script type="text/javascript">
                var dp = new DayPilot.Scheduler("dp");

                dp.treeEnabled = true;

                dp.scale = "Day";
                dp.startDate = "2014-01-01";
                dp.days = 365;
                dp.dynamicLoading = true;
                
                dp.onScroll = function(args) {
                    args.async = true;
                    
                    var start = args.viewport.start;
                    var end = args.viewport.end;
                    
                    $.post("backend_events.php", 
                        {
                            start: start.toString(),
                            end: end.toString()
                        },
                        function(data) {
                            args.events = data;
                            args.loaded();
                        }
                    );
                    
                };
                
                dp.onBeforeEventRender = function(args) {
                };

                dp.timeHeaders = [
                    { groupBy: "Month", format: "MMMM yyyy" },
                    { groupBy: "Day", format: "d"}
                ];

                //dp.cellWidthSpec = "Auto";
                dp.bubble = new DayPilot.Bubble({
                    
                });

                // http://api.daypilot.org/daypilot-scheduler-oneventmoved/ 
                dp.onEventMoved = function (args) {
                    $.post("backend_move.php", 
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString(),
                        newResource: args.newResource
                    }, 
                    function() {
                        dp.message("Moved.");
                    });
                };

                // http://api.daypilot.org/daypilot-scheduler-oneventresized/ 
                dp.onEventResized = function (args) {
                    $.post("backend_resize.php", 
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString()
                    }, 
                    function() {
                        dp.message("Resized.");
                    });
                };

                // event creating
                // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
                dp.onTimeRangeSelected = function (args) {
                    var name = prompt("New event name:", "Event");
                    dp.clearSelection();
                    if (!name) return;

                    $.post("backend_create.php", 
                        {
                            start: args.start.toString(),
                            end: args.end.toString(),
                            resource: args.resource,
                            name: name
                        }, 
                        function(data) {
                            var e = new DayPilot.Event({
                                start: args.start,
                                end: args.end,
                                id: data.id,
                                resource: args.resource,
                                text: name
                            });
                            dp.events.add(e);

                            dp.message(data.message);
                        });
                };

                dp.init();
                dp.scrollTo(new DayPilot.Date());

                loadResources();

                function loadResources() {
                    $.post("backend_resources.php", function(data) {
                        dp.resources = data;
                        dp.update();
                    });
                }

            </script>

        </div>
        <div class="clear">
        </div>
</body>
</html>

