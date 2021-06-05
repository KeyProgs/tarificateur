@if($enfants)
    @foreach($enfants as $enfant)
        @php
            {{
            global $count_enfants;
            $count_enfants++;
            }}
        @endphp
        <tr id="tr_enfant_{{$count_enfants}}">
            <td>
                <input type="text" name="nom_en_{{ $count_enfants}}" id="nom_en_{{ $count_enfants}}"
                       class="mt-m15 form-control" value="{{$enfant->nom }}">
                <span class="text-danger error-msg" id="error_nom_en_{{ $count_enfants}}">
                       <strong class="text-danger"></strong>
                </span>
            </td>
            <td>
                <input type="text" name="prenom_en_{{ $count_enfants}}" id="prenom_en_{{ $count_enfants}}"
                       class="mt-m15 form-control" value="{{$enfant->prenom}}">
                <span class="text-danger error-msg" id="error_prenom_en_{{ $count_enfants}}">
                       <strong class="text-danger"></strong>
                </span>
            </td>
            <td>

                <select name="sexe_en_{{ $count_enfants}}" id="sexe_en_{{ $count_enfants}}"
                        class="mt-m15 form-control form-control-sm ">
                    <option value=""></option>
                    <option @if($enfant->civilite_id == 1) selected @endif value="M">Masculin</option>
                    <option @if($enfant->civilite_id == 2) selected @endif value="F">Féminin</option>
                </select>
                <span class="text-danger error-msg" id="error_sexe_en_{{ $count_enfants}}">
                      <strong class="text-danger"></strong>
                </span>
            </td>
            <td>
                <input type="text" name="date_naissance_en_{{ $count_enfants}}"
                       id="date_naissance_en_{{ $count_enfants}}" class="date-picker mt-m15 form-control"
                       value="{{\App\Helpers\Helper::getDateFormat($enfant->date_naissance)}}">
                <span class="text-danger error-msg" id="error_date_naissance_en_{{ $count_enfants}}">
                    <strong class="text-danger"></strong>
                </span>
            </td>
            <td>
                <select name="ayant_droit_en_{{ $count_enfants}}" id="ayant_droit_en_{{ $count_enfants}}"
                        class="mt-m15 form-control form-control-sm ayant-droit-en">
                    <option value=""></option>
                    <option @if($enfant->ayant_droit=="prospect") selected @endif value="Prospect">Prospect
                    </option>

                    <option @if($enfant->ayant_droit=="conjoint") selected @endif value="Conjoint">Conjoint
                    </option>


                </select>
                <span class="text-danger error-msg" id="error_ayant_droit_en_{{ $count_enfants}}">
                    <strong class="text-danger"></strong>
                </span>
            </td>
            <td>
                <input type="text" data-mask="9-99-99-99-999-999-99"
                       name="numero_securite_social_en_{{ $count_enfants}}"
                       id="numero_securite_social_en_{{ $count_enfants}}" class="mt-m15 form-control"
                       value="{{$enfant->numero_securite_sociale}}">
                <span class="text-danger error-msg" id="error_numero_securite_social_en_{{ $count_enfants}}">
                    <strong class="text-danger"></strong>
                </span>
            </td>
            <td class="p0" align="center">
                <a href="javascript:void(0)" title="Supprimer" id="{{ $count_enfants}}"
                   data-enfant-id="{{$enfant->id}}" class="remove_enfant existe btn btn-link"><i
                            class="icon-user-minus"></i>
                    <input type="hidden" name="id_en_{{$count_enfants}}" id="id_en_{{$count_enfants}}"
                           value="{{$enfant->id}}">
                    <input type="hidden" name="relation_en_{{$count_enfants}}" id="relation_en_{{$count_enfants}}"
                           value="{{$enfant->id_relation}}">
                </a>
            </td>
        </tr>

    @endforeach
@endif