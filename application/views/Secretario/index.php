
<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Secretários <small class="pull-right"><a class="btn btn-success" href="<?php echo base_url('secretario/novo') ?>"> <i class="fa fa-plus"></i> Novo</a></small></h1>
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

                    <!--<th class="text-center" style="width: 50px">Mais</th>-->
                    <th class="text-center" style="width: 150px">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($secretarios as $secretario) { ?>
                    <tr>
                        <td><?php echo $secretario->nome ?></td>
                        <td><?php echo $secretario->identidade ?></td>
                        <td><?php echo $secretario->telefone ?></td>
                        <td><?php echo $secretario->email ?></td>
                        <!--<td class="text-center"></td>-->
                        <td class="text-center">
                            <button type="button"  class="btn btn-default" title="Mais detalhes"><i class="glyphicon glyphicon-zoom-in"></i></button>
                            <a href="<?php echo base_url('secretario/alterar/' . $secretario->idsecretario) ?>" class="btn btn-primary" title="Alterar" ><i class="fa fa-pencil"></i></a>
                            <button type="button" onclick="confirmarSecretario('<?php echo $secretario->idsecretario ?>')" class="btn btn-danger" title="Excluir"><i class="fa fa-remove"></i></button>
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