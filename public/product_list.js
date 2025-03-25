// <!-- js cho nút bấm thêm sp yêu thích   -->
function toggleHeart(button) {
  const img = button.querySelector('.heart-icon');
  // Kiểm tra và thay đổi src của hình ảnh
  if (img.src.includes('prd_list_heart.png')) {
    img.src = 'img/prd_heart_full.png'; // Chuyển sang hình heart_full
  } else {
    img.src = 'img/prd_list_heart.png'; // Chuyển về hình heart
  }
}

// popup cho desk
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


//popup cho tab
document.addEventListener('DOMContentLoaded', () => {
const avatarButton = document.getElementById('menuButton');
const popup = document.getElementById('popupMenufortablet');

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


// Mở popup khi nhấn vào "VIẾT BÌNH LUẬN"
document.getElementById('write-comment').addEventListener('click', function(e) {
e.preventDefault();
document.getElementById('comment-popup').classList.remove('hidden');
});

// Đóng popup khi nhấn vào nút ×
document.getElementById('close-popup').addEventListener('click', function() {
document.getElementById('comment-popup').classList.add('hidden');
});

// Đóng popup khi nhấn vào nút Hủy
document.getElementById('cancel-btn').addEventListener('click', function() {
document.getElementById('comment-popup').classList.add('hidden');
});

// Mã JavaScript để điều khiển việc hiển thị popup và ẩn navbar
const commentPopup = document.getElementById('comment-popup');
const navbar = document.getElementById('navbar');
const closeButton = document.getElementById('close-popup');

// Mở popup và ẩn navbar
function openPopup() {
  commentPopup.classList.remove('hidden');  // Hiện popup
  navbar.classList.add('hidden');           // Ẩn navbar
}

// Đóng popup và hiện navbar
function closePopup() {
  commentPopup.classList.add('hidden');    // Ẩn popup
  navbar.classList.remove('hidden');       // Hiện lại navbar
}

// Mở popup khi bấm vào phần tử comment-popup
commentPopup.addEventListener('click', openPopup);

// Đóng popup khi bấm vào nút "Hủy"
closeButton.addEventListener('click', closePopup);


//tăng số lượng sản phẩm 
const decreaseButton = document.getElementById('decrease');
const increaseButton = document.getElementById('increase');
const quantitySpan = document.getElementById('quantity');
                                
let quantity = 1;
decreaseButton.addEventListener('click', () => {
                                    
  if (quantity > 1) {
    quantity--;
    quantitySpan.textContent = quantity;
  }
});
increaseButton.addEventListener('click', () => {
  quantity++;
  quantitySpan.textContent = quantity;
});