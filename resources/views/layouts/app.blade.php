<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') | Doctor.uk</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/assets/img/favicon.ico')}}"/>
    <link href="{{asset('assets/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('assets/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- FontAwsem Link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/table/datatable/dt-global_style.css')}}">

    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <!-- toastr -->
    <link href="{{asset('assets/plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <style>
        ul li span .fa{
            font-size:20px;
            display:inline;
            color :#54c889;
        }
        label.error {
            color: white!important;
            background-color: #27AE60;
            border-color: #27AE60;
            padding:1px 20px 1px 20px;
        }  
    </style>

</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> 
        <div class="loader"> 
            <div class="loader-content">
                <div class="spinner-grow align-self-center" style="background-color: #27AE60;"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{url('home')}}">
                        <img src="{{asset('assets/assets/img/logo5.png')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{url('home')}}" class="nav-link">
                        @if(Auth::user()->type == "Admin")
                         (Admin) 
                        @elseif(Auth::user()->type == "Doctor")
                        (Doctor)
                        @endif
                    </a>
                    <!-- <a href="{{url('home')}}" class="nav-link"> Doctor.uk |&nbsp;
                        @if(Auth::user()->type == "Admin")
                        <small> {{Auth::user()->name}} (Admin) </small>
                        @elseif(Auth::user()->type == "Doctor")
                        <small> Dr. {{Auth::user()->name}}</small>
                        @endif
                    </a> -->
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="{{asset('assets/assets/img/logo.png')}}" alt="avatar">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a href="{{route('profile')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> My Profile</a>
                            </div>
                          
                            <div class="dropdown-item">
                                <form id="logout" action="{{route('logout') }}" method="post">
                                        {{csrf_field()}}
                                        <a href="javascript:{}" onclick="document.getElementById('logout').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>Sign Out
                                    </a>
                                </form>       
                            </div>
                            
                    </div>
                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li> -->
                                <li class="breadcrumb-item active" aria-current="page"><span>@yield('header')</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
           
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <!-- <div class="shadow-bottom"></div> -->

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    @if(\Laratrust::isAbleTo('dashboard-read'))
                    <li class="menu">
                        <a href="{{route('home')}}" data-active="{{Request::is(['home','home/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span> <i class="fa fa-tachometer"></i>&nbsp;&nbsp;&nbsp;Dashboard</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->type == "Admin")
                        @if(\Laratrust::isAbleTo('users-read') OR \Laratrust::isAbleTo('role-read') OR \Laratrust::isAbleTo('permission-read'))
                            <li class="menu">
                                <a href="#app10" data-toggle="collapse" data-active="{{Request::is(['user','role','permission']) ? 'true' : 'false'}}" 
                                aria-expanded="{{Request::is(['user','role','permission']) ? 'true' : 'false'}}" class="{{Request::is(['user','role','permission']) ? 'dropdown-toggle' : 'dropdown-toggle collapsed'}}">
                                    <div class="">
                                        <span> <i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Administrator</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </a>
                                <ul class="collapse submenu list-unstyled {{Request::is(['user','role','permission']) ? 'show' : ''}}" id="app10" data-parent="#accordionExample">
                                @if(\Laratrust::isAbleTo('users-read'))
                                    <li class="{{Request::is(['user','user/*']) ? 'active' : ''}}"><a href="{{route('user.index')}}"> User </a></li>
                                @endif
                                @if(\Laratrust::isAbleTo('role-read'))
                                    <li class="{{Request::is(['role','role/*']) ? 'active' : ''}}"><a href="{{route('role.index')}}"> Roles </a></li>
                                @endif
                                @if(\Laratrust::isAbleTo('permission-read'))
                                    <li class="{{Request::is(['permission','permission/*']) ? 'active' : ''}}"><a href="{{route('permission.index')}}"> Permission </a></li>
                                @endif
                                </ul>
                            </li>
                        @endif
                        @if(\Laratrust::isAbleTo('category-read') OR \Laratrust::isAbleTo('sub-category-read') OR \Laratrust::isAbleTo('illness-read') OR \Laratrust::isAbleTo('symptoms-read'))
                            <li class="menu">
                                <a href="#app0" data-toggle="collapse" data-active="{{Request::is(['category','subcategory','illnes','symptom']) ? 'true' : 'false'}}" 
                                aria-expanded="{{Request::is(['category','subcategory','illnes','symptom']) ? 'true' : 'false'}}" class="{{Request::is(['category','subcategory','illnes','symptom']) ? 'dropdown-toggle' : 'dropdown-toggle collapsed'}}">
                                    <div class="">
                                        <span> <i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;Setting</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </a>
                                <ul class="collapse submenu list-unstyled {{Request::is(['category','subcategory','illnes','symptom']) ? 'show' : ''}}" id="app0" data-parent="#accordionExample">
                                @if(\Laratrust::isAbleTo('category-read'))
                                    <li class="{{Request::is(['category','category/*']) ? 'active' : ''}}"><a href="{{route('category.index')}}"> Category </a></li>
                                @endif
                                @if(\Laratrust::isAbleTo('sub-category-read'))
                                    <li class="{{Request::is(['subcategory','subcategory/*']) ? 'active' : ''}}"><a href="{{route('subcategory.index')}}"> Sub Category </a></li>
                                @endif
                                @if(\Laratrust::isAbleTo('illness-read'))
                                    <li class="{{Request::is(['illnes','illnes/*']) ? 'active' : ''}}"><a href="{{route('illnes.index')}}"> Illlnesses </a></li>
                                @endif
                                @if(\Laratrust::isAbleTo('symptoms-read'))
                                    <li class="{{Request::is(['symptom','symptom/*']) ? 'active' : ''}}"><a href="{{route('symptom.index')}}"> Symptoms </a></li>
                                @endif
                                </ul>
                            </li>
                        @endif
                        @if(\Laratrust::isAbleTo('doctor-read') OR \Laratrust::isAbleTo('patient-read'))
                            <li class="menu">
                                <a href="#app2" data-toggle="collapse" data-active="{{Request::is(['doctor','patient_list']) ? 'true' : 'false'}}" aria-expanded="{{Request::is(['doctor','patient_list']) ? 'true' : 'false'}}" class="{{Request::is(['doctor','patient_list']) ? 'dropdown-toggle' : 'dropdown-toggle collapsed'}}">
                                    <div class="">
                                        <span> <i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;User Accounts</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </a>
                                <ul class="collapse submenu list-unstyled {{Request::is(['doctor','patient_list']) ? 'show' : ''}}" id="app2" data-parent="#accordionExample">
                                @if(\Laratrust::isAbleTo('doctor-read'))
                                    <li class="{{Request::is(['doctor','doctor/*']) ? 'active' : ''}}"><a href="{{route('doctor.index')}}"> Doctors </a></li>
                                @endif
                                @if(\Laratrust::isAbleTo('patient-read'))
                                    <li class="{{Request::is(['patient_list','patient_list/*']) ? 'active' : ''}}"><a href="{{route('patient_list')}}"> Patients </a></li>
                                @endif
                                </ul>
                            </li>
                        @endif
                        @if(\Laratrust::isAbleTo('appointment-read'))
                            <li class="menu">
                                <a href="{{route('appoinment.index')}}" data-active="{{Request::is(['appoinment','appoinment/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <span> <i class="fa fa-clock"></i>&nbsp;&nbsp;&nbsp;&nbsp;Appointment</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                        <!-- <li class="menu">
                            <a href="{{route('profile')}}" data-active="{{Request::is(['profile','profile/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                <span> <i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;My Profile</span>
                                </div>
                            </a>
                        </li> -->
                        <!-- <li class="menu">
                            <a href="{{route('illnes_test')}}" data-active="{{Request::is(['illnes_test','illnes_test/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                <span> <i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;My Profile</span>
                                </div>
                            </a>
                        </li> -->
                    @endif

                    @if(Auth::user()->type == "Doctor")
                        <li class="menu">
                            <a href="{{route('doctor_profile')}}" data-active="{{Request::is(['doctor_profile','doctor_profile/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <span><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{route('speciality.index')}}" data-active="{{Request::is(['speciality','speciality/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <span> <i class="fa fa-diamond"></i>&nbsp;&nbsp;&nbsp; Speciality</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="#app0" data-toggle="collapse" aria-expanded="{{Request::is(['doctor_slots','doctor_slots_available','doctor_slots_book','doctor_slots_total','doctor_slots_check_date','check_date_slot']) ? 'true' : 'false'}}" class="{{Request::is(['doctor_slots','doctor_slots_available','doctor_slots_book','doctor_slots_total','doctor_slots_check_date','check_date_slot']) ? 'dropdown-toggle' : 'dropdown-toggle collapsed'}}">
                                <div class="">
                                    <span> <i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;Slots Detail</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled {{Request::is(['doctor_slots','doctor_slots_available','doctor_slots_book','doctor_slots_total','doctor_slots_check_date','check_date_slot']) ? 'show' : ''}}" id="app0" data-parent="#accordionExample">
                                <li class="{{Request::is(['doctor_slots','doctor_slots/*']) ? 'active' : ''}}"><a href="{{route('doctor_slots.index')}}"> Add Slots </a></li>
                                <li class="{{Request::is(['doctor_slots_available','doctor_slots_available/*']) ? 'active' : ''}}"><a href="{{route('doctor_slots_available')}}"> Available Slots </a></li>
                                <li class="{{Request::is(['doctor_slots_book','doctor_slots_book/*']) ? 'active' : ''}}"><a href="{{route('doctor_slots_book')}}"> Booked Slots </a></li>
                                <li class="{{Request::is(['doctor_slots_total','doctor_slots_total/*']) ? 'active' : ''}}"><a href="{{route('doctor_slots_total')}}"> Total Slots </a></li>
                                <li class="{{Request::is(['doctor_slots_check_date','check_date_slot', 'check_date_slot/*', 'doctor_slots_check_date/*']) ? 'active' : ''}}"><a href="{{route('doctor_slots_check_date')}}"> Check Date Slots </a></li>
                            </ul>
                        </li>

                        <li class="menu">
                            <a href="{{route('reviews_list')}}" data-active="{{Request::is(['reviews_list','reviews_list/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <span> <i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Reviews List</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{route('doctor_appoinment')}}" data-active="{{Request::is(['doctor_appoinment','doctor_appoinment/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                <span> <i class="fa fa-clock"></i>&nbsp;&nbsp;&nbsp;Appointment</span>
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

       @yield('content')

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/assets/js/libs/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('assets/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/assets/js/dashboard/dash_2.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/plugins/table/datatable/datatables.js')}}"></script>
    {{-- <script src="{{asset('assets/js/custom.js')}}"></script> --}}
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/assets/js/scrollspyNav.js')}}"></script>
    <!-- toastr -->
    <script src="{{asset('assets/plugins/notification/snackbar/snackbar.min.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{asset('assets/assets/js/components/notification/custom-snackbar.js')}}"></script>

    <script>
        $('#zero-config, #zero-config2').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>

    @if(Session::has('success'))
        <script>
            Snackbar.show({
                // text: 'I Am Here.',
                text: '{!!Session::get('success')!!}',
                pos: 'top-right',
                // text: 'Info',
                actionTextColor: '#fff',
                backgroundColor: '#2196f3'
                // toastr.success("{!!Session::get('success')!!}"),
            });
        </script>
    @endif

    @if(Session::has('msg'))
        <script>
            Snackbar.show({
                // text: 'I Am Here.',
                text: '{!!Session::get('msg')!!}',
                pos: 'top-right',
                // text: 'Danger',
                actionTextColor: '#fff',
                backgroundColor: '#e7515a'
                // toastr.success("{!!Session::get('success')!!}"),
            });
        </script>
    @endif

    <script>
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                image: {
                    required: true,
                },
                cat_id: {
                    required: true,
                },
                contact: {
                    required: true,
                },
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                date_of_birth:{
                    required : true,
                },
                description:{
                    required : true,
                    minlength: 50
                },
                hospital_name:{
                    required : true,
                },
                fees_amount:{
                    required : true,
                },
                'speciality[]':{
                    required : true,
                },
               
                
            },
            messages: {
                name: {
                    required: "Name is required"
                },
                image: {
                    required: "Image is required"
                },
                cat_id: {
                    required: "Category is required"
                },
                // contact: {
                //     required: "Contact is required"
                // },
                // email: {
                //     required: "Email is required"
                // },
                // password: {
                //     required: "Contact is required"
                // },
                // gender: {
                //     required: "Gender is required"
                // },
                // date_of_birth: {
                //     required: "Date Of Birth is required"
                // },
                'speciality[]': {
                    required: "Speciality is required"
                },
            }
        });
    </script>

    @yield('javascript')

</body>
</html>
