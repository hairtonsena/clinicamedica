
<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pacientes <small class="pull-right"><a class="btn btn-success" href="<?php echo base_url('paciente/novo') ?>"> <i class="fa fa-plus"></i> Novo</a></small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?php $this->load->view('display/mensagem') ?>
        <table id="table_id" class="table display">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Identidade</th>
                    <th>Telefone</th>
                    <th>Email</th>

                    <th class="text-center" style="width: 50px">Status</th>
                    <th class="text-center" style="width: 150px">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente) { ?>
                    <tr>
                        <td><?php echo $paciente->nome ?></td>
                        <td><?php echo $paciente->identidade ?></td>
                        <td><?php echo $paciente->telefone ?></td>
                        <td><?php echo $paciente->email ?></td>
                        <td class="text-center">
                            <?php if ($paciente->status == 1) { ?>
                                <label class="label label-success">Ativo</label>
                            <?php } else { ?>
                                <label class="label label-danger">Inativo</label>    
                            <?php } ?>

                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default" onclick="showPaciente('<?php echo $paciente->idpaciente ?>')"> <i class="fa fa-eye"></i></button>
                            <?php if ($this->session->userdata('userTipo') != 'SECRETARIO') { ?>
                                <a href="<?php echo base_url('paciente/alterar/' . $paciente->idpaciente) ?>" class="btn btn-primary" title="Alterar" ><i class="fa fa-pencil"></i></a>
                                <button type="button" onclick="confirmarPaciente('<?php echo $paciente->idpaciente ?>')" class="btn btn-danger" title="Excluir"><i class="fa fa-remove"></i></button>
                                <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->
<?php
$this->load->view('display/footer.php');
?>