<!DOCTYPE html>
<html>
<head>
    <title>DayPilot Pro for JavaScript</title>
	<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />    

	<!-- helper libraries -->
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	<!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	
        <!-- daypilot themes -->
	<link type="text/css" rel="stylesheet" href="themes/scheduler_8.css" />    
	<link type="text/css" rel="stylesheet" href="themes/bubble_default.css" />    
	<link type="text/css" rel="stylesheet" href="themes/navigator_white.css" />    
</head>
<body>
        <div id="header">
			<div class="bg-help">
				<div class="inBox">
					<h1 id="logo"><a href='http://code.daypilot.org/50604/ajax-scheduler-for-javascript-php'>AJAX Scheduler for JavaScript/PHP</a></h1>
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

                // behavior and appearance
                dp.cssClassPrefix = "scheduler_8";
                dp.cellWidth = 40;
                dp.eventHeight = 25;
                dp.headerHeight = 25;

                // view
                dp.startDate = new DayPilot.Date("2013-05-01").firstDayOfMonth();  // or just dp.startDate = "2013-03-25";
                dp.cellGroupBy = "Month";
                dp.days = dp.startDate.daysInMonth();
                dp.cellDuration = 1440; // one day

                dp.moveBy = 'Full';
                dp.showToolTip = false;

                // bubble, with async loading
                dp.bubble = new DayPilot.Bubble({
                    cssClassPrefix: "bubble_default",
                    onLoad: function(args) {
                        var ev = args.source;
                        args.async = true;  // notify manually using .loaded()

                        // simulating slow server-side load
                        setTimeout(function() {
                            args.html = "<div style='font-weight:bold'>" + ev.text() + "</div><div>Start: " + ev.start().toString("MM/dd/yyyy HH:mm") + "</div><div>End: " + ev.end().toString("MM/dd/yyyy HH:mm") + "</div><div>Id: " + ev.id() + "</div>";
                            args.loaded();
                        }, 500);

                    }
                });

                // no events at startup, we will load them later using loadEvents()
                dp.events.list = [];

                dp.treeEnabled = true;
                dp.rowHeaderWidthAutoFit = true; // TODO fix for tree
                dp.rowHeaderWidth = 200;

                // 
                dp.resources = [
                             { name: "Room A", id: "A", expanded: true, children:[
                                     { name : "Room A.1", id : "A.1" },
                                     { name : "Room A.2", id : "A.2" }
                                     ] 
                             },
                             { name: "Room B", id: "B" },
                             { name: "Room C", id: "C", loaded: false }
                            ];

                // http://api.daypilot.org/daypilot-scheduler-onbeforeeventrender/
                dp.onBeforeEventRender = function(args) {
                    args.e.cssClass = "test";
                    args.e.innerHTML = args.e.text + ":";
                };

                // see http://api.daypilot.org/daypilot-scheduler-onbeforecellrender/ 
                dp.onBeforeCellRender = function(args) {
                    if (args.cell.start.getDayOfWeek() === 6) {
                        args.cell.color = "#dddddd";
                    }
                };

                // http://api.daypilot.org/daypilot-scheduler-onbeforetimeheaderrender/
                dp.onBeforeTimeHeaderRender = function(args) {
                    if (args.header.start.getDayOfWeek() === 6) {
                        args.header.html = "Sat";
                    }
                };

                // http://api.daypilot.org/daypilot-scheduler-onbeforeresheaderrender/ 
                dp.onBeforeResHeaderRender = function(args) {
                    if (args.resource.loaded === false) {
                        args.resource.innerHTML += " (loaded dynamically)";
                    }
                };

                // http://api.daypilot.org/daypilot-scheduler-oneventmoved/ 
                dp.onEventMoved = function (args) {
                    DayPilot.request(
                        "backend_move.php", 
                        function(req) { // success
                            var response = eval("(" + req.responseText + ")");
                            if (response && response.result) {
                                dp.message("Moved: " + response.message);
                            }
                        },
                        args,
                        function(req) {  // error
                            dp.message("Saving failed");
                        }
                    );        
                };

                // http://api.daypilot.org/daypilot-scheduler-oneventresized/ 
                dp.onEventResized = function (args) {
                    DayPilot.request(
                        "backend_resize.php", 
                        function(req) { // success
                            var response = eval("(" + req.responseText + ")");
                            if (response && response.result) {
                                dp.message("Resized: " + response.message);
                            }
                        },
                        args,
                        function(req) {  // error
                            dp.message("Saving failed");
                        }
                    );    
                };

                // event creating
                // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
                dp.onTimeRangeSelected = function (args) {
                    var name = prompt("New event name:", "Event");
                    dp.clearSelection();
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        resource: args.resource,
                        text: name
                    });
                    dp.events.add(e);

                    args.text = name;

                    DayPilot.request(
                        "backend_create.php", 
                        function(req) { // success
                            var response = eval("(" + req.responseText + ")");
                            if (response && response.result) {
                                dp.message("Created: " + response.message);
                            }
                        },
                        args,
                        function(req) {  // error
                            dp.message("Saving failed");
                        }
                    ); 
                };

                // http://api.daypilot.org/daypilot-scheduler-oneventclick/
                dp.onEventClick = function(args) {
                    alert("clicked: " + args.e.id());
                };

                dp.init();

                loadEvents();

                function loadEvents() {
                    DayPilot.request("backend_events.php", function(result) {
                        var data = eval("(" + result.responseText + ")");
                        for(var i = 0; i < data.length; i++) {
                            var e = new DayPilot.Event(data[i]);                
                            dp.events.add(e);
                        }
                    });
                }

            </script>

        </div>
        <div class="clear">
        </div>
</body>
</html>

