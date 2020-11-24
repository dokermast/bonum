
<script type="text/javascript">

    base_url = window.location.origin;

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function categoryStatus(id, status){

        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': getCookie("XSRF-TOKEN") ,
            }
        });

        $.ajax({
            type: "POST",
            url: base_url + '/admin/categories/status',
            data: {
                id: id,
                status: status
            },
            success: function (data) {
                if(status){
                    $("#off_"+id).css("display","none");
                    $("#on_"+id).css("display","");
                } else {
                    $("#on_"+id).css("display","none");
                    $("#off_"+id).css("display","");
                }
                if(data.ids){
                    data.ids.forEach(function(id){
                        if(status){
                            $("#off_"+id).css("display","none");
                            $("#on_"+id).css("display","");
                        } else {
                            $("#on_"+id).css("display","none");
                            $("#off_"+id).css("display","");
                        }
                    });
                }
            },
            error: function (data) {
                console.log('Errror');
            }
        });
    }

</script>
