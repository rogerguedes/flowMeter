var timeInterruption;
var cont;

var syncNodesTable;
$(document).ready(function(){
    syncNodesTable = $("#syncNodesTable");
    syncNodesTable
    console.log("yoh");
    $.ajax({
        type: "GET",
        url: "syncnodes/read",
        success: function (data){
            console.log(data);
            if(data.status){
                console.log(window.syncNodesTable);
                for(index in data.object){
                    var newRow = $('<tr>');
                    var idColumn = $('<td>', {text: data.object[index].id});
                    var aliasColumn = $('<td>', {text: data.object[index].alias});
                    var ipAddressColumn = $('<td>', {text: data.object[index].ipAddress});
                    var statusColumn = $('<td>', {text: data.object[index].status});
                    var actionsColumn = $('<td>');

                    newRow.append(newRow);
                    newRow.append(idColumn);
                    newRow.append(aliasColumn);
                    newRow.append(ipAddressColumn);
                    newRow.append(statusColumn);
                    newRow.append(actionsColumn);

                    syncNodesTable.append(newRow);
                    console.log(data.object[index]);
                }
            }
            else{
                console.log("ops");
            }
        },
        dataType: "json",
        accepts: {json: "application/json"}
    });
});
