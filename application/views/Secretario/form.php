<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nome</label>
            <input name="nome" type="text" value="<?php echo $form['nome']?>" class="form-control">
            <?php echo form_error('nome','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Idade</label>
            <input name="idade" type="number" value="<?php echo $form['idade']?>" class="form-control">
            <?php echo form_error('idade','<span class="text-danger">','</span>'); ?>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Sexo</label>
            <select name="sexo" class="form-control">
                <option value="">Selecione</option>
                <option <?php if($form['sexo']=="Feminino"){ echo 'selected="true"'; } ?> value="Feminino">Feminino</option>
                <option <?php if($form['sexo']=="Masculino"){ echo 'selected="true"'; } ?> value="Masculino">Masculino</option>
            </select>
            <?php echo form_error('sexo','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Identidade</label>
            <input name="identidade" type="text" value="<?php echo $form['identidade']?>" class="form-control">
            <?php echo form_error('identidade','<span class="text-danger">','</span>'); ?>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Telefone</label>
            <input name="telefone" type="text" value="<?php echo $form['telefone']?>" class="form-control">
            <?php echo form_error('telefone','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" value="<?php echo $form['email']?>" class="form-control">
            <?php echo form_error('email'); ?>

        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Logradouro</label>
            <input name="logradouro" type="text" value="<?php echo $form['logradouro']?>" class="form-control">
            <?php echo form_error('logradouro','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Numero</label>
            <input name="numero" type="text" value="<?php echo $form['numero']?>" class="form-control">
            <?php echo form_error('numero','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>bairro</label>
            <input name="bairro" type="text" value="<?php echo $form['bairro']?>" class="form-control">
            <?php echo form_error('bairro','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>cidade</label>
            <input name="cidade" type="text" value="<?php echo $form['cidade']?>" class="form-control">
            <?php echo form_error('cidade','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>CEP</label>
            <input name="cep" type="text" value="<?php echo $form['cep']?>" class="form-control">
            <?php echo form_error('cep','<span class="text-danger">','</span>'); ?>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Código</label>
            <input name="codigo" type="text" value="<?php echo $form['codigo']?>" class="form-control">
            <?php echo form_error('codigo','<span class="text-danger">','</span>'); ?>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Senha</label>
            <input name="senha" type="password" value="" class="form-control">
            <?php echo form_error('senha','<span class="text-danger">','</span>'); ?>
        </div>

    </div>
</div>

<div class="col-lg-12">
    <div class="form-group text-right">
        <a href="<?php echo base_url('secretario') ?>" class="btn btn-default">Cancelar</a>
        <button class="btn btn-success" type="submit" name="submit" value="abc">Salvar</button>

    </div>
</div>



