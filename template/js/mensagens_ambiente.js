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
    }

    return msg;
}