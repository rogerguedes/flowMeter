$.ajax({
    type: "POST",
    url: window.backEnd.appFullPath+"app/login",
    data: {email: "viniciuscarvalho789@gmail.com", password: "qwe123"},
    success: function (data){
        console.log(data);
    },
    dataType: "json",
    accepts: {json: "application/json"}
});

