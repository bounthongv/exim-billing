<?php

 $menu= $_SESSION["menu"];

 if($menu=='0'){ ?>
 
		<div class="header_top" id="home">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<a class="navbar-brand" href="index.php">
					ລະບົບສາງ-ຂາຍສິນຄ້າ</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto tp-nav text-center">
						<!--<li class="nav-item active">
							<a class="nav-link" href="index.html">Home
							</a>
						</li>
						<li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
						<li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>-->
                        
               
                
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຂໍ້ມູນທົ່ວໄປ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="customer_list.php">ຂໍ້ມູນລູກຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="supplier_list.php">ຂໍ້ມູນຜູ້ສະໜອງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="stock_list.php">ລາຍການລົດຂາຍສິນຄ້າ</a>
                                   <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="exchange_list.php">ຕັ້ງຄ່າອັດຕາແລກປ່ຽນ</a>
                               
                		 </div>
				</li>              
				
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ສາງສິນຄ້າ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="group_list.php">ໝວດສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="product_list.php">ລາຍການສິນຄ້າຫຼັກ</a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item"href="product_qty_list.php">ລາຍການຈຳນວນສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="transfer_mini_stock_list.php">ລາຍການຈ່າຍສິນຄ້າໃຫ້ສາງລົດ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຈ່າຍສິນຄ້າອື່ນໆ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="transfer_from_mini_stock_list.php">ຮັບສິນຄ້າຄືນຈາກສາງລົດ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="opening_list.php">ລາຍການຍອດຍົກມາ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການກວດນັບສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສິນຄ້າແຕ່ລະສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສັງລວມການຮັບ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສັງລວມການຈ່າຍ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="summary_receipt_payment.php">ລາຍງານສັງລວມການຮັບ-ຈ່າຍ</a>
                 </div>
				</li>   	
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຈັດຊື້</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">ລາຍການໃບສະເໜີລາຄາ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການໃບສັ່ງຊື້ສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການໃບສົ່ງສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="product_receipt_list.php">ລາຍການຮັບສິນຄ້າເຂົ້າສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການສົ່ງຄືນສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item"href="#">ລາຍງານການຊື້ສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສັງລວມໜີ້ຜູ້ສະໜອງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານການສົ່ງຄືນສິນຄ້າ</a>
                		 </div>
				</li> 
                <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຂາຍ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="add_sale_stock_mini.php">ຂາຍ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="add_sale_stock.php">ຂາຍຫນ້າຮ້ານ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="sale_list.php">ລາຍການຂາຍສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="sale_difference.php">ລາຍງານຜິດດ່ຽງຕົ້ນທືນຂາຍ</a>
                                <div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">ລາຍການໃບສັ່ງຈອງສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="sale_debit_list.php">ລາຍການໃບບິນຂາຍຕິດໜີ້</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການໃບຮັບເງິນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຮັບຄືນສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການສົ່ງມອບເງິນສົດ</a>
                                <div class="dropdown-divider"></div>                                
                                <a class="dropdown-item"href="sale_daily.php">ລາຍງານການຂາຍປະຈຳວັນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="sale_by_product.php">ລາຍງານການຂາຍຕາມສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="best_seller.php">ລາຍງານສິນຄ້າຂາຍດີ</a>                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="customer_debit_list.php">ລາຍງານລູກຄ້າຕິດໜີ້</a>
                		 </div>
				</li> 
              <!--  
                <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ການເງິນ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">ຂໍ້ມູນລູກຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຄັງເງິນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການເບີກຈ່າຍເງິນທອນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຮັບມອບເງິນສົດ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຈ່າຍຊຳລະໜີ້</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການມອບເງິນເຂົ້າບັນຊີ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຖອນເງິນເຂົ້າເງິນສົດ</a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item"href="#">ລາຍງານຄັງເງິນລວມ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານການການຮັບເງິນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານການຈ່າຍເງິນ</a>
                		 </div>
				</li>  -->        
                        
              <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ລະບົບ</a>
               
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="office_detail.php">ຂໍ້ມູນສຳນັກງານ</a>
                                <div class="dropdown-divider"></div>
                       
                                <a class="dropdown-item"href="user_list.php">ຂໍ້ມູນຜູ້ໃຊ້</a>
                                <div class="dropdown-divider"></div>
								
							
                                
                                <a class="dropdown-item"href="#">ການປິດບັນຊີສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ການປິດບັນຊີຄັງເງິນ</a>
                		 </div>
				</li>
					
                   <li class="nav-item"><a class="nav-link" href="#" onClick="toui()">
                   <i class="fas fa-lock"></i>&nbsp;ອອກລະບົບ</a></li>
                    
                   <!--<li class="nav-item"><a class="nav-link" href="index.php?lang=la">
                    <img src="images/Laos-Flag-icon.png" height="18" />&nbsp;ລາວ</a>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link" href="index.php?lang=en">
                    <img src="images/england-3-512.png" height="15"/>&nbsp;ອັງກິດ</a>
                    </li>
                    -->
                  </ul>
					<!--<form action="#" method="post" class="form-inline my-2 my-lg-0 search">
						<input class="form-control mr-sm-2" type="search" placeholder="Search here..." name="Search" required>
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
                    <img src="images/jica1.jpg">-->

				</div>
			</nav>
		</div>

<?php } elseif($menu=='1'){ ?>
           		<div class="header_top" id="home">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<a class="navbar-brand" href="index.php">
					ລະບົບສາງ-ຂາຍສິນຄ້າ</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto tp-nav text-center">
						
               
                
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຂໍ້ມູນທົ່ວໄປ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="customer_list.php">ຂໍ້ມູນລູກຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="supplier_list.php">ຂໍ້ມູນຜູ້ສະໜອງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="stock_list.php">ລາຍການລົດຂາຍສິນຄ້າ</a>
                                   <div class="dropdown-divider"></div>
                              <a class="dropdown-item"href="exchange_list.php">ຕັ້ງຄ່າອັດຕາແລກປ່ຽນ</a>
                               
                		 </div>
				</li>              
				
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ສາງສິນຄ້າ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="group_list.php">ໝວດສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="product_list.php">ລາຍການສິນຄ້າຫຼັກ</a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item"href="product_qty_list.php">ລາຍການຈຳນວນສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="transfer_mini_stock_list.php">ລາຍການຈ່າຍສິນຄ້າໃຫ້ສາງລົດ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຈ່າຍສິນຄ້າອື່ນໆ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="transfer_from_mini_stock_list.php">ຮັບສິນຄ້າຄືນຈາກສາງລົດ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="opening_list.php">ລາຍການຍອດຍົກມາ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການກວດນັບສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສິນຄ້າແຕ່ລະສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສັງລວມການຮັບ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສັງລວມການຈ່າຍ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="summary_receipt_payment.php">ລາຍງານສັງລວມການຮັບ-ຈ່າຍ</a>
                 </div>
				</li>   	
              
                        
              
					
                   <li class="nav-item"><a class="nav-link" href="#" onClick="toui()">
                   <i class="fas fa-lock"></i>&nbsp;ອອກລະບົບ</a></li>
                    
               
                  </ul>
					

				</div>
			</nav>
		</div>

<?php } elseif($menu=='2'){ ?>
           		<div class="header_top" id="home">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<a class="navbar-brand" href="index.php">
					ລະບົບສາງ-ຂາຍສິນຄ້າ</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto tp-nav text-center">
						
               
                
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຂໍ້ມູນທົ່ວໄປ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="customer_list.php">ຂໍ້ມູນລູກຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="supplier_list.php">ຂໍ້ມູນຜູ້ສະໜອງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="stock_list.php">ລາຍການລົດຂາຍສິນຄ້າ</a>
                                   <div class="dropdown-divider"></div>
                              <a class="dropdown-item"href="exchange_list.php">ຕັ້ງຄ່າອັດຕາແລກປ່ຽນ</a>
                               
                		 </div>
				</li>              
				
                <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຈັດຊື້</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">ລາຍການໃບສະເໜີລາຄາ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການໃບສັ່ງຊື້ສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການໃບສົ່ງສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="product_receipt_list.php">ລາຍການຮັບສິນຄ້າເຂົ້າສາງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການສົ່ງຄືນສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item"href="#">ລາຍງານການຊື້ສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານສັງລວມໜີ້ຜູ້ສະໜອງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານການສົ່ງຄືນສິນຄ້າ</a>
                		 </div>
				</li> 
                        
              
					
                   <li class="nav-item"><a class="nav-link" href="#" onClick="toui()">
                   <i class="fas fa-lock"></i>&nbsp;ອອກລະບົບ</a></li>
                    
               
                  </ul>
					

				</div>
			</nav>
		</div>

<?php } elseif($menu=='3'){ ?>
           		<div class="header_top" id="home">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<a class="navbar-brand" href="index.php">
					ລະບົບສາງ-ຂາຍສິນຄ້າ</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto tp-nav text-center">
						
               
                
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຂໍ້ມູນທົ່ວໄປ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="customer_list.php">ຂໍ້ມູນລູກຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="supplier_list.php">ຂໍ້ມູນຜູ້ສະໜອງ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="stock_list.php">ລາຍການລົດຂາຍສິນຄ້າ</a>
                                   <div class="dropdown-divider"></div>
                              <a class="dropdown-item"href="exchange_list.php">ຕັ້ງຄ່າອັດຕາແລກປ່ຽນ</a>
                               
                		 </div>
				</li>              
				
                 <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">ຂາຍ</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="add_sale_stock.php">ຂາຍ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="sale_list.php">ລາຍການຂາຍສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="sale_difference.php">ລາຍງານຜິດດ່ຽງຕົ້ນທືນຂາຍ</a>
                                <div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">ລາຍການໃບສັ່ງຈອງສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="sale_debit_list.php">ລາຍການໃບບິນຂາຍຕິດໜີ້</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການໃບຮັບເງິນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການຮັບຄືນສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍການສົ່ງມອບເງິນສົດ</a>
                                <div class="dropdown-divider"></div>                                
                                <a class="dropdown-item"href="sale_daily.php">ລາຍງານການຂາຍປະຈຳວັນ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="sale_by_product.php">ລາຍງານການຂາຍຕາມສິນຄ້າ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="best_seller.php">ລາຍງານສິນຄ້າຂາຍດີ</a>                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"href="#">ລາຍງານລູກຄ້າຕິດໜີ້</a>
                		 </div>
				</li> 
                        
              
					
                   <li class="nav-item"><a class="nav-link" href="#" onClick="toui()">
                   <i class="fas fa-lock"></i>&nbsp;ອອກລະບົບ</a></li>
                    
               
                  </ul>
					

				</div>
			</nav>
		</div>

<?php } else {} ?>
<script>
function toui() {
    if ( confirm("ທ່ານຕ້ອງການອອກຈາກລະບົບຫຼືບໍ່ ?") == true) {
		
		
       location='../logout.php';
		
    } 
	
}
</script>
<style type="text/css">
    @import url("LAOS/stylesheet.css");
body,td,th ,h1,h2,h3,h4,small,input[type='button'],input[type='text'],input[type='submit'], a{
	font-family: LAOS;


}
.ui-autocomplete { font-family:"Phetsarath OT";}
	
</style>
