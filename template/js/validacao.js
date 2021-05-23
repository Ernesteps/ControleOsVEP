function ValidarTela(tela) {
    var ret = true;

    switch (tela) {

        case 1: // Tela de Setor
            if ($("#nome").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 2: // Tela de Alocar Equipamento
            if ($("#setor").val().trim() == '' || $("#equipamento").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 3: // Tela de Novo Equipamento
            if ($("#tipo").val().trim() == '' || $("#modelo").val().trim() == '' || $("#identificacao").val().trim() == '' || $("#descricao").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 4: // Tela de Modelo
            if ($("#nome").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 5: // Tela de Tipo
            if ($("#nome").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 6: // Tela de Usuario

            if ($("#tipo").val().trim() != '') {

                if ($("#nome").val().trim() == '' || $("#cpf").val().trim() == '') {
                    toastr.warning(RetornarMsg(0));
                    return false;
                }

            }

            if ($("#tipo").val().trim() == '2' || $("#tipo").val().trim() == '3') {

                if ($("#email").val().trim() == '' || $("#telefone").val().trim() == '' || $("#endereco").val().trim() == '') {
                    toastr.warning(RetornarMsg(0));
                    return false;
                }
            }

            if ($("#tipo").val().trim() == '2') {
                
                if ($("#setor").val().trim() == '') {
                    toastr.warning(RetornarMsg(0));
                    return false;
                }
            }

            break;

        case 7: // Tela de Novo Chamado (Funcionário)
            if ($("#equipamento").val().trim() == '' || $("#descricao").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 8: // Tela de Meus Dados (Funcionário)
            if ($("#email").val().trim() == ''|| $("#telefone").val().trim() == '' || $("#endereco").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 9: // Tela de Senha (Funcionário)
            if ($("#senha_atual").val().trim() == '' || $("#nova_senha").val().trim() == ''
                || $("#repitir_nova_senha").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 10: // Tela de Atender Chamado (Técnico)
            if ($("#data").val().trim() == '' || $("#funcionario").val().trim() == ''
                || $("#setor").val().trim() == '' || $("#equipamento").val().trim() == '' || $("#laudo").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 11: // Tela de Meus Dados (Técnico)
            if ($("#nome").val().trim() == '' || $("#email").val().trim() == ''
                || $("#telefone").val().trim() == '' || $("#endereco").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 12: // Tela de Senha (Técnico)
            if ($("#senha_atual").val().trim() == '' || $("#nova_senha").val().trim() == ''
                || $("#repitir_nova_senha").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 13: // Tela de Consultar Equipamento (Tipo)
            if ($("#tipo").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 14: //Tela de Remover Equipamento
            if ($("#setor").val().trim() == '') {
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;

        case 15: //Tela de Acesso
            if($("#cpf").val().trim() == '' || $("#pass").val().trim() == ''){
                toastr.warning(RetornarMsg(0));
                ret = false;
            }
            break;
        }

    return ret;
}