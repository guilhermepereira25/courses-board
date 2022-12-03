<?php include __DIR__ . '/../default/header-html.php'; ?>

<a href="novo-curso" class="btn btn-primary mb-3">Novo Curso</a>

<ul class="list-group">
    <?php foreach ($cursos as $curso) : ?>
        <li class="list-group-item d-flex justify-content-between">
            <?php echo $curso->getDescricao(); ?>

            <span>
                <a href="alterar-curso?id=<?php echo $curso->getId(); ?>" class="btn btn-info btn-sm">
                    Alterar
                </a>  
                
                <a onclick="return deleteAlert();" href="excluir-curso?id=<?php echo $curso->getId(); ?>" class="btn btn-danger btn-sm">
                    Excluir
                </a>    
            </span>

        </li>
    <?php endforeach; ?>
</ul>

<?php include __DIR__ . '/../default/end-html.php'; ?>

<script>
    function deleteAlert() {
        var answer = confirm("Deseja deletar esse registro?");

        if (answer) {
            alert("Registro excluído");
            return true;
        } else {
            return false;
        }
    }
</script>