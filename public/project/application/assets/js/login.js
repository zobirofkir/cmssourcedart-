document.querySelector('.btncnx').addEventListener('click',()=>{
 var Nom=$('#name').val().trim();
        if(Nom!="" ){
            localStorage.setItem("user",Nom);
            window.location.href='./live/index.php';      
        
        }
})

window.addEventListener('load',()=>{
    var obj=localStorage.getItem('user');
    if(obj!=null){
        window.location.href='./live/index.php';      

    }
})
      






