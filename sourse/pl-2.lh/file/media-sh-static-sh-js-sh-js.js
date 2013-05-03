window.onload = init;

function init() {
    hover();
    formularz();
}

function hover() {  
    newImage1 = new Image();
    newImage1.src = "/media/static/images/glosuj2_on.jpg";
    oldImage1 = new Image();
    oldImage1.src = "/media/static/images/glosuj2.jpg"; 
    
    newImage2 = new Image();
    newImage2.src = "/media/static/images/zobacz_wyniki_on.jpg";
    oldImage2 = new Image();
    oldImage2.src = "/media/static/images/zobacz_wyniki.jpg";
    
    newImage3 = new Image();
    newImage3.src = "/media/static/images/zatwierdz_kolor_on.jpg";
    oldImage3 = new Image();
    oldImage3.src = "/media/static/images/zatwierdz_kolor.jpg";
    
    newImage4 = new Image();
    newImage4.src = "/media/static/images/przyciskKom_on.jpg";
    oldImage4 = new Image();
    oldImage4.src = "/media/static/images/przyciskKom.jpg"; 
    
    if(document.getElementById("sondaHover2")) {
    document.getElementById("sondaHover2").onmouseover = addEfekt1;
    document.getElementById("sondaHover2").onmouseout = deleteEfekt1;
    }
    if(document.getElementById("look")) {
    document.getElementById("look").onmouseover = addEfekt2;
    document.getElementById("look").onmouseout = deleteEfekt2;
    }
    if(document.getElementById("sondaHover3")) {
    document.getElementById("sondaHover3").onmouseover = addEfekt4;
    document.getElementById("sondaHover3").onmouseout = deleteEfekt4;
    }
    if(document.getElementById("kolorHover")) {
    document.getElementById("kolorHover").onmouseover = addEfekt3;
    document.getElementById("kolorHover").onmouseout = deleteEfekt3;
    }
}

function addEfekt1() {
    document.getElementById("sondaHover2").style.background = "url(" + newImage1.src + ")";
}

function deleteEfekt1() {
    document.getElementById("sondaHover2").style.background = "url(" + oldImage1.src + ")";
}

function addEfekt2() {
    document.getElementById("look").style.background = "url(" + newImage2.src + ")";
}

function deleteEfekt2() {
    document.getElementById("look").style.background = "url(" + oldImage2.src + ")";
}

function addEfekt4() {
    document.getElementById("sondaHover3").style.background = "url(" + newImage4.src + ")";
}

function deleteEfekt4() {
    document.getElementById("sondaHover3").style.background = "url(" + oldImage4.src + ")";
}
function addEfekt3() {
    document.getElementById("kolorHover").style.background = "url(" + newImage3.src + ")";
}

function deleteEfekt3() {
    document.getElementById("kolorHover").style.background = "url(" + oldImage3.src + ")";
}
function formularz() {
    if(document.getElementById("adresEmail")) {
        document.getElementById("adresEmail").onfocus = zaznaczForm;
        document.getElementById("adresEmail").onblur = wyjdzForm;
    }
    if(document.getElementById("saInput")) {
        document.getElementById("saInput").onfocus = zaznaczForm;
        document.getElementById("saInput").onblur = wyjdzForm;
    }
    if(document.getElementById("blogFormInput")) {
        document.getElementById("blogFormInput").onfocus = zaznaczForm;
        document.getElementById("blogFormInput").onblur = wyjdzForm;
    }
    if(document.getElementById("blogTytul")) {
    document.getElementById("blogTytul").onfocus = zaznaczForm;
    document.getElementById("blogTytul").onblur = wyjdzForm;
    }
    if(document.getElementById("blogTytul1")) {
    document.getElementById("blogTytul1").onfocus = zaznaczForm;
    document.getElementById("blogTytul1").onblur = wyjdzForm;
    }
    if(document.getElementById("blogTytul2")) {
    document.getElementById("blogTytul2").onfocus = zaznaczForm;
    document.getElementById("blogTytul2").onblur = wyjdzForm;
    }
    if(document.getElementById("blogTytul3")) {
    document.getElementById("blogTytul3").onfocus = zaznaczForm;
    document.getElementById("blogTytul3").onblur = wyjdzForm;
    }
    if(document.getElementById("blogTytul5")) {
    document.getElementById("blogTytul5").onfocus = zaznaczForm;
    document.getElementById("blogTytul5").onblur = wyjdzForm;
    }
    if(document.getElementById("blogOpis")) {
    document.getElementById("blogOpis").onfocus = zaznaczForm;
    document.getElementById("blogOpis").onblur = wyjdzForm;
    }
    if(document.getElementById("wpiszFraze")) {
        document.getElementById("wpiszFraze").onfocus = zaznaczForm;
        document.getElementById("wpiszFraze").onblur = wyjdzForm;
    }
    if(document.getElementById("searchBlog")) {
        document.getElementById("searchBlog").onfocus = zaznaczForm;
        document.getElementById("searchBlog").onblur = wyjdzForm;
    }
    if(document.getElementById("komentarzEmail")) {
        document.getElementById("komentarzEmail").onfocus = zaznaczForm;
        document.getElementById("komentarzEmail").onblur = wyjdzForm;
    }
    if(document.getElementById("findProjAA")) {
        var child = document.getElementById("findProjAA").childNodes;
        for(var i=0; i<child.length; i++) {
            if(child[i].nodeName.indexOf("INPUT") > -1) {
                child[i].onfocus = zaznaczForm;
                child[i].onblur = wyjdzForm;
            }
        }
    }
    
}

function zaznaczForm() {
    if (this.value == this.defaultValue) {
        this.value = '';
    }
}

function wyjdzForm() {
    if (this.value == '') {
        this.value = this.defaultValue;
    }
}

//-----
function submit_epasaz_search(){
    data = $('#epasaz_search').serialize();
    action = $('#epasaz_search').attr('action');
    window.open(action + '?' + data);
    $('epasaz_search_input').value = '';
    return false;
}

function ScrollToElement(theElement){
    var selectedPosY = 0;
    while (theElement != null) {
        selectedPosY += theElement.offsetTop;
        theElement = theElement.offsetParent;
    }
    window.scrollTo(0, selectedPosY);
}

function switchBlokGlowna(elementNum) {
	articles = $('.calyBlok');
	nums = $('.numerIndex ul li');
	articles.hide();
	$(articles[elementNum]).show();
	nums.children('a').removeClass('active');
	$(nums[elementNum]).children('a').addClass('active');
}

function switchBlokDzial(elementNum) {
	articles = $('.calyBlokDzial .metaWnetrz2');
	nums = $('.numerDzial ul li');
	articles.hide();
	$(articles[elementNum]).show();
	nums.children('a').removeClass('active');
	$(nums[elementNum]).children('a').addClass('active');
}

function swithBlokEkspert(elementNum) {
	questions = $('.textAndItem .nadBlok2Img');
	baloons = $('.numPrakPorNaw2 .ajaxAktPod');
	nums = $('.numPrakPorNaw2 ul li');
	questions.hide();
	baloons.hide();
	$(questions[elementNum]).show();
	$(baloons[elementNum]).show();
	nums.children('a').removeClass('active');
	$(nums[elementNum]).children('a').addClass('active');
}

function swithBlokNewspaperDW(elementNum) {
	items = $('.kartki1 .calyBlok1');
	nums = $('.m_jak_m_swi .numer3 ul li a');
	items.hide();
	$(items[elementNum]).show();
	nums.removeClass('active');
	$(nums[elementNum]).addClass('active');
}

function swithBlokNewspaperKU(elementNum) {
	items = $('.kartki .calyBlok1');
	nums = $('.numerIndex ul li a');
	items.hide();
	$(items[elementNum]).show();
	nums.removeClass('active');
	$(nums[elementNum]).addClass('active');
}

function swithBlokPromotedArticlesMM(elementNum) {
	images = $('.moje_2 img');
	articles = $('.moje_2All .moje_2Item');
	images.hide();
	$(images[elementNum]).show();
	articles.removeClass('moje_active');
	$(articles[elementNum]).addClass('moje_active');
}

function swithBlokImgDescKU(id,elementNum) {
	items = $('#' + id + '.sylAll .sylItem');
	nums = $('#' + id + ' .numerIndex2 ul li a');
	items.hide();
	$(items[elementNum]).show();
	nums.removeClass('activeKU');
	$(nums[elementNum]).addClass('activeKU');
}

function input_with_value(id) {
	var value = $(id).val();
	var init_id = $(id).attr('id') + '_init';
	
	$(id).blur(function(){
        if ($(this).val() == '') {
            $(this).val($(this).siblings('label#' + init_id).text());
			$(this).siblings('label#' + init_id).remove();
		} 
    });
    
	$(id).focus(function(){
		if ($(this).val() == value) {
			$(this).after('<label id="' +  init_id +'" style="display:none;">' + value + '</label>');
	        $(this).val('');
		}
    });
}

function odmiana_ilosci(ilosc, txt_pojenynczy, txt_od_2_do_4, txt_wiecej_i_zero) {
    if (ilosc < 0)
        ilosc *= -1
    ostatnia_cyfra = ilosc % 10
    przedostatnia_cyfra = (ilosc % 100) / 10

    if (ilosc == 1)
        return txt_pojenynczy
    if (przedostatnia_cyfra != 1 && (ostatnia_cyfra > 1 && ostatnia_cyfra < 5))
        return txt_od_2_do_4

    return txt_wiecej_i_zero
}

function switch_avatar(id){
	$(id).find('a.opt').click(function(){
		var choice = $(this).attr('id');
		if (choice == 'opt1') {
			$(id).find('#opt1').parent().parent().hide();
			$(id).find('#opt2').parent().parent().show();
			var list = $(this).parent().parent().parent().find('.header_preview');
			list.children().hide();
		}
		else {
			$(id).find('#opt2').parent().parent().hide();
			$(id).find('#opt1').parent().parent().show();
		}
		return false;
	});
}

$(document).ready(function(){
	$('.logowanie1').load('/login_links/');
	
    /**
     *  przelacznik zakladek
     */
    $('ul.tab_switcher li h4 a').click(function(){
        var content_id = '#' + $(this).attr('id') + '_content';
		var switcher_class = $(this).parents('ul').siblings('input[name=switcher_class]').val();
		if (!switcher_class)
		  switcher_class = 'eksperciOgladana';
        
        $(this).parent().parent().siblings().removeClass(switcher_class);
        $(this).parent().parent().addClass(switcher_class);
        
        $(this).parents('ul').parent().siblings().hide();
        $(content_id).show();
        
        return false;
    });

    /** 
     *  blog
     */
    $('.blogImg').load($('input[name=photo_list]').val());
    
    $('.blogImgSend').click(function(){
        if ($('#blogCheckbox').attr('checked')) {
            if ($('.loadImg1 #blog_photo_edit').val() == 1) {
                $('#aux_form textarea').text($('.loadImg').find('textarea').val());
                $.post($('input[name=photo_edit]').val(), $('#aux_form').serialize(), function(data) {
					$('.loadImg1 #blog_photo_edit').val(0);
		            $('.blogImg').load($('input[name=photo_list]').val());
				});
            }
            else {
                $('#aux_form textarea').text($('.loadImg').find('textarea').val());
                uploadPhoto(document.getElementById('obrazek'));
            }

            // czyczczenie pol
            $('.loadImg').find('input:file').val('');
            $('.loadImg').find('input:checkbox').removeAttr('checked');
            $('.loadImg').find('textarea').val('');            
        }
        else {
            alert('Aby dodać plik, należy zaakceptować warunki.');
        }
        return false;
    });

    // usun wpis
	$('#add_post_form div #blogButton1').click(function() {
        var status = confirm('Czy chcesz usunąc wpis?');
        if (status) {
        	console.log("++++++++++++++++++++++++++++++");
        	console.log($('input[name=post_delete]').val());
            document.location = $('input[name=post_delete]').val();
        }
		return false;
	});
	
	// zapisz jako szkic
	$('#add_post_form div #blogButton2').click(function() {
		$('form input[name=status]').attr('checked', 'checked');
	});
	
	// zapisz
	$('#add_post_form div #blogButton3').click(function() {
		$('form input[name=status]').removeAttr('checked');
	});

    // usun blog
    $('#edit_blog_form div #blogButton1').click(function() {
        var status = confirm('Czy chcesz usunąc blog?');
        if (status) {
            document.location = $('input[name=blog_delete]').val();
        }
        return false;
    });
	
    // zliczanie ilosci znakow w opisie przy zakladaniu bloga
    $('#create_blog_form div #id_description').keyup(function() {
		var chars = 500 - $(this).val().length;
		$('#create_blog_form .znak500').text('pozostało ' + chars + ' ' + odmiana_ilosci(chars, 'znak', 'znaki', 'znaków'));
	});
    
	switch_avatar('#create_blog_form');
	switch_avatar('#edit_blog_form');
	
	// podglad avatarow
    $('#id_header').change(function() {
        var id = $(this).val();
        var list = $(this).parent().parent().find('.header_preview');
        list.children().hide();
        if (id) {
            list.find('li#' + id).show();
        }
    });
	
	// bloczek zagladam takze
	$('.blogArchItem .blogArchItemL a').click(function() {
		$('.blogArchItem .blogArchItemF').load($('.blogArchItem input[name=add_bookmark]').val());
		$('.blogArchItem .blogArchItemF').show();
		return false;
	});
	
	$('#arch_see_also').click(function() {
		$('.blogArchItem .blogArchItemUl').load($('.blogArchItem input[name=bookmark_list]').val());
	});
	
	
	/** 
	 *  profil uzytkownika
	 */
	// bloczek moje wiadomosci
	$('.myMess .odp').load($('.myMess input[name=message_list]').val());
	
	$('#all_users_sort_form div #id_sort').change(function() {
	   $('#all_users_sort_form').submit();	
	});

	/** 
	 *  experts
	 */
	$('#expertsImg').load($('input[name=photo_list]').val());

	$('#expertsImgSend').click(function(){
		if ($('#experts_photo_edit').val() == 1) {
			$('#aux_form textarea').text($('#expertsLoadImg').find('textarea').val());
			$.post($('input[name=photo_edit]').val(), $('#aux_form').serialize())
			$('#experts_photo_edit').val(0);
		} else {
			$('#aux_form textarea').text($('#expertsLoadImg').find('textarea').val());
			uploadPhoto(document.getElementById('obrazek'), 59);
		}
	    
		// czyczczenie pol
		$('#expertsLoadImg').find('input:file').val('');
		$('#expertsLoadImg').find('textarea').val('');
		
		// lista plikow
		$('#expertsImg').load($('input[name=photo_list]').val());
		
		return false;
	});	
	/**
	 *  galeria
	 */
	$('.galeriaNr1').find('#gal_mb_switcher li a').click(function() {
		var img_id = '#' + $(this).attr('id') + '_img';
		var content_id = '#' + $(this).attr('id') + '_content';
		
		$('#gal_mb_switcher li a').removeClass('galeriaActive');
		$('.galeriaNr2 a.gal_mb_image').hide();
		$('.galeriaNr3').hide();
		
		$(this).addClass('galeriaActive');
		$(img_id).show();
		$(content_id).show();
		
		return false;
	});
	jQuery('.kontenerLi').jcarousel();

    /* galeria - dekoteria */
    $('a#gallery_tab').click(function() {
        $(this).parent().addClass('active');
        $('a#dekoteria_tab').parent().removeClass('active');
        $('div#gallery').show();
        $('div#dekoteria').hide();
    });
    
    $('a#dekoteria_tab').click(function() {
        $(this).parent().addClass('active');
        $('a#gallery_tab').parent().removeClass('active');
        $('div#dekoteria').show();
        $('div#gallery').hide();
    });
    
    /* ekspert - stylista */
    $('a#ekspert_radzi_tab').click(function() {
        $(this).parent().addClass('active');
        $('a#stylista_radzi_tab').parent().removeClass('active');
        $('div#ekspert_radzi').show();
        $('div#stylista_radzi').hide();
    });
    
    $('a#stylista_radzi_tab').click(function() {
        $(this).parent().addClass('active');
        $('a#ekspert_radzi_tab').parent().removeClass('active');
        $('div#stylista_radzi').show();
        $('div#ekspert_radzi').hide();
    });
    
    /* forum - blogi - pomysly */
    $('a#fbp_forum').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div.fbp .content').hide();
        $('div.fbp #forum').show();
    });
    
    $('a#fbp_blogi').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div.fbp .content').hide();
        $('div.fbp #blogi').show();
    });
    
    $('a#fbp_pomysly').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div.fbp .content').hide();
        $('div.fbp #pomysly').show();
    });
    
    /* top czytane - top komentowane */
    $('a#topczytane_tab').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div#topkomentowane').hide();
        $('div#topczytane').show();
    });
    
    $('a#topkomentowane_tab').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div#topczytane').hide();
        $('div#topkomentowane').show();
    });
    
    /* sonda - quizy */
    $('a#sonda_tab').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div#quzi').hide();
        $('div#sonda').show();
    });
    
    $('a#quiz_tab').click(function() {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('div#sonda').hide();
        $('div#quzi').show();
    });
});
