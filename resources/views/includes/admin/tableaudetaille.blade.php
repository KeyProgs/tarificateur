<div class="row">
    <div class="col-md-12">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Tableau de bord</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse" ></a></li>
                    </ul>
                </div>
            </div>


            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th rowspan="2">Fournisseur</th>
                    <th colspan="3">Fiches</th>
                    <th colspan="3">Contrats</th>
                    <th colspan="3">Chiffre d'affaire</th>
                    <th colspan="2">Ratios</th>
                </tr>
                <tr>
                    <th>Total</th>
                    <th>Mauvaise</th>
                    <th>Net</th>

                    <th>Total</th>
                    <th>Chute</th>
                    <th>Net</th>

                    <th>Total</th>
                    <th>Chute</th>
                    <th>Net</th>

                    <th>Brute</th>
                    <th>Net</th>

                </tr>
                </thead>
                <tbody>

                @foreach($provenancesData as $provenanceData)
                    <tr>
                        <td> {{$provenanceData['nom']}} </td>
                        <td> {{$provenanceData['countFiches']}} </td>
                        <td> {{$provenanceData['countFichesMauvaise']}}</td>
                        <td> {{$provenanceData['countFiches'] - $provenanceData['countFichesMauvaise']}} </td>
                        <td> {{$provenanceData['countDevis']}}</td>
                        <td> {{$provenanceData['countDevisChute'] }}</td>
                        <td> {{$provenanceData['countDevis'] - $data['countDevisChute'] }}</td>
                        <td>{{number_format($provenanceData['chiffreAffaireDevis'],2)}}€</td>
                        <td>{{number_format($provenanceData['chiffreAffaireDevisChute'],2)}}€</td>
                        <td>{{number_format($provenanceData['chiffreAffaireDevis']-$provenanceData['chiffreAffaireDevisChute'],2) }}
                            €
                        </td>
                        <td> {{number_format($provenanceData['brute'],2)}}%</td>
                        <td> {{number_format($provenanceData['net'],2)}}%</td>

                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
        <!-- / Basic datatable -->



    </div>
    <!-- /content area -->
</div>
