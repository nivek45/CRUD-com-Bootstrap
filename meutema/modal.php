<?php
if (!isset($_SESSION)) session_start();
?>

<!-- Modal -->
<div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir Carro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!isset($_SESSION['user'])): ?>
                    <!-- Mensagem de erro exibida se o usuário não estiver logado -->
                    <div class="alert alert-danger" role="alert">
                        Você precisa estar logado para realizar esta ação.
                    </div>
                <?php else: ?>
                    <!-- Conteúdo normal do modal -->
                    Tem certeza de que deseja excluir este carro?
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="#" id="confirm" class="btn btn-primary">
                        <i class="fa-solid fa-circle-check"></i> Excluir
                    </a>
                <?php endif; ?>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fa-regular fa-circle-xmark"></i> Não
                </button>
            </div>
        </div>
    </div>
</div>
