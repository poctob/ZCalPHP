/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function() {
    $( "#dialog-confirm" ).puidialog({
         buttons: [{  
                text: 'Yes',  
                icon: 'ui-icon-check',  
                click: function() {  
                    $('#dialog-confirm').puidialog('hide');  
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