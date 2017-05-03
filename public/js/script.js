function confirmarMedico(medico) {

    $("#myModalLabel").text('Excluir Médico');

    var html = 'Você realmente deseja excluir este médico?';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>';
    botao += ' <a href="'+ urlBase + 'medico/excluir/' + medico +'"  class="btn btn-primary">Sim</a>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}

function confirmarSecretario(secretario) {

    $("#myModalLabel").text('Excluir Secretário');

    var html = 'Você realmente deseja excluir este secretário?';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>';
    botao += ' <a href="'+ urlBase + 'secretario/excluir/' + secretario +'"  class="btn btn-primary">Sim</a>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}