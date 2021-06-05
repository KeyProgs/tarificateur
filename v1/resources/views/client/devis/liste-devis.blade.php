@extends('client.layouts.client')

@section('content')
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.client.client-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                @include('includes.client-page-header',['page'=>'Liste devis'])
                <!-- /page header -->

                <!-- Content area -->
                <div class="content ">
                    <div class="col-md-12">
                        @foreach($liste_devis as $devis)
                            <div class="col-md-3">
                                <table class="col-md-12" border="0" cellpadding="0" cellspacing="0" align="right" bgcolor="#ffffff" style="border: 1px solid slategray; background-color: #ffffff;">
                                    <tbody>
                                    <tr>
                                        <td width="100%" valign="top">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                <tbody>
                                                <tr>
                                                    <td height="15">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"
                                                        style="text-transform:uppercase !important;font-weight : bold;color: #444444; font-size: 17px; line-height: 26px; padding: 0 5px;">
                                                        {{$devis->formule->nom}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="15">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="100" height="1" bgcolor="#e9e9e9"
                                                        style="font-size: 1px; line-height: 1px;">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="20">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" height="24"
                                                        style="color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
                                                        <span style="font-size: 18px; position: relative; bottom: 12px;">€ </span>
                                                        {{$devis->cotisation}}
                                                        <span style="font-size: 14px; color: #808080; font-style: italic;"> / mois</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"
                                                        style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                        <img style="width: 120px;height: 100px"
                                                             src="{{asset('uploads/img/gammes/'.$devis->formule->gamme->nom)}}.png">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"
                                                        style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                        {{$devis->formule->gamme->compagnie->nom}}
                                                        - {{$devis->formule->gamme->nom}}

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10">
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td width="auto" align="center">
                                                        <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tbody>
                                                            <tr>
                                                                <td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                                    <a href="{{url('/espace-client/verification/f-'.$devis->simulation->fiche->id.'/devis-'.$devis->id.'/'.$devis->formule->id.' ')}}"
                                                                       style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">
                                                                        voir les details
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="30">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                <!-- Footer -->
                @include('includes.footer')
                <!-- /footer -->
                </div>
               <!-- /Content area -->
           </div>
        <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
@endsection