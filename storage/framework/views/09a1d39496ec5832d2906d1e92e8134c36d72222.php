<div class="row">
    <div class="col-xs-5">
        <label for="name">Имя* <small>( max 255 символов )</small></label>
        <input
                type="text"
                name="name"
                class="form-control"
                id="name"
                value="<?php echo e($data->name); ?>"
                placeholder="Имя">
    </div>
    <div class="col-xs-5">
        <label for="alias">Алиас* <small>( max 255 символов )</small></label>
        <input
                type="text"
                name="alias"
                class="form-control"
                id="alias"
                value="<?php echo e($data->alias); ?>"
                placeholder="Алиас">
    </div>
    <div class="col-xs-2">
        <label for="alias">Articul</label>
        <input
                type="text"
                name="articul"
                class="form-control"
                id="articul"
                value="<?php echo e($data->articul); ?>"
                placeholder="articul">
    </div>
</div>