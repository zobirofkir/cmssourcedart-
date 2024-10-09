window.onscroll = function() {scrollFunction()};

function scrollFunction() {

  if( document.getElementById("myBtn")!=null){

  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
  
  }

}



// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  window.scrollTo({
      top:0,
      left:0,
      behavior:"smooth"

  });
}


// When the user clicks on the sherch button
function rechercher(){
  var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
       
  if(this.readyState==4 || this.status==200){
      var data=this.responseText;
      setTimeout(function(){
            $('.info').css("display","flex");
           document.getElementById("info").innerHTML=data;
           $('.btn-search').removeClass('animate')           
           réniGlightbox();

      },3500);

  }  
 }

 var lien="";
  if($('title').text()=="Accueil")
  lien="./E-poster/";


xhr.open("POST",lien+"PHP/iposter.php",true);
xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

var titre=document.getElementById("titre").value;
var data="titre="+titre+"&op=1";
xhr.send(data);


}




function réniGlightbox(){
  $("#glightbox").remove();
  $("#main").remove();
  var lien="";
  if($('title').text()=="Accueil")
  lien="./E-poster/";

  $("body").append('<script class="test" src="'+lien+'js/glightbox.min.js" id="glightbox"></script>');
  $("body").append('<script src="'+lien+'js/main.js" id="main"></script>');

  var glightbox = GLightbox({
   selector: '.glightbox'
  });
}



function animateButton(e) {

  e.preventDefault;
  //reset animation
  e.target.classList.remove('animate');
  
  e.target.classList.add('animate');
  
 
};

function getAll(){
  var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){       
      if(this.readyState==4 || this.status==200){
          var data=this.responseText;
          setTimeout(function(){
            $('.info').css("display","flex");
            document.getElementById("info").innerHTML=data;
            $('#getAll').removeClass('animate')           

            réniGlightbox();
 
          },3500);
      }  
 }
 var lien="";
 if($('title').text()=="Accueil")
 lien="./E-poster/";
xhr.open("POST",lien+"PHP/iposter.php",true);
xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
var data="op=2";
xhr.send(data);
}


$(".btn-search").on("click",(event)=>{
  animateButton(event);
  rechercher();

})








$("#getAll").on("click",(event)=>{
  getAll();
  animateButton(event);

})



document.querySelectorAll('.bt button').forEach(btn=>{
  btn.addEventListener('click',function(event){

    

    animateButton(event);
    var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function()
        {  

            if(this.readyState==4 || this.status==200){
                var data=this.responseText;
                document.getElementById("info").innerHTML=data;
                réniGlightbox();
                setTimeout(function(){
                  $('.bt').fadeOut();
                  $('.info').css("display","flex");
                  $('#myBtnreteur').fadeIn();
                  event.target.classList.remove('animate');
                  
                  

                  $('.welcome-msg').text(type)

                },3500);
            }  
        }
        xhr.open("POST","./E-poster/PHP/iposter.php",true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        var type=$(this).text();
        var data="op=3&type="+type;
        xhr.send(data);
     
  })
})

if(document.querySelector('#myBtnreteur'))
document.querySelector('#myBtnreteur').addEventListener('click',function(){

  document.querySelector('.contenteposter').scrollTo({
    top:0,
    left:0,
    behavior:"smooth"

});
  
})

if(document.querySelector('.contenteposter'))
document.querySelector('.contenteposter').onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.querySelector('.contenteposter').scrollTop > 20) {
    document.getElementById("myBtnreteur").style.display = "block";
  } else {
    document.getElementById("myBtnreteur").style.display = "none";
  }
}


