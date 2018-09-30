$(document).ready(function(){

    $("body").on("click", "#like", function(){
        var _token     = $("input[name='_token']").val();
        var episode_id = $(this).data("id");

        $.ajax({
            url: "/rate",
            data: {
                episode_id: episode_id,
                rate:'like',
                _token:_token
            },
            dataType: "json",
            success: function(response) {
                $("#rate-area").html(Lang.get('roya.RATE', {"rate" : Lang.get("roya.LIKE")})+"<a href='#' id='undo-rate' data-id='"+response.id+"' data-episode='"+episode_id+"'>"+Lang.get("roya.UNDO_RATE")+"</a>");
            }
        });
    });

    $("body").on("click", "#dislike", function(){
        var _token     = $("input[name='_token']").val();
        var episode_id = $(this).data("id");

        $.ajax({
            url: "/rate",
            data: {
                episode_id: episode_id,
                rate:'dislike',
                _token:_token
            },
            dataType: "json",
            success: function(response) {
                $("#rate-area").html(Lang.get('roya.RATE', {"rate" : Lang.get("roya.DISLIKE")})+"<a href='#' id='undo-rate' data-id='"+response.id+"' data-episode='"+episode_id+"'>"+Lang.get("roya.UNDO_RATE")+"</a>");
            }
        });
    });

    $("body").on("click", "#undo-rate", function(){

        var _token     = $("input[name='_token']").val();
        var rate_id    = $(this).data("id");
        var episode_id = $(this).data("episode");

        $.ajax({
            url: "/undorate",
            data: {
                rate_id: rate_id,
                _token:_token
            },
            dataType: "json",
            success: function(response) {
                $("#rate-area").html("<div class='btn-group' role='group' aria-label='Basic example'>" +
                    "<button id='like'    data-id='"+episode_id+"' type='button' class='btn btn-success'>"+Lang.get("roya.LIKE")+" <i class='fa fa-thumbs-up'></i></button>" +
                    "<button id='dislike' data-id='"+episode_id+"' type='button' class='btn btn-danger'>"+Lang.get("roya.DISLIKE")+" <i class='fa fa-thumbs-down'></i></button>" +
                    "</div>");
            }
        });
    });

    $("body").on("click", "#follow", function(){
        var _token  = $("input[name='_token']").val();
        var show_id = $(this).data("id");

        $.ajax({
            url: "/follow",
            data: {
                show_id: show_id,
                _token:_token
            },
            dataType: "json",
            success: function(response) {
                $("#following-area").html("<button id='unfollow' data-id='"+response.id+"' data-show='"+show_id+"' type='button' class='btn btn-primary'><i class='fa fa-minus'></i> "+Lang.get("roya.UNFOLLOW")+"</button>");
            }
        });
    });

    $("body").on("click", "#unfollow", function(){
        var _token  = $("input[name='_token']").val();
        var show_id = $(this).data("show");

        $.ajax({
            url: "/unfollow",
            data: {
                id: $(this).data("id"),
                _token:_token
            },
            dataType: "json",
            success: function(response) {
                $("#following-area").html("<button id='follow' data-id='"+show_id+"' type='button' class='btn btn-primary'><i class='fa fa-plus'></i> "+Lang.get("roya.FOLLOW")+"</button>");
            }
        });
    });

    $('body').on('click', '#find', function(e){
        e.preventDefault();
        var searchKeyword = $('#keyword').val().trim();
        searchKeyword     = searchKeyword.replace(/&/gi, 'and');
        searchKeyword     = searchKeyword.replace(/[\+?\/#%><!\\]/g, ' ');
        searchKeyword     = searchKeyword.replace(/ +/g, '+');
        var newAction     = '/search/'+searchKeyword;
        if(searchKeyword.length !== 0){
            $('#search-form').attr('action', newAction);
            $('#search-form').submit();
        }else{
            $('#keyword').focus();
        }
    });

    $('body').on('keydown', function(e){
        if(e.keyCode === 13){
            e.preventDefault();
            var searchKeyword = $('#keyword').val().trim();
            searchKeyword     = searchKeyword.replace(/&/gi, 'and');
            searchKeyword     = searchKeyword.replace(/[\+?\/#%><!\\]/g, ' ');
            searchKeyword     = searchKeyword.replace(/ +/g, '+');
            var newAction     = '/search/'+searchKeyword;
            if(searchKeyword.length !== 0){
                $('#search-form').attr('action', newAction);
                $('#search-form').submit();
            }else{
                $('#keyword').focus();
            }
        }
    });

});