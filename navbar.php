<!--start  menu -->
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php">Shop2hand</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">หน้าหลัก <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.html">สมัครสมาชิก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="databoad\login.php">ล็อคอิน</a>
                        </li>
                        <?php
                        if (!empty($_SESSION['m_name'])) {

                            echo '<li class="nav-item">
                                <a class="nav-link" href="databoad/member">';
                            echo 'สวัสดีคุณ ' . $_SESSION['m_name'];
                            echo '</a></li>';
                            echo '
                            <li class="nav-item"><a class="nav-link" href="databoad/logout.php"> 
                            Logout </a></li>
                            ';
                        }
                        ?>

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
<!--end  menu -->