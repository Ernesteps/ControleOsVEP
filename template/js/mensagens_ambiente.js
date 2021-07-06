function RetornarMsg(num) {
    var msg = '';

    switch (num) {
        case -2:
            msg = 'Não foi possível excluir o registro, pois está em uso!'
            break;

        case -1:
            msg = 'Ocorreu um erro na operação. Tente mais tarde!'
            break;

        case 0:
            msg = 'Preencher o(s) campo(s) obrigatório(s)!'
            break;

        case 1:
            msg = 'Ação realizada com sucesso!'
            break;

        case 2:
            msg = 'Usuário não encontrado!'
            break;

        case 3:
            msg = 'Erro de digito de senha!'
            break;

        case 4:
            msg = 'A senha digitada não coincide com o usuário logado.'
            break;

        case 5:
            msg = 'Senha verificada.'
            break;

        case 6:
            msg = 'Senha deverá ter no minimo 6 caracteres.'
            break;

        case 7:
            msg = 'Senha e Repetir Senha não conferem.'
            break;

        case 8:
            msg = 'Não foi encontrado registro.'
            break;

        case 9:
            msg = 'Atendimento ao chamado iniciado.'
            break;

        case 10:
            msg = 'Chamado Encerrado.'
            break;
    }

    return msg;
}