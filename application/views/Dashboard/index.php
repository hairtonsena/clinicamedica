<?php
$this->load->view('display/head.php');
$this->load->view('display/menu.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <h1>Olá <?php echo $this->session->userdata('userNome') ?>!</h1>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<?php
$this->load->view('display/footer.php');
?>