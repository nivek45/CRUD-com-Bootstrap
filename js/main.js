/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que acionou o modal
    var idCliente = button.data('customer'); // Captura o data-customer se for cliente
    var idCar = button.data('car'); // Captura o data-Car se for funcionário
    var modal = $(this); // Modal atual

    // Verifica se o modal deve exibir informações de "Cliente" ou "Car"
    if (idCliente) {
        modal.find('.modal-title').text('Excluir Cliente: ' + idCliente);
        modal.find('.modal-body').text('Deseja mesmo excluir o cliente: ' + idCliente + '?');
        modal.find('#confirm').attr('href', 'delete.php?id=' + idCliente);
    }
    else if (idCar) {
        modal.find('.modal-title').text('Excluir Funcionário: ' + idCar);
        modal.find('.modal-body').text('Deseja mesmo excluir o funcionário: ' + idCar + '?');
        modal.find('#confirm').attr('href', 'delete.php?id=' + idCar);
    }
});

$('#delete-modal-user').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idUsuario = button.data('usuario');
    var modal = $(this);

    modal.find('.modal-title').text('Excluir usuário: ' + idUsuario);
    modal.find('.modal-body').text('Deseja mesmo excluir o usuário: ' + idUsuario + '?');
    modal.find('#confirm').attr('href', 'delete.php?id=' + idUsuario);
});