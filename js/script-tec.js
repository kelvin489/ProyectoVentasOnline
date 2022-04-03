let img__slider = document.getElementsByClassName('img__slider');
let etape = 0;
let nbr__img = img__slider.length;
let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');


function enleverActiveImages(){
	for (let i = 0; i < nbr__img ; i++) {
		img__slider[i].classList.remove('active');
		
	}
}

suivant.addEventListener('click', function(){
	etape++;
	if(etape >= nbr__img){
		etape = 0;
	}
	enleverActiveImages();
	img__slider[etape].classList.add('active');
})

precedent.addEventListener('click', function(){
	etape--;
	if(etape < 0){
		etape = nbr__img - 1;
	}
	enleverActiveImages();
	img__slider[etape].classList.add('active');
})

setInterval(function() {
	etape++;
	if(etape >= nbr__img){
		etape = 0;	
	}
	enleverActiveImages();
	img__slider[etape].classList.add('active');
}, 3000)
	

//-----------------------------
//-------Cart Shop------------
//----------------------------

let cartIcon = document.querySelector('#cart-icon');
let cart = document.querySelector('.cart');
let closeCart = document.querySelector('#close-cart');
//Open cart
cartIcon.onclick = () => {
	cart.classList.add("active");
};
//Close cart
closeCart.onclick = () => {
	cart.classList.remove("active");
};

if (document.readyState == 'loading'){
	document.addEventListener("DOMContentLoaded", ready);
} else{
	ready();
}

function ready(){
	var removeCartButtons = document.getElementsByClassName("cart-remove");
	console.log(removeCartButtons);
	for (var i = 0; i < removeCartButtons.length; i++) {
		var button = removeCartButtons[i];
		button.addEventListener("click", removeCartItem);
	}

	var quantityInputs = document.getElementsByClassName("cart-quantity");
	for (var i = 0; i < quantityInputs.length; i++){
		var input = quantityInputs[i];
		input.addEventListener("change", quantityChanged);
	}

	var addCart = document.getElementsByClassName("add-cart");
	for (var i = 0; i < addCart.length; i++){
		var button = addCart[i];
		button.addEventListener("click", addCartClicked);
	}

	document
	 .getElementsByClassName("btn-buy")[0]
	 .addEventListener("click", buyButtonClicked);
}

function buyButtonClicked() {
	alert('Your Order is placed');
	var cartContent = document.getElementsByClassName("cart-content")[0];
	while (cartContent.hasChildNodes()) {
		cartContent.removeChild(cartContent.firstChild);
	}
	updatetotal();
}

function removeCartItem(event) {
	var buttonClicked = event.target;
	buttonClicked.parentElement.remove();
	updatetotal();
}

function quantityChanged(event){
	var input = event.target;
	if (isNaN(input.value) || input.value <= 0) {
		input.value = 1;
	}
	updatetotal();
}
//ADD TO CART
function addCartClicked(event) {
	var button = event.target;
	var shopProducts = button.parentElement;
	var title = shopProducts.getElementsByClassName("product-title")[0].innerText;
	var price = shopProducts.getElementsByClassName("price")[0].innerText;
	var productImg = shopProducts.getElementsByClassName("product-img")[0].src;
	addProductToCart(title, price, productImg);
	updatetotal();
}

function addProductToCart(title, price, productImg) {
	var cartShopBox = document.createElement("div");
	cartShopBox.classList.add("cart-box");
	var cartItems = document.getElementsByClassName("cart-content")[0];
	var cartItemsNames = cartItems.getElementsByClassName("cart-product-title");
	for (var i = 0; i < cartItemsNames.length; i++){
		if (cartItemsNames[i].innerText == title) {
		swal('Ya ingreso el producto al carrito', '', 'success');
		return;
	  }
	}

var cartBoxContent = `<img src="${productImg}" class="cart-img">
	    			<div class="detail-box">
	    				<div class="cart-product-title">${title}</div>
	    				<div class="cart-price">${price}</div>
	    				<input type="number" value="1" class="cart-quantity">
	    			</div>
	    			<i class="fa-solid fa-trash-can cart-remove"></i>`;
cartShopBox.innerHTML = cartBoxContent;
cartItems.append(cartShopBox);
cartShopBox.getElementsByClassName("cart-remove")[0].addEventListener("click", removeCartItem);
cartShopBox.getElementsByClassName("cart-quantity")[0].addEventListener("change", quantityChanged);
}

//UPDATE TOTAL
function updatetotal() {
	var cartContent = document.getElementsByClassName("cart-content")[0];
	var cartBoxes = cartContent.getElementsByClassName("cart-box");
	var total = 0;
	for (var i = 0; i < cartBoxes.length; i++) {
		var cartBox = cartBoxes[i];
		var priceElement = cartBox.getElementsByClassName("cart-price")[0];
		var quantityElement = cartBox.getElementsByClassName("cart-quantity")[0];
		var price = parseFloat(priceElement.innerText.replace("S/",""));
		var quantity = quantityElement.value;
		total = total + price * quantity;
	}
	total = Math.round(total * 100) / 100;

	document.getElementsByClassName("total-price")[0].innerText = "S/" + total;
	
}

//--------------------------
//--------Header Hide Scroll---------
//--------------------------

var scroll1 = window.payeYOffset;
window.onscroll = function(){
	var scroll2 = window.pageYOffset;
	if (scroll1 > scroll2) {
		document.querySelector("header").style.top = "0";
		document.querySelector("#cart-icon").style.top = "35px";
	}else{
		document.querySelector("header").style.top = "-300px";
		document.querySelector("#cart-icon").style.top = "-100px";
	}
	scroll1 = scroll2;
}