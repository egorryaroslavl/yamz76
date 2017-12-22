<div class="row">
    <div class="col-xs-6">
        <label for="name">Имя</label>
        <input
                type="text"
                name="name"
                class="form-control"
                id="name"
                value="<?php if( isset( $data->name ) )$data->name ?>"
                placeholder="Имя">
    </div>
    <div class="col-xs-6">
        <label for="alias">Алиас</label>
        <input
                type="text"
                name="alias"
                class="form-control"
                id="alias"
                value="<?php if( isset( $data->alias ) )$data->alias ?>"
                placeholder="Алиас">
    </div>

</div>