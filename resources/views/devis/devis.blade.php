@extends('layouts.client')

@section('content')

    @php extract($data);@endphp
    <style>
        .w20 {
            width: 20%;
            text-align: center;
            size: 13px;
            font-weight: bold;
            padding: 30px;
        }

        .w40 {
            width: 40%;
            text-align: center;
            size: 13px;
            font-weight: bold;
            padding: 10px;
        }

        .w20 p {
            text-align: left;
        }

        .devistd {
            text-align: center;
            align-content: center;
            alignment: center;

        }

        .trline {
            font-size: initial;
        }

        .souscrire {
            left: 0px;
        }

        h1 {
            font-family: fantasy;
        }
    </style>


    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default p-20">
                    <a href="#" class="btn bg-indigo-300 legitRipple"><i class=" icon-phone position-left"></i>09.72.58.25.76
                    </a>
                    <h1></h1>

                    <br><br><br>
                    <table border=0 class="col-md-12 " style="margin-top: 10px;">
                        <tr class="bg-indigo-800">
                            <td class="w20 " colspan="2">

                                <div class="row panel content-group border-top-lg border-top-blue">
                                    <div class="col-md-6">

                                        <p><h5>Client</h5> <br></p>
                                        <p>Nom_ : {{$prospect->nom}} {{$prospect->prenom}} <br></p>
                                        <p>Régime : {{$prospect->regime->libelle}} <br></p>
                                        <p>Email : {{$prospect->email}} <br></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><h5>Conjoint</h5>  <br></p>
                                        <p>Nom : {{@$conjoint->nom}} {{@$conjoint->prenom}} <br></p>
                                        <p>Régime : {{$conjoint!=null ?$conjoint->regime->libelle:''}} <br></p>
                                        <p>Régime : . <br></p>
                                    </div>
                                    <div class="col-md-12"><p>NNombre d'enfants à charge
                                            : {{@sizeof($prospect->enfants())}}</p></div>
                                </div>

                                <div style="text-align: left;">
                                    <h4>
                                        Bonjour Mr {{$prospect->nom }} vous trouverais les détails de votre devis
                                        ci-dessous,
                                    </h4>

                                </div>
                            </td>
                            <td class="w20 "></td>
                            <td class="w20 "></td>
                            <td class="w20 ">
                                <div class="">
                                    <img src="/uploads/img/gammes/{{$gamme->nom}}.svg"/>
                                    <h2>{{$formule->nom}} <br></h2>
                                    <h6>{{$compagnie->nom}} {{$gamme->nom}}</h6>
                                </div>
                                <h6 class="bg-blue">{{$prix}} /mois</h6>
                                <div id="souscrire" class="souscrire">

                                    <a class="btn bg-blue legitRipple"
                                       href="/client-verification/f-{{$fiche->id}}/devis-{{$devis->id}}"><i
                                                class="icon-cart position-left"></i>
                                        Souscrire ..:: {{$prix}} €/mois ::..
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="w20" style="text-align: left; " valign="top">
                                <div>
                                    Les remboursements exprimés en pourcentage de la BRSS*
                                    incluent la prise en charge
                                    du Régime de Base. Les montants exprimés en euros interviennent en complément de
                                    l’éventuelle part du régime de base. Les forfaits intégrant une limite annuelle
                                    s’appliquent par bénéfi ciaire et par année d’adhésion, soit par période de 12
                                    (douze) mois successifs à compter de la date d’effet de la garantie ou des Renforts
                                    optionnels à l’exception des Équipements Optique pour lesquels la prestation est
                                    biennale. Les remboursements ne peuvent dépasser les frais restant à la charge du
                                    bénéfi ciaire des prestations. Les garanties du présent contrat s’inscrivent dans le
                                    cadre du dispositif législatif des contrats d’assurances visés à l’article L. 871-1
                                    du Code de la Sécurité sociale dits “contrats responsables”.
                                </div>
                            </td>
                            <td class="w20 devistd" colspan="3">

                                <table border="0" width="100%">
                                    <tr>
                                        <td class="w40">
                                            <img src="/uploads/img/gammes/{{$gamme->nom}}.svg"/>
                                            <br> <h5>{{$formule->nom}}</h5>
                                        </td>
                                        <td class="w40"><H5>Garanties</H5></td>
                                    </tr>
                                    @foreach($ArrayVolets as $key => $volet)
                                        <tr class="trline bg-green-700">
                                            <td colspan="2">
                                                {{$key}}
                                            </td>
                                        </tr>

                                        @foreach($volet as $Svolet)
                                            <tr>
                                                <td class="w40 bg-blue-800"><h6>{{$Svolet->valeur}}</h6></td>
                                                <td class="w40 bg-blue-600"><h6>{{$Svolet->garantie}}</h6></td>
                                            </tr>
                                        @endforeach

                                    @endforeach
                                </table>
                            </td>
                            <td class="w20">


                            </td>
                        </tr>
                    </table>


                </div>
                <!-- /page header -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 no-padding">

                    <!-- Footer - About -->
                    <div class="col-md-5 footer-widget">
                        <h6><span>Notre mission</span></h6>
                        <p style="text-align:justify;">Nous vous accompagnons dans le choix des garanties le plus
                            adaptées à votre situation, nous vous proposerons des tarifs atractifs sans rogner sur la
                            qualité des garanties et services. <br><br>Parce que le meilleur prix n’est pas toujours la
                            meilleure chose pour vous, nous choisissons ensemble le bon compromis en fonction de votre
                            situation.</p>

                    </div>
                    <div class="col-md-1 footer-widget">
                        &nbsp;
                    </div>


                    <!-- Footer - Flickrfeed -->
                    <div class="col-md-6 footer-widget">
                        <h6><span>Nos partenaires</span></h6>

                        <ul class="thumbs">

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/ADF.png" alt="">
                                </a>
                            </li>

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/ALPTIS.png" alt="">
                                </a>
                            </li>

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/APIVIAMUTUELLE.png" alt="">
                                </a>
                            </li>

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/ECA.png" alt="">
                                </a>
                            </li>

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/FFA.png" alt="">
                                </a>
                            </li>

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/NEOLIANE.png" alt="">
                                </a>
                            </li>

                            <li style="background-color: #E5E3E3;">
                                <a href="#">
                                    <img src="/images/CompagnieAssurances/SOLLYAZAR.png" alt="">
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>



@endsection



