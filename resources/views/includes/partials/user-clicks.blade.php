
<script type="text/javascript">(function(c,a){if(!a.__SV){var b=window;try{var d,m,j,k=b.location,f=k.hash;d=function(a,b){return(m=a.match(RegExp(b+"=([^&]*)")))?m[1]:null};f&&d(f,"state")&&(j=JSON.parse(decodeURIComponent(d(f,"state"))),"mpeditor"===j.action&&(b.sessionStorage.setItem("_mpcehash",f),history.replaceState(j.desiredHash||"",c.title,k.pathname+k.search)))}catch(n){}var l,h;window.mixpanel=a;a._i=[];a.init=function(b,d,g){function c(b,i){var a=i.split(".");2==a.length&&(b=b[a[0]],i=a[1]);b[i]=function(){b.push([i].concat(Array.prototype.slice.call(arguments,
    0)))}}var e=a;"undefined"!==typeof g?e=a[g]=[]:g="mixpanel";e.people=e.people||[];e.toString=function(b){var a="mixpanel";"mixpanel"!==g&&(a+="."+g);b||(a+=" (stub)");return a};e.people.toString=function(){return e.toString(1)+".people (stub)"};l="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
    for(h=0;h<l.length;h++)c(e,l[h]);var f="set set_once union unset remove delete".split(" ");e.get_group=function(){function a(c){b[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));e.push([d,call2])}}for(var b={},d=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<f.length;c++)a(f[c]);return b};a._i.push([b,d,g])};a.__SV=1.2;b=c.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
    MIXPANEL_CUSTOM_LIB_URL:"file:"===c.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(b,d)}})(document,window.mixpanel||[]);
    mixpanel.init("{{ env('MIXPANEL_TOKEN') }}");
    
        $(document).ready(function(event){
            setTimeout(function(){
                var data ={};
                var ref = document.referrer.split('/')[2];
                let referrer =  { social : '', hostname : window.location.hostname};
                if(window.location.href.split('/')[2] !== ref)
                {
                    referrer = { social : ref, hostname : window.location.hostname};
                }
                
                data['fromUrl']=referrer.social ? referrer.social:"{{url()->previous()}}";
                data['page']= "{{url()->current()}}";
                data['toUrl']= "{{url()->current()}}";
                data['ip']= $('#ip').val();
                data["_token"]="{{ csrf_token() }}";
                // if(data['page'] !== data['toUrl']){
                    $.ajax({
                        url: "{{ route('frontend.user.tracker') }}",
                        method: 'post',
                        data: data,
                        success: function(response){
                        //console.log(response);
                    }})
                // }
            }, 3000);

            $("body button, body .btn, a").click(function( event ) {
                var data ={};
                var eventname = $('.card-title').text() == undefined ? null : $.trim($('.card-title').text());
                data['name']= $(event.target).attr("name") == undefined ? null : $(event.target).attr("name");
                data['button']= $(event.target).text() == undefined ? null : $(event.target).text()+ '('+eventname+')';
                data['fromUrl']= "{{url()->previous()}}";
                data['toUrl']= $(event.target).attr("href") == undefined ? null : $(event.target).attr("href");
                data['data']= $(this).val() == undefined ? null : $(this).val();
                data['page']= "{{url()->current()}}";
                data['ip']= $('#ip').val();
                data["_token"]="{{ csrf_token() }}";
                ga('send', 'event', data.button, data.page, 'Click');
                mixpanel.track(data.page+' : '+data.button);
                $.ajax({
                    url: "{{ route('frontend.user.tracker') }}",
                    method: 'post',
                    data: data,
                    success: function(response){
                    // console.log(response);
                }})
            });
        $("body input").blur(function( event ) {
            var data ={};
            data['name']= $(event.target).attr("name") == undefined ? null : $(event.target).attr("name");
            data['data']= $(this).val() == undefined ? null : $(this).val();
            data['page']= "{{url()->current()}}";
            data['ip']= $('#ip').val();
            data["_token"]="{{ csrf_token() }}";
            // console.log(data);
            // ga('send', 'event', data.name, data.page, data.data);
            mixpanel.track(data.page+' : '+data.name+' : '+data.data);
            $.ajax({
                url: "{{ route('frontend.user.tracker') }}",
                method: 'post',
                data: data,
                success: function(response){
                //console.log(response);
            }})
        });
    });

</script>