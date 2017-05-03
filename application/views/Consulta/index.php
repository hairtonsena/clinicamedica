
<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Consultas <small class="pull-right"><a class="btn btn-success" href="<?php echo base_url('consulta/nova') ?>"> <i class="fa fa-plus"></i> Nova</a></small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?php $this->load->view('display/mensagem') ?>
        <table id="table_id" class="table display">
            <thead>
                <tr>
                    <th>Consulta Nª</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th class="text-center" style="width: 50px">Queixa</th>
                    <th class="text-center" style="width: 50px">Status</th>
                    <?php if ($this->session->userdata('userTipo') != 'SECRETARIO') { ?>
                        <th class="text-center" style="width: 150px">Ação</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta) { ?>
                    <tr>
                        <td><?php echo $consulta->idconsulta ?></td>
                        <td><?php echo $consulta->paciente ?></td>
                        <td><?php echo $consulta->medico ?></td>
                        <td><?php echo $consulta->data ?></td>
                        <td><?php echo $consulta->hora ?></td>
                        <td><button type="button" class="btn btn-default" onclick="showQueixa('<?php echo $consulta->queixa ?>')"> <i class="fa fa-eye"></i></button></td>
                        <td class="text-center">
                            <?php if ($consulta->status == 0) { ?>
                                <label class="label label-danger">Aberta</label>
                            <?php } else { ?>
                                <label class="label label-success">Fexada</label>    
                            <?php } ?>

                        </td>
                        <td class="text-center">

                            <?php if ($this->session->userdata('userTipo') != 'SECRETARIO') { ?>
                                <a href="<?php echo base_url('consulta/finalizar/' . $consulta->idconsulta) ?>"  class="btn btn-success" title="Mais detalhes"><i class="fa fa-check-circle-o"></i></a>
                                <a href="<?php echo base_url('consulta/alterar/' . $consulta->idconsulta) ?>" class="btn btn-primary" title="Alterar" ><i class="fa fa-pencil"></i></a>
                                <button type="button" onclick="confirmarConsulta('<?php echo $consulta->idconsulta ?>')" class="btn btn-danger" title="Excluir"><i class="fa fa-remove"></i></button>
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