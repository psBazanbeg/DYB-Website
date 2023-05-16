//change navbar style on scroll

window.addEventListener('scroll', () => {
    document.querySelector('nav').classList.toggle
    ('window-scroll', window.scrollY > 0)
})



//side bar toggle buttton

const sidebar = document.querySelector('aside');
const show_sidebar = document.querySelector('#show-sidebar-btn');
const hide_sidebar = document.querySelector('#hide-sidebar-btn');

show_sidebar.addEventListener('click', ()=>{
    sidebar.style.left = '0';
    show_sidebar.style.display = 'none';
    hide_sidebar.style.display = 'inline-block';
})

hide_sidebar.addEventListener('click', ()=>{
    sidebar.style.left = '-100%';
    show_sidebar.style.display = 'inline-block';
    hide_sidebar.style.display = 'none';
})




