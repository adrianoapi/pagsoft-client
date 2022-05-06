@extends('layouts.app')
<style>

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  
    #script-warning {
      display: none;
      background: #eee;
      border-bottom: 1px solid #ddd;
      padding: 0 10px;
      line-height: 40px;
      text-align: center;
      font-weight: bold;
      font-size: 12px;
      color: red;
    }
  
    #loading {
      display: none;
      position: absolute;
      top: 10px;
      right: 10px;
    }
  
    #calendar {
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 10px;
    }
  
  </style>
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Schedule</h4>
                        <a href="#" class="btn btn-success"><i class="fa fa-file"></i> New</a>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="fixed-table-toolbar">
                        <div class="bars pull-left">
                            <div class="toolbar">
                                //
                            </div>
                        </div>
                    </div>

                    <div id='calendar'></div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function () {
   
   var SITEURL = "{{ url('/') }}";
     
   $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
     
   var calendar = $('#calendar').fullCalendar({
                       editable: true,
                       events: {{route('event.index')}},
                       displayEventTime: false,
                       editable: true,
                       eventRender: function (event, element, view) {
                           if (event.allDay === 'true') {
                                   event.allDay = true;
                           } else {
                                   event.allDay = false;
                           }
                       },
                       selectable: true,
                       selectHelper: true,
                       select: function (start, end, allDay) {
                           var title = prompt('Event Title:');
                           if (name) {
                               var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                               var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                               $.ajax({
                                   url: {{route('event.store')}},
                                   data: {
                                       title: title,
                                       start: start,
                                       end: end,
                                       type: 'add'
                                   },
                                   type: "POST",
                                   success: function (data) {
                                       displayMessage("Event Created Successfully");
     
                                       calendar.fullCalendar('renderEvent',
                                           {
                                               id: data.id,
                                               name: name,
                                               start_date: start_date,
                                               end_date: end_date,
                                           },true);
     
                                       calendar.fullCalendar('unselect');
                                   }
                               });
                           }
                       },
                       eventDrop: function (event, delta) {
                           var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                           var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
     
                           $.ajax({
                               url: SITEURL + '/fullcalenderAjax',
                               data: {
                                   title: event.title,
                                   start: start,
                                   end: end,
                                   id: event.id,
                                   type: 'update'
                               },
                               type: "POST",
                               success: function (response) {
                                   displayMessage("Event Updated Successfully");
                               }
                           });
                       },
                       eventClick: function (event) {
                           var deleteMsg = confirm("Do you really want to delete?");
                           if (deleteMsg) {
                               $.ajax({
                                   type: "POST",
                                   url: SITEURL + '/fullcalenderAjax',
                                   data: {
                                           id: event.id,
                                           type: 'delete'
                                   },
                                   success: function (response) {
                                       calendar.fullCalendar('removeEvents', event.id);
                                       displayMessage("Event Deleted Successfully");
                                   }
                               });
                           }
                       }
    
                   });
    
   });
    
   function displayMessage(message) {
       toastr.success(message, 'Event');
   } 
</script>
@endsection
