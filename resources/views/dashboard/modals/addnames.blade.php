
<div id="send-names-modal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                <h3>Agregar Nombre y Apellido</h3>
            </div>
            <div class="modal-body">
                <form name="send-names-form" id="send-names-form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="first_name">Nombre</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" minlength="3" required autofocus>

                    </div>
                    <div class="form-group">
                        <label class="control-label" for="last_name">Apellido</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" minlength="3" required>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="sendAjaxForm('{{$user->id}}', 'send-names-form')" class="btn btn-primary" id="send-names-btn">Guardar</button>
                <a href="#" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>