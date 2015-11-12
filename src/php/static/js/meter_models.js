//System elements
var meterModels;
//MeterModels view elements
var meterModelsDiv;
var meterModelsAddBtn;

//Modal elements
function ModalPane(containerElement){
    this.container = containerElement;

    this.setToCreateMM = function(){
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
                $('<h4>', {class: "modal-title", id: "myModalLabel", text: "Adicionar Modelo"})
                );
        //############ Body
        var nameTxtField = $('<input>', {type: "text", class: "form-control", id: "form-metermodel-name"});

        var descTxtField = $('<textarea>', {type: "text", class: "form-control", id: "form-metermodel-desc"});

        var errorPane = $('<div>', {id: "myModalSubmitErr"});

        var modalBody = $('<div>', {class: "modal-body"}).append(
                errorPane,
                $('<form>').append(
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-metermodel-name", class: "control-label", text: "Nome"}),
                        nameTxtField
                        ),
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-metermodel-desc", class: "control-label", text: "Descrição"}),
                        descTxtField
                        )
                    )
                );
        //############ Footer
        createButton = $('<button>', { id: "modalAddModelBtn", type: "button", class: "btn btn-primary", text: "Adicionar"});

        createButton.off("click");

        createButton.click(this,function(event){
            $.ajax({
                type: "POST",
                url: window.backEnd.appFullPath+"metermodels/create",
                data: {name: nameTxtField.val(), desc: descTxtField.val()},
                success: function (data){
                    if(data.status){
                        nameTxtField.val("");
                        descTxtField.val("");
                        errorPane.empty();
                        event.data.hide();
                        window.meterModelsDiv.empty();
                        window.showMeterModels();
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
    
    this.setToEditMM = function(meterModel){
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
                $('<h4>', {class: "modal-title", id: "myModalLabel", text: "Adicionar Modelo"})
                );
        //############ Body
        var nameTxtField = $('<input>', {type: "text", class: "form-control", id: "form-metermodel-name"});
        nameTxtField.val(meterModel.name);
        var descTxtField = $('<textarea>', {type: "text", class: "form-control", id: "form-metermodel-desc"});
        descTxtField.val(meterModel.description);
        var errorPane = $('<div>', {id: "myModalSubmitErr"});

        var modalBody = $('<div>', {class: "modal-body"}).append(
                errorPane,
                $('<form>').append(
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-metermodel-name", class: "control-label", text: "Nome"}),
                        nameTxtField
                        ),
                    $('<div>', {class: "form-group"}).append(
                        $('<label>', {for: "form-metermodel-desc", class: "control-label", text: "Descrição"}),
                        descTxtField
                        )
                    )
                );
        //############ Footer
        createButton = $('<button>', { id: "modalAddModelBtn", type: "button", class: "btn btn-primary", text: "Adicionar"});

        createButton.off("click");

        createButton.click(this,function(event){
            $.ajax({
                type: "POST",
                url: window.backEnd.appFullPath+"metermodels/update",
                data: {id: meterModel.id, name: nameTxtField.val(), desc: descTxtField.val()},
                success: function (data){
                    if(data.status){
                        nameTxtField.val("");
                        descTxtField.val("");
                        errorPane.empty();
                        console.log(event.data);
                        event.data.hide();
                        window.meterModelsDiv.empty();
                        window.showMeterModels();
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

    this.show = function(){
        this.container.modal('show');
    }

    this.hide = function(){
        this.container.modal('hide');
    }

}

var modalPane;

function MeterModelPane(containerElement){
    this.container = containerElement;

    this.showModel = function(meterModel){
        this.container.empty();
        this.container.show();
        var paneHeader = $('<div>', {class: "panel-heading text-center"}).append(
                $('<span>',{class: "panel-title", text: meterModel.name})
                );
        var cmdList;
        if(meterModel.commands && meterModels.commands.length > 0){
            cmdList = $('<div>', {class: "list-group"});
            for(index in meterModels){
                cmdList.append($('<button>', {type: "button", class:"list-group-item", text: "Cras justo odio"}))
            }
        }else{
            cmdList = $('<div>', {class: "alert alert-info", role: "alert", text: "Esse medidor não possui nenhum comando."});
        }
        var paneBody = $('<div>', {class: "panel-body"}).append(
                $('<strong>', {text: "Descrição"}),
                $('<p>', {text: meterModel.description}),
                $('<strong>', {text: "Comandos"}),
                cmdList
                );
        this.container.append(
                paneHeader,
                paneBody
                );
    }
    
    this.show = function(){
        this.container.show();
    }

    this.hide = function(){
        this.container.hide();
    }

}

var meterModelPane;

function meterModelsShow(objects, HTMLelement){
    if(objects && objects.length > 0){
        var meterModelsTable = $('<table>',{id:"meterModelsTable", class:"table table-striped table-bordered table-hover table-condensed"});

        var headerRow = $('<tr>');

        headerRow.append($('<th>',{text: 'ID'}));
        headerRow.append($('<th>',{text: 'Nome'}));
        headerRow.append($('<th>',{text: 'Descrição'}));
        headerRow.append($('<th>',{text: 'Ações'}));

        meterModelsTable.append(headerRow);

        for(index in objects){
            var newRow = $('<tr>');

            var idColumn = $('<td>', {text: objects[index].id});
            var nameColumn = $('<td>', {text: objects[index].name});
            var descriptionColumn = $('<td>', {text: objects[index].description});

            var actionsColumn = $('<td>');
            var updateBtn =  $('<button>', {class: "btn btn-warning btn-xs", title: "Editar"});
            updateBtn.click(objects[index], function(event){
                window.modalPane.setToEditMM(event.data);
                window.modalPane.show();
            });
            var updateBtnIcon = $('<span>', {class: 'glyphicon glyphicon-edit', 'aria-hidden':'true'});
            updateBtn.append( updateBtnIcon );
            
            actionsColumn.append( updateBtn );

            var seeBtn = $('<button>', {class: "btn btn-primary btn-xs", title: "Ver"}).append(
                    $('<span>', {class: 'glyphicon glyphicon-eye-open', 'aria-hidden':'true'})
                    );

            seeBtn.click(objects[index], function(event){
                meterModelPane.showModel(event.data);
            });

            actionsColumn.append(seeBtn);

            var deleteBtn = $('<button>', {class: "btn btn-danger btn-xs", title: "Deletar"});
            deleteBtn.click(objects[index], function(event){
                $.ajax({
                    type: "POST",
                    url: window.backEnd.appFullPath+"metermodels/delete",
                    data: {id: event.data.id},
                    success: function (data){
                        console.log(data);
                        if(data.status){
                            window.meterModelsDiv.empty();
                            window.showMeterModels();
                        }
                        else{
                            console.log("something gone wrong.");
                            if(data.errors.length > 0){
                            }
                        }
                    },
                    dataType: "json",
                    accepts: {json: "application/json"}
                });
            });
            var deleteBtnIcon = $('<span>', {class: 'glyphicon glyphicon-remove', 'aria-hidden':'true'});
            deleteBtn.append( deleteBtnIcon );

            actionsColumn.append( deleteBtn );

            newRow.append(idColumn);
            newRow.append(nameColumn);
            newRow.append(descriptionColumn);
            newRow.append(actionsColumn);

            meterModelsTable.append(newRow);
        }
        HTMLelement.append(meterModelsTable);
    }else{
        HTMLelement.append($('<h1>',{text:'Você não possui nenhum modelo de medidor.', class:'text-center'}))
    }
}

function showMeterModels(){
    $.ajax({
        type: "GET",
    url: window.backEnd.appFullPath+"metermodels/read",
    success: function (data){
        if(data.status){
            meterModelsShow(data.object, window.meterModelsDiv);
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
    window.meterModelsDiv = $("#meterModelsDiv");
    
    meterModelsAddBtn = $("#addModelBtn");
    
    window.modalPane = new ModalPane($("#myModal"));
    meterModelsAddBtn.off("click");
    meterModelsAddBtn.click(function(){
        window.modalPane.setToCreateMM();
        window.modalPane.show();
    });
    
    window.meterModelPane = new MeterModelPane($("#meterModelPane"));
    meterModelPane.hide();
    window.showMeterModels();
});

