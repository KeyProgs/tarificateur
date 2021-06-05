@foreach($fiches as $fiche)
    <tr id="{{$fiche->id}}" class="data-tr">
        <td>
            @php
                echo '<b><a class="open-fiche-new-tab" data-href="' . url("fiche-details") . '/' . $fiche->id . '">' . strtoupper($fiche->personne->nom . ' ' . $fiche->personne->prenom) . '</a></b></br>' .
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
                   echo  $fiche->personne->details->telephone_1 . '  <a href="callto:'. $fiche->personne->details->telephone_1 . '"><i title="Appeler" class="text-size-base cursor-pointer btn-rounded icon-phone2"></i></a></br>';
                }
                if(!empty($fiche->personne->details->telephone_2)) {
                   echo $fiche->personne->details->telephone_2 . '  <a href="callto:'. $fiche->personne->details->telephone_1 . '<i title="Appeler" class="text-size-base cursor-pointer icon-phone2"></i></a></br>';
                }
                if(!empty($fiche->personne->details->telephone_3)) {
                   echo $fiche->personne->details->telephone_3 . '  <a href="callto:'. $fiche->personne->details->telephone_1 . '<i title="Appeler" class="text-size-base cursor-pointer icon-phone2"></i></a></br>';
                }
            @endphp
        </td>
        <td>
            @php
                if(!empty($fiche->simulation)){
                   echo  'Inséré le : '.$fiche->created_at->format('d/m/Y H:i') . '</br>' . 'Date d\'effet : ' . date('d/m/Y', strtotime(str_replace('-', '/', $fiche->simulation))) . '</br><span class="text-bold text-success">' . $fiche->etat->valeur . '</span>';
                }else{
                   echo 'Inséré le : '.$fiche->created_at->format('d/m/Y H:i') . '</br>' . 'Date d\'effet : ' .   \Carbon\Carbon::now()->tomorrow()->format('d/m/Y')  . '</br><span class="text-bold text-success">' . $fiche->etat->valeur . ' - </span>('.$fiche->user->nom.')';
                }
            @endphp
        </td>
        <td>@php
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





