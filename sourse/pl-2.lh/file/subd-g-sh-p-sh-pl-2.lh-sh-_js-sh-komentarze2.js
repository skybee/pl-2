(function($) {
	$.fn.favoriteArticleButton = function(articleId) {
		if (!articleId) {
			return;
		}
		var _this = this;

		$.get('?ajax=1&action=get_favorite_article_info&articleId='+articleId, function(data) {
	  			if (data == 'logout') {
	  				var location = '?ajax=1&action=get_login_form&height=262&width=427&forwardUrl=http://pl-2.lh/profil/dodaj-artykul-do-schowka/'+articleId;
	  				$("#favoritesArticleLink").attr('href',location);
	  				
					tb_init(_this);//pass where to apply thickbox
	  			}	
	  			else
	  			{
	  				if (data == 'login|untracked')
	  				{
	  					var location = 'http://pl-2.lh/profil/dodaj-artykul-do-schowka/'+articleId;
	  					_this.attr('href',location);
	  					_this.removeAttr('class');
	  				}
	  			else if (data == 'login|tracked')
	  				_this.parent().remove();
	  		}
		});
	};
})(jQuery);

function loadFavoriteArticleInfo(articleId) {
	if (!articleId)
		return;

	$.get('?ajax=1&action=get_favorite_article_info&articleId='+articleId, function(data) {
  			if (data == 'logout')
  			{
  				var location = '?ajax=1&action=get_login_form&height=262&width=427&forwardUrl=http://pl-2.lh/profil/dodaj-artykul-do-schowka/'+articleId;
  				$("#favoritesArticleLink").attr('href',location);
  				
				tb_init('#favorites a#favoritesArticleLink');//pass where to apply thickbox
  			}	
  			else
  			{
  				if (data == 'login|untracked')
  				{
  					var location = 'http://pl-2.lh/profil/dodaj-artykul-do-schowka/'+articleId;
  					$("#favoritesArticleLink").attr('href',location);
  					$("#favoritesArticleLink").removeAttr('class');
  				}
  				else if (data == 'login|tracked')
  					$("#favorites").remove();
  			}
		});
	
}

(function($) {
	$.fn.buildComments = function(params) {
		params.rootElement = this;
		new ArticleComments(params);
	};
})(jQuery);

function ArticleComments(params) {
	var _this = this;
	var defaults = {
		docId: 0, //Id dokumentu
		limit: 3, //Ilość artykułów na stronie
		pageNr: 1, //Która strona komentarzy (od 1)
		host: '', //Host z jakiego mają być sciągane informacje o komentarzach
		forumId: 0, //Do jakiego forum ma zostać dodany wątek
		isFrozen: false, //Czy jest zablokowana możliwość komentowania
		rootElement: null //Element html w którym znajdują się komentarze
	};
	
	this.params = $.extend(defaults, params);
	this.thread = null; //Informacje o wątku
	this.user = null; //Informacje o userze (jeśli jest zalogowany)
		
	//Elementy komentarzy
	this.header = null;
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url: 'http://'+_this.params.host + "/komentarze/ajax?action=getArticleCommentsInfo",
		data: "offset="+_this.params.pageNr+"&articleId="+_this.params.docId+"&postsOnPage="+_this.params.limit,
		success: function(json) {
			_this.thread = json.thread;
			_this.user = json.user;
			
			//Nagłówek komentarzy
			_this.header = $('<div class="commentsHeader"><button type="button"><img src="http://pl-2.lh/subd-g/p/pl-2.lh/prawo/_i/skomentuj_button.gif"></button><span class="countInfo">Liczba komentarzy: '+json.thread.post_count+'</span></div>');
			_this.header.appendTo(_this.params.rootElement);
			//_this.header.find('button').bind('click', function() {
				_this.showNewCommentForm();
			//});
			
			if (_this.thread.post_count > 0) {
				_this.showComments();
			} else {
				//_this.buildNoCommentsInfo();
			}
		},
		complete: function () {
			//$('#ajaxLoader').css('display','none');	
		}
	});
	
	this.trim = function(arg) { 
		if (!arg) {
			return '';
		}
	    return arg.replace(/^\s+/, '').replace(/\s+$/, '');
	};
	
	this.showComments = function() {
		for (var i = 0; i < this.thread.comments.length; i++) {
			var post 	= this.thread.comments[i];
			var time    = post['time'];
			var login   = post['userLogin'];
			var content = post['content'];
			var info    = '';
			if (post['deleted'] == 1) {
				info = '(POST USUNIĘTY)';
			}
					
			var comment = $('<table class="comment"><tr><td class="avatar"></td><td><div class="existingComment"></div></td></tr></table>').appendTo(this.params.rootElement);
			_this.getAvatar(post['userAvatar'], post['avatarWidth'], post['avatarHeight']).appendTo(comment.find('.avatar'));
			var intro = $("<div class='commentIntro'>dodano: <strong>"+time+"</strong> przez:<strong> "+login+"</strong> "+info+" </div>").appendTo(comment.find('.existingComment'));
			var content = $("<div class='commentContent'><a href='"+this.thread.url+"'>"+content+"</a></div>").appendTo(comment.find('.existingComment'));
			$("<div class='spacer'></div>").appendTo(this.params.rootElement);
		}
			
		if (this.thread.url) {
			$('<a class="threadLink" alt="zobacz całą dyskusję" title="Zobacz całą dyskusję na forum" href="'+this.thread.url+'"><img src="http://pl-2.lh/subd-g/p/pl-2.lh/prawo/_i/zobacz_cala_dyskusje.png"></a>').appendTo(this.params.rootElement);
		}
	};
	
	this.buildNewCommentForm = function() {
		var newComment = $('<table class="comment"><tr><td class="avatar"></td><td><form method="post"><div class="newComment"></div></form></td></tr></table>').insertAfter(_this.header);
		var form = newComment.find('form');
		form.attr('action', 'http://'+_this.params.host+"/komentarze/ajax?action=addArticleComment");
		var commentAuthor = $('<input type="text" class="nick" value="" name="nick">'); 
		var commentContent = $('<textarea name="comment"></textarea>');
		var formContent = newComment.find('.newComment');
		
		$('<input type="hidden" name="articleId" value="'+_this.params.docId+'"/>').appendTo(formContent);
		$('<input type="hidden" name="forumId" value="'+_this.params.forumId+'"/>').appendTo(formContent);
		var as = $('<input type="hidden" id="as" name="as" value=""/>').appendTo(formContent);
		
		var formTable = $('<table><tr><td class="label">Autor:</td><td></td></tr><tr><td class="label">Komentarz:</td><td></td></tr></table>').appendTo(formContent);
		formTable.find('tr:eq(1) td:eq(1)').append(commentContent);
		
		if (_this.user) {
			_this.getAvatar(_this.user.avatar, _this.user.avatarWidth, _this.user.avatarHeight).appendTo(newComment.find('.avatar'));
			formTable.find('tr:eq(0) td:eq(1)').append($('<span>'+_this.user.login+'</span>'));
			//commentContent.focus();
		} else {
			_this.getAvatar().appendTo(newComment.find('.avatar'));
			formTable.find('tr:eq(0) td:eq(1)').append(commentAuthor);
			var loginInfo = $('<div class="profil_status2">Chcesz skomentować artykuł? <strong><a href="?ajax=1&amp;action=get_login_form&amp;height=262&amp;width=427" class="u tb">Zaloguj się</a></strong> lub wypowiedz się jako gość:<br /><br /></div>').prependTo(formContent);
			tb_init(loginInfo.find('a'));
			//commentAuthor.focus();
		}
		
		var submitButton = $("<input type='submit' value='Dodaj komentarz' class='addCommentButton' alt='Dodaj komentarz' title='Dodaj komentarz' />").appendTo(formContent); 
		$("<div class='spacer'></div>").insertAfter(newComment);
		
		commentContent.bind('blur', function() {
			as.attr('value', 'pronto');
		});
		
		form.bind('submit', function() {
			var content = _this.trim(commentContent.val());
			commentContent.nextAll().remove();
			if (content) {
				return true;
			} else {
				$("<span class='error' style='color: red;'>Prosimy podać treść komentarza</span>").insertAfter(commentContent);
				return false;
			}
		});
	};
	
	this.buildNoCommentsInfo = function() {
		var mainElement = $('<div id="noCommentsCloud"></div>').appendTo(_this.params.rootElement);
		$('<div class="center padd5" style="padding-top: 10px; background: #E3E3E3">Ten artykuł nie był jeszcze skomentowany</div><div class="center" style="font-size: 18px; padding-top: 25px; height: 130px; background: #E3E3E3 url(http://pl-2.lh/subd-g/portal/pl-2.lh/kobieta/chmorka.png) no-repeat 50% 0;" ><span>Podziel się z nami<br />swoją opinią</span><br /><br /><span class="link" style="color: white;">Rozpocznij dyskusję</span></div><div class="center" style="height: 40px; background: #E3E3E3 url(http://pl-2.lh/subd-g/portal/pl-2.lh/kobieta/chmorka.png) no-repeat 50% -155px;" >lub<br />Sprawdź gdzie prowadzone są najciekawsze rozmowy</div>').appendTo(mainElement);
		
		mainElement.find('.link')
		.hover(function(){
			$(this).css('text-decoration', 'underline');
		}, function() {
			$(this).css('text-decoration', 'none');
		})
		.bind('click', function(){
			_this.showNewCommentForm();
		});
	};
	
	this.showNewCommentForm = function() {
		$('#noCommentsCloud').remove();
		this.header.find('button').remove();
		this.buildNewCommentForm();
	};
	
	/***
	 * Przez ta funkcje powinno sie przepuszczac kazdy wyswietlany w komentarzach avatar
	 * @param fileName
	 * @param width
	 * @param height
	 * @returns Element img z avatarem
	 */
	this.getAvatar = function(fileName, width, height) {
		//Domyślny avatar
		var obj = {
			url: 'http://pl-2.lh/subd-g/p/pl-2.lh/biznes/_i/ico-guest.png',
			width: 50,
			height: 50
		};
		if (fileName && width && height) {
			if (width > height) {
				obj.height = height/(width/50);
				obj.width  = 50;
			} else {
				obj.width = width/(height/50);
				obj.height = 50;
			}
			obj.url = 'http://pl-2.lh/subd-g/wieszjak/image/avatar/' + fileName;
		}
		return $("<img src='"+obj.url+"' width='"+obj.width+"' height='"+obj.height+"'/>");
	};
}
