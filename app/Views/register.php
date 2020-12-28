<div class="container">
    <div class="row">
        <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Register</h3>
                <hr>
                <form action="/register" method="POST">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?= set_value('nombre') ?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" value="<?= set_value('apellido') ?>">
                            </div>
                        </div>


                    <div class="col-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                        </div>
                        
                    </div>
                    

                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                       <label for="change">Password</label>
                       <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                    </div>

                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                       <label for="password_confirm">Confirmar</label>
                       <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                    </div>
                    </div>

                    <?php if (isset($validation)): ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                    <div class="col-12 col-sm-4">
                        <button type="submit" class="btn btn-primary">Registro</button>
                    </div>

                        <div class="col-12 col-sm-8 text-right">
                            <a href="/">Inicia Sesion</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>