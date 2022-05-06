@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Ledger Entry</h4>

                    </div>
                    <div class="card-body table-full-width table-responsive">

                            <div id='calendar'></div>  

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('scripts')
 <!-- fullcalendar -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
 
 <script type="text/javascript">

 

    $(document).ready(function () {
       
       $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
         
       var calendar = $('#calendar').fullCalendar({
                           editable: true,
                           events: "{{route('event.index')}}",
                           eventColor: "#3788d8",
                           eventTextColor: "#fff",
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
                               if (title) {
                                   var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                   var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                   $.ajax({
                                       url: "{{route('event.store')}}",
                                       data: {
                                           title: title,
                                           start: start,
                                           end: end,
                                           location: "Rua Epaminondas",
                                           all_day: false,
                                           type: 'add',
                                           _token: "{{ csrf_token() }}",
                                       },
                                       type: "POST",
                                       success: function (data) {
                                           console.log(data);
                                           displayMessage("Event Created Successfully");
         
                                           calendar.fullCalendar('renderEvent',
                                               {
                                                   id: data.id,
                                                   title: title,
                                                   start: start,
                                                   end: end,
                                                   allDay: allDay
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
                                   url: "{{route('event.update')}}",
                                   data: {
                                       title: event.title,
                                       start: start,
                                       end: end,
                                       id: event.id,
                                       type: 'update',
                                       _token: "{{ csrf_token() }}"
                                   },
                                   type: "POST",
                                   success: function (response) {
                                       displayMessage("Event Updated Successfully");
                                   }
                               });
                           },

                           eventClick: function (event) {

                            //$('#exampleModal').modal('toggle');
                            //$('#exampleModal').modal('show');
                            //$('#exampleModal').modal('hide');
                            //return false;
                            
                               var deleteMsg = confirm("Do you really want to delete?");
                               if (deleteMsg) {
                                   $.ajax({
                                       type: "POST",
                                       url: "{{route('event.delete')}}",
                                       data: {
                                               id: event.id,
                                               type: 'delete',
                                               _token: "{{ csrf_token() }}"
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
            demo.showNotification('top','right', message, 2)
       } 
    </script>
@endsection
