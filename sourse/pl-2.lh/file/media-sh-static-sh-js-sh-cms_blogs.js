function load_blogs(page, options, limit) {
    $('.przewijaki img').show();

    //$.get('/blogi/get_list/' + limit + '/1/' + page + '/', options,
    $.get('/blogi/get_list/' + limit + '/1/' + page + '/', options,
        function(data) {
            $('#glogs_container').html(data);
            distribute();
            $('.przewijaki img').hide();
            var distanceTop = $('.przewijaki').offset().top - $(window).height();;
            $(window).bind('scroll', function(){
                if($(window).scrollTop() > distanceTop) {
                    $(window).unbind();
                    $('.przewijaki img').show();
                    //$.get('/blogi/get_list/' + limit + '/2/' + page + '/', options,
                    $.get('/blogi/get_list/' + limit + '/2/' + page + '/', options,
                        function(data) {
                            $('#glogs_container').html(data);
                            distribute();
                            $('.przewijaki img').hide();
                            if ($('#paginator_prev').html() != 0) {
                                $('.button.left').fadeIn('slow');
                                $('.button.left').click(function(){
                                    location.href='?p=' + parseInt($('#paginator_prev').html());
                                });
                            }
                            if ($('#paginator_next').html() !=0) {
                                $('.button.right').fadeIn('slow');
                                $('.button.right').click(function(){
                                    location.href='?p=' + parseInt($('#paginator_next').html());
                                });
                            }
                        });                        
                }
                
            });
        }
    );
}

function distribute() {
    $('#glogs_container').find('.glog.shadow').each(function(i, obj){
        var left_height = $('.lewa_col').height();
        var middle_height = $('.srodek_col').height();
        var right_height = $('.prawa_col').height();
        var smallest = Math.min(left_height, middle_height, right_height);
        if (left_height == smallest) {
            $('.lewa_col').append(obj);
        } 
        else if (middle_height == smallest) {
            $('.srodek_col').append(obj);
        }
        else if (right_height == smallest) {
            $('.prawa_col').append(obj);
        }
        $(obj).fadeIn('slow'); 
    });
    
}

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}


