$(function(){
  

  $.ajax({
        url: 'central-notificacoes-api.php',
        type: 'POST',
        data: {'acao':'atualizar'},
        success: function(data){
          if(data != '0'){

            checa_nao_lidos_div(data);


            $('.tp-submenu-notificacao .tp-central-notificacao-dropdown .tp-central-notificacao-dropdown-body').html(data);
            
          }
        }
      });


  $('.tp-submenu-notificacao__box').click( function(){
        var $suspensa = $('.tp-central-notificacao-dropdown');
    
        var width = $(window).width();
        if(width < 600){
          $('.tp-central-notificacao-dropdown').width(width);
          $('.tp-central-notificacao-dropdown').css('left','unset');
          $('.tp-central-notificacao-dropdown').css('right','0px');
        }
        
        if($suspensa.is(':visible'))
            $suspensa.hide(100);
            else
            $suspensa.show(0);
        });

      $('body').on('click',function(e){
        var $suspensa = $('.tp-central-notificacao-dropdown');

        let caixa_not = document.querySelector('.tp-submenu-notificacao');

        if(!caixa_not.contains(e.target)){
          $suspensa.hide(100);
        }
      });

       $('.tp-central-notificacao-dropdown-heading-fechar').on('click',function(){
        var $suspensa = $('.tp-central-notificacao-dropdown');
        $suspensa.hide(100);});
       

    $('.tp-submenu-notificacao').on('click','.marcar-lido', function(){
      var id = $(this).attr('data-codigo');
      var $this = $(this);
      var $caixa = $(this).parent().parent();
      
      
       
      $caixa.addClass('blur');
      $.ajax({
        url: 'central-notificacoes-api.php',
        type: 'POST',
        data: {id: id, 'acao':'lido'},
        success: function(data){
          if(data == 'S'){
            $this.children('.fa').removeClass('fa-circle').addClass('fa-circle-o');
            $this.attr('data-balao','Marcar não Lido');
            $caixa.removeClass('notify-nao-lido');
          }else{
            $this.children('.fa').removeClass('fa-circle-o').addClass('fa-circle');
            $this.attr('data-balao','Marcar Lido');
            
            $caixa.addClass('notify-nao-lido');
          }
          $caixa.removeClass('blur');
          checa_nao_lidos_div();
        }
      });
    });


    setInterval(function(){

     if($('.tp-central-notificacao-dropdown').is(':visible'))
        return true;

      $.ajax({
        url: 'central-notificacoes-api.php',
        type: 'POST',
        data: {'acao':'atualizar'},
        success: function(data){
          if(data != '0'){

            checa_nao_lidos_div(data);


            $('.tp-submenu-notificacao .tp-central-notificacao-dropdown .tp-central-notificacao-dropdown-body').html(data);
            
          }
        }
      });
    }, 180000);


    function checa_nao_lidos_div(data = $('.tp-central-notificacao-dropdown-body').html()){
        if($(data).hasClass('notify-nao-lido')){
                $('.tp-submenu-notificacao .tp-submenu-persona_User_Img .pulse').remove();
                $('.tp-submenu-notificacao .tp-submenu-persona_User_Img').append('<span class="pulse">1</span>');
                $('.tp-submenu-notificacao .tp-submenu-persona_User_Img i').addClass('notificacoes-nao-lidas');
            }
            
            if(!$(data).hasClass('notify-nao-lido') && $('.tp-submenu-notificacao .tp-submenu-persona_User_Img .pulse').length){
                $('.tp-submenu-notificacao .tp-submenu-persona_User_Img .pulse').remove();
                $('.tp-submenu-notificacao .tp-submenu-persona_User_Img i').removeClass('notificacoes-nao-lidas');
            }
    }

  });