@extends('layouts.app')
@section('content')
	<style type="text/css">
		#container {
		    width: 60%;
		    margin-left: 20%;
		    height: 300px;
		}
		#mydrag {
		    width: 75px;
		    height: 30px;
		    background-color: red;
		}
	</style>	
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css">	
	<div id="container">
		<div class="row">
			<div id='calendar'></div>
			<div id="mydrag" >My Drag</div>			
		</div>
		<div id="eventDisplay"></div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			function onExternalEventDrop(date, allDay) {
			    alert("Dropped on " + date + " with allDay=" + allDay);
			}

			$('#mydrag').each(function() {

			    // create an Event Object
			    // (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			    // it doesn't need to have a start or end
			    var eventObject = {
			        id : 2,
			        title: 'MyDrag Title',
			        start : moment()
			    };

			    // store the Event Object in DOM element
			    // so we can get to it later
			    $(this).data('eventObject', eventObject);

			    // make the event draggable using jQuery UI
			    $(this).draggable({
			        containment: '#container',
			        helper: 'clone',
			        // revert: 'invalid',
			        revert: function(droppableObj) {
			            //if false then no socket object drop occurred.
			            if(droppableObj === false) {
			                // revert the object by returning true
			                alert('Not a droppable object');
			                return true;
			            }
			            else {
			                
			                // droppableObj was returned,
			                // We can perform additional checks here
			                // return false so object does not revert
			                return false;
			            }
			         },
			        revertDuration: 500,
			        start: function(e, ui) {
			            $(ui.helper).css('width', $(this).css('width'));
			        }
			    });

			});

		    $('#calendar').fullCalendar({
	            header: {
	                left: 'prev,next today',
	                center: 'title',
	                right: 'month,agendaWeek,agendaDay'
	            },
	            editable: true,
	            droppable: true, // this allows things to be dropped onto the calendar !!!
	            events : [
	            	{
	            		id : 1,
	            		start : moment(),
	            		title : 'adasd',
	            		droppable: true,
	            	}
	            ],
	            drop: function(date, allDay) { // this function is called when something is dropped
	            
	                // retrieve the dropped element's stored Event Object
	                var originalEventObject = $(this).data('eventObject');
	                
	                // we need to copy it, so that multiple events don't have a reference to the same object
	                var copiedEventObject = $.extend({}, originalEventObject);
	                
	                // assign it the date that was reported
	                copiedEventObject.start = date;
	                copiedEventObject.allDay = allDay;	                

	                // render the event on the calendar
	                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
	                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
	                
	                // is the "remove after drop" checkbox checked?
	                if ($('#drop-remove').is(':checked')) {
	                    // if so, remove the element from the "Draggable Events" list
	                    $(this).remove();
	                }
	                
	            },
	            eventClick: function(calEvent, jsEvent, view) {
                    console.log( calEvent );
                },
                eventDrop: function(event, delta, revertFunc) {

                    alert(event.title + " was dropped on " + event.start.format());

                    if (!confirm("Are you sure about this change?")) {
                        revertFunc();
                    }

                },
                dayClick: function(date, jsEvent, view) {
                	$("#eventDisplay").html("<p><b>Title:</b> " + 'asdadasd' + "</p>")
                	$("#eventDisplay").modal({
            	        width: 400,
            	        modal: true
            	    });
                    // alert('Clicked on: ' + date.format());

                    // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                    // alert('Current view: ' + view.name);

                    // change the day's background color just for fun
                    $(this).html('clicked');

                }
	        });


			$('#calendar').droppable();			
		});
	</script>
@stop