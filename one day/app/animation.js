var phone = window.matchMedia("(max-width: 928px)");
const f_item = document.getElementById('first-box-item'),
        last_section = document.getElementById('last_section_box'),
        l_item = document.getElementById('last-box-item');
    if (phone.matches) {
        f_item.style.left="unset";
        l_item.style.right="unset";
        last_section.style.transform = "unset";
    } else {
      window.addEventListener("scroll",()=>{
          if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
              f_item.style.left = "0";
              l_item.style.right = "0";
          }else{
              f_item.style.left = "-50%";
              l_item.style.right = "-50%";
          }
          if (document.body.scrollTop > 900 || document.documentElement.scrollTop > 900) {
              last_section_box.style.animation = "animlastsection 1s forwards alternate";
          }else{
              last_section_box.style.animation = "none";
          }
      });
    }