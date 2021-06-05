@php
    //$sous_volet_columun = "gamme_id";
    //$sous_volet_columun_value = 4;

    $sous_volets_ids = \App\Sous_volet::where($sous_volet_columun,$sous_volet_columun_value)->pluck('id')->toArray();
    $volets_ids = \App\Sous_volet::where($sous_volet_columun,$sous_volet_columun_value)->pluck('volet_id')->toArray();
    $volets  = \App\Volet::whereIn('id',$volets_ids)->get();
@endphp
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">
                </h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>


            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($volets as $volet)
                    <tr>
                        <td>{{$volet->valeur}}</td>
                        <td>{{$volet->description}}</td>
                    </tr>
                    @foreach($volet->sousVolets as $sousVolet)
                        @if(in_array($sousVolet->id,$sous_volets_ids))
                        <tr>
                            <td> ------------ {{$sousVolet->valeur}} </td>
                            <td> ------------- {{$sousVolet->description}}</td>
                        </tr>
                        @endif
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>