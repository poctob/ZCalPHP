/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

    applyDataTableUI();
    applyEditDialogUI();
    
    $.getJSON('../../calendar/listJson', populateCalendarDropDown);
    
    
    $('#eventAdd').puibutton({
        icon: 'ui-icon-circle-plus',
        click: function() {
        window.location.href='../new/'+calendar_id;
        }
    });    
    
    $('#eventEdit').puibutton({
        icon: 'ui-icon-pencil',
        click: function() {
        window.location.href='../edit/'+selectedItem;
        }
    });    
    
    $('#eventView').puibutton({
        icon: 'ui-icon-search',
        click: function() {
        window.location.href='../view/'+selectedItem;
        }
    });    
    
    $('#eventDelete').puibutton({
        icon: 'ui-icon-trash',
        click: function() {
             $( "#delete-dialog-confirm" ).puidialog('show');           
        }
    });    
    
     disableCalendarEditButtons();
     
     $('#eventViewSection').puipanel();  
});

function populateCalendarDropDown(data)
{
    $('#calendarsDropDown').puidropdown();
    for (var key in data)
    {
        var calendar = data[key];
        $('#calendarsDropDown').puidropdown
                ('addOption', calendar['name'], calendar['id']);
                
        if(typeof calendar_id !== 'undefined')
        {
             $('#calendarsDropDown').puidropdown('selectValue', calendar_id);
        }
    }
    
    $('#calendarsDropDown').puidropdown({
        change: function(event){
            var url=$('#calendarsDropDown').puidropdown('getSelectedValue');
            window.location.href=url;
        }
    });
    
}

function applyDataTableUI()
{
    $('#eventsDataTable').puidatatable({
        caption: "Events",
        paginator: {
            rows: 5
        },
        columns: [
            {field: 'title', headerText: 'Title', sortable: true},
            {field: 'valid_from', headerText: 'Valid From', sortable: true},
            {field: 'valid_to', headerText: 'Valid To', sortable: true},
            {field: 'start_time', headerText: 'Start Time', sortable: true},
            {field: 'end_time', headerText: 'End Time', sortable: true},
            {field: 'is_all_day', headerText: 'All Day', sortable: true}
        ],
        datasource: function(callback) {
            $.ajax({
                type: "GET",
                url: '../listJson/'+calendar_id,
                dataType: "json",
                context: this,
                success: function(response) {
                    callback.call(this, response);
                }
            });
        },
        selectionMode: 'multiple',
        rowSelect: function(event, data) {
            selectedItem = data.id;
            enableCalendarEditButtons();
            $('#messages').puigrowl('show', [{severity: 'info', summary: 'Row Selected', detail: (data.id)}]);
        },
        rowUnselect: function(event, data) {
            selectedItem = -1;
            disableCalendarEditButtons();
            $('#messages').puigrowl('show', [{severity: 'info', summary: 'Row Unselected', detail: (data.id)}]);
        }
    });
}

function disableCalendarEditButtons()
{
    $('#eventEdit').puibutton('disable');
    $('#eventView').puibutton('disable');
    $('#eventDelete').puibutton('disable');
}

function enableCalendarEditButtons()
{
    $('#eventEdit').puibutton('enable');
    $('#eventView').puibutton('enable');
    $('#eventDelete').puibutton('enable');
}

function applyEditDialogUI()
{
    $('#eventTitleText').puiinputtext();
    $('#eventIsAllDay').puicheckbox();
    $('#eventCheckEveryDay').puicheckbox();
    $('#eventCheckMonday').puicheckbox();
    $('#eventCheckTuesday').puicheckbox();
    $('#eventCheckWednesday').puicheckbox();
    $('#eventCheckThursday').puicheckbox();
    $('#eventCheckFriday').puicheckbox();
    $('#eventCheckSaturday').puicheckbox();
    $('#eventCheckSunday').puicheckbox();

    $('#eventSaveButton').puibutton({
        icon: 'ui-icon-check'
    });

    $('#eventCancelButton').puibutton({
        icon: 'ui-icon-close'
    });
}

function newEventAction()
{
    $.ajax({
        url: '../new/'+calendar_id,
        cache: false
    })
            .done(function(html)
            {
                var new_data = $('#eventAddForm', html);
                $('#eventAddForm').replaceWith(new_data);
                   applyEditDialogUI();
            });
}






