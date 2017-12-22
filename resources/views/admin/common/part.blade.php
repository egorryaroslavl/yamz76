<div class="row">
    <div class="col-xs-4">
        <label for="parta">Часть </label>
        <input
                type="text"
                name="parta"
                class="form-control"
                id="parta"
                value="{{ old('parta') }}"
                placeholder="Часть A">
    </div>
    <div class="col-xs-4">
        <label for="partb">Часть B*</label>
        <select
                type="text"
                name="partb"
                class="form-control"
                id="partb"
                value="{{ old('partb') }}"
                placeholder="Часть B">
	        <option value="0">Выбрать</option>
	        <option value="a">A</option>
	        <option value="b">B</option>
	        <option value="c">C</option>
        </select>
    </div>
    <div class="col-xs-4">
        <label for="partc">Часть C*</label>
        <input
                type="button"
                name="partc"
                class="form-control"
                id="partc"
                value="OK"
                 >
    </div>
</div>