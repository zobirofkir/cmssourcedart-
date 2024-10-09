window.onload = function () {
  $('.btnjr1').addClass('btnactive');
  $('.jr1').addClass('jouractive');
  vedioSource('','')
};
 
function vedioSource(source,id){  

 var dt=null;

  var Go=()=>{
    document.getElementById("cmclive").href=""+source+"";
     $('.logo').fadeIn("slow");
     
      document.querySelectorAll('.btnplay').forEach(btn=>{
        if(btn!=id.children[2]){
          $(btn).fadeOut();
          $(btn).parent().parent().removeClass('active')
        }
        else{
          $(btn).fadeIn();
          $(btn).parent().parent().addClass('active')
        }
      })
      réniGlightbox(source)
      
  }
 
  if(source!=""){
    

    if(id.className=="code"){

      Swal.fire({
        title: 'Entrez votre code modératrice',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Valider',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {

          var ttc = new XMLHttpRequest();
              ttc.onreadystatechange=function(){
                  if(this.status==200 && this.readyState==4){
                          var data=this.responseText;
                          if(data!=1){
                        

                            Swal.fire({
                              position: 'top-end',
                              icon: 'error',
                              title: "code invalide",
                              showConfirmButton: false,
                              timer: 1500
                            })
                          }
                            
                            else{
                              Go();
                              dt=1;
                              bol=true;
                            }
                          
                  }
              }
              ttc.open("POST",'./PHP/getIdsale.php',true);
              ttc.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
              var data="id="+login;
              ttc.send(data);


              
            
    
                
    
        },
       
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {

        
        
        if (result.isConfirmed) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "code Valide",
            showConfirmButton: false,
            timer: 1500
          })
        }
        
      })

    }

    else{
     Go();
     dt=1;
    }
    
  }

  else{
    document.getElementById("cmclive").href="./img/app/fiche new 3.jpg";
    $('.logo').fadeOut("slow");
    dt=1;
    réniGlightbox();
  }
  

  if(dt==null){
    $("#contentvedio").html('<div class="preloader1"></div>'); 
    $('.logo').fadeOut();
  }
   
}

  
function réniGlightbox(e){
  /*** Initiate glightbox ***/
  if(e){
    if (e.startsWith("https://youtu.be")) {
      var glightbox = GLightbox({
        selector: '.glightbox'
      });
      $("#glightbox").remove();
      $("head").append('<script src="./js/glightbox.min.js?v:0.02" id="glightbox"></script>');
      $("#contentvedio").html('<div class="preloader1"></div>');

      setTimeout(()=>{
        document.getElementById("cmclive").click();   
        $('.preloader1').hide('slow', function(){ $('.preloader1').remove(); });
        document.getElementById("cmclive").href="";  
      },1000) 
    }
    else if (e.startsWith("./videos")) {
      $("#contentvedio").html('<div class="preloader1"></div>');
      setTimeout(()=>{
        $('.preloader1').hide('slow', function(){ $('.preloader1').remove(); });
        
        $("#contentvedio").html('<video controls autoplay events currentTime volume  width="100%" height="100%"><source src="'+e+'" "></video> ');

          
        },1000) 
      }
    }else{
        $("#contentvedio").html('<img src="./img/app/fiche new 3.jpg" width="100%" height="100%" >');
 
  }

}


function logo(){
  $('.logo').fadeOut("slow");
  $(".plyr__volume button").click();
}

document.querySelector('.btnjr1').addEventListener('click',function(){
    
    $('.btnjr').removeClass('btnactive')
    $('.jr').removeClass('jouractive')
    
    $(this).addClass('btnactive')
    $('.jr1').addClass('jouractive')
    
})
