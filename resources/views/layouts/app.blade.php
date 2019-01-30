@include('includes.header')


<body class="">



<div class="wrapper">
    <div class="main-panel">
        @include('includes.sliebar')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>


@include('includes.footer')