const nav = document.getElementsByTagName('nav')[0],
      menu = document.getElementsByClassName('toggle-menu')[0],
      dark_mode = document.getElementsByClassName('dark_mode')[0],
      info_ttg = document.getElementsByClassName('info_ttg')[0];

      menu.addEventListener('click',()=>{
        nav.classList.toggle('active-nav');
        dark_mode.addEventListener('click',()=>{
          if(nav.classList.contains('active-nav')){
            nav.classList.remove('active-nav');
          }
        });
        info_ttg.addEventListener('click',()=>{
          if(nav.classList.contains('active-nav')){
            nav.classList.remove('active-nav');
          }
        });
      });

      //scroll bar
      var total_height = document.body.scrollHeight - window.innerHeight,
          scroller = document.getElementById('own-scroll-bar');
      window.addEventListener("scroll",()=>{
        scroller.style.height = (window.pageYOffset / total_height) * 100 + "%";
      });
  // scroll start
      function scroll_start(){
        document.getElementById('second-section').scrollIntoView({behavior:"smooth",block:"start"});
      }
      function scroll_info(){
        document.getElementById('last-section').scrollIntoView({behavior:"smooth",block:"start"});
      }
      function scroll_to_top(){
        window.scrollTo({behavior:"smooth",top: 0});
      }
      // scroll end
      