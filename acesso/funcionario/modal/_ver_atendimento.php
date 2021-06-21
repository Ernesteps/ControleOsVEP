<div class="modal fade" id="modal-detalhe">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalhes do atendimento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Data e hora do Atendimento</label>
                        <input type="text" disabled class="form-control" id="data_hora_atend">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Data e hora do Encerramento</label>
                        <input disabled class="form-control" id="data_hora_enc">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Técnico</label>
                        <input disabled class="form-control" id="tecnico">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Laudo</label>
                        <textarea readonly class="form-control" id="laudo"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->