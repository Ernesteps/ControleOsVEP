function CarregarDadosExcluir(id, nome) {

    $("#cod_item").val(id); //Val pra jogar valor, input...
    $("#nome_excluir").html(nome); //HTML Preenche algo na tela, uma label ou descrição
}

function CarregarDadosTipoAlterar(id, nome) {

    $("#cod_alt").val(id); //Val pra jogar valor, input...
    $("#nome_alt").val(nome); //HTML Preenche algo na tela, uma label ou descrição
}

function CarregarDadosSetorAlterar(id, nome) {

    $("#cod_alt").val(id); //Val pra jogar valor, input...
    $("#nome_alt").val(nome); //HTML Preenche algo na tela, uma label ou descrição
}

function CarregarDadosModeloAlterar(id, nome) {

    $("#cod_alt").val(id); //Val pra jogar valor, input...
    $("#nome_alt").val(nome); //HTML Preenche algo na tela, uma label ou descrição
}

function MostrarTipoUsuario(tipo) {

    if (tipo != '') {
        $("#divTipo123").show();
        $("#btn_gravar").show();
        $("#divTipo2").hide();
        $("#divTipo23").hide();

    } else {
        $("#divTipo123").hide();
        $("#btn_gravar").hide();
        $("#divTipo2").hide();
        $("#divTipo23").hide();
    }

    if (tipo == '2' || tipo == '3') {
        $("#divTipo23").show();
        $("#divTipo2").hide();
    }

    if (tipo == '2') {
        $("#divTipo2").show();
    }
}

function ValidarCPFCadastro(cpf) {
    if (cpf.trim() != '') {
        $.post('ajax/verificar_cpf_duplicado.php',
            { cpf_user: cpf },
            function (retorno) {
                if (retorno == 1) {
                    $("#cpf").val('');
                    $("#val_cpf").html('O CPF: ' + cpf + ', já existe!');
                    $("#val_cpf").show();
                } else {
                    $("#val_cpf").hide();
                }
            });
    }
}

function ValidarEmailCadastro(email) {
    if (email.trim() != '') {
        $.post('ajax/verificar_email_duplicado.php',
            { email_user: email },
            function (retorno) {
                if (retorno == 1) {
                    $("#email").val('');
                    $("#val_email").html('O Email: ' + email + ', já existe!');
                    $("#val_email").show();
                } else {
                    $("#val_email").hide();
                }
            });
    }
}

function InserirTipo(){
    var nome = $("#nome").val().trim();

    if(ValidarTela(5)){
        $.post("ajax/tipo_equipamento_ajax.php", {
            nome_tipo : nome,
            acao : 'I'
        }, function (retorno_chamada){
            $("#nome").val('')
            toastr.success(RetornarMsg(1));

            $.post("ajax/tipo_equipamento_ajax.php", {
                acao : 'C'
            }, function (retorno_chamada){
                $("#tabTipos").html(retorno_chamada);
            });
        });
    }
    return false;
}

function InserirModelo(){
    var nome = $("#nome").val().trim();

    if(ValidarTela(4)){
        $.post("ajax/modelo_ajax.php", {
            nome_modelo : nome,
            acao : 'I'
        }, function (retorno_chamada){
            $("#nome").val('')
            toastr.success(RetornarMsg(1));
            
            $.post("ajax/modelo_ajax.php", {
                acao : 'C'
            }, function (retorno_chamada){
                $("#tabModelos").html(retorno_chamada);
            });
        });
    }
    return false;
}

function InserirSetor(){
    var nome = $("#nome").val().trim();

    if(ValidarTela(1)){
        $.post("ajax/Setor_ajax.php", {
            nome_setor : nome,
            acao: 'I'
        }, function (retorno_chamada){
            $("#nome").val('')
            toastr.success(RetornarMsg(1));

            $.post("ajax/Setor_ajax.php", {
                acao : 'C'
            }, function (retorno_chamada){
                $("#tabSetores").html(retorno_chamada);
            });
        });
    }
    return false;
}