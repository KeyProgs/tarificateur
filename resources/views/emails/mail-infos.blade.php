@extends('layouts.utilisateur')

@section('content')
    <script src="{{asset('/global-assets/js/demo_pages/mail_list_read.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.utilisateur-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default">


                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"
                                                                       style="font-size: 15px;"></i> Accueil
                                </a>
                            </li>
                            <li class="active">Email Details</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li>
                                <input type="search" class="form-control" placeholder="N° Télephone">
                            </li>
                            <li>
                                <a href="#" style="     "><i class="icon-phone2 position-left"></i>Appeler</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   style="color: #065809; font-weight: bold;">
                                    <i class="icon-alarm position-left"></i> Rappels <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{url('/fiches/etat/21/-1')}}">
                                            <span><span class="badge bg-teal-400 pull-right"></span> </span>
                                            Rappels en retard
                                        </a>
                                    </li>
                                    <li><a href="{{url('/fiches/etat/21/0')}}">
                                            <span><span class="badge bg-teal-400 pull-right"></span> </span>
                                            Rapples
                                            du jour</a></li>
                                    <li><a href="{{url('/fiches/etat/21/1')}}">
                                            <span><span class="badge bg-teal-400 pull-right"></span> </span>
                                            Rappeles programmés</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{url('/fiches/etat/21')}}">
                                            Tout Les Rappels</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">

                            <!-- Single mail -->
                            <div class="panel panel-white">

                                <!-- Mail toolbar -->
                                <div class="panel-toolbar panel-toolbar-inbox">
                                    <div class="navbar navbar-default">
                                        <ul class="nav navbar-nav visible-xs-block no-border">
                                            <li>
                                                <a class="text-center collapsed" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
                                                    <i class="icon-circle-down2"></i>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                                            <div class="btn-group navbar-btn">
                                                <a href="mail_write.html" class="btn btn-default"><i class="icon-reply"></i> <span class="hidden-xs position-right">Répondre</span></a>
                                                <a href="mail_write.html" class="btn btn-default"><i class="icon-reply-all"></i> <span class="hidden-xs position-right">Répondre à tous</span></a>
                                                <a href="mail_write.html" class="btn btn-default"><i class="icon-forward"></i> <span class="hidden-xs position-right">Vers l'avant</span></a>
                                                <a href="#" class="btn btn-default"><i class="icon-bin"></i> <span class="hidden-xs position-right">Supprimer</span></a>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu7"></i>
                                                        <span class="caret"></span>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#">Action</a></li>
                                                        <li><a href="#">Another action</a></li>
                                                        <li><a href="#">Something else here</a></li>
                                                        <li><a href="#">One more line</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!--<div class="pull-right-lg">
                                                <p class="navbar-text">12:49 pm</p>
                                                <div class="btn-group navbar-btn">
                                                    <a href="#" class="btn btn-default"><i class="icon-printer"></i> <span class="hidden-xs position-right">Print</span></a>
                                                    <a href="#" class="btn btn-default"><i class="icon-new-tab2"></i> <span class="hidden-xs position-right">Share</span></a>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                                <!-- /mail toolbar -->


                                <!-- Mail details -->
                                <div class="media stack-media-on-mobile mail-details-read">
                                    <a href="#" class="media-left">
										<span class="btn bg-teal-400 btn-rounded btn-icon btn-xlg">
											<span class="letter-icon"></span>
										</span>
                                    </a>

                                    <div class="media-body">
                                        <h6 class="media-heading">Message objet</h6>
                                        <div class="letter-icon-title text-semibold">Emetteur UserName<a href="#">&lt;emetteur@emetteur.com&gt;</a></div>
                                    </div>

                                    <!--<div class="media-right media-middle text-nowrap">
                                        <ul class="list-inline list-inline-condensed no-margin">
                                            <li><a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-circle img-xs" alt=""></a></li>
                                            <li><a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-circle img-xs" alt=""></a></li>
                                            <li><a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-circle img-xs" alt=""></a></li>
                                            <li><span class="btn bg-teal-400 btn-xs">+26</span></li>
                                        </ul>
                                    </div>-->
                                </div>
                                <!-- /mail details -->


                                <!-- Mail container -->
                                <div class="mail-container-read">

                                    <!-- Email sample (demo) -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tr>
                                            <td>

                                                <!-- Hero -->
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tr>
                                                        <td align="center" bgcolor="#f67b7c" style="background-image: url('http://demo.interface.club/limitless/assets/images/bg.png'); background-repeat: repeat;">
                                                            <table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                <tr>
                                                                    <td width="100%" height="15"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">

                                                                        <!-- Nav -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td width="100%" valign="middle">

                                                                                    <!-- Logo -->
                                                                                    <table width="280" border="0" cellpadding="0" cellspacing="0" align="left">
                                                                                        <tr>
                                                                                            <td height="60" valign="middle" width="100%" align="left">
                                                                                                <a href="#"><img width="125" src="../../../../global_assets/images/logo_light.png" alt=""></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /logo -->


                                                                                    <!-- View Online -->
                                                                                    <table width="280" border="0" cellpadding="0" cellspacing="0" align="right">
                                                                                        <tr>
                                                                                            <td height="60" valign="middle" width="100%" align="right">
                                                                                                <a href="#" style="color: #ffffff;">Check the online version</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /view Online -->

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%" height="30"></td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /nav -->


                                                                        <!-- Title -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td valign="middle" align="center" style="font-size: 40px; color: #ffffff; line-height: 50px; font-weight: 300;">
                                                                                    We Create <span style="font-weight: 400;">Magic.</span>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /title -->


                                                                        <!-- Subtitle -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td width="100%" height="30"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td valign="middle" width="100%">
                                                                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                        <tr>
                                                                                            <td width="30"></td>
                                                                                            <td width="540" align="center" style="font-size: 14px; color: #ffffff; line-height: 24px;">
                                                                                                This is a demo of email template, please do not use it as a fully functional template. Sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                                            </td>
                                                                                            <td width="30"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /subtitle -->


                                                                        <!-- Button -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td height="40"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="auto" align="center">
                                                                                    <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                        <tr>
                                                                                            <td width="auto" align="center" height="40" bgcolor="#344b61" style="border-radius: 20px; padding-left: 40px; padding-right: 40px; font-weight: 500;">
                                                                                                <a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 34px;">More Information..</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /button -->

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="50"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- /hero -->


                                                <!-- We have a Great Workspace -->
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tr>
                                                        <td width="100%" valign="top" bgcolor="#ffffff" align="center">
                                                            <table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                <tr>
                                                                    <td width="100%" height="50"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">

                                                                        <!-- Post -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td width="100%" align="center">
                                                                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
                                                                                        <tr>
                                                                                            <td width="100%">
                                                                                                <a href="#">
                                                                                                    <img src="../../../../global_assets/images/placeholders/cover.jpg" alt="" border="0" width="600" height="auto" style="border-radius: 4px;">
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%" height="25"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="35" width="100%" align="center" style="font-size: 24px; color: #444444; line-height: 32px; font-weight: 500;">
                                                                                                We have a Great Workspace
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%" height="15"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td valign="middle" width="100%" align="center" style="font-size: 14px; color: #808080; line-height: 22px;">
                                                                                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%" height="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="auto" align="center">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                                    <tr>
                                                                                                        <td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px;">
                                                                                                            <a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; font-weight: 500; line-height: 32px; width: 100%;">Read more</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /post -->

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="50"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- /we have a Great Workspace -->


                                                <!-- The Best Prices for You -->
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tr>
                                                        <td width="100%" height="1" bgcolor="#dddddd" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" width="100%" valign="top" bgcolor="#fafafa" style="background-color: #fafafa;">
                                                            <table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                <tr>
                                                                    <td width="100%" height="50"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">

                                                                        <!-- Header -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                        <tr>
                                                                                            <td align="center" valign="middle" style="font-size: 24px; color: #444444; line-height: 32px; font-weight: 500;">
                                                                                                The Best Prices for You
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%" height="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%">
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                                    <tr>
                                                                                                        <td height="1" bgcolor="#f67b7c" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%" height="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle" width="100%" style="font-size: 14px; color: #808080; line-height: 22px; font-weight: 400;">
                                                                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore...
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="100%" height="30"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /header -->


                                                                        <!-- Prices -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td width="100%" valign="top" align="center">

                                                                                    <!-- Basic license -->
                                                                                    <table width="290" border="0" cellpadding="0" cellspacing="0" align="left" bgcolor="#ffffff" style="border: 1px solid #dddddd; background-color: #ffffff;">
                                                                                        <tr>
                                                                                            <td width="290" valign="top" align="center">
                                                                                                <table width="294" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                                    <tr>
                                                                                                        <td height="15">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" style="color: #444444; font-size: 17px; line-height: 24px; padding: 0px 5px; font-weight: 500;">
                                                                                                            Regular License
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td width="100" height="1" bgcolor="#e9e9e9" tyle="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px; font-weight: 400;">
                                                                                                            Non-Responsive layout
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="text-align: center; color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                                                            Builder excluded
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="text-align: center; color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                                                            Instant Access
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="25">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="24" style="text-align: center; color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
                                                                                                            <span style="font-size: 18px; position: relative; bottom: 12px;">$ </span>49<span style="font-size: 14px; color: #808080; font-style: italic;"> / month</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="25">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td width="auto" align="center">
                                                                                                            <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                                                <tr>
                                                                                                                    <td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                                                                                        <a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Sign Up</a>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="30">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /basic license -->


                                                                                    <!-- Space -->
                                                                                    <table width="1" border="0" cellpadding="0" cellspacing="0" align="left">
                                                                                        <tr>
                                                                                            <td width="100%" height="30"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /space -->


                                                                                    <!-- OEM license -->
                                                                                    <table width="290" border="0" cellpadding="0" cellspacing="0" align="right" bgcolor="#ffffff" style="border: 1px solid #dddddd; background-color: #ffffff;">
                                                                                        <tr>
                                                                                            <td width="294" valign="top">
                                                                                                <table width="290" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                                    <tr>
                                                                                                        <td height="15">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" style="color: #444444; font-size: 17px; line-height: 26px; padding: 0px 5px; font-weight: 500;">
                                                                                                            OEM License
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="15">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td width="100" height="1" bgcolor="#e9e9e9" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="20">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                                                            Responsive layout
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                                                            Builder included
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="10">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                                                            Instant Access
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="25">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="center" height="24" style="color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
                                                                                                            <span style="font-size: 18px; position: relative; bottom: 12px;">$ </span>80<span style="font-size: 14px; color: #808080; font-style: italic;"> / month</span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="25">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td width="auto" align="center">
                                                                                                            <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                                                <tr>
                                                                                                                    <td width="auto" align="center" height="38" bgcolor="#fa6f6f" style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                                                                                        <a href="#" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Sign Up</a>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="30">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /OEM license -->

                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /prices -->

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="60"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- /the Best Prices for You -->


                                                <!-- Let our Clients Convince you -->
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tr>
                                                        <td align="center" width="100%" valign="top" bgcolor="#4f97e2" style="background-image: url('http://demo.interface.club/limitless/assets/images/bg.png'); background-color: #4f97e2; background-repeat: repeat;">
                                                            <table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                <tr>
                                                                    <td width="100%" height="50"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">

                                                                        <!-- Header -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td valign="middle" align="center" width="100%" style="font-size: 24px; color: #ffffff; line-height: 32px; font-weight: 500;">
                                                                                    Let our Clients Convince you
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%" height="30"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%">
                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                                        <tr>
                                                                                            <td width="100" height="1" bgcolor="#ffffff" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%" height="30"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" valign="middle" width="100%" style="font-size: 14px; color: #ffffff; line-height: 22px;">
                                                                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt <b>mollit anim id est laborum</b>. Sed ut perspiciatis unde omnis iste...
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="100%" height="30"></td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /header -->


                                                                        <!-- Testimonials -->
                                                                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                            <tr>
                                                                                <td width="100%">

                                                                                    <!-- Left table -->
                                                                                    <table width="275" border="0" cellpadding="0" cellspacing="0" align="left" bgcolor="#ffffff" style="border-radius: 4px;">
                                                                                        <tr>
                                                                                            <td width="100%" align="center">
                                                                                                <a href="#">
                                                                                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" alt="" border="0" width="83" height="auto" style="border-radius: 100px;">
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td valign="middle" align="center" style="font-size: 14px; color: #ffffff; line-height: 22px;">
                                                                                                Excepteur sint occaecat cupidatat non proident id est laborum.
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="20"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" style="font-size: 15px; color: #ffffff; line-height: 22px;">
                                                                                                <span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: #fff;">Cris Costo</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /left table -->


                                                                                    <!-- Space -->
                                                                                    <table width="1" border="0" cellpadding="0" cellspacing="0" align="left">
                                                                                        <tr>
                                                                                            <td width="100%" height="40"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /space -->


                                                                                    <!-- Right table -->
                                                                                    <table width="275" border="0" cellpadding="0" cellspacing="0" align="right" style="border-radius: 4px;" bgcolor="#ffffff">
                                                                                        <tr>
                                                                                            <td width="100%" align="center">
                                                                                                <a href="#">
                                                                                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" alt="" border="0" width="83" height="auto" style="border-radius: 100px;">
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td valign="middle" align="center" style="font-size: 14px; color: #ffffff; line-height: 22px;">
                                                                                                Sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="20"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" style="font-size: 15px; line-height: 22px;">
                                                                                                <span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: #ffffff;">Jason Kenny</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <!-- /right table -->

                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- /testimonials -->

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100%" height="50"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- /let our Clients Convince you -->


                                                <!-- Footer -->
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tr>
                                                        <td align="center" width="100%" valign="top" bgcolor="#344b61">

                                                            <!-- Wrapper -->
                                                            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                <tr>
                                                                    <td width="100%" height="40" align="center" valign="middle" style="font-size: 12px; color: #aebecd;">
                                                                        <a href="#" style="color: #ffffff;">Unsubscribe</a>

                                                                        <span style="color: #ffffff;">&nbsp;/&nbsp;</span>

                                                                        <a href="#" style="color: #ffffff;">Send to a friend</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <!-- /wrapper -->

                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- /footer -->

                                            </td>
                                        </tr>
                                    </table>
                                    <!-- /email sample (demo) -->

                                </div>
                                <!-- /mail container -->


                                <!-- Attachments -->
                                <div class="mail-attachments-container">
                                    <h6 class="mail-attachments-heading">2 Pièces jointes</h6>

                                    <ul class="mail-attachments">
                                        <li>
											<span class="mail-attachments-preview">
												<i class="icon-file-pdf icon-2x"></i>
											</span>

                                            <div class="mail-attachments-content">
                                                <span class="text-semibold">file1.pdf</span>

                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li class="text-muted">174 KB</li>
                                                    <li><a href="#">Afficher</a></li>
                                                    <li><a href="#">Telecharger</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
											<span class="mail-attachments-preview">
												<i class="icon-file-pdf icon-2x"></i>
											</span>

                                            <div class="mail-attachments-content">
                                                <span class="text-semibold">file2.pdf</span>

                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li class="text-muted">736 KB</li>
                                                    <li><a href="#">Afficher</a></li>
                                                    <li><a href="#">Telecharger</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /attachments -->

                            </div>
                            <!-- /single mail -->

                        </div>
                    </div>
                    <!-- /detached content -->

                    <!-- Footer -->
                    @include('includes.footer')
                <!-- /footer -->

                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection




