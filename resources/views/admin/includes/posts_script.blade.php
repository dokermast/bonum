
<script type="text/javascript">

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function postOn(id){
        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': getCookie("XSRF-TOKEN") ,
            }
        });

        $.ajax({
            type: "POST",
            url: '/public/admin/posts/on',
            data: {
                id: id
            },
            success: function (data) {
                console.log(data.id);
                $("#off_"+id).css("display","none");
                $("#on_"+id).css("display","");
            },
            error: function (data) {
                console.log(data);
                console.log('Errror');
            }
        });
    }
    function postOff(id){
        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': getCookie("XSRF-TOKEN") ,
            }
        });

        $.ajax({
            type: "POST",
            url: '/public/admin/posts/off',
            data: {
                id: id
            },
            success: function (data) {
                $("#on_"+id).css("display","none");
                $("#off_"+id).css("display","");
            },
            error: function (data) {
                console.log('Errror');
            }
        });
    }

</script>
