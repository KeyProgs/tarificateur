<div class="row">
    <div class="col-md-12">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Historique</h5>
                <div class="input-group col-md-12">
                    <div class="input-group col-md-4">
                        <form id="form_search" action="{{url('/tableau-bord')}}" method="GET">
                            <input type="date"
                                   id="search-text" name="date" class="form-control" placeholder="Rechercher">
                            <span class="input-group-btn">
                            <button onclick="document.getElementById('form_search').submit()" id="search-btn" class="btn btn-primary btn-sm rounded0 legitRipple"
                                            type="button">
                                        Chercher
                            </button>
						</span>
                        </form>
                    </div>
                </div>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>


            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="10%">User</th>
                    <th width="10%">Fiche</th>
                    <th width="15%">Action</th>
                    <th width="40%">Description</th>
                    <th width="15%">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($historique as $hist)
                    @php
                        $fiche=\App\Fiche::find($hist->fiche_id)
                    @endphp
                    <tr>
                        <td> {{$hist->id}}</td>
                        <td> {{$hist->user->nom." ".$hist->user->prenom}} </td>
                        <td>
                            @if($hist->fiche_id != null)
                                <a target="_blank" href="{{url('/fiche-details')."/".$hist->fiche_id}}">{{$fiche->personne->prenom." ".$fiche->personne->nom}}</a>
                            @endif

                        </td>
                        <td> {{$hist->action->action}} </td>
                        <td> {{$hist->description}}</td>
                        <td> {{$hist->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    {{ $historique->links() }}
    <!-- / Basic datatable -->
        <div class="col-md-12">
        </div>
        <!-- Footer -->
    @include('includes.footer')
    <!-- /footer -->

    </div>
    <!-- /content area -->
</div>
