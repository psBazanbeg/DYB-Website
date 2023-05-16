//change navbar style on scroll

window.addEventListener('scroll', () => {
    document.querySelector('nav').classList.toggle
    ('window-scroll', window.scrollY > 0)
})

// show/hide faq answers

const faqs = document.querySelectorAll('.faq');


faqs.forEach(faq => {
    faq.addEventListener('click', () => {
        faq.classList.toggle('open');

        //change icon
        const icon = faq.querySelector('.faq__icons i');

        if(icon.className === 'uil uil-plus-circle'){
            icon.className = "uil uil-minus-circle";
        } else {
            icon.className = "uil uil-plus-circle";
        }
    })
})

//hide sub nav bar icon when click on it

/*const navbar_ul = document.getElementById('subNav');

document.onclick = function(e){
    if(e.target.id == 'subNav'){
        navbar_ul.classList.remove('active');
    }
}*/


// show/hide nav menu

const menu = document.querySelector(".nav__menu");
const openBtn = document.querySelector("#open-menu-btn");
const closeBtn = document.querySelector("#close-menu-btn");

openBtn.addEventListener('click', ()=>{  //open nav menu
    menu.style.display = "flex";
    closeBtn.style.display = "inline-block";
    openBtn.style.display = "none";
    
})

closeBtn.addEventListener('click', ()=>{  //close nav menu
    menu.style.display = "none";
    closeBtn.style.display = "none";
    openBtn.style.display = "inline-block";   
})
/*
pageBody.addEventListener('click', ()=>{  //close nav menu
    menu.style.display = "none";
    closeBtn.style.display = "none";
    openBtn.style.display = "inline-block";   
})*/

/* above methode can be implemented like this method also

//create the method
const closeNav = () => {
    menu.style.display = "none";
    closeBtn.style.display = "none";
    openBtn.style.display = "inline-block"; 
}

//ans called the method here
closeBtn.addEventListener('click', closeNav)

*/

/* 

const body = document.getElementById('.container');

document.onclick = function(e){
    if(e.target.id !=='.container'){
        menu.classList.remove('active');
    }
}
*/

/*
window.onclick = function(event){
    if(!event.target.matches(".barbtn")){
        var dd = document.querySelector(".nav__menu");
        for(var i=0; i<dd.length; i++){
            var x = dd[i];
            if(x.classList.contains("show")){
                x.classList.remove("show");
            }
        }
    }
}
*/


