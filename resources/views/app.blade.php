<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Lapse</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
        <style type="text/css">
            body{
                font-size: 14px;
                font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            }
            .ReactTable .rt-tbody .rt-td {
                padding: 15px;
            }
        </style>
    </head>

    <body style="margin:0; padding: 0">

        <div style="border-top: 4px solid #62e1e6">
            <div class="container" style="width: 80%; margin-left: auto; margin-right: auto;margin-top: 7%"> 
                <div style="text-align:center; margin-bottom: 10px;"> 
                    <h1> <span style="color: #1aa8af; font-weight: bold">LARAVEL</span> 
                        <span style="font-weight: 300; color: #4cc2c7">LAPSE </span>
                    </h1> 
                    <h1 style="color: #374244; font-weight: 300"> Your Self Hosted Error Tracking System </h1>
                    <h3 style="color: #484747; font-weight: 400"> Dont worry for your exception, LAPSE is A Great way to detect your error in Production</h3>
                </div>
                <br/>
                <br/>
                <div id="error-displayer"></div> 
            </div>
        </div>

        <script type="text/javascript">
            window.currentUrl = "{{ url()->current() }}";
            window.detailUrl = "{{ route('lapse.detail') }}"
        </script>

        <script src="{{ mix('js/app.js', 'vendor/lapse') }}"></script>

    </body>
</html>