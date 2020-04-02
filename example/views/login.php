<div class='container'>
    <h1>Login</h1>
    <?php $this->login(); ?>
    <form method='POST'>
        <div class='form-group'>
            <label for='email'>Email: </label>
            <input id='email' type='text' name='email' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='senha'>Senha: </label>
            <input id='senha' type='password' name='senha' class='form-control' />
        </div>
        <div class='form-group'>
            <input type='submit' value='Entrar' class='btn btn-outline-primary' />
        </div>
    </form>
</div>