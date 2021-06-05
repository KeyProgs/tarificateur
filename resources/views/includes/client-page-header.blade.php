<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content hidden">
        <div class="page-title">
            <h4><i class="icon-user position-left"></i> <span class="text-semibold"></span>Espace client</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                            class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                            class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                            class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('home.client')}}"><i class="icon-home2 position-left"></i> Accueil</a></li>
            @if(!empty($page))
                <li class="active">{{$page}}</li>
            @endif
        </ul>

    </div>
</div>
<!-- /page header -->