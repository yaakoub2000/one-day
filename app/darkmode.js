//start dark mode
//start moons to top function
function moons(){
  const body_section = document.getElementById('darkmode_anim');
  const create = document.createElement('i');
            var size = Math.random() * 60;
  create.classList.add("moons_create","fa","fa-moon")
  create.style.width = 50 + size + 'px';
  create.style.height = 50 + size + 'px';
  create.style.left = Math.random() * innerWidth + 'px';
  body_section.appendChild(create);
  setTimeout(() => {
    create.remove();
}, 4000);
}
//end moons to top function
const dark_mode_btn = document.getElementsByClassName('dark_mode')[0],
      dark_icon = document.getElementById('dark-icon'),
      dark_link = document.getElementsByClassName('dark_toggle')[0];
      var d_Mode = localStorage.getItem('d_mode');
        // enable
        var enable_dark = () =>{
          dark_link.setAttribute("href","styles/main_dark.css");
          dark_icon.classList.replace("fa-moon","fa-sun")
          localStorage.setItem('d_mode','enabled');
        }
        // disable
        var disable_dark = () =>{
          dark_link.removeAttribute("href");
          dark_icon.classList.replace("fa-sun","fa-moon")
          localStorage.setItem('d_mode',null);
        }
        //check if already dark in storage
        if(d_Mode == 'enabled'){
          enable_dark();
        }
        dark_mode_btn.addEventListener("click",()=>{
          d_Mode = localStorage.getItem('d_mode');
          if(d_Mode !== 'enabled'){
            enable_dark();
          }else{
            disable_dark();
          }
        });
        

        //end dark mode