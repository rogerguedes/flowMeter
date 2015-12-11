//beans objects
var readings;
//view objects
var modalPane;
var beokersTable;
var brokerAddBtn;

function ModalPane(containerElement){
    this.container = containerElement;

    this.setToCreateBroker = function(){
        this.container.empty();
        var modalContent = $('<div>', {class:"modal-content"});
        this.container.append(
                $('<div>',{class: "modal-dialog", role: "document"}).append(
                    modalContent
                    )
                );
        //############ Header
        var modalHeader = $('<div>', {class: "modal-header"}).append(
                $('<button>', {type: 'button', class: "close", 'data-dismiss': "modal", 'aria-label': "Fechar"}).append(
                    $('<span>', {'aria-hidden': "true", html: "&times;"})
                    ),
                $('<h4>', {class: "modal-title", id: "myModalLabel", text: "Adicionar Broker"})
                );
        //############ Body
        var netAddrTxtField = $('<input>', {type: "text", class: "form-control", id: "form-syncnode-netaddr"});

        var portTxtField = $('<input>', {type: "text", class: "form-control", id: "form-syncnode-port"});

        var topicTxtField = $('<input>', {type: "text", class: "form-control", id: "form-syncnode-topic"});
        
        var errorPane = $('<div>', {id: "myModalSubmitErr"});

        var modalBody = $('<div>', {class: "modal-body"}).append(
                errorPane,
                $('<form>').append(
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-syncnode-netaddr", class: "control-label", text: "Endereço de Rede"}),
                        netAddrTxtField
                        ),
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-syncnode-port", class: "control-label", text: "Porta"}),
                        portTxtField
                        ),
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-syncnode-topic", class: "control-label", text: "Tópico"}),
                        topicTxtField
                        )
                    )
                );
        //############ Footer
        createButton = $('<button>', { id: "modalAddModelBtn", type: "button", class: "btn btn-primary", text: "Adicionar"});

        createButton.off("click");

        createButton.click(this,function(event){
            $.ajax({
                type: "POST",
                url: window.backEnd.appFullPath+"brokers/create",
                data: {ip_address: netAddrTxtField.val(), port: portTxtField.val(), topic: topicTxtField.val()},
                success: function (data){
                    if(data.status){
                        netAddrTxtField.val()
                        portTxtField.val()
                        topicTxtField.val()
                        errorPane.empty();
                        event.data.hide();
                        window.loadBrokers();
                    }
                    else{
                        console.log("something gone wrong.");
                        if(data.errors.length > 0){
                            var errorList = $('<ul>')
                            for(index in data.errors){
                                errorList.append( $('<li>', {text: data.errors[index]}) );
                            }
                            errorPane.empty();
                            errorPane.append(errorList);
                        }
                    }
                },
                dataType: "json",
                accepts: {json: "application/json"}
            });
        });
        var modalFooter = $('<div>', {class: "modal-footer"}).append(
                $('<button>', {type: "button", class: "btn btn-default", 'data-dismiss': "modal", text: "Fechar"}),
                createButton
                );

        modalContent.append(modalHeader);
        modalContent.append(modalBody);
        modalContent.append(modalFooter);
    }
    
    this.setToEditBroker = function( element ){
        this.container.empty();
        var modalContent = $('<div>', {class:"modal-content"});
        this.container.append(
                $('<div>',{class: "modal-dialog", role: "document"}).append(
                    modalContent
                    )
                );
        //############ Header
        var modalHeader = $('<div>', {class: "modal-header"}).append(
                $('<button>', {type: 'button', class: "close", 'data-dismiss': "modal", 'aria-label': "Fechar"}).append(
                    $('<span>', {'aria-hidden': "true", html: "&times;"})
                    ),
                $('<h4>', {class: "modal-title", id: "myModalLabel", text: "Editar Broker"})
                );
        //############ Body
        var netAddrTxtField = $('<input>', {type: "text", class: "form-control", id: "form-syncnode-netaddr"});
        netAddrTxtField.val( element.ipAddress );

        var portTxtField = $('<input>', {type: "text", class: "form-control", id: "form-syncnode-port"});
        portTxtField.val( element.port );

        var topicTxtField = $('<input>', {type: "text", class: "form-control", id: "form-syncnode-topic"});
        topicTxtField.val( element.topic );
        
        var errorPane = $('<div>', {id: "myModalSubmitErr"});

        var modalBody = $('<div>', {class: "modal-body"}).append(
                errorPane,
                $('<form>').append(
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-syncnode-netaddr", class: "control-label", text: "Endereço de Rede"}),
                        netAddrTxtField
                        ),
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-syncnode-port", class: "control-label", text: "Porta"}),
                        portTxtField
                        ),
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-syncnode-topic", class: "control-label", text: "Tópico"}),
                        topicTxtField
                        )
                    )
                );
        //############ Footer
        createButton = $('<button>', { id: "modalAddModelBtn", type: "button", class: "btn btn-primary", text: "Salvar"});

        createButton.off("click");

        createButton.click(this ,function(event){
            $.ajax({
                type: "POST",
                url: window.backEnd.appFullPath+"brokers/update",
                data: {id: element.id, ip_address: netAddrTxtField.val(), port: portTxtField.val(), topic: topicTxtField.val()},
                success: function (data){
                    if(data.status){
                        netAddrTxtField.val()
                        portTxtField.val()
                        topicTxtField.val()
                        errorPane.empty();
                        event.data.hide();
                        window.loadBrokers();
                    }
                    else{
                        console.log("something gone wrong.");
                        if(data.errors.length > 0){
                            var errorList = $('<ul>')
                            for(index in data.errors){
                                errorList.append( $('<li>', {text: data.errors[index]}) );
                            }
                            errorPane.empty();
                            errorPane.append(errorList);
                        }
                    }
                },
                dataType: "json",
                accepts: {json: "application/json"}
            });
        });
        var modalFooter = $('<div>', {class: "modal-footer"}).append(
                $('<button>', {type: "button", class: "btn btn-default", 'data-dismiss': "modal", text: "Fechar"}),
                createButton
                );

        modalContent.append(modalHeader);
        modalContent.append(modalBody);
        modalContent.append(modalFooter);
    }

    this.setToDeleteBroker = function( elementToDelete ){
        this.container.empty();
        var modalContent = $('<div>', {class:"modal-content"});
        this.container.append(
                $('<div>',{class: "modal-dialog", role: "document"}).append(
                    modalContent
                    )
                );
        //############ Header
        var modalHeader = $('<div>', {class: "modal-header"}).append(
                $('<button>', {type: 'button', class: "close", 'data-dismiss': "modal", 'aria-label': "Close"}).append(
                    $('<span>', {'aria-hidden': "true", html: "&times;"})
                    ),
                $('<h4>', {class: "modal-title", id: "myModalLabel", text: "Alerta!"})
                );
        //############ Body

        var errorPane = $('<div>', {id: "myModalSubmitErr"});

        var modalBody = $('<div>', {class: "modal-body"}).append(
                errorPane,
                $('<strong>',{text: "Você tem certeza que deseja deletar o Broker cujo ID é "+elementToDelete.id+"?"})
                );
        //############ Footer
        createButton = $('<button>', { id: "modalAddModelBtn", type: "button", class: "btn btn-danger", text: "Deletar"});

        createButton.off("click");

        createButton.click(this,function(event){
            $.ajax({
                type: "POST",
                url: window.backEnd.appFullPath+"brokers/delete",
                data: {id: elementToDelete.id},
                success: function (data){
                    if(data.status){
                        errorPane.empty();
                        event.data.hide();
                        window.loadBrokers();
                    }
                    else{
                        console.log("something gone wrong.");
                        if(data.errors.length > 0){
                            var errorList = $('<ul>')
                            for(index in data.errors){
                                errorList.append( $('<li>', {text: data.errors[index]}) );
                            }
                            errorPane.empty();
                            errorPane.append(errorList);
                        }
                    }
                },
                dataType: "json",
                accepts: {json: "application/json"}
            });
        });
        var modalFooter = $('<div>', {class: "modal-footer"}).append(
                $('<button>', {type: "button", class: "btn btn-default", 'data-dismiss': "modal", text: "Cancelar"}),
                createButton
                );

        modalContent.append(modalHeader);
        modalContent.append(modalBody);
        modalContent.append(modalFooter);
    }
    
    this.show = function(){
        this.container.modal('show');
    }

    this.hide = function(){
        this.container.modal('hide');
    }

}

function jsTable(containerElement, headers, attrNames){

    this.container = containerElement;
    this.headers = headers;
    this.attrNames = attrNames;
    this.currentDisplayed = null;
    
    this.draw = function(elements){
        this.container.empty();
        if(elements && elements.length > 0){
            var newTable = $('<table>',{id:"meterModelsTable", class:"table table-striped table-bordered table-hover table-condensed"});

            var headerRow = $('<tr>');
            for(index in this.headers){
                headerRow.append($('<th>',{text: this.headers[index]}));
            }
            newTable.append(headerRow);

            for(i in elements){
                console.log( elements[i] );
                var newRow = $('<tr>');
                for(j in this.attrNames){
                    newRow.append($('<td>',{text: elements[i][ this.attrNames[j] ]}));
                }
                newTable.append(newRow);
            }
            this.container.append(newTable);
        }else{
            this.container.append($('<h1>',{text:'Você não possui nenhuma Leitura registrada.', class:'text-center'}))
        }
    }

    this.show = function(){
        this.container.show();
    }

    this.hide = function(){
        this.container.hide();
    }

}

function loadReadings(){
    $.ajax({
        type: "GET",
        url: window.backEnd.appFullPath+"readings/read",
        success: function (data){
            if(data.status){
                window.readings = data.object;
                window.readingsTable.draw( window.readings );
            }
            else{
                console.log("something gone wrong.");
            }
        },
        dataType: "json",
        accepts: {json: "application/json"}
    });
}

$(document).ready(function(){
    window.modalPane = new ModalPane( $("#myModal") );
    window.readingsTable = new jsTable( $("#readingsDiv") , ["ID", "Fluxo", "Volume", "Data"], ["id", "flow", "volume", "date"]);
    window.loadReadings();
    /*
    */
});


