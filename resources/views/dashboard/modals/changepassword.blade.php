
<div id="change-password-modal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                <h3>Cambiar Contraseña</h3>
            </div>
            <div class="modal-body">
                <form name="change-password-form" id="change-password-form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="old_password">Contrseña actual</label>
                        <input class="form-control" type="password" name="old_password" id="old_password" required autofocus minlength="6">

                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Nueva contraseña</label>
                        <input class="form-control" type="password" name="password" id="password" minlength="8" required>

                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password_confirmation">Confirmar contraseña</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" minlength="8" required equalTo="#password">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="sendAjaxForm('{{$user->id}}', 'change-password-form')" class="btn btn-primary" id="change-password-btn">Guardar</button>
                <a href="#" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>