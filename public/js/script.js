function confirmarMedico(medico) {

    $("#myModalLabel").text('Excluir Médico');

    var html = 'Você realmente deseja excluir este médico?';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>';
    botao += ' <a href="' + urlBase + 'medico/excluir/' + medico + '"  class="btn btn-primary">Sim</a>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}

function confirmarSecretario(secretario) {

    $("#myModalLabel").text('Excluir Secretário');

    var html = 'Você realmente deseja excluir este secretário?';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>';
    botao += ' <a href="' + urlBase + 'secretario/excluir/' + secretario + '"  class="btn btn-primary">Sim</a>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}

function confirmarPaciente(paciente) {

    $("#myModalLabel").text('Excluir Paciente');

    var html = 'Você realmente deseja excluir este paciente?';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>';
    botao += ' <a href="' + urlBase + 'paciente/excluir/' + paciente + '"  class="btn btn-primary">Sim</a>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}

function confirmarConsulta(consulta) {

    $("#myModalLabel").text('Excluir Consulta');

    var html = 'Você realmente deseja excluir esta consulta?';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>';
    botao += ' <a href="' + urlBase + 'consulta/excluir/' + consulta + '"  class="btn btn-primary">Sim</a>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}

function showQueixa(queixa) {
    $("#myModalLabel").text('Excluir Consulta');

    var html = '<strong>Queixa:</strong> <p> ' + queixa + '</p>';

    var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>';

    $("#myModalBody").html(html);
    $("#myModalFooter").html(botao);
    $("#myModal").modal('show');
}

function showPaciente(paciente) {
    $("#myModalLabel").text('Paciente');

    var html = '';

    $.getJSON(urlBase + 'paciente/show/' + paciente, function (data) {
        var items = [];
        var p = '';





        html += '<h2>' + data['paciente']['nome'] + '</h2>';
        p += '<p><strong>Indetidade: </strong>' + data['paciente']['identidade'] + '<strong> Idade: </strong>' + data['paciente']['idade'] + '<strong>Sexo: </strong>' + data['paciente']['sexo'] + '<strong> Telefone: </strong>' + data['paciente']['telefone'] + '<strong>Email: </strong>' + data['paciente']['email'] + '</p> ';

        p += '<p><strong>Logradouro: </strong>' + data['paciente']['logradouro'] + '<strong> Numero: </strong>' + data['paciente']['numero'] + '<strong> Bairro: </strong>' + data['paciente']['bairro'] + '<strong> Cidade: </strong>' + data['paciente']['Cidade'] + '<strong> CEP: </strong>' + data['paciente']['cep'] + '</p> ';
        p += '<p><strong>Fixa: </strong>' + data['paciente']['fixa'] + '</p> ';

        html += p;

        var tr = '';
        var consulta = data['consultas']


        for (var i = 0; i < consulta.length; i++) {

            tr += "<tr><td>" + consulta[i]['idconsulta'] + "</td> <td>"
                    + consulta[i]['paciente'] + "</td> <td>"
                    + consulta[i]['medico'] + " </td> <td>"
                    + consulta[i]['data'] + "</td> <td>" + consulta[i]['hora']
                    + "</td><td class='text-center'> ";

            if ((consulta[i]['status']) == 0) {
                tr += " <label class='label label-danger'>Aberta</label>"
            } else {
                tr += "<label class='label label-success'>Fexada</label>";
            }
            tr += " </td> </tr>";

        }

        var table = '<table id="table_id" class="table table-bordered display"><thead><tr><th>Consulta Nª</th><th>Paciente</th><th>Médico</th><th>Data</th><th>Hora</th><th class="text-center" style="width: 50px">Status</th></tr></thead><tbody>';

        table += tr;


        table += '</tbody></table>';
        
        html += table;

        var botao = '<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>';

        $("#myModalBody").html(html);
        $("#myModalFooter").html(botao);
        $("#myModal").modal('show');
    });











}