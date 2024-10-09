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
document.querySelector('#myBtn').addEventListener('click',function(){
  window.scrollTo({
      top:0,
      left:0,
      behavior:"smooth"

  });
})


