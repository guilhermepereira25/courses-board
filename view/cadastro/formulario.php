<?php include __DIR__ . '/../default/header-html.php'; ?>

<form action="realiza-cadastro" method="post">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-info text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-3">

                            <h2 class="fw-bold mb-2 text-uppercase">SING UP</h2>
                            <p class="text-body-50 mb-5">Please enter your login and password!</p>

                            <div class="form-outline form-white mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg"/>
                                <label class="form-label" for="email">Email</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="senha" name="senha" class="form-control form-control-lg"/>
                                <label class="form-label" for="senha">Senha</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input onkeyup="return validatePasswords()" type="password" id="confirm-password" name="confirm-password" class="form-control form-control-lg" />
                                <label class="form-label" for="confirm-password">Confirmar senha</label>
                            </div>

                            <button onclick="return pass_alert()" class="btn btn-outline-light btn-lg px-5">Cadastrar</button>
                        </div>

                        <span id="senha-incorreta-alert"></span>

                        <div>
                            <p class="text-body mb-0 mt-3">Já possui conta? <a href="login" class="text-white fw-bold">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include __DIR__ . '/../default/end-html.php'; ?>

<script>
    function validatePasswords() {
        let password = document.getElementById('senha').value;
        let confirmPassword = document.getElementById('confirm-password').value;
        let wrong_pass_alert = document.getElementById('senha-incorreta-alert');

        if (password != confirmPassword) {
            wrong_pass_alert.style.color = 'red';
            wrong_pass_alert.innerHTML = 'As senhas não coincidem';
            return false;
        } else {
            wrong_pass_alert.style.color = 'white';
            wrong_pass_alert.innerHTML = 'Senhas coincidem';
            return true;
        }
    }
    
    function pass_alert() {
        let password = document.getElementById('senha').value;
        let confirmPassword = document.getElementById('confirm-password').value;

        if (password != "" && confirmPassword != "") {
            alert("Seu cadastro foi concluído");
            return true;
        } else {
            alert("Por favor, preencha os campos corretamente");
            return false;
        }
    }

</script>