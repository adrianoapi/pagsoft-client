@extends('layouts.app')

@section('content')
<style>
.padraoText {
    background-color:blue;
}
.vermelhoText {
    background-color:#FE2E64;
}
.azulClaroText {
    background-color:#85C1E9;
}
.roxoText {
    background-color:#BB62E5;
}
.marromText {
    background-color:#5F3F0C;
}
.verdeClaroText {
    background-color:#58D68D;
}
.verdeText {
    background-color:#59b300;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <div id='calendar'></div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



  <!-- Modal update 2024-05-31 -->
  <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Editar Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="comment">
        {{Form::hidden('event_id', NULL, ['id' => 'event_id'])}}
        {{Form::hidden('start', NULL, ['id' => 'start'])}}
        {{Form::hidden('end', NULL, ['id' => 'end'])}}
          <table>
            <tbody>
                <tr>
                    <td>Color</td>
                    <td>
                        {{Form::textarea('title', NULL, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title...'])}}
                    </td>
                </tr>
                <tr style="display: none;">
                    <td>Editable</td>
                    <td>
                        {{Form::text('editable', NULL, ['class' => 'form-control', 'id' => 'editable', 'placeholder' => 'true/false'])}}
                    </td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>
                        {{Form::textarea('location', NULL, ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'location...'])}}
                    </td>
                </tr>
                <tr>
                    <td>Icon</td>
                    <td>
                        {{Form::text('icon', NULL, ['class' => 'form-control', 'id' => 'icon', 'placeholder' => 'icon'])}}
                    </td>
                </tr>
                <tr style="display: none;">
                    <td>All day</td>
                    <td>
                        {{Form::text('all_day', NULL, ['class' => 'form-control', 'id' => 'all_day', 'placeholder' => 'true/false'])}}
                    </td>
                </tr>
                <tr>
                    <td>Cor</td>
                    <td>
                        {{Form::text('backgroundColor', NULL, ['class' => 'form-control', 'id' => 'backgroundColor', 'placeholder' => '#FFFFFF'])}}
                        <select id="mySelect" class="form-control">
                            <option class="padraoText" value="" >Padrão</option>
                            <option class="vermelhoText" value="#FE2E64" >Vermelho</option>
                            <option class="azulClaroText"   value="#85C1E9" >Azul Claro</option>
                            <option class="roxoText" value="#BB62E5" >Roxo</option>
                            <option class="marromText" value="#5F3F0C" >Marrom</option>
                            <option class="verdeClaroText" value="#58D68D" >Verde Claro</option>
                            <option class="verdeText" value="#59b300" >Verde</option>
                        </select>
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{Form::submit('Salvar alterações', array('name'=>'submit', 'class'=>'btn btn-primary'))}}
        </div>
        </form>
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

var select = document.getElementById('mySelect');
select.onchange = function () {
    select.className = 'form-control '+this.options[this.selectedIndex].className;
    console.log();
    $("#backgroundColor").focus();
    console.log(this.options[this.selectedIndex].value);
    $("#backgroundColor").val(this.options[this.selectedIndex].value);
}

$('#comment').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "{{route('event.update')}}",
        data: {
            title: $('#title').val(),
            icon: $('#icon').val(),
            backgroundColor: $('#backgroundColor').val(),
            editable: $('#editable').val(),
            location: $('#location').val(),
            all_day: $('#all_day').val(),
            id: $('#event_id').val(),
            start: $('#start').val(),
            end: $('#end').val(),
            type: 'update',
            _token: "{{ csrf_token() }}"
        },
        type: "POST",
        success: function (response) {
            displayMessage("Evento atualizado com sucesso!");
            
            //fechar modal
            $('#eventModal').modal('hide');

            $('#calendar').fullCalendar( 'refetchEvents' );
        }
    });
});

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

                            if(event.icon != '')
                            {
                                element.find('.fc-title').prepend('<i class="nc-icon '+event.icon+'"></i> ');
                            }

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
                                        displayMessage("Evento criado com sucesso!");
        
                                       /* calendar.fullCalendar('renderEvent',
                                            {
                                                id: data.id,
                                                title: title,
                                                location: location,
                                                start: start,
                                                end: end,
                                                allDay: allDay
                                            },true);*/
        
                                        $('#calendar').fullCalendar( 'refetchEvents' );
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
                                }else
                                {
                                    $('#eventModal').modal('show');

                                    $.ajax({
                                        type: "GET",
                                        url: "{{route('event.show')}}",
                                        data: {
                                                id: event.id,
                                                _token: "{{ csrf_token() }}"
                                        },
                                        success: function (response) {
                                            var data = JSON.parse(response);
                                            $("#title").val(data.title);
                                            $("#icon").val(data.icon);
                                            $("#backgroundColor").val(data.backgroundColor);
                                            $("#editable").val(data.editable);
                                            $("#location").val(data.location);
                                            $("#all_day").val(data.all_day);
                                            $("#event_id").val(data.id);
                                            $("#start").val(data.start);
                                            $("#end").val(data.end);
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
