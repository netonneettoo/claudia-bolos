@section('styles')
    <link href="/assets/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@endsection

<div class="col-lg-4" style="position:relative;">
    <a id="remove_cake_image" class="btn btn-xs btn-danger" style="position:absolute;right:20px;top:6px;display:none;"><span class="glyphicon glyphicon-remove"></span></a>
    <img id="cake_image_preview" src="/assets/admin/img/no-image.jpg" alt="cake-request-image" class="img-thumbnail" />
    <input id="cake_image" name="cake_image" accept="image/*" type="file"/>
    <a href="" id="reset_input_file" class="btn btn-sm btn-danger" style="margin-top:20px;">Limpar</a>
    <a href="" id="select_input_file" class="btn btn-sm btn-primary" style="float:right;margin-top:20px;">Selecionar</a>
    <div style="clear:both;"><br/></div>
</div>
<div class="col-lg-8">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="delivery_timestamp">Data da Entrega:</label>
            <input id="delivery_timestamp" name="delivery_timestamp" class="form-control" type="text" />
        </div>
        <div class="form-group">
            <label for="client_name">Cliente:</label>
            <input id="client_name" name="client_name" class="form-control" type="text" value="{{$cakeRequest->client_name}}" />
        </div>
        <div class="form-group">
            <label for="client_phone">Telefone:</label>
            <input id="client_phone" name="client_phone" class="form-control" type="text" value="{{$cakeRequest->client_phone}}" />
        </div>
        <div class="form-group">
            <label for="client_mobile">Celular:</label>
            <input id="client_mobile" name="client_mobile" class="form-control" type="text" value="{{$cakeRequest->client_mobile}}" />
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control">
                <option value="opened" {{$cakeRequest->status == 'opened' ? 'selected' : ''}}>Aberto</option>
                <option value="closed" {{$cakeRequest->status == 'closed' ? 'selected' : ''}}>Fechado</option>
                <option value="cancelled" {{$cakeRequest->status == 'cancelled' ? 'selected' : ''}}>Cancelado</option>
                <option value="excluded" {{$cakeRequest->status == 'excluded' ? 'selected' : ''}}>Excluído</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estimated_price">Preço Estimado:</label>
            <input id="estimated_price" name="estimated_price" class="form-control" type="text" value="{{$cakeRequest->estimated_price}}" />
        </div>
        <div class="form-group">
            <label for="payment_value">Valor do Pagamento:</label>
            <input id="payment_value" name="payment_value" class="form-control" type="text" value="{{$cakeRequest->payment_value}}" />
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="note">Anotações:</label>
            <textarea id="note" name="note" class="form-control" rows="10">{{$cakeRequest->note}}</textarea>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group text-right">
            <input class="btn btn-primary" type="submit" value="Salvar"/>
        </div>
    </div>
</div>

@section('scripts')
    <!-- Data picker -->
    <script src="/assets/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="/assets/admin/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="/assets/admin/js/plugins/jquery-mask/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {

            var deliveryTimestamp = $('#delivery_timestamp');
            var cakeImageInput = $('#cake_image');
            var cakeImagePreview = $('#cake_image_preview');
            var removeCakeImage = $('#remove_cake_image');
            var cakeImageDefault = '/assets/admin/img/no-image.jpg';

            deliveryTimestamp.datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                autoclose: true,
                todayHighlight: true
            });

            $('#estimated_price').mask('00.000.000,00', {reverse: true, selectOnFocus: true});
            $('#payment_value').mask('00.000.000,00', {reverse: true, selectOnFocus: true});
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            $('#client_phone').mask(SPMaskBehavior, spOptions);
            $('#client_mobile').mask(SPMaskBehavior, spOptions);

            @if ($cakeRequest->id)
                deliveryTimestamp.datepicker('update', '{{$cakeRequest->getDeliveryTimestamp()}}');
                @if(strlen($cakeRequest->cake_image) > 32)
                    cakeImagePreview.attr('src', '{{$cakeRequest->cake_image}}');
                    removeCakeImage.show('slow');
                @endif
            @else
                @if ($request->get('day') != null)
                    deliveryTimestamp.datepicker('update', '{{$request->get('day')}}');
                @endif
            @endif

            cakeImageInput.change(function() {
                readInputFile(this);
            });

            function readInputFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        cakeImagePreview.attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    cakeImagePreview.attr('src', cakeImageDefault);
                }
                removeCakeImage.hide('fast');
            }

            $('#select_input_file').click(function(evt) {
                evt.preventDefault();
                cakeImageInput.click();
            });

            $('#reset_input_file').click(function(evt) {
                evt.preventDefault();
                removeCakeImage.hide('fast');
                cakeImageInput.val('');
                cakeImagePreview.attr('src', cakeImageDefault);
            });

            $('#remove_cake_image').click(function(evt) {
                evt.preventDefault();
                removeCakeImageAjax('{{$cakeRequest->id}}');
            });

            var removeCakeImageAjax = function(id) {
                $.post('/api/delete-cake-image', { '_token': '{{csrf_token()}}', 'id': id }, function(data) {
                    removeCakeImage.hide('fast');
                    cakeImagePreview.attr('src', cakeImageDefault);
                }, 'json').error(function(data) {
                    console.warn(data);
                });
            };
        });

    </script>

@endsection