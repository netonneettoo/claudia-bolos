@section('styles')
    <link href="/assets/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@endsection

<div class="col-lg-4">
    <img id="cake_request_preview" src="/assets/admin/img/no-image.jpg" alt="cake-request-image" class="img-thumbnail" />
    <input id="cake_image" name="cake_image" accept="image/*" type="file"/>
    <a href="#" id="reset_input_file" class="btn btn-sm btn-danger" style="margin-top:20px;">Limpar</a>
    <a href="#" id="select_input_file" class="btn btn-sm btn-primary" style="float:right;margin-top:20px;">Selecionar</a>
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

    <script>
        $(document).ready(function() {
            $('#delivery_timestamp').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                autoclose: true,
                todayHighlight: true
            });

            $('#cake_image').change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#cake_request_preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#cake_request_preview').attr('src', '/assets/admin/img/no-image.jpg');
                }
            }

            $('#select_input_file').click(function(evt) {
                evt.preventDefault();
                $('#cake_image').click();
            });

            $('#reset_input_file').click(function(evt) {
                evt.preventDefault();
                $('#cake_image').val('');
                $('#cake_request_preview').attr('src', '/assets/admin/img/no-image.jpg');
            });
        });
    </script>

    @if($cakeRequest->id != null)
        <script>
            $(document).ready(function() {
                $('#delivery_timestamp').datepicker('update', '{{$cakeRequest->getDeliveryTimestamp()}}');
            });
        </script>
    @endif
@endsection