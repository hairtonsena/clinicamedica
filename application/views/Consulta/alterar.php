
<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Consulta <small> Alterar</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <form role="form" action="<?php echo base_url('consulta/alterar/'.$form['idconsulta']) ?>" method="POST" >
            <input name="idconsulta" type="hidden" value="<?php echo $form['idconsulta'] ?>" />
            <?php $this->load->view('Consulta/form') ?>
        </form>
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->
<?php
$this->load->view('display/footer.php');
?>