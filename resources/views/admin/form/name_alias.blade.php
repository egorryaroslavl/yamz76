<div class="row">
    <div class="col-xs-6">
        <label for="name">Имя</label>
        <input
                type="text"
                name="name"
                class="form-control"
                id="name"
                value="{{$data->name}}"
                placeholder="Имя">
    </div>
    <div class="col-xs-6">
        <label for="alias">Алиас</label>
        <input
                type="text"
                name="alias"
                class="form-control"
                id="alias"
                value="{{$data->alias}}"
                placeholder="Алиас">
    </div>

</div>