$(document).ready(function(){
        var url = 'http://senasoft.local/tema';     
        /////////////////////////////////////////////////////////////   
        //executes code below when user click on pagination links
        $("#principal").on( "click", "#paginacao a", function (e){
            $(this).removeClass( "page" ).addClass( "pag" ); 
            e.preventDefault();
            //$(".loading-div").show(); //show loading element
            var page = $(this).attr("data-page");
            url = 'http://senasoft.local/tema/page/'+page;
            cargar(page);          

        });
        /////////////////////////////////////////////////////////////

        var cargar=function(ini){
            $.getJSON(url).done(function( json ) {
                $("#contenedor").empty();
                var html="";
                $.each(json, function(i, item){
                    html +="<div id='lista-topicos'><div class='topico'>\n\
                        <div class='opcoes-topico'><dl><dt>"+json[i].comentarios+"</dt><dd>Respuestas</dd></dl>\n\
                        <dl><dt>"+json[i].visitas+"</dt><dd>Visualizaciones</dd></dl>\n\
                        <dl><dt>"+json[i].fecha_creacion.substring(5, 10)+"</dt><dd>hora "+json[i].fecha_creacion.substring(11, 16)+"</dd></dl></div>\n\
                        <h4><a href='respuesta.html' title=''>"+json[i].titulo+"<span>/ por "+json[i].nickname+" </span></a></h4>\n\
                        <h5><a href='#' title=''>"+json[i].descripcion+"</a></h5></div></div>";

                });
                ///////////////////////////
                var val=(json[0].registros/10);
                if (val>val.toPrecision(2)) {
                    var fin = (val)+1;
                    html += "<div id='paginacao'>\n\
                    <a id='primeiro' href='#' data-page='1'>« Primero</a>";
                    for (var i = 1; i <= fin;i++) {
                        if (ini==i) {
                            html+="<a href='#'  class='page' data-page='"+i+"' ' >"+i+"</a>";
                        }else{
                            html+="<a href='#'  class='pag' data-page='"+i+"' ' >"+i+"</a>";
                        }
                    };
                    html+="<a id='ultimo' href='#' data-page='"+fin.toPrecision(2)+"'>Último »</a></div>";
                }
                ///////////////////////////

                $("#contenedor").append(html);
                }).fail(function( jqxhr, textStatus, error ) {
                    alert('Disculpe, existió un problema');
                });   
        };     
                     
        cargar(0);
});
       