<style>
    #mainNav {
        background-color: transparent;
        border: none;
        box-shadow: none;
        position: absolute;
        width: 100%;
        z-index: 1000;
        padding: 20px 40px; /* Menambahkan padding yang lebih luas */
        box-shadow: 0 1px 4px rgba(146, 161, 176, 0.15);
    }

    #mainNav .navbar-brand {
        font-size: 28px; /* Ukuran font brand lebih besar */
        font-weight: bold;
        color: #0B1215;
        margin-right: 50px; /* Memberikan jarak antara brand dan menu */
        display: flex;
        align-items: center; /* Menyelaraskan logo dan teks secara vertikal */
    }

    #mainNav .navbar-nav > li > a {
        color: #0B1215;
        font-weight: 600;
        font-size: 20px; /* Ukuran font lebih besar */
        margin: 5px 20px; /* Memberikan jarak horizontal antar menu */
        padding: 10px 15px; /* Memperbesar area klik */
    }

    #mainNav .navbar-nav > li > a:hover {
        color: #3c8dbc;
        text-decoration: none;
        background-color: rgba(76, 130, 175, 0.1); /* Memberikan efek hover */
        border-radius: 5px; /* Membuat sudut membulat */
    }

    #mainNav .dropdown-menu {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px; /* Sudut dropdown lebih membulat */
        padding: 15px;
        width: 300px; /* Menentukan lebar dropdown */
        min-width: 250px; /* Minimum lebar dropdown */
        max-width: 400px; /* Maksimum lebar dropdown */
    }

    #mainNav .dropdown-menu > li > a {
        color: #0B1215;
        font-size: 16px; /* Ukuran font di dropdown */
    }

    #mainNav .dropdown-menu > li > a:hover {
        background-color: #f5f5f5;
        color: #3c8dbc;
    }

    #mainNav .dropdown-menu > div > a {
        color: #0B1215;
        font-size: 16px; /* Ukuran font di dropdown */
        display: block; /* Membuat setiap item dropdown menjadi blok terpisah */
    }

    #mainNav .dropdown-menu > div > a:hover {
        background-color: #f5f5f5;
        color: #3c8dbc;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center; /* Menyelaraskan avatar dan nama secara vertikal */
    }

    .site-logo {
        width: 40px; /* Ukuran logo */
        height: auto; /* Menjaga rasio aspek logo */
        margin-right: 10px; /* Memberikan jarak antara logo dan teks */
    }

    .img-user {
        margin-right: 10px; /* Memberikan jarak antara gambar dan nama */
        width: 30px; /* Ukuran gambar avatar */
        height: 30px; /* Menjaga proporsi gambar */
        object-fit: cover;
    }

    @media (max-width: 768px) {
        #mainNav {
            padding: 10px 20px; /* Penyesuaian untuk layar kecil */
        }

        .img-user {
            width: 25px; /* Ukuran lebih kecil pada layar kecil */
            height: 25px; /* Menjaga proporsi gambar pada layar kecil */
        }
        
        #mainNav .navbar-brand {
            font-size: 16px; /* Ukuran lebih kecil untuk layar kecil */
        }

        #mainNav .navbar-nav > li > a {
            font-size: 16px; /* Ukuran lebih kecil untuk layar kecil */
            margin: 0px 10px; /* Margin lebih kecil untuk layar kecil */
        }

        .navbar-nav {
            margin: 10rem -15px;
        }

        .site-logo {
            width: 30px; /* Mengurangi ukuran logo pada layar kecil */
        }
    }
</style>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#">
            <?php
                $logoPath = BASE_URL . 'uploads/logo/' . get_option('site_logo');
                if (get_option('site_logo') && file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . get_option('site_logo'))) {
                    echo '<img class="site-logo" src="' . $logoPath . '" alt="Organization Logo">';
                } else {
                    echo get_option('site_name');
                }
            ?>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (!app()->aauth->is_loggedin()): ?>
                <li>
                    <a class="page-scroll" href="<?= site_url('login'); ?>"><i class="fa fa-sign-in"></i> Login</a>
                </li>
                <?php else: ?>
                <li class="dropdown">
                    <a class="page-scroll dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'yuuki0.webp'); ?>" class="img-circle img-user" alt="User Image"> 
                        <?= get_user_data('full_name'); ?>
                        <span class="caret"></span>
                    </a>
                    <!-- Mengganti ul/li dengan div untuk dropdown -->
                    <div class="dropdown-menu">
                        <div><a class="dropdown-item" href="<?= site_url('user/profile'); ?>">Profil Saya</a></div>
                        <div><a class="dropdown-item" href="<?= site_url('dashboard'); ?>">Dashboard</a></div>
                        <div class="divider"></div>
                        <div><a class="dropdown-item bg-danger text-danger" href="<?= site_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>