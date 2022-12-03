<?php include __DIR__ . '/../default/header-html.php'; ?>

<form action="realiza-login" method="post">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your login and password!</p>

                            <div class="form-outline form-white mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Email</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="senha" name="senha" class="form-control form-control-lg" />
                                <label class="form-label" for="senha">Senha</label>
                            </div>

                            <!--<p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                            <button class="btn btn-outline-light btn-lg px-5">Login</button>
                        </div>

                        <div>
                            <p class="mb-0">Não possui conta? <a href="cadastro" class="text-white-50 fw-bold">Cadastrar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include __DIR__ . '/../default/end-html.php'; ?>