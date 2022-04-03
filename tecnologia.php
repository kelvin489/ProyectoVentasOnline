<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Productos</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/tec-style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
	<input type="checkbox" id="check2">
	<header>
		<img class="logo" src="img/logohome.png" width="150">
		
		<div class="buscador">
			<form>
				<input class="text" type="text" name="" placeholder="Buscar...">
				<input type="submit" name="" value="Buscar">
			</form>
		</div>
		<nav>
			<ul class="nav_links"> 
				<li><a href="home.php">Inicio</a></li>
				<li><a href="home.php #categorias">Categorias</a></li>
				<li><a href="#titulo-2">Ofertas</a></li>
			</ul>
		</nav>
		<div>
		<a class="cta" href="administradores/login.php"><button>Iniciar Sesión</button></a>
		<i class="fa-solid fa-cart-shopping" id="cart-icon"></i>
		</div>
		<div class="cart">
	    	<h2 class="cart-title">Añade al Carrito</h2>
	    	<div class="cart-content">
	    		
	    	</div>
	    	<div class="total">
	    		<div class="total-title">Total</div>
	    		<div class="total-price">S/0</div>
	    	</div>

	    	<button type="button" class="btn-buy">Buy Now</button>

	    	<i class="fa-solid fa-xmark" id="close-cart"></i>

	    </div>

		</div>
		<label for="check2" class="bar">
	    	<span class="fa fa-bars" id="bars"></span>
	    	<span class="fa fa-times" id="times"></span>
	    </label>
	    
	</header>
	<!--------------SLIDER------------------->
	
	<div class="slider-3">
		<img src="img/banner.jpg" class="img__slider active">
		<img src="img/banner6.png" class="img__slider">
		<img src="img/banner4.png" class="img__slider">
			<div class="suivant">
			&#10095;
			</div>
			<div class="precedent">
			&#10094;
			</div>
	</div>

	<!------------SECTION-------------------->
	<section class="shop container">
		<h2 class="section-title">Lo más vendido</h2>

		<div class="shop-content">
			<div class="product-box">
				<img src="img/1.jpg" class="product-img">
				<h2 class="product-title">Samsung Galaxy A52</h2>
				<span class="price">S/ 250</span>
				<i class="fa-solid fa-cart-shopping add-cart"></i>
			</div>

			<div class="product-box">
				<img src="img/4.jpg" class="product-img">
				<h2 class="product-title">Lenovo ThinpkPad</h2>
				<span class="price">S/ 500</span>
				<i class="fa-solid fa-cart-shopping add-cart"></i>
			</div>

			<div class="product-box">
				<img src="img/2.jpg" class="product-img">
				<h2 class="product-title">Xiaomi Earbuds</h2>
				<span class="price">S/ 120</span>
				<i class="fa-solid fa-cart-shopping add-cart"></i>
			</div>

			<div class="product-box">
				<img src="img/3.jpg" class="product-img">
				<h2 class="product-title">Iphone 13 Pro Max</h2>
				<span class="price">S/750</span>
				<i class="fa-solid fa-cart-shopping add-cart"></i>
			</div>
		</div>
	</section>
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/script-tec.js"></script>
</body>
</html>