/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var selectedItem = -1;

$(function() {

    applyDataTableUI();

    $('#calendarAdd').puibutton({
        icon: 'ui-icon-circle-plus',
        click: function() {
            newCalendarAction();
            $('#calendarAddDialog').puidialog('show');

        }
    });

    $('#calendarEdit').puibutton({
        icon: 'ui-icon-pencil',
        click: function() {
            editCalendarAction();
            $('#calendarAddDialog').puidialog('show');
        }
    });

    $('#calendarDelete').puibutton({
        icon: 'ui-icon-trash',
        click: function() {
             $( "#dialog-confirm" ).puidialog('show');           
        }
    });
    
    $('#calendarManage').puibutton({
        icon: 'ui-icon-wrench',
        click: function() {
            manageCalendarAction();
        }
    });

    $('#messages').puigrowl();

    applyEditDialogUI();
    disableCalendarEditButtons();
});


function disableCalendarEditButtons()
{
    $('#calendarEdit').puibutton('disable');
    $('#calendarDelete').puibutton('disable');
    $('#calendarManage').puibutton('disable');
}

function enableCalendarEditButtons()
{
    $('#calendarEdit').puibutton('enable');
    $('#calendarDelete').puibutton('enable');
    $('#calendarManage').puibutton('enable');
}

function applyDataTableUI()
{
    $('#calendarsDataTable').puidatatable({
        caption: "Calendars",
        paginator: {
            rows: 5
        },
        columns: [
            {field: 'name', headerText: 'Name', sortable: true},
            {field: 'start_date', headerText: 'Start Date', sortable: true},
            {field: 'end_date', headerText: 'End Date', sortable: true},
            {field: 'is_active', headerText: 'Active?', sortable: true}
        ],
        datasource: function(callback) {
            $.ajax({
                type: "GET",
                url: 'listJson',
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

function applyEditDialogUI()
{

    $('#calendarAddDialog').puidialog({
        showEffect: 'fade',
        hideEffect: 'fade',
        minimizable: true,
        maximizable: true,
        modal: true
    });

    $('#calendarNameText').puiinputtext();
    $('#calendarActive').puicheckbox();

    $('#calendarSaveButton').puibutton({
        icon: 'ui-icon-check'
    });

    $('#calendarCancelButton').puibutton({
        icon: 'ui-icon-close',
        click: function() {
            $('#calendarAddDialog').puidialog('hide');
        }
    });

    $('#calendarAddForm').submit(function(event) {
        $('#calendarAddDialog').puidialog('hide');
    });
}
function editCalendarAction()
{
    $.ajax({
        url: 'edit/' + selectedItem.toString(),
        cache: false
    })
            .done(function(html)
            {
                var new_data = $('#calendarAddForm', html);
                $('#calendarAddForm').replaceWith(new_data);
                applyEditDialogUI();
            });
}

function deleteCalendarAction()
{
    $('#dialog-confirm').puidialog('hide');  
    $.ajax({
        url: 'delete/' + selectedItem.toString(),
        cache: false
    })
            .done(function(html)
            {
               location.reload();
            });
}

function newCalendarAction()
{
    $.ajax({
        url: 'new/',
        cache: false
    })
            .done(function(html)
            {
                var new_data = $('#calendarAddForm', html);
                $('#calendarAddForm').replaceWith(new_data);
                applyEditDialogUI();
            });
}

function manageCalendarAction()
{
    window.location.href = "../event/list/"+selectedItem.toString();
}