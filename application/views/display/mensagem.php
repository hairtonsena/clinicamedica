<?php if ($this->session->flashdata('sucesso')) { ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b class="alert-link"><i class="fa fa-check"></i> Sucesso! </b> <?php echo $this->session->flashdata('sucesso') ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('erro')) { ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b class="alert-link"><i class="fa fa-times"></i> Erro! </b> <?php echo $this->session->flashdata('erro') ?>
    </div>
<?php } ?>