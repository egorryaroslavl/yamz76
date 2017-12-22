<?php

?>
<div class="modal fade" id="makechangeform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button
                        type="button"
                        class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">
                    Пакетное изменение цен в категории [ {{$data->category->name}} ]</h4>
            </div>
            <div class="modal-body">
                <p style="font-weight:bold;padding: 10px ">Эта операция изменит цены всей продукции принадлежащей категории  [ {{$data->category->name}} ].<br>
                Отменить изменения будет нельзя!<br>
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <label for="todo">Как будем их менять?</label>
                        <select id="todo" name="todo" class="form-control m-b">
                            <option value="0">Выбрать действие</option>
                            <option value="up">Увеличить</option>
                            <option value="down">Уменьшить</option>
                            <option value="chislo">Задать значение</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label
                                for="percents"
                                class="font-bold"
                                style="display: none"
                                id="percents_label">На <span id="hm">1</span> %
                            <input
                                    type="number"
                                    step="1"
                                    max="1000"
                                    min="1"
                                    class="form-control percents"
                                    id="percents"
                                    value="1"
                                    name="percents">
                        </label>
                        <label
                                for="chislo"
                                class="font-bold"
                                style="display: none"
                                id="chislo_label"> Внести значение
                            <input
                                    type="text"
                                    class="form-control chislo"
                                    id="chislo"
                                    value=""
                                    name="chislo">
                        </label>
                    </div>
                </div>
                <input type="hidden" id="ids" name="ids" value="{{$data->ids}}">
                <input type="hidden" id="category_id" name="category_id" value="{{$data->category->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button
                        type="button"
                        name="go"
                        id="go-btn"
                        class="btn btn-primary">Готово</button>
            </div>
        </div>
    </div>
</div>