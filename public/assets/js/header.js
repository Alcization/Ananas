//script cho popup nút sản phẩm
    let div = document.getElementById("myNav");
    let mbOverlay = document.getElementById("mobileNav");

    let flag = 0;

    function openOverlay() {
        div.style.display = "flex";
    }

    function closeOverlay() {
        div.style.display = "none";
    }

    function mobileOverlay() {
        if(flag === 0) {
            mbOverlay.style.display = "flex";
            flag = 1;
        } else {
            mbOverlay.style.display = "none";
            flag = 0;
        }
    }

// popup cho menu popup
    document.addEventListener('DOMContentLoaded', () => {
    const avatarButton = document.getElementById('avatarButton');
    const popup = document.getElementById('popupMenu');
    
    // toggle popup khi bấm nút avatar
    avatarButton.addEventListener('click', (event) => {
      event.stopPropagation(); // ngăn chặn sự kiện bấm lan ra ngoài
      popup.classList.toggle('hidden');
    });
    
    // ẩn popup khi bấm ra ngoài
    document.addEventListener('click', () => {
      if (!popup.classList.contains('hidden')) {
        popup.classList.add('hidden');
      }
    });
    
    // ngăn popup bị ẩn khi bấm bên trong popup
    popup.addEventListener('click', (event) => {
      event.stopPropagation();
    });
    });