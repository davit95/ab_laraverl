<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css_build/all.css"/>
        
        @yield('styles')
        
        <script type="text/javascript" src="/js/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="/js_build/first.js"></script>  
    </head>
    <body>
        <div class="contentWrap">
            @include('layout.parts.menu')

            @yield('content')

            @include('layout.parts.footer')
        </div>
        <div style="z-index: 1001; display: none; position: absolute;" class="acResults"></div>
        <script type="text/javascript" src="/js/waypoints.min.js"></script>     
        <script type="text/javascript" src="/js/jquery.counterup.min.js"></script>        
        <script type="text/javascript" src="/js/chosen.jquery.js"></script>       
        <script type="text/javascript" src="/js/ImageSelect.jquery.js"></script>              
        <script type="text/javascript">
            // jQuery(document).ready(function($) {

            //     $(".currency-select").chosen();

            //     $('.currency-select').on('change', function() {
            //         $(this).parents('form').submit();
            //     });

            //     $( ".menuBtnLink" ).click(function() {
            //         $( ".menu" ).slideToggle( "slow", function() {
            //             // Animation complete.
            //         });
            //     });

            //     $('.popup-with-form').magnificPopup({
            //         type: 'inline',
            //         preloader: false,
            //         focus: '#name',
            //         mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side

            //         // When elemened is focused, some mobile browsers in some cases zoom in
            //         // It looks not nice, so we disable it:
            //         callbacks: {
            //             beforeOpen: function() {
            //                 if($(window).width() < 700) {
            //                     this.st.focus = false;
            //                 } else {
            //                     this.st.focus = '#name';
            //                 }
            //             }
            //         }
            //     });

            //     $('.counter').counterUp({
            //         delay: 50,
            //         time: 4000
            //     });

            //     $("#suggest1").autocomplete({
            //         url: '/ajax/autocomplete',
            //         minChars: 1,
            //         delay: 40,
            //         maxItemsToShow: 30,
            //         processData : function(data) {
            //            var countries = JSON.parse(data[0].value).countries;
            //            var cities = JSON.parse(data[0].value).cities;
            //            var states = JSON.parse(data[0].value).states;
            //            var arr = [];
            //            for(var k in countries)
            //            {
            //                 arr.push([countries[k].name, countries[k]]);
            //            }
            //            for(var k in cities)
            //            {
            //                 var code;
            //                 cities[k].us_state_id ? code = cities[k].us_state_code : code = cities[k].country_code;
            //                 arr.push([cities[k].name + ', ' + code, cities[k]]);
            //            }
            //            for(var k in states)
            //            {
            //                 arr.push([states[k].name, states[k]]);
            //            }
            //            return arr;
            //         },
            //         showResult: function(value, data) {
            //             var center_type = $("select[name='avo1']").val();
            //             switch(center_type)
            //             {
            //                 case "VO" : var url = data[0].vo_url;
            //                 break;

            //                 case "MR" : var url = data[0].mr_url;
            //                 break;
            //             }                          
            //             return value;                        
            //         },
            //         onItemSelect : function(value) {
            //             var center_type = $("select[name='avo1']").val();
            //             switch(center_type)
            //             {
            //                 case "VO" : var url = value.data[0].vo_url;
            //                 break;

            //                 case "MR" : var url = value.data[0].mr_url;
            //                 break;
            //             }
            //             window.location.href = url;
            //         }
            //     });

            //     $("input#suggest1").keyup(function(e) {

            //         var code = e.which;
            //         if(code==13) {
            //             e.preventDefault();
            //         }
            //         if(code==13||code==186) {
            //             $("#searchBtn").click();
            //         }
            //     });


            //     $("#avoS").on('submit', function() {
            //         return false;
            //     });

            //     $("input[name='inputy']").on('cahnge', function() {
            //         console.log($(this).val());
            //     });

            //     $( ".avo1" ).change(function() {
            //         return false;
            //         var e = document.getElementById("Services");
            //         var strType = e.options[e.selectedIndex].value;

            //         if(strType=='VO') {
            //             $("#avoS").attr("action", "search2.php");
            //         } else {
            //             $("#avoS").attr("action", "mr-search.php");
            //         }

            //     });

            //     if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            //         $(".videoWrap").hide();
            //         $( "div.videoTop" ).addClass( "bgHomeMobile" );
            //     }
            // });
        </script>
        <script>jQuery(document).ready(function($){$(".currency-select").chosen();$('.currency-select').on('change',function(){$(this).parents('form').submit();});$(".menuBtnLink").click(function(){$(".menu").slideToggle("slow",function(){});});$('.popup-with-form').magnificPopup({type:'inline',preloader:false,focus:'#name',mainClass:'mfp-no-margins mfp-with-zoom',callbacks:{beforeOpen:function(){if($(window).width()<700){this.st.focus=false;}else{this.st.focus='#name';}}}});$('.counter').counterUp({delay:50,time:4000});$("#suggest1").autocomplete({url:'/ajax/autocomplete',minChars:1,delay:40,maxItemsToShow:30,processData:function(data){var countries=JSON.parse(data[0].value).countries;var cities=JSON.parse(data[0].value).cities;var states=JSON.parse(data[0].value).states;var arr=[];for(var k in countries)
        {arr.push([countries[k].name,countries[k]]);}
        for(var k in cities)
        {var code;cities[k].us_state_id?code=cities[k].us_state_code:code=cities[k].country_code;arr.push([cities[k].name+', '+code,cities[k]]);}
        for(var k in states)
        {arr.push([states[k].name,states[k]]);}
        return arr;},showResult:function(value,data){var center_type=$("select[name='avo1']").val();switch(center_type)
        {case"VO":var url=data[0].vo_url;break;case"MR":var url=data[0].mr_url;break;}
        return value;},onItemSelect:function(value){var center_type=$("select[name='avo1']").val();switch(center_type)
        {case"VO":var url=value.data[0].vo_url;break;case"MR":var url=value.data[0].mr_url;break;}
        window.location.href=url;}});$("input#suggest1").keyup(function(e){var code=e.which;if(code==13){e.preventDefault();}
        if(code==13||code==186){$("#searchBtn").click();}});$("#avoS").on('submit',function(){return false;});$("input[name='inputy']").on('cahnge',function(){console.log($(this).val());});$(".avo1").change(function(){return false;var e=document.getElementById("Services");var strType=e.options[e.selectedIndex].value;if(strType=='VO'){$("#avoS").attr("action","search2.php");}else{$("#avoS").attr("action","mr-search.php");}});if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){$(".videoWrap").hide();$("div.videoTop").addClass("bgHomeMobile");}});</script>
        
        @yield('scripts')

        <script type="text/javascript">
            try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"3905af7162cebd4cfacf7319052bc7ad",petok:"1b4bc84b2128b131e4f3960265e1a2555cce3403-1444035030-1800",zone:"alliancevirtualoffices.com",rocket:"a",apps:0}];document.write('<script type="text/javascript" src="/js/cloudflare.min.js"><'+'\/script>');}}catch(e){};
        </script>
        <script type="text/rocketscript">
            var $zoho= $zoho || {salesiq:{values:{},ready:function(){}}};
            var d=document;
            s=d.createElement("script");
            s.type="text/javascript";
            s.defer=true;
            s.src="https://salesiq.zoho.com/alliancevirtualoffices/float.ls?embedname=alliancevirtualoffices";
            t=d.getElementsByTagName("script")[0];
            t.parentNode.insertBefore(s,t);
        </script>
    </body>
</html>