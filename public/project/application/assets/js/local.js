
window.onload = function () {
  $('.btnjr1').addClass('btnactive');
  $('.jr1').addClass('jouractive');
  vedioSource('','')
};

  function vedioSource(src,e){  
   
    var dt=null;
 
     var Go=()=>{
           
         document.querySelectorAll('.btnplay').forEach(btn=>{
           if(btn!=e.children[1]){
             $(btn).fadeOut();
             $(btn).parent().parent().removeClass('active')
           }
           else{
             $(btn).fadeIn();
             $(btn).parent().parent().addClass('active')
           }
         
         })
         réniGlightbox(src);
     }
    
     if(src)
        Go();
 
 
     else{
       document.getElementById("cmclive").href="./img/app/fiche new 3.jpg";
       $('.logo').fadeOut("slow");
       
       réniGlightbox(src);
     }dt=1;
     
  
     if(dt==null){
       $("#contentvedio").html('<div class="preloader1"></div>'); 
     }
      
   
   }
   
   
 
 
 
 
   
   
   function réniGlightbox(e){
    console.log(e);
      $("#contentvedio").html('<div class="preloader1"></div>');
   
      setTimeout(()=>{
         
        $('.preloader1').hide('slow', function(){ $('.preloader1').remove(); });
        if(e){

          $("#contentvedio").html('<iframe src="'+e+'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
        }else{
          $("#contentvedio").html('<img src="./img/app/fiche new 3.jpg" width="100%" height="100%" >');

        }


      },1000) 
   }
 
document.querySelector('.btnjr1').addEventListener('click',function(){
    
    $('.btnjr').removeClass('btnactive')
    $('.jr').removeClass('jouractive')
    
    $(this).addClass('btnactive')
    $('.jr1').addClass('jouractive')
    
})

 
 
 
 