<div class='container'>
    <h1>Cadastro</h1>
    <?php $this->cadastrar(); ?>
    <form method='POST'>
        <div class='row'>
            <div class='col'>
                <div class='form-group'>
                    <label for='nome'>Nome: </label>
                    <input id='nome' type='text' name='nome' class='form-control' pattern='[A-Za-z\s]{4,}' required />
                </div>
            </div>
            <div class='col-2'>
                <div class='form-group'>
                    <label for='idade'>Idade: </label>
                    <input id='idade' type='number' name='idade' class='form-control' required />
                </div>    
            </div>
        </div>
        <div class='form-group'>
            <label for='tel'>Telefone</label>
            <input id='tel' type='tel' name='tel' class='form-control' pattern='[0-9]{11,}' required />
        </div>
        <div class='form-group'>
            <label for='email'>Email: </label>
            <input id='email' type='text' name='email' class='form-control' pattern='^[A-z0-9\_\-]{3,}\@[A-Za-z0-9]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9]{2,})?$' required />
        </div>
        <div class='form-group'>
            <label for='senha'>Senha: </label>
            <input  type='password' name='senha' class='form-control pass_input' required autocomplete='on' />
            <div id='pass_strength_box' class='bg-dark text-light'>
                <h5 class='pass_strength_header'>Força da senha</h5>
                <div class='progress'>
                    <div class='pass_strength_bar'></div>
                </div>
                <ul class='pass_strength'>
                    <li id='pass_length' data-length='8'>
                        Tamanho da senha (no mínimo 8 caracteres)
                        <span class='pass_strength_icon'></span>
                    </li>
                    <li id='pass_numCaract'>
                        Numeros e caracteres
                        <span class='pass_strength_icon'></span>
                    </li>
                    <li id='pass_specCaract'>
                        Caracteres especiais
                        <span class='pass_strength_icon'></span>
                    </li>
                    <li id='pass_ulCaract'>
                        Letras maiúsculas e minúsculas
                        <span class='pass_strength_icon'></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class='form-group'>
            <input type='submit' value='Cadastrar' class='btn btn-outline-primary submit' />
        </div>
    </form>
</div>
<script src='<?php echo BASE_URL; ?>assets/js/ps_script.js'></script>