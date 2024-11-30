
    <link rel="stylesheet" href="index.css">

</head>


<body>
    <div id="main">
        
    </div>
    <section>
        <!-- slideshow -->
       
            <h2>Phim đang chiếu</h2>
        </div>
        <!-- ảnh hàng dọc -->
        </div>
        <div id="products">
            <div class="content">
                <?php 
                foreach ($loadall as $phim) {
                    echo ' <div class="items">
                    <img src="'.$phim['image'].' " alt="">
                    <a href="#">
                        <h3>'.$phim['ten'].'</h3>
                    </a>
                    <p>'.$phim['gioithieu'].'</p>
                </div>';
                }
                ?>
                
           
        </div>
    </section>
    
</body>

</html>