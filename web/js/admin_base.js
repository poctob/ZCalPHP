/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var selectedItem = -1;

$(function() {
    $('#messages').puigrowl();
    $( "#delete-dialog-confirm" ).puidialog({
         buttons: [{  
                text: 'Yes',  
                icon: 'ui-icon-check',  
                click: function() {  
                    deleteAction();
                }  
            },  
            {  
                text: 'No',  
                icon: 'ui-icon-close',  
                click: function() {  
                    $('#dialog-confirm').puidialog('hide');  
                }  
            }  
        ]  
    }            
            );
});

function deleteAction()
{
    $('#delete-dialog-confirm').puidialog('hide');  
    $.ajax({
        url: '../delete/' + selectedItem.toString(),
        cache: false
    })
            .done(function()
            {
               location.reload();
               $('#messages').puigrowl('show',
               [{severity: 'info', summary: 'Success', detail: 'Item deleted!'}]); 
            })
             .error(function()
            {
               $('#messages').puigrowl('show',
               [{severity: 'error', summary: 'Error', detail: 'Failed to delete item!'}]); 
            });
}