/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

    $.getJSON('../../calendar/listJson', populateCalendarDropDown);

    $('#eventAdd').puibutton({
        icon: 'ui-icon-circle-plus',
        click: function() {
            //       newEventAction();
            $('#eventAddDialog').puidialog('show');

        }
    });

    applyEditDialogUI();
});

function populateCalendarDropDown(data)
{
    $('#calendarsDropDown').puidropdown();
    for (var key in data)
    {
        var calendar = data[key];
        $('#calendarsDropDown').puidropdown
                ('addOption', calendar['name'], calendar['id']);
                
        if(calendar_id)
        {
             $('#calendarsDropDown').puidropdown('selectValue', calendar_id);
        }
    }
}


function applyEditDialogUI()
{
    $('#eventAddDialog').puidialog({
        showEffect: 'fade',
        hideEffect: 'fade',
        minimizable: true,
        maximizable: true,
        modal: true
    });

    $('#eventNameText').puiinputtext();
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
        icon: 'ui-icon-close',
        click: function() {
            $('#eventAddDialog').puidialog('hide');
        }
    });

    $('#eventAddForm').submit(function(event) {
        $('#eventAddDialog').puidialog('hide');
    });
}

function newEventAction()
{
    $.ajax({
        url: '../new/',
        cache: false
    })
            .done(function(html)
            {
                var new_data = $('#eventAddForm', html);
                $('#eventAddForm').replaceWith(new_data);
                applyEditDialogUI();
            });
}



