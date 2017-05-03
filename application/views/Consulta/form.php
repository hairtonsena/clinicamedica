<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Paciente</label>

            <?php if (isset($form['idconsulta'])) { ?>
            <input type="text" disabled="true" value="<?php echo $form['paciente'] ?>" class="form-control" />
            <?php } else { ?>

                <select name="paciente_idpaciente" class="form-control">
                    <option value="">Selecione</option>
                    <?php foreach ($pacientes as $paciente) { ?>
                        <option value="<?php echo $paciente->idpaciente ?>"><?php echo $paciente->nome ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('paciente_idpaciente', '<span class="text-danger">', '</span>'); ?>
            <?php } ?>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Médico</label>
            <select name="medico_idmedico" class="form-control">
                <option value="">Selecione</option>
                <?php foreach ($medicos as $medico) { ?>
                <option <?php if($medico->idmedico==$form['medico_idmedico']){ echo 'selected="true"';} ?>  value="<?php echo $medico->idmedico ?>"><?php echo $medico->nome ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('medico_idmedico', '<span class="text-danger">', '</span>'); ?>
        </div>
    </div>


    <div class="col-lg-3">
        <div class="form-group">
            <label>Data</label>
            <input name="data" type="date" value="<?php echo $form['data'] ?>" class="form-control">
            <?php echo form_error('data', '<span class="text-danger">', '</span>'); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Hora</label>
            <input name="hora" type="time" value="<?php echo $form['hora'] ?>" class="form-control">
            <?php echo form_error('hora', '<span class="text-danger">', '</span>'); ?>

        </div>
    </div>


</div>

<div class="col-lg-12">
    <div class="col-lg-12">
        <div class="form-group">
            <label>Queixa</label>
            <textarea name="queixa" rows="5" class="form-control"><?php echo $form['queixa'] ?></textarea>
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



