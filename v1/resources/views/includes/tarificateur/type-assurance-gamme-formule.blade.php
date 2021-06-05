@php
    if (in_array($type_assurance->id, $user_types_assurance_array)) {
        echo '<ul>';
        $gammes = $type_assurance->gammes;
        $gammesIds = $type_assurance->gammesIds();


        if (sizeof($gammesIds) > 0) {
            $g = new \App\Gamme();
            $compagnies = $g->compagnies($gammesIds);
            foreach ($compagnies as $compagniee) {
                //dd($compagnie->compagnie_id);
                echo '<li>' . $compagniee->nom;

                $gammmes = \App\Gamme::where('compagnie_id', '=', $compagniee->compagnie_id)
                    ->where('type_assurance_id','=',$type_assurance->id)
                    ->get();
                //dd($gammmes);
                if (sizeof($gammmes) > 0) {
                    echo '<ul>';
                }
                foreach ($gammmes as $gamme) {
                    //var_dump($gamme);
                    // var_dump ($fiche->isInGamme($gamme->id));
                    // echo $gamme->id ;
                    if ($fiche->isInGamme($gamme->id) == 1) {
                        $formules = \App\Formule::where('gamme_id', '=', $gamme->id)->get();

                        if (sizeof($formules) > 0) {
                            echo '<li>' . $gamme->nom;
                            echo '<ul>';
                        }
                        foreach ($formules as $formule) {
                            echo '<li data-value="' . $formule->id . '">' . $formule->nom . '</li>';
                            $formulesIds[] = $formule->id;
                        }
                        if (sizeof($formules) > 0) {
                            echo '</ul>';
                            echo '</li>';
                        }
                    } else {
                        echo '<li>' . $gamme->nom . "  /  " . $fiche->isInGamme($gamme->id) . " </li>";
                    }
                }
                if (sizeof($gammmes) > 0) {
                    echo '</ul>';
                }
                echo '</li>';
            }
        }
        echo '</ul>';
    } else {
        echo "<br><span class='p-10 text-size-large'>vous n'êtes pas autorisé à cette option</span><br><br>";
    }
@endphp

<script>

    $('.treeview').treeview({
        debug: true,
        data: {{ json_encode($formulesIds) }},
    });
</script>