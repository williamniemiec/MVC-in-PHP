<div class='container'>
    <h1>Login</h1>
    <?php $this->login(); ?>
    <form method='POST'>
        <div class='form-group'>
            <label for='email'>Email: </label>
            <input id='email' type='text' name='email' class='form-control' />
        </div>

        <div class='form-group'>
            <label for='password'>Password: </label>
            <input id='password' type='password' name='pass' class='form-control' />
        </div>
        
        <div class='form-group'>
            <input type='submit' value='Login' class='btn btn-outline-primary' />
        </div>
    </form>
</div>