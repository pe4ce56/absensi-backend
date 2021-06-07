<!-- Mirrored from www.themeon.net/nifty/v2.9.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 02 Feb 2019 03:58:19 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title') | {{$data['configuration']['app-name'] ?? ''}}</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{asset('assets/css/nifty.min.css')}}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{asset('assets/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{asset('assets/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
    <link href="{{asset('assets/plugins/themify-icons/themify-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-table/bootstrap-table.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/x-editable/css/bootstrap-editable.css')}}" rel="stylesheet">

    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{asset('assets/css/demo/nifty-demo.min.css')}}" rel="stylesheet">

    @yield('css')
    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->

</head>
