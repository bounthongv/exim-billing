<title>ລະບົບສາງ</title>
		<div class="header_top" id="home">
			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
				<a class="navbar-brand" href="index.php">
					ລະບົບສາງ-ຂາຍສິນຄ້າ</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
           <?php
		   
		  $user_id=$_SESSION['user_id'];
		   
    $sp=mysqli_query($con,"      select menu_user.user_id,menu_list.header_id,  menu_user.list_id,menu_list.list_name,menu_list.link,menu_header.header_name
     
     from menu_user
     
     left join menu_list on menu_user.list_id=menu_list.list_id
     left join menu_header on menu_list.header_id=menu_header.header_id   
           
      where menu_user.user_id='$user_id' and menu_user.status='on'
	   group by  menu_list.header_id order by  menu_list.header_id    ");	  
	while($s=mysqli_fetch_array($sp)){		
	
	
	     ?>             
               
                
               <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"aria-expanded="false"><?php echo $s['header_name']; ?></a>
        
        
       
		<div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                             <?php
							
		   
    $spd=mysqli_query($con," select menu_user.user_id,menu_list.header_id, menu_user.list_id,menu_list.list_name,menu_list.link,menu_header.header_name
     
     from menu_user
     
     left join menu_list on menu_user.list_id=menu_list.list_id
     left join menu_header on menu_list.header_id=menu_header.header_id   
           
      where menu_user.user_id='$user_id'   and  menu_header.header_id='$s[header_id]' and menu_user.status='on'    ");	  
	while($sd=mysqli_fetch_array($spd)){		
	     ?>                              
								<a class="dropdown-item" href="<?php echo $sd['link']; ?>"><?php echo $sd['list_name']; ?></a>
                                <div class="dropdown-divider"></div>                		                             
							<?php } ?> 	
                                                       
                		    </div>
                            
                            
				</li>
               <?php } ?> 
                
                
                
                    
				
					
                   <li class="nav-item"><a class="nav-link" href="#" onClick="toui()">
                   <i class="fas fa-lock"></i>&nbsp;ອອກລະບົບ</a></li>
                   
                <?php 
				$sql_user=mysqli_query($con,"select * from stocks where stock_id='".$_SESSION['stock_id']."'");
				$r_user_stock=mysqli_fetch_array($sql_user);
				        
						
				
				?>   
                   
                   
                    <li class="nav-item"><a class="nav-link" href="#">ສາງ : <?php echo $r_user_stock['stock_name'];?> User: <?php echo $_SESSION['username'];?></a></li>
                    
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
