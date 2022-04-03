const slides = document.querySelector(".slider").children;
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const indicator = document.querySelector(".indicator");
let index = 0;

	prev.addEventListener("click",function(){
		prevSlide();
		updateCircleIndicator();
		resetTimer();
	})

	next.addEventListener("click",function(){
		nextSlide();
		updateCircleIndicator();
		resetTimer();
	})

	// create circle indicators
	function circleIndicator(){
		for(let i=0; i< slides.length; i++){
			const div = document.createElement("div");
				  div.innerHTML=i+1;
				div.setAttribute("onclick","indicateSlide(this)")
				div.id=i;
				if(i==0){
					div.className="active";
				}
			   indicator.appendChild(div);
		}
	}

	circleIndicator();

	function indicateSlide(element){
		index=element.id;
		changeSlide();
		updateCircleIndicator();
	}

	function updateCircleIndicator(){
		for(let i=0; i<indicator.children.length; i++){
			indicator.children[i].classList.remove("active");
		}
		indicator.children[index].classList.add("active");
	}

	function prevSlide(){
		if (index==0){
			index=slides.length-1;
		}
		else{
			index--;
		}
		changeSlide();
	}

	function nextSlide(){
		if (index==slides.length-1){
			index=0;
		}
		else{
			index++;
		}

		changeSlide();
    }

    function changeSlide(){
    	for(let i=0; i<slides.length; i++){
    		slides[i].classList.remove("active")
    	}
    	slides[index].classList.add("active");
    }

    function resetTimer(){
    	clearInterval(timer);
    	timer=setInterval(autoPlay,4000);
    }

    function autoPlay(){
    	nextSlide();
    	updateCircleIndicator();
    }

    let timer = setInterval(autoPlay,4000);

//--------------------------
//--------Header Hide Scroll---------
//--------------------------

var scroll1 = window.payeYOffset;
window.onscroll = function(){
	var scroll2 = window.pageYOffset;
	if (scroll1 > scroll2) {
		document.querySelector("header").style.top = "0";
		document.querySelector(".action").style.top = "29px";
		document.querySelector("#cart-icon").style.top = "35px";
		document.querySelector(".title_user").style.top = "32px";
	}else{
		document.querySelector("header").style.top = "-300px";
		document.querySelector(".action").style.top = "-100px";
		document.querySelector("#cart-icon").style.top = "-100px";
		document.querySelector(".title_user").style.top = "-100px";
	}
	scroll1 = scroll2;
}

//--------------------------
//--------User DROPDOWN---------
//--------------------------

function menuToggle(){
	const toggleMenu = document.querySelector('.menu');
	toggleMenu.classList.toggle('active');
}

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

//-------------------------------------------

function Funcion(){
	location.href="administradores/login.php";
}
function Logout(){
	swal({
		title: "Está seguro?",
		text: "AL PRESIONAR 'OK' CERRARÁ LA SESIÓN",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	  })
	  .then((willDelete) => {
		if (willDelete) {
		  swal("Sesión cerrada correctamente!", {
			icon: "success",
			buttons: true,
		  });
		  location.href="logout.php?logout=true";
		} else {
		  return;
		}
	  });
}