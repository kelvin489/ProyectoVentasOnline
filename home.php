<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home | Ventas</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
				<li><a href="">Inicio</a></li>
				<li><a href="#categorias">Categorias</a></li>
				<li><a href="#titulo-2">Ofertas</a></li>
			</ul>
		</nav>
		<div>
		<a class="cta" href="login.php"><button>Iniciar Sesión</button></a>
		<i class="fa-solid fa-cart-shopping" id="cart-icon"></i>
		<div class="cart">
	    	<h2 class="cart-title">Lista de Productos</h2>
	    	<div class="cart-content">
	    		
	    	</div>
	    	<div class="total">
	    		<div class="total-title">Total</div>
	    		<div class="total-price">S/0</div>
	    	</div>

	    	<button type="button" onclick="Funcion2();" class="btn-buy">Ver Compras &#10095;</button>

	    	<i class="fa-solid fa-xmark" id="close-cart"></i>

	    </div>

		</div>
		<label for="check2" class="bar">
	    	<span class="fa fa-bars" id="bars"></span>
	    	<span class="fa fa-times" id="times"></span>
	    </label>
	    <label class="user-car">
	    <a class="fas fa-user" href="login.php" id="login"></a>
	    </label>
	</header>

	<!-------------SLIDER----BANNER---------------->

	<section class="home">
		<div class="slider">
			<div class="slide active" style="background-image: url('img/banner2.png');">
				<div class="container">
					<div class="caption">
						<h1>Black Collection 2022</h1>
						<p>Lorem ipsum dummy text goes here.</p>
						<a href="">Shop Now</a>
					</div>
				</div>
			</div>
			<div class="slide" style="background-image: url('img/banner8.jpg');">
				<div class="container">
					<div class="caption">
						<h1>Best Phone's 2022</h1>
						<p>Lorem ipsum dummy text goes here.</p>
						<a href="">Shop Now</a>
					</div>
				</div>
			</div>
			<div class="slide" style="background-image: url('img/banner7.jpg');">
				<div class="container">
					<div class="caption">
						<h1>Oficine Day 2022</h1>
						<p>Lorem ipsum dummy text goes here.</p>
						<a href="">Shop Now</a>
					</div>
				</div>
			</div>
		</div>

		<div class="controls">
			<div class="prev">&#10094;</div>
			<div class="next">&#10095;</div>
		</div>

		<div class="indicator">		
		</div>
	</section>

	<!-----------SECCION------------>

	<section class="section_2">
		<h1 class="section_2_titulo">Resultados Sale´s Awards 2022</h1>
		<ul class="results">
			<li><i class="fa-solid fa-ranking-star"></i></li>
			<li><i class="fa-solid fa-store"></i></li>
			<li><i class="fa-solid fa-truck"></i></li>
		</ul>
	</section>

	<!-----------SECCION 1------------>


	<section class="discovery">
		<div class="container-row">
			<div class="section-header">
				<h2>Te puede interesar</h2>
			</div>
			<div class="discovery-body">
				<a class="advertising" href="#">
				<div class="advertising__info">
					<span class="advertising__info__title">MIN COMPRA S/349</span>
					<span class="advertising__info__text advertising__info__text--bold">HASTA S/120 DSCTO</span>
					<span class="advertising__info__text advertising__info__text--bold">CUPÓN: ELECTRO</span>
					<button class="advertising__info__button andes-button andes-button--small andes-button--loud" aria-label="HASTA S/150 DSCTO CUPÓN: ELECTRO, Ver más">Ver más</button>
				</div>
				<div class="advertising__image">
					<img decoding="async" class="electro" src="img/electro.jpg" alt="MIN COMPRA S/449">
				</div>	
				</a>
				<a class="advertising" href="#">
				<div class="advertising__info">
					<span class="advertising__info__title">MIN COMPRA S/649</span>
					<span class="advertising__info__text advertising__info__text--bold">HASTA S/150 DSCTO</span>
					<span class="advertising__info__text advertising__info__text--bold">CUPÓN: MUEBLES</span>
					<button class="advertising__info__button andes-button andes-button--small andes-button--loud" aria-label="HASTA S/150 DSCTO CUPÓN: ELECTRO, Ver más">Ver más</button>
				</div>
				<div class="advertising__image">
					<img decoding="async" src="https://http2.mlstatic.com/D_NQ_862531-MLA49490925972_032022-C.webp" alt="MIN COMPRA S/349">
				</div>	
				</a>
			</div>
		</div>
	</section>

	<!-----------SECCION 2----------->
	
	<section class="shop container">
		<h2 class="section-title">Lo más vendido</h2>
	
		<div class="shop-content">
		<?php include("administradores/config/dbconfig.php");
	$sentenciaSQL=$conexion->prepare("SELECT * FROM producto");
	$sentenciaSQL->execute();
	$listaProducto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
	?>
	<?php foreach ($listaProducto as $lista) { ?>
			<div class="product-box">
				<img src="./img/<?php echo $lista['Imagen']; ?>" class="product-img">

				<h2 class="product-title"><?php echo $lista['Nombre']; ?></h2>
				<span class="price">S/<?php echo $lista['Precio']; ?></span>
				<i class="fa-solid fa-cart-shopping add-cart"></i>
			</div>
			<?php } ?>
			
		</div>
		
		
	</section>
	

	<!-----------SECCION 3----------->

	<section class="categories">
		<div class="categories-container">
			<div class="section-header">
				<h2 id="categorias">Categorías Populares</h2>
			</div>
			<main>
			<div class="cards">
				<div class="card" onclick="Funcion();">
					<div class="card__image-container">
						<img class="sofa" src="img/sofa.png">
					</div>
					<div class="card__content">
						<p class="card__title text--medium">
							Muebles
						</p>
						<div class="card__info">
							<p class="text--medium"></p>
							<p class="card__price text--medium">&#10095;</p>
						</div>
					</div>
				</div>
				<div class="card" onclick="Funcion2();">
					<div class="card__image-container">
						<img src="img/refri.png" width="50">
					</div>
					<div class="card__content">
						<p class="card__title text--medium">
							Electrodomésticos
						</p>
						<div class="card__info">
							<p class="text--medium"></p>
							<p class="card__price text--medium">&#10095;</p>
						</div>
					</div>
				</div>
				<div class="card" onclick="Funcion3();">
					<div class="card__image-container">
						<img src="img/lap.png">
					</div>
					<div class="card__content">
						<p class="card__title text--medium">
							Tecnología
						</p>
						<div class="card__info">
							<p class="text--medium"></p>
							<p class="card__price text--medium">&#10095;</p>
						</div>
					</div>
				</div>
				<div class="card" onclick="Funcion4();">
					<div class="card__image-container">
						<img src="img/fut.png">
					</div>
					<div class="card__content">
						<p class="card__title text--medium">
							Deportes
						</p>
						<div class="card__info">
							<p class="text--medium"></p>
							<p class="card__price text--medium">&#10095;</p>
						</div>
					</div>
				</div>
				<div class="card" onclick="Funcion5();">
					<div class="card__image-container">
						<img src="img/ropa.png">
					</div>
					<div class="card__content">
						<p class="card__title text--medium">
							Ropa y Accesorios
						</p>
						<div class="card__info">
							<p class="text--medium"></p>
							<p class="card__price text--medium">&#10095;</p>
						</div>
					</div>
				</div>
				<div class="card" onclick="Funcion6();">
					<div class="card__image-container">
						<img class="juguetes" src="img/jug.png">
					</div>
					<div class="card__content">
						<p class="card__title text--medium">
							Juguetes
						</p>
						<div class="card__info">
							<p class="text--medium"></p>
							<p class="card__price text--medium">&#10095;</p>
						</div>
					</div>
				</div>
			</div>
			</main>	
			
		</div>
	</section>
	
	<!----------------SECCION 4------------------>

	<section class="site-shopping-info">
		<div class="container-info">
			<div class="info-slide">
				<div class="img-container">
					<img decoding="async" src="img/pago.png" class="img-container" width="60px">
				</div>
				<h2>Pago con Tarjetas</h2>
				<p>
					<span>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					</span>
				</p>
			</div>
			<div class="info-slide">
				<div class="img-container">
					<img decoding="async" src="https://http2.mlstatic.com/resources/frontend/homes-korriban/assets/images/ecosystem/shipping.svg" class="img-container">
				</div>
				<h2>Envios Gratis desde S/ 89</h2>
				<p>
					<span>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					</span>
				</p>
			</div>
			<div class="info-slide">
				<div class="img-container">
					<img decoding="async" src="https://http2.mlstatic.com/resources/frontend/homes-korriban/assets/images/ecosystem/protected.svg" class="img-container">
				</div>
				<h2>Compra Protegida</h2>
				<p>
					<span>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					</span>
				</p>
			</div>
		</div>
	</section>


	<!----------------FOOTER----------------------->

	<section class="footer">
		<div class="social">
			<a href=""><i class="fab fa-instagram"></i></a>
			<a href=""><i class="fab fa-snapchat"></i></a>
			<a href=""><i class="fab fa-twitter"></i></a>
			<a href=""><i class="fab fa-facebook-f"></i></a>
		</div>

		<ul class="list">
			<li><a href="">Home</a></li>
			<li><a href="">Services</a></li>
			<li><a href="">About</a></li>
			<li><a href="">Term</a></li>
			<li><a href="">Privacy Policy</a></li>
		</ul>
		<p class="copyright">
			K & B Company @ 2022
		</p>
	</section>


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>