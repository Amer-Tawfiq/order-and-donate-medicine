// // استرجاع السلة من localStorage أو تعيينها كقائمة فارغة
// let cart = JSON.parse(localStorage.getItem('cart')) || [];


// // تحديث عرض سلة المشتريات والمجموع الكلي
// function updateCartDisplay() {
//     const cartItems = document.getElementById('cart-items');
//     const totalPriceElement = document.getElementById('total-price');

//     cartItems.innerHTML = ''; // مسح العناصر الحالية في السلة
//     let totalPrice = 0; // تصفير المجموع قبل الحساب

//     if (cart.length === 0) {
//         cartItems.innerHTML = '<p>Your cart is empty.</p>';
//         totalPriceElement.textContent = "0"; // تحديث المجموع
//     } else {
//         // عرض كل عنصر في السلة
//         cart.forEach(item => {
//             const div = document.createElement('div');
//             div.classList.add('cart-item');
//             div.innerHTML = `
//                 <p>${item.name} - ${item.quantity} × ${item.price} SR</p>
//                 <button class="remove-btn" onclick="removeFromCart('${item.name}')">Delete</button>
//             `;
//             cartItems.appendChild(div);

//             // حساب المجموع الكلي
//             totalPrice += item.quantity * item.price;
//         });

//         // تحديث المجموع في الصفحة
//         totalPriceElement.textContent = totalPrice.toFixed(2);
//     }
// }


// // إزالة دواء من السلة
// function removeFromCart(name) {
//     const itemIndex = cart.findIndex(item => item.name === name);
//     if (itemIndex !== -1) {
//         cart.splice(itemIndex, 1); // إزالة الدواء من المصفوفة
//         localStorage.setItem('cart', JSON.stringify(cart)); // تحديث localStorage
//         updateCartDisplay(); // تحديث العرض
//     }
// }

// // إتمام الدفع
// function checkout() {
//     if (cart.length === 0) {
//         alert('Your cart is empty. !');
//     } else {
//         alert('Thank you. We will contact you ');
//         localStorage.removeItem('cart'); // مسح السلة بعد الدفع
//         cart = [];
//         updateCartDisplay();
//     }
// }

// // تحميل سلة المشتريات عند فتح الصفحة
// window.onload = function() {
//     updateCartDisplay(); // تحديث السلة عند تحميل الصفحة
// };

// // إضافة دواء إلى السلة
// function addToCart(name, price) {
//     const existingItem = cart.find(item => item.name === name);

//     if (existingItem) {
//         // إذا كان الدواء موجود في السلة، نقوم بتحديث الكمية
//         existingItem.quantity++;
//     } else {
//         // إذا لم يكن الدواء موجود في السلة، نقوم بإضافته
//         cart.push({ name: name, price: price, quantity: 1 });
//     }

//     // حفظ السلة في localStorage
//     localStorage.setItem('cart', JSON.stringify(cart));
//     updateCartDisplay(); // تحديث السلة
// }

// // الكود التالي يمكن ربطه بعناصر الأدوية في الصفحة، بحيث يتم استدعاء addToCart عند الضغط على زر إضافة الدواء
// // مثال: <button onclick="addToCart('Panadol', 5)">إضافة إلى السلة</button>
// استرجاع السلة من localStorage أو تعيينها كقائمة فارغة
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// تحديث عرض سلة المشتريات
function updateCartDisplay() {
    const cartItems = document.getElementById('cart-items');

    cartItems.innerHTML = ''; // مسح العناصر الحالية في السلة

    if (cart.length === 0) {
        cartItems.innerHTML = '<p>Your cart is empty.</p>';
    } else {
        // عرض كل عنصر في السلة
        cart.forEach(item => {
            const div = document.createElement('div');
            div.classList.add('cart-item');
            div.innerHTML = `
                <p>${item.name} - ${item.quantity}</p>
                <button class="remove-btn" onclick="removeFromCart('${item.name}')">Delete</button>
            `;
            cartItems.appendChild(div);
        });
    }
}

// إزالة دواء من السلة
function removeFromCart(name) {
    const itemIndex = cart.findIndex(item => item.name === name);
    if (itemIndex !== -1) {
        cart.splice(itemIndex, 1); // إزالة الدواء من المصفوفة
        localStorage.setItem('cart', JSON.stringify(cart)); // تحديث localStorage
        updateCartDisplay(); // تحديث العرض
    }
}

// إتمام الدفع
function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty. !');
    } else {
        alert('Thank you. We will contact you');
        localStorage.removeItem('cart'); // مسح السلة بعد الدفع
        cart = [];
        updateCartDisplay();
    }
}

// تحميل سلة المشتريات عند فتح الصفحة
window.onload = function() {
    updateCartDisplay(); // تحديث السلة عند تحميل الصفحة
};

// إضافة دواء إلى السلة
function addToCart(name) {
    const existingItem = cart.find(item => item.name === name);

    if (existingItem) {
        // إذا كان الدواء موجود في السلة، نقوم بتحديث الكمية
        existingItem.quantity++;
    } else {
        // إذا لم يكن الدواء موجود في السلة، نقوم بإضافته
        cart.push({ name: name, quantity: 1 });
    }

    // حفظ السلة في localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay(); // تحديث السلة
}
