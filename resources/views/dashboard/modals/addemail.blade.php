
<div id="send-email-modal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                <h3>Agregar correo electronico</h3>
            </div>
            <div class="modal-body">
                <form name="send-email-form" id="send-email-form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="email">Direccion de correo</label>
                        <input class="form-control" type="email" name="email" id="email" required autofocus>

                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email_confirmation">Confirmar correo</label>
                        <input class="form-control" type="email" name="email_confirmation" id="email_confirmation" required equalTo="#email">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="sendAjaxForm('{{$user->id}}', 'send-email-form')" class="btn btn-primary" id="send-email-btn">Guardar</button>
                <a href="#" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>