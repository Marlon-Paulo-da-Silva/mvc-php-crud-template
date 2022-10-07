/**
 * Excluir popup
 *
 */ 
  var excluirPopUp = document.querySelectorAll('.excluir-popup');
  
  
  
  for (var i = 0; i < excluirPopUp.length; i++) {
    excluirPopUp[i].addEventListener('click', function(){
      var _this = this;
      var codigo_popup =  _this.getAttribute('data-codigo');
      Swal.fire({
        title: 'Tem certeza de que deseja excluir a conversão?',
        text: "Essa ação é irreversível!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#9E9E9E',
        confirmButtonText: 'Excluir!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
          var xhttp = new XMLHttpRequest();
          //console.log('tr[data-codigo="'+codigo_popup+'"]');
          document.querySelector('tr[data-codigo="'+codigo_popup+'"]').remove();
          var data = new FormData();
          data.append('acao','apagar_popup');
          data.append('codigo',codigo_popup);
          xhttp.onreadystatechange = function() {
            if(this.readyState==1 ){
              /*
              Swal.fire(
                'Excluído!',
                'Conversão excluída com sucesso.',
                'success'
              );
              */
          }

          };
          xhttp.open("POST", "ferramentas_conversao_api.php", true);
          xhttp.send(data);

        }
      })


        
      

      
      
    });
    
  }



  $('.corpo-interno__chamada__btn').on('click', function(){

    var conteudo = $(this).attr('data-content-personalizado');
    var etapa1 = $(this).attr('data-content-etapa1');
    var etapa2 = $(this).attr('data-content-etapa2');
    var etapa3 = $(this).attr('data-content-etapa3');


    
        
    

    const swalWithBootstrapButtons = Swal.mixin({
        
        width: '85%',
        progressSteps: ['1', '2', '3', '4' , '5' ],
 
      }).queue([
        {
            
            text: conteudo,
            imageUrl: '/modulos/popup_conversao/imagens/exemplos/saida.jpg',
            html: "<h2><span>Intenção de saída</span> <a data-qual='intencao_saida' onclick='adicionar_exemplo(this)' class='adicionar_exemplo exemplos__btn exibir-em--verde'>Adicionar no site</a></h2> ",
            confirmButtonText: 'Próximo &rarr;', 
        },
        {
            
            imageUrl: '/modulos/popup_conversao/imagens/exemplos/alerta.jpg',
            html: "<h2><span>Alertas</span> <a data-qual='alerta_imoveis' onclick='adicionar_exemplo(this)' class='adicionar_exemplo exemplos__btn exibir-em--verde'>Adicionar no site</a></h2>",
            confirmButtonText: 'Próximo &rarr;',
        },
        {
            title: 'Youtube',
            text: conteudo,
            imageUrl: '/modulos/popup_conversao/imagens/exemplos/youtube.jpg',
            html: etapa3,
            confirmButtonText: 'Próximo &rarr; ',
        },
        {
            title: 'Formulários',
            text: conteudo,
            imageUrl: '/modulos/popup_conversao/imagens/exemplos/forms.jpg',
            html: etapa3,
            confirmButtonText: 'Próximo &rarr;',
        },
        {
            title: 'Facebook',
            text: conteudo,
            imageUrl: '/modulos/popup_conversao/imagens/exemplos/facebook.jpg',
            html: etapa3,
            confirmButtonText: 'Concluir ',
        },
      ])
      
      
 })

 function adicionar_exemplo(e){
     $this = $(e)
     qual = $this.attr('data-qual');
     $this.html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Carregando...').attr('onClick','');
     $.ajax({
        url: "ferramentas_conversao_api.php?acao=inserir_exemplo&qual="+qual, 
        method: 'GET',
        success: function(result){

            var res = JSON.parse(result);
            //console.log(res.status);
           

            setTimeout(function(){
                if(res.status == '200'){
                    location.reload();
                }else{
                    $this.text('Ocorreu um erro. Recarregue a página e tente novamente.');
                }
            },2000);
      }});
 }