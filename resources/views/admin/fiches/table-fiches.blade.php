<table id="fiches" class="table table-hover table-striped" style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Prospect</th>
        <th>Adresse</th>
        <th>Contact</th>
        <th>Etat</th>
        <!--<th class="hidden">Note</th>-->
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @if(!empty($fiches))
        @foreach($fiches as $fiche)
            <tr id="{{$fiche->id}}" class="data-tr">
                <td>
                    <input id="{{$fiche->id}}" type="checkbox" name="" class="fiche-checkbox">
                </td>
                <td>
                    @php
                      echo  '<b><a class="open-fiche-new-tab" data-href="' . url("fiche-details") . '/' . $fiche->id . '">' . strtoupper($fiche->personne->nom . ' ' . $fiche->personne->prenom) . '</a></b></br>' .
                               \Carbon\Carbon::parse($fiche->personne->date_naissance)->diff(\Carbon\Carbon::now())->format('%y ans');
                            if(!empty($fiche->personne->conjoint()[0])) {
                               echo  '</br>Conjoint : <b>' . $fiche->personne->conjoint()[0]->nom . ' ' . $fiche->personne->conjoint()[0]->prenom . '</b>';
                            }
                            if(!empty($fiche->personne->enfants()[0])) {
                               if(!empty($fiche->personne->conjoint()[0])) {
                                 echo '</br>Nbr d\'enfants : ' . (sizeof($fiche->personne->enfants()) + sizeof(\App\Personne::find($fiche->personne->conjoint()[0]->id)->enfants()));
                               } else {
                                 echo '</br>Nbr d\'enfants : ' . sizeof($fiche->personne->enfants());
                               }
                            }
                    @endphp
                </td>
                <td>
                    @php
                        echo $fiche->personne->details->ville . ' (' . $fiche->personne->details->code_postal . ')</br>' . $fiche->personne->details->adresse;
                    @endphp
                </td>
                <td>
                    @php
                        if(!empty($fiche->personne->details->email)) {
                           echo  ucfirst($fiche->personne->details->email) . '</br>';
                        }
                        if(!empty($fiche->personne->details->telephone_1)) {
                           echo  $fiche->personne->details->telephone_1 . '  <i title="Appeler" class="text-size-base cursor-pointer btn-rounded icon-phone2"></i></br>';
                        }
                        if(!empty($fiche->personne->details->telephone_2)) {
                           echo $fiche->personne->details->telephone_2 . '  <i title="Appeler" class="text-size-base cursor-pointer icon-phone2"></i></br>';
                        }
                        if(!empty($fiche->personne->details->telephone_3)) {
                           echo $fiche->personne->details->telephone_3 . '  <i title="Appeler" class="text-size-base cursor-pointer icon-phone2"></i></br>';
                        }
                    @endphp
                </td>
                <td>

                <td>
                    Ins??r?? le : {{$fiche->created_at->format('d/m/Y H:i') }}</br>Date d'effet
                    :  {{$fiche->simulation != null ?  date('d/m/Y', strtotime(str_replace('-', '/', $fiche->simulation->date_effet)) ) : \Carbon\Carbon::now()->tomorrow()->format('d/m/Y')}} </br>
                    @if(sizeof($fiche->piece_jointes)>0)
                        <b>{{sizeof($fiche->piece_jointes)}} pj</b><br>
                    @endif
                    <span class="text-bold text-success"> {{$fiche->etat->valeur}} </span>({{$fiche->user->nom}})
                </td>

                <td>
                    @php
                        echo '<ul class="icons-list">
                                  <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                          <i class="icon-menu9"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-menu-right">
                                         <!-- <li ><a class="fiche_historique" id="' . $fiche->id . '" ><i class="icon-history"></i> voir l\'historique</a>
                                          </li>-->
                                          <li><a href="' . url("fiche-details") . '/' . $fiche->id . '"><i class="icon-file-text2"></i> voir les details
                                              </a>
                                          </li>
                                      </ul>
                                  </li>
                              </ul>
                              <input type="hidden" id="fiche_id" class="fiche_id" value="' . $fiche->id . '">';
                    @endphp
                </td>
            </tr>
        @endforeach
    @else
        <tr class="data-tr">
            <td align="center" colspan="5">
                Aucun resultat
            </td>
        </tr>
    @endif
    </tbody>
</table>
@php
    //$fiches->withPath('fiches/etat/1')
@endphp
<div class="custom-pagination" align="center">
    {{ $fiches->onEachSide(1)->links() }}
</div>



