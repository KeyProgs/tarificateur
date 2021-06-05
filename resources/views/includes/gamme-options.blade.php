@php
    if (!isset($gamme_id_options)){
        $gamme_id_options = null;
    }
    //@include('includes.gamme-options',['gamme_id_options' => "3"])
    $gamme = \App\Gamme::find($gamme_id_options);
    $options = $gamme->options;
@endphp
<div class="row">
    <div class="col-md-4">
        <input type="text" value="" name="total_prix" id="total_prix">
        <div class="form-group">
            @foreach($options as $option)
                <input type="checkbox" name="options[]" class="checked-option"
                       value="{{$option->id}}" data-prix="{{$option->prix}}">
                <label class="text-custom-grey text-bold"><b>{{$option->nom}}</b>&nbsp;</label>
                &nbsp;&nbsp;(Prix : {{number_format($option->prix,2)}})<br>
            @endforeach
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".checked-option").change(function () {
            //if(this.checked) {
            getChecked();
            //}
        });

        function getChecked() {
            var options = [];
            var total = 0;
            $.each($("input[name='options[]']:checked"), function () {
                options.push($(this).val());
                total += parseFloat($(this).attr('data-prix'));
            });
            //alert("My options ids are: " + options.join(","));
            $("#total_prix").val(total);
        }
    })
</script>