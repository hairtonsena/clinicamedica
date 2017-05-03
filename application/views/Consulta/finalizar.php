
<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Consulta <small> Finalizar</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <table id="table_id" class="table table-bordered display">
                <thead>
                    <tr>
                        <th>Consulta Nª</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Data</th>
                        <th>Hora</th>

                        <th class="text-center" style="width: 50px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $form['idconsulta'] ?></td>
                        <td><?php echo $form['paciente'] ?></td>
                        <td><?php echo $form['medico'] ?></td>
                        <td><?php echo $form['data'] ?></td>
                        <td><?php echo $form['hora'] ?></td>
                        <td class="text-center">
                            <?php if ($form['status'] == 0) { ?>
                                <label class="label label-danger">Aberta</label>
                            <?php } else { ?>
                                <label class="label label-success">Fexada</label>    
                            <?php } ?>

                        </td>

                    </tr>
                    <tr>
                        <td colspan="6">
                            <strong>Queixa:</strong>
                            <p>
                                <?php echo $form['queixa'] ?>
                            </p>
                        </td> 
                    </tr>
                </tbody>
            </table>
        </div>
        <form role="form" action="<?php echo base_url('consulta/finalizar/' . $form['idconsulta']) ?>" method="POST" >
            <input name="idconsulta" type="hidden" value="<?php echo $form['idconsulta'] ?>" />

            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Prontuário</label>
                        <textarea name="prontuario" rows="5" class="form-control"><?php echo $form['prontuario'] ?></textarea>
                        <?php echo form_error('queixa', '<span class="text-danger">', '</span>'); ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group text-right">
                    <a href="<?php echo base_url('consulta') ?>" class="btn btn-default">Cancelar</a>
                    <button class="btn btn-success" type="submit" name="submit" value="abc">Salvar</button>

                </div>
            </div>
        </form>
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->
<?php
$this->load->view('display/footer.php');
?>