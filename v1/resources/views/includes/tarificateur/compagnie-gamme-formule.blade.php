@php
    $compagnies = \App\Compagnie::all();
@endphp
<div style="float: left">
    <select name="compagnie_id" id="compagnie_id" style="height: 25px">
        <option selected value="" disabled> -- Choisir la compagnie --</option>
        <option  value="111"> -- Autre --</option>
        @foreach($compagnies as $compagnie)
            <option value="{{$compagnie->id}}">{{$compagnie->nom}}</option>
        @endforeach
    </select>
</div>

&nbsp;&nbsp;
<div style="float: left">
    <select name="gamme_id" id="gamme_id" style="height: 25px">
        <option selected value=""> -- Choisir la gamme --</option>
        <option  value="111"> -- Autre --</option>

    </select>
</div>

&nbsp;&nbsp;
<div style="float: left">
    <select name="formule_id" id="formule_id" style="height: 25px">
        <option selected value=""> -- Choisir la formule --</option>
        <option  value="111"> -- Autre --</option>

    </select>
    <br>
    <span class="text-danger error-msg" id="error_formule_id">
        <strong class="text-danger"></strong>
    </span>
</div>
&nbsp;&nbsp;
<div style="float: left">
    <input type="text" name="cotisation" placeholder="Cotisation" style="height: 25px;">
    <br>
    <span class="text-danger error-msg" id="error_cotisation">
      <strong class="text-danger"></strong>
    </span>
</div>



