
<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Secretário <small> Alterar</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <form role="form" action="<?php echo base_url('secretario/alterar/'.$form['idsecretario']) ?>" method="POST" >
            <input name="idsecretario" type="hidden" value="<?php echo $form['idsecretario'] ?>" />
            <?php $this->load->view('Secretario/form') ?>
        </form>
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->
<?php
$this->load->view('display/footer.php');
?>