<!-- All CSS -->
<link rel="stylesheet" href="{{ asset('storage/frontend/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/owl.theme.default.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/bootstrap-select.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/meanmenu.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/spacing.css') }}">
<link rel="stylesheet" href="{{ asset('storage/frontend/css/cookieconsent.min.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">

<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
    #preloader #status {
        background-image: url({{ asset('storage/places/preloader.gif') }});
    }

    .top,
    .main-nav nav .navbar-nav .nav-item .dropdown-menu,
    .video-button:before,
    .video-button:after,
    .special .read-more a,
    .service .read-more a,
    .testimonial-bg,
    .project .read-more a,
    .team-text,
    .cta .overlay,
    .blog-area .blog-image .date,
    .blog-area .read-more a,
    .newsletter-area .overlay,
    .footer-social-link ul li a,
    .scroll-top,
    .single-section .read-more a,
    .sidebar .widget .search button,
    .comment button,
    .contact-item:hover .contact-icon,
    .product-item .text button,
    .btn-arf,
    .project-photo-carousel .owl-nav .owl-prev,
    .project-photo-carousel .owl-nav .owl-next,
    .faq h4.panel-title a,
    .team-social li a:hover,
    .doc_detail_social li i,
    .nav-doctor .nav-link.active {
        background: {{ '#'.$g_setting->theme_color }}!important;
    }
    .product-detail button,
    .product-detail .nav-pills .nav-link.active,
    .contact-form .btn,
    .career-sidebar .widget button {
        background: {{ '#'.$g_setting->theme_color }}!important;
    }
    
    .service .service-item .text h3 a:hover,
    .project .project-item .text h3 a:hover,
    .blog-area .blog-item h3 a:hover,
    .footer-item ul li a:hover,
    .sidebar .widget .type-2 ul li a:hover,
    .sidebar .widget .type-1 ul li:before,
    .sidebar .widget .type-1 ul li a:hover,
    .single-section h3,
    .contact-icon,
    .product-item .text h3 a:hover,
    .career-main-item h3,
    .reg-login-form .new-user a {
        color: {{ '#'.$g_setting->theme_color }}!important;
    }
    .product-detail .nav-pills .nav-link {
        color: {{ '#'.$g_setting->theme_color }}!important;
    }
    .text-animated li a:hover,
    .feature .feature-item {
        background-color: {{ '#'.$g_setting->theme_color }}!important;
    }
    .text-animated li a:hover,
    .special .read-more a,
    .footer-social-link ul li a,
    .contact-item:hover .contact-icon,
    .faq h4.panel-title,
    .team-social li a:hover {
        border-color: {{ '#'.$g_setting->theme_color }}!important;
    }
    .contact-form .btn {
        border-color: {{ '#'.$g_setting->theme_color }}!important;
    }
    .product-detail .nav-pills .nav-link.active {
        color: #fff!important;
    }
    .feature .feature-item:hover,
    .service .read-more a:hover,
    .project .read-more a:hover,
    .blog-area .read-more a:hover,
    .single-section .read-more a:hover,
    .comment button:hover,
    .doc_detail_social li:hover i {
        background: #333!important;
    }
    .product-detail button:hover,
    .contact-form .btn:hover {
        background: #333!important;
    }
    .footer-social-link ul li a:hover {
        background: transparent!important;
    }
    .special .read-more a:hover {
        background: transparent!important;
        border-color: #fff!important;
    }
    
    .container-iframe {
        position: relative;
        width: 100%;
        height: auto;
        overflow: hidden;
      }

      .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        border: none;
      }

      .feature-mono {
          padding-left: 20px;
          padding-right: 20px;
          padding-top: 0;
          padding-bottom: 5px;
          border: 1px solid #ddd;
          overflow: hidden;
          background-color: #ffffff;
          box-shadow: 1px 1px 3px 4px rgba(226, 228, 229, 0.3);
          position: relative;
          margin-bottom: 10px;
      }

      .feature-mono span {
          font-size: 15px;
          font-weight: 700;
          margin: 5px 0 10px;
          padding: 0;
      }

      .feature-mono h4 a {
          font-size: 18px !important;
          font-weight: 600 !important;
          margin: 5px 0 5px !important;
          padding: 0 !important;
          color:#000 !important;
      }

      .feature-mono p {
          padding-bottom: 0;
          margin-bottom: 5px;
          font-size: 14px;
          line-height: 1.2;
      }

      .feature-seo {
          height: 225px;
          padding: 10px;
          border:1px solid #ddd;
          overflow: hidden;
          background-color: #ffffff;
          -webkit-box-shadow: 10px 5px 5px 5px rgba(226, 228, 229, 0.5);
          -moz-box-shadow: 5px 5px 5px 5px rgba(226, 228, 229, 0.5);
          box-shadow: 5px 5px 5px 5px rgba(226, 228, 229, 0.5);
          position: relative;
      }

      .feature-seo small {
          padding-bottom: 0;
          margin-bottom: 5px;
          font-size: 14px;
          line-height: 1.5;
      }

      .feature-seo h4 {
          font-weight: 600;
          margin: 5px 0 10px;
          padding: 0;
      }

      .feature-seo.footer {
          height: 40px;
          padding: 7px;
          margin-bottom: 10px;
          overflow: hidden;
          background: #e6bc67;
          /* Old browsers */
          color:#000;
          -webkit-box-shadow: 10px 10px 5px 10px rgba(226, 228, 229, 1);
          -moz-box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
          box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
          position: relative;
      }

      .ebook-details {
          padding: 10px 0 10px 0;
      }

      .ebook-details img {
          -webkit-transition: all .3s ease-in-out;
          -moz-transition: all .3s ease-in-out;
          -ms-transition: all .3s ease-in-out;
          -o-transition: all .3s ease-in-out;
          transition: all .3s ease-in-out;
      }

      .copybox img {
          -webkit-box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
          -moz-box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
          box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
      }

      .shadowbox {
          width: 15em;
          margin: auto;
          text-align: center;
          border: 1px solid #333;
          box-shadow: 8px 8px 5px #444;
          padding: 8px 12px;
          font-size: larger;
          background-image: linear-gradient(180deg, #fff, #ddd 40%, #ccc);
        }

  .btn-container {
    margin-bottom: 10px;
    text-align: center;
  }

  .greyscaleall {
    webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    -o-filter: grayscale(100%);
    filter: grayscale(100%);

  }

  .mycheckbox {
    font-size: 12px;
    color: black;
    font-weight: 500;
  }

  .btn-color-mode-switch {
    display: inline-block;
    margin: 0px;
    position: relative;
  }

  .btn-color-mode-switch>label.btn-color-mode-switch-inner {
    margin: 0px;
    width: 170px;
    height: 26px;
    background: #E0E0E0;
    border-radius: 26px;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;

    display: block;
  }

  .btn-color-mode-switch>label.btn-color-mode-switch-inner:before {
    content: attr(data-on);
    cursor: pointer;
    position: absolute;
    font-size: 12px;
    font-weight: bold;
    top: 5px;
    right: 25px;
    margin-bottom: 5px;
  }

  .btn-color-mode-switch>label.btn-color-mode-switch-inner:after {
    content: attr(data-off);
    cursor: pointer;
    width: 85px;
    height: 22px;
    font-size: 12px;
    background: #fff;
    border-radius: 26px;
    position: absolute;
    left: 2px;
    top: 2px;
    font-weight: bold;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0px 0px 6px -2px #111;
    padding: 2px 0px;
    margin-bottom: 10px;
  }

  .btn-color-mode-switch input[type="checkbox"] {
    cursor: pointer;
    width: 70px;
    height: 25px;
    opacity: 0;
    position: absolute;
    top: 0;
    z-index: 1;
    padding: 2px 0px;
    margin: 0px;
  }

  .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner {
    background: #E0E0E0;
    color: black;
    font-weight: bold;
    font-size: 12px;


  }

  .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner:after {
    content: attr(data-on);
    left: 83px;
    background: white;
    font-weight: bold;
    font-size: 12px;
  }

  .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner:before {
    content: attr(data-off);
    right: auto;
    left: 15px;
    color: black;
    font-weight: bold;
    font-size: 12px;
  }

  .btn-color-mode-switch input[type="checkbox"]:checked~.alert {
    display: block;
  }

  .toolbar-disabilitas {
    position: fixed;
    top: 6%;
    left: 0;
    z-index: 999;
    height: 1px;
    width: -180px;
    text-align: center;
    background: transparent !important;
    background-color: transparent !important;
  }

  .open-toolbar {
    margin-top: 90%;
    padding-top: 8px;
    padding-right: 5px;
    padding-left: 5px;
    padding-bottom: 3px;
    height: 50px;
    border: none;
    width: 50px;
  }

  .toolbar-disabilitas .open-toolbar {
    background: #4054b2;

  }

  .toolbar-disabilitas .groupcontenttoolbar {
    transform: translateX(-180px);
    transition: transform 0.6s;
  }

  .toolbar-disabilitas.show-toolbar .groupcontenttoolbar {
    transform: translateX(0px);

  }

  .contenttoolbar_disabilitas {
    margin-top: 10%;
    padding-top: 15px;
    display: flex;
    flex-direction: column;
    height: max-content;
    border: 1px solid black;
    box-shadow: 0 10px 10px rgb(0 0 0 / 0.2);
    background-color: white;
    width: 180px;
    word-break: break-all;
    overflow: hidden;
  }

  .groupcontenttoolbar {
    display: flex;
    flex-direction: row;

    height: 1px;

    background-color: transparent !important;

  }

  .titletools {
    font-size: 13px !important;
    font-weight: bold;
    margin-bottom: 10px;
    padding-left: 5px;
    padding-right: 5px;
    color: black;
  }


  .bodytools {
    left: 0;
    height: max-content;
    width: 100%;
    margin-bottom: 10px;
  }

  .subtitletools {
    font-size: 12px !important;
    margin-bottom: 5px;
    cursor: pointer;
    left: 0;
    font-family: Arial, Helvetica, sans-serif;
    padding-left: 10px;
    text-align: left;
    color: black
  }

  .subtitletoolsactive {
    background-color: black;
    font-size: 12px !important;
    margin-bottom: 5px;
    cursor: pointer;
    left: 0;
    padding-top: 5px;
    padding-left: 10px;
    padding-bottom: 5px;
    text-align: left;
    color: white;
    font-weight: bold;
  }

  .subtitletools:hover,
  .subtitletools:focus,
  .subtitletools:active {
    background-color: black;
    color: white;
    font-weight: bold;
    font-size: 12;
    max-width: 100%;
    padding-top: 5px;
    padding-left: 10px;
    padding-bottom: 5px;

  }

  .flexrowdata {
    display: flex;
    flex-direction: row;
    height: 100%;
    width: 100%;
  }

  .flexrowtext {
    display: flex;
    flex-direction: column;

    height: 100%;
    justify-content: center;
    align-items: center;
    width: 100%;
  }

  .datatextinfo {
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: center;

  }

  .texttulisan {
    color: black;
    font-size: 18px;
    font-weight: bold;
  }

  @media only screen and (max-width: 900px) {
    .toolbar-disabilitas {
      top: 11%;
    }
  }
</style>