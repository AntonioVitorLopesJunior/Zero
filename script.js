/*$(document).ready(function(){
    $('#button').click(function(){
        var nome = document.getElementById('camp-name').value;
        while(nome.indexOf(" ") !== -1){
            nome = nome.replace(" ", "+");
        }
        alert(nome);
        $.getJSON('http://localhost/teste/clientes_curl.php?nome='+nome, function (dados){
           document.getElementById('resultado').innerHTML = dados['cat_nome'];
        });
    });
});*/
$(document).ready(function(e){
    $("form[ajax=true]").submit(function(e) {
        e.preventDefault();
        var form_data = $(this).serializeArray();
        $.ajax({
            url: './clientes_curl.php', 
            type: 'POST',      
            data: form_data,     
            cache: false,
            success: function(txt){
                var json = JSON.parse(txt);
                $('form[ajax=true]').after('<table><tbody><tr><th>Nome</th><th>Categoria</th><th>Status da Categoria</th></tr><tr><td>'+form_data[0].value+'</td><td>'+json.cat_nome+'</td><td>'+json.cat_status+'</td></tr></tbody></table>');
            }           
        });
    });
});