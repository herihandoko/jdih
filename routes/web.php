<?php

use App\Http\Controllers\Admin\DashboardController as DashboardControllerForAdmin;
use App\Http\Controllers\Admin\FooterColumnController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\LoginController as LoginControllerForAdmin;
use App\Http\Controllers\Admin\LogoutController as LogoutControllerForAdmin;
use App\Http\Controllers\Admin\ForgetPasswordController as ForgetPasswordControllerForAdmin;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageContactController;
use App\Http\Controllers\Admin\PageHomeController;
use App\Http\Controllers\Admin\PhotoChangeController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ResetPasswordController as ResetPasswordControllerForAdmin;
use App\Http\Controllers\Admin\PasswordChangeController as PasswordChangeControllerForAdmin;
use App\Http\Controllers\Admin\ProfileChangeController as ProfileChangeControllerForAdmin;
use App\Http\Controllers\Admin\CategoryController as CategoryControllerForAdmin;
use App\Http\Controllers\Admin\SocialMediaItemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SurveyController as SurveyControllerForAdmin;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\TermController;

/* --------------------------------------- */
/* JDIH Admin Controller */
/* --------------------------------------- */
use App\Http\Controllers\Admin\PageVisiMisiController;
use App\Http\Controllers\Admin\PageStrukturOrganisasiController;
use App\Http\Controllers\Admin\PageTupoksiController;
use App\Http\Controllers\Admin\ProdukHukumTypeController;
use App\Http\Controllers\Admin\ProdukHukumCategoryController;
use App\Http\Controllers\Admin\ProdukHukumListController;
use App\Http\Controllers\Admin\ProdukHukumUrusanPemerintahanController;
use App\Http\Controllers\Admin\ProdukHukumBidangHukumController;
use App\Http\Controllers\Admin\ArtikelHukumListController;
use App\Http\Controllers\Admin\MajalahHukumListController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\BeritaListController;

/* --------------------------------------- */
/* JDIH Front End Controller */
/* --------------------------------------- */
use App\Http\Controllers\Front\VisiMisiController;
use App\Http\Controllers\Front\StrukturOrganisasiController;
use App\Http\Controllers\Front\TupoksiController;
use App\Http\Controllers\Front\SurveyController;

use App\Http\Controllers\Front\ProdukHukumController;
use App\Http\Controllers\Front\SearchPeraturanController;

use App\Http\Controllers\Front\ArtikelHukumController;
use App\Http\Controllers\Front\SearchArtikelHukumController;

use App\Http\Controllers\Front\MajalahHukumController;
use App\Http\Controllers\Front\SearchMajalahHukumController;

use App\Http\Controllers\Front\FrontPageController;

use Illuminate\Support\Facades\Route;

Route::get('/turun', function() {
    Artisan::call('down');
    return 'Application is now in maintenance mode.';
});

Route::get('/naik', function() {
    Artisan::call('up');
    return 'Application is now live.';
});

/* --------------------------------------- */
/* JDIH Admin Route */
/* --------------------------------------- */
Route::group(['middleware' => ['prevent-back-history', 'get.adminmenu', 'XssSanitizer']], function(){
    Route::get('admin/company/view', [CompanyController::class,'index'])->name('admin.company.index');
    Route::get('admin/company/create', [CompanyController::class,'create'])->name('admin.company.create');
    Route::post('admin/company/store', [CompanyController::class,'store'])->name('admin.company.store');
    Route::get('admin/company/edit/{id}', [CompanyController::class,'edit']);
    Route::post('admin/company/update/{id}', [CompanyController::class,'update']);
    Route::get('admin/company/delete/{id}', [CompanyController::class,'destroy']);
    
    Route::resource('admin/menu/store', MenuController::class);
    
    /* --------------------------------------- */
    /* Category - Admin */
    /* --------------------------------------- */
    Route::get('admin/category/view', [CategoryControllerForAdmin::class,'index'])->name('admin.category.index');
    Route::get('admin/category/create', [CategoryControllerForAdmin::class,'create'])->name('admin.category.create');
    Route::post('admin/category/store', [CategoryControllerForAdmin::class,'store'])->name('admin.category.store');
    Route::get('admin/category/delete/{id}', [CategoryControllerForAdmin::class,'destroy']);
    Route::get('admin/category/edit/{id}', [CategoryControllerForAdmin::class,'edit']);
    Route::post('admin/category/update/{id}', [CategoryControllerForAdmin::class,'update']);

    /* --------------------------------------- */
    /* Slider - Admin */
    /* --------------------------------------- */
    Route::get('admin/slider/view', [SliderController::class,'index'])->name('admin.slider.index');
    Route::get('admin/slider/create', [SliderController::class,'create'])->name('admin.slider.create');
    Route::post('admin/slider/store', [SliderController::class,'store'])->name('admin.slider.store');
    Route::get('admin/slider/delete/{id}', [SliderController::class,'destroy']);
    Route::get('admin/slider/edit/{id}', [SliderController::class,'edit']);
    Route::post('admin/slider/update/{id}', [SliderController::class,'update']);


    /* --------------------------------------- */
    /* Logo - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/logo/edit', [GeneralSettingController::class,'logo_edit'])->name('admin.general_setting.logo');
    Route::post('admin/setting/general/logo/update', [GeneralSettingController::class,'logo_update']);


    /* --------------------------------------- */
    /* Favicon - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/favicon/edit', [GeneralSettingController::class,'favicon_edit'])->name('admin.general_setting.favicon');
    Route::post('admin/setting/general/favicon/update', [GeneralSettingController::class,'favicon_update']);


    /* --------------------------------------- */
    /* Login Background - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/loginbg/edit', [GeneralSettingController::class,'loginbg_edit'])->name('admin.general_setting.loginbg');
    Route::post('admin/setting/general/loginbg/update', [GeneralSettingController::class,'loginbg_update']);


    /* --------------------------------------- */
    /* TopBar - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/topbar/edit', [GeneralSettingController::class,'topbar_edit'])->name('admin.general_setting.topbar');
    Route::post('admin/setting/general/topbar/update', [GeneralSettingController::class,'topbar_update']);


    /* --------------------------------------- */
    /* Banner - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/banner/edit', [GeneralSettingController::class,'banner_edit'])->name('admin.general_setting.banner');
    Route::post('admin/setting/general/banner/update', [GeneralSettingController::class,'banner_update']);


    /* --------------------------------------- */
    /* Footer - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/footer/edit', [GeneralSettingController::class,'footer_edit'])->name('admin.general_setting.footer');
    Route::post('admin/setting/general/footer/update', [GeneralSettingController::class,'footer_update']);


    /* --------------------------------------- */
    /* Sidebar - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/sidebar/edit', [GeneralSettingController::class,'sidebar_edit'])->name('admin.general_setting.sidebar');
    Route::post('admin/setting/general/sidebar/update', [GeneralSettingController::class,'sidebar_update']);


    /* --------------------------------------- */
    /* Color - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/color/edit', [GeneralSettingController::class,'color_edit'])->name('admin.general_setting.color');
    Route::post('admin/setting/general/color/update', [GeneralSettingController::class,'color_update']);


    /* --------------------------------------- */
    /* Preloader - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/preloader/edit', [GeneralSettingController::class,'preloader_edit'])->name('admin.general_setting.preloader');
    Route::post('admin/setting/general/preloader/update', [GeneralSettingController::class,'preloader_update']);


    /* --------------------------------------- */
    /* Sticky Header - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/stickyheader/edit', [GeneralSettingController::class,'stickyheader_edit'])->name('admin.general_setting.stickyheader');
    Route::post('admin/setting/general/stickyheader/update', [GeneralSettingController::class,'stickyheader_update']);


    /* --------------------------------------- */
    /* Google Analytic - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/googleanalytic/edit', [GeneralSettingController::class,'googleanalytic_edit'])->name('admin.general_setting.googleanalytic');
    Route::post('admin/setting/general/googleanalytic/update', [GeneralSettingController::class,'googleanalytic_update']);


    /* --------------------------------------- */
    /* Google Recaptcha - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/googlerecaptcha/edit', [GeneralSettingController::class,'googlerecaptcha_edit'])->name('admin.general_setting.googlerecaptcha');
    Route::post('admin/setting/general/googlerecaptcha/update', [GeneralSettingController::class,'googlerecaptcha_update']);


    /* --------------------------------------- */
    /* Tawk Live Chat - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/tawklivechat/edit', [GeneralSettingController::class,'tawklivechat_edit'])->name('admin.general_setting.tawklivechat');
    Route::post('admin/setting/general/tawklivechat/update', [GeneralSettingController::class,'tawklivechat_update']);


    /* --------------------------------------- */
    /* Cookie Consent - Admin */
    /* --------------------------------------- */
    Route::get('admin/setting/general/cookieconsent/edit', [GeneralSettingController::class,'cookieconsent_edit'])->name('admin.general_setting.cookieconsent');
    Route::post('admin/setting/general/cookieconsent/update', [GeneralSettingController::class,'cookieconsent_update']);


    /* --------------------------------------- */
    /* Page Settings - Admin */
    /* --------------------------------------- */
    Route::group(['prefix'=>'admin/page/home'], function() {

        Route::get('/edit', [PageHomeController::class,'edit'])->name('admin.page_home.edit');
        Route::post('/1', [PageHomeController::class,'update1']);
        Route::post('/2', [PageHomeController::class,'update2']);
        Route::post('/3', [PageHomeController::class,'update3']);
        Route::post('/4', [PageHomeController::class,'update4']);
        Route::post('/5', [PageHomeController::class,'update5']);
        Route::post('/6', [PageHomeController::class,'update6']);
        Route::post('/7', [PageHomeController::class,'update7']);
        Route::post('/8', [PageHomeController::class,'update8']);
        Route::post('/9', [PageHomeController::class,'update9']);
        Route::post('/10', [PageHomeController::class,'update10']);

        /* JDIH Home Section */
        Route::post('/11', [PageHomeController::class,'update11']);
        Route::post('/12', [PageHomeController::class,'update12']);
        Route::post('/13', [PageHomeController::class,'update13']);
    });

    Route::group(['prefix'=>'admin/page'], function() {
        Route::get('/contact/edit', [PageContactController::class,'edit'])->name('admin.page_contact.edit');
        Route::post('/contact/update', [PageContactController::class,'update']);        
    });

    /* --------------------------------------- */
    /* Social Media - Admin */
    /* --------------------------------------- */
    Route::get('admin/social-media/view', [SocialMediaItemController::class,'index'])->name('admin.social_media.index');
    Route::get('admin/social-media/create', [SocialMediaItemController::class,'create'])->name('admin.social_media.create');
    Route::post('admin/social-media/store', [SocialMediaItemController::class,'store'])->name('admin.social_media.store');
    Route::get('admin/social-media/delete/{id}', [SocialMediaItemController::class,'destroy']);
    Route::get('admin/social-media/edit/{id}', [SocialMediaItemController::class,'edit']);
    Route::post('admin/social-media/update/{id}', [SocialMediaItemController::class,'update']);

    /* --------------------------------------- */
    /* Footer Columns - Admin */
    /* --------------------------------------- */
    Route::get('admin/footer/view', [FooterColumnController::class,'index'])->name('admin.footer.index');
    Route::get('admin/footer/create', [FooterColumnController::class,'create'])->name('admin.footer.create');
    Route::post('admin/footer/store', [FooterColumnController::class,'store'])->name('admin.footer.store');
    Route::get('admin/footer/delete/{id}', [FooterColumnController::class,'destroy']);
    Route::get('admin/footer/edit/{id}', [FooterColumnController::class,'edit']);
    Route::post('admin/footer/update/{id}', [FooterColumnController::class,'update']);


    /* --------------------------------------- */
    /* Menu - Admin */
    /* --------------------------------------- */
    Route::get('admin/menu/view', [MenuController::class,'index'])->name('admin.menu.index');
    Route::post('admin/menu/update', [MenuController::class,'update']);


    /* --------------------------------------- */
    /* Admin Users and Roles - Admin */
    /* --------------------------------------- */
    Route::get('admin/role/user', [RoleController::class,'user'])->name('admin.role.user');
    Route::get('admin/role/user-create', [RoleController::class,'user_create'])->name('admin.role.user-create');
    Route::post('admin/role/user-store', [RoleController::class,'user_store'])->name('admin.role.user-store');
    Route::get('admin/role/user/edit/{id}', [RoleController::class,'user_edit']);
    Route::post('admin/role/user/update/{id}', [RoleController::class,'user_update']);
    Route::get('admin/role/user/edit/password/{id}', [RoleController::class,'user_edit_password']);
    Route::post('admin/role/user/update/password/{id}', [RoleController::class,'user_update_password']);
    Route::get('admin/role/user/delete/{id}', [RoleController::class,'user_destroy']);
    Route::get('admin/role/index', [RoleController::class,'index'])->name('admin.role.index');
    Route::get('admin/role/create', [RoleController::class,'create'])->name('admin.role.create');
    Route::post('admin/role/store', [RoleController::class,'store'])->name('admin.role.store');
    Route::get('admin/role/delete/{id}', [RoleController::class,'destroy']);
    Route::get('admin/role/edit/{id}', [RoleController::class,'edit']);
    Route::post('admin/role/update/{id}', [RoleController::class,'update']);
    Route::get('admin/role/access-setup/{id}', [RoleController::class,'access_setup']);
    Route::post('admin/role/access-setup-update/{id}', [RoleController::class,'access_setup_update']);
    
    Route::get('admin/dashboard', [DashboardControllerForAdmin::class,'index'])->name('admin.dashboard');
    Route::get('admin/logout', [LogoutControllerForAdmin::class,'index'])->name('admin.logout');
    Route::get('admin/reset-password/{token}/{email}', [ResetPasswordControllerForAdmin::class,'index']);
    Route::post('admin/reset-password/update', [ResetPasswordControllerForAdmin::class,'update']);
    Route::get('admin/password-change', [PasswordChangeControllerForAdmin::class,'index'])->name('admin.password_change');
    Route::post('admin/password-change/update', [PasswordChangeControllerForAdmin::class,'update']);
    Route::get('admin/profile-change', [ProfileChangeControllerForAdmin::class,'index'])->name('admin.profile_change');
    Route::post('admin/profile-change/update', [ProfileChangeControllerForAdmin::class,'update']);
    Route::get('admin/photo-change', [PhotoChangeController::class,'index'])->name('admin.photo_change');
    Route::post('admin/photo-change/update', [PhotoChangeController::class,'update']);
    Route::get('admin/survey', [SurveyControllerForAdmin::class,'index'])->name('admin.survey');
    Route::get('admin/survey/get-data/', [SurveyControllerForAdmin::class,'getSurveyData'])->name('admin.survey.get_data');
    
    Route::get('admin/page-visimisi/view', [PageVisiMisiController::class,'index'])->name('admin.web_setting.page_visimisi');
    Route::post('admin/page-visimisi/store', [PageVisiMisiController::class,'store']);
    Route::post('admin/page-visimisi/update', [PageVisiMisiController::class,'update']);

    Route::get('admin/page-strukturorganisasi/view', [PageStrukturOrganisasiController::class,'index'])->name('admin.web_setting.page_strukturorganisasi');
    Route::post('admin/page-strukturorganisasi/store', [PageStrukturOrganisasiController::class,'store']);
    Route::post('admin/page-strukturorganisasi/update', [PageStrukturOrganisasiController::class,'update']);

    Route::get('admin/page-tupoksi/view', [PageTupoksiController::class,'index'])->name('admin.web_setting.page_tupoksi');
    Route::post('admin/page-tupoksi/store', [PageTupoksiController::class,'store']);
    Route::post('admin/page-tupoksi/update', [PageTupoksiController::class,'update']);
    
    Route::get('admin/produk-hukum/tipe-dokumen/view', [ProdukHukumTypeController::class,'index'])->name('admin.produk_hukum.tipe.index');
    Route::get('admin/produk-hukum/tipe-dokumen/create', [ProdukHukumTypeController::class,'create'])->name('admin.produk_hukum.tipe.create');
    Route::post('admin/produk-hukum/tipe-dokumen/store', [ProdukHukumTypeController::class,'store'])->name('admin.produk_hukum.tipe.store');
    Route::get('admin/produk-hukum/tipe-dokumen/edit/{id}', [ProdukHukumTypeController::class,'edit']);
    Route::post('admin/produk-hukum/tipe-dokumen/update/{id}', [ProdukHukumTypeController::class,'update']);

    Route::get('admin/produk-hukum/jenis-peraturan/view', [ProdukHukumCategoryController::class,'index'])->name('admin.produk_hukum.jenis.index');
    Route::get('admin/produk-hukum/jenis-peraturan/create', [ProdukHukumCategoryController::class,'create'])->name('admin.produk_hukum.jenis.create');
    Route::post('admin/produk-hukum/jenis-peraturan/store', [ProdukHukumCategoryController::class,'store'])->name('admin.produk_hukum.jenis.store');
    Route::get('admin/produk-hukum/jenis-peraturan/edit/{id}', [ProdukHukumCategoryController::class,'edit']);
    Route::post('admin/produk-hukum/jenis-peraturan/update/{id}', [ProdukHukumCategoryController::class,'update']);
    
    Route::get('admin/produk-hukum/urusan-pemerintahan/view', [ProdukHukumUrusanPemerintahanController::class,'index'])->name('admin.produk_hukum.up.index');
    Route::get('admin/produk-hukum/urusan-pemerintahan/create', [ProdukHukumUrusanPemerintahanController::class,'create'])->name('admin.produk_hukum.up.create');
    Route::post('admin/produk-hukum/urusan-pemerintahan/store', [ProdukHukumUrusanPemerintahanController::class,'store'])->name('admin.produk_hukum.up.store');
    Route::get('admin/produk-hukum/urusan-pemerintahan/edit/{id}', [ProdukHukumUrusanPemerintahanController::class,'edit']);
    Route::post('admin/produk-hukum/urusan-pemerintahan/update/{id}', [ProdukHukumUrusanPemerintahanController::class,'update']);
    
    Route::get('admin/produk-hukum/bidang-hukum/view', [ProdukHukumBidangHukumController::class,'index'])->name('admin.produk_hukum.bh.index');
    Route::get('admin/produk-hukum/bidang-hukum/create', [ProdukHukumBidangHukumController::class,'create'])->name('admin.produk_hukum.bh.create');
    Route::post('admin/produk-hukum/bidang-hukum/store', [ProdukHukumBidangHukumController::class,'store'])->name('admin.produk_hukum.bh.store');
    Route::get('admin/produk-hukum/bidang-hukum/edit/{id}', [ProdukHukumBidangHukumController::class,'edit']);
    Route::post('admin/produk-hukum/bidang-hukum/update/{id}', [ProdukHukumBidangHukumController::class,'update']);

    Route::get('admin/produk-hukum/list-data/view', [ProdukHukumListController::class,'index'])->name('admin.produk_hukum.listdata.index');
    Route::get('admin/produk-hukum/list-data/create', [ProdukHukumListController::class,'create'])->name('admin.produk_hukum.listdata.create');
    Route::post('admin/produk-hukum/list-data/store', [ProdukHukumListController::class,'store'])->name('admin.produk_hukum.listdata.store');
    Route::get('admin/produk-hukum/list-data/edit/{id}', [ProdukHukumListController::class,'edit']);
    Route::post('admin/produk-hukum/list-data/update/{id}', [ProdukHukumListController::class,'update']);
    Route::get('admin/produk-hukum/list-data/delete/{id}', [ProdukHukumListController::class,'destroy']);
    Route::get('admin/produk-hukum/list-data/jenisdokumen', [ProdukHukumListController::class,'jenisdokumen'])->name('admin.produk_hukum.listdata.jenisdokumen');
    Route::post('admin/produk-hukum/list-data/postjenisdokumen', [ProdukHukumListController::class,'postjenisdokumen'])->name('admin.produk_hukum.listdata.postjenisdokumen');

    Route::get('admin/media-hukum/artikel-hukum/view', [ArtikelHukumListController::class,'index'])->name('admin.media_hukum.artikelhukum.index');
    Route::get('admin/media-hukum/artikel-hukum/create', [ArtikelHukumListController::class,'create'])->name('admin.media_hukum.artikelhukum.create');
    Route::post('admin/media-hukum/artikel-hukum/store', [ArtikelHukumListController::class,'store'])->name('admin.media_hukum.artikelhukum.store');
    Route::get('admin/media-hukum/artikel-hukum/edit/{id}', [ArtikelHukumListController::class,'edit']);
    Route::post('admin/media-hukum/artikel-hukum/update/{id}', [ArtikelHukumListController::class,'update']);

    Route::get('admin/media-hukum/majalah-hukum/view', [MajalahHukumListController::class,'index'])->name('admin.media_hukum.majalahhukum.index');
    Route::get('admin/media-hukum/majalah-hukum/create', [MajalahHukumListController::class,'create'])->name('admin.media_hukum.majalahhukum.create');
    Route::post('admin/media-hukum/majalah-hukum/store', [MajalahHukumListController::class,'store'])->name('admin.media_hukum.majalahhukum.store');
    Route::get('admin/media-hukum/majalah-hukum/edit/{id}', [MajalahHukumListController::class,'edit']);
    Route::post('admin/media-hukum/majalah-hukum/update/{id}', [MajalahHukumListController::class,'update']);
    
    Route::get('admin/photo-gallery/view', [PhotoController::class,'index'])->name('admin.photo.index');
    Route::get('admin/photo-gallery/create', [PhotoController::class,'create'])->name('admin.photo.create');
    Route::post('admin/photo-gallery/store', [PhotoController::class,'store'])->name('admin.photo.store');
    Route::get('admin/photo-gallery/delete/{id}', [PhotoController::class,'destroy']);
    Route::get('admin/photo-gallery/edit/{id}', [PhotoController::class,'edit']);
    Route::post('admin/photo-gallery/update/{id}', [PhotoController::class,'update']);
    
    Route::get('admin/media-hukum/berita/view', [BeritaListController::class,'index'])->name('admin.media_hukum.berita.index');
    Route::get('admin/media-hukum/berita/create', [BeritaListController::class,'create'])->name('admin.media_hukum.berita.create');
    Route::post('admin/media-hukum/berita/store', [BeritaListController::class,'store'])->name('admin.media_hukum.berita.store');
    Route::get('admin/media-hukum/berita/edit/{id}', [BeritaListController::class,'edit']);
    Route::post('admin/media-hukum/berita/update/{id}', [BeritaListController::class,'update']);
    Route::get('admin/media-hukum/berita/delete/{id}', [BeritaListController::class,'destroy']);
    
    Route::get('admin/media-hukum/category-berita/view', [BeritaListController::class,'category'])->name('admin.media_hukum.berita.category');
    Route::get('admin/media-hukum/category-berita/create', [BeritaListController::class,'categorycreate'])->name('admin.media_hukum.berita.categorycreate');
    Route::get('admin/media-hukum/category-berita/edit/{id}', [BeritaListController::class,'categoryedit']);
    Route::post('admin/media-hukum/category-berita/store', [BeritaListController::class,'categorystore'])->name('admin.media_hukum.berita.categorystore');
    Route::post('admin/media-hukum/category-berita/update/{id}', [BeritaListController::class,'categoryupdate']);
    
    Route::get('admin/dashboard/getyear/{years}', [DashboardControllerForAdmin::class,'getyear'])->name('admin.dashboard.getyear');
});

/* --------------------------------------- */
/* JDIH Front End Route */
/* --------------------------------------- */
Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::get('/', [HomeController::class,'index'])->name('homepage');
    Route::post('search', [SearchController::class,'index']);
    Route::get('search', function() {abort(404);});
    
    Route::get('terms-and-conditions', [TermController::class,'index'])->name('front.term');
    Route::get('privacy-policy', [PrivacyController::class,'index'])->name('front.privacy');
    
    Route::get('admin', function () {return redirect('admin/login');});
    Route::get('admin/login', [LoginControllerForAdmin::class,'index'])->name('admin.login');
    Route::post('admin/login/store', [LoginControllerForAdmin::class,'store'])->name('admin.login.store');
    Route::get('admin/forget-password', [ForgetPasswordControllerForAdmin::class,'index'])->name('admin.forget_password');
    Route::post('admin/forget-password/store', [ForgetPasswordControllerForAdmin::class,'store'])->name('admin.forget_password.store');
    
    Route::get('visi-misi', [VisiMisiController::class,'index'])->name('front.visimisi');
    Route::get('struktur-organisasi', [StrukturOrganisasiController::class,'index'])->name('front.strukturorganisasi');
    Route::get('tupoksi', [TupoksiController::class,'index'])->name('front.tupoksi');
    Route::get('spmipm', [SurveyController::class,'index'])->name('front.spmipm');
    Route::post('spmipm/create', [SurveyController::class,'create'])->name('front.spmipm.create');

    Route::get('produkhukum/{slug}', [ProdukHukumController::class,'peraturan'])->name('front.peraturanhukum');
    Route::get('produkhukum/{menuslug}/{slug}', [ProdukHukumController::class,'detail']);
    Route::post('produkshukum/search-peraturan', [SearchPeraturanController::class,'index']);
    Route::get('produkshukum/search-peraturan', [SearchPeraturanController::class,'index']);

    Route::get('artikel-hukum', [ArtikelHukumController::class,'index'])->name('front.artikelhukum');
    Route::get('artikel-hukum/{slug}', [ArtikelHukumController::class,'detail']);
    Route::post('search-artikel-hukum', [SearchArtikelHukumController::class,'index']);

    Route::get('majalah-hukum', [MajalahHukumController::class,'index'])->name('front.majalahhukum');
    Route::get('majalah-hukum/{slug}', [MajalahHukumController::class,'detail']);
    Route::post('search-majalah-hukum', [SearchMajalahHukumController::class,'index']);

    Route::get('frontpage/{slug}', [FrontPageController::class,'index'])->name('front.frontpage');
    Route::get('frontpage/{menuslug}/{slug}', [FrontPageController::class,'detail']);
    Route::post('frontpage/search-dokumen/{slug}', [SearchPeraturanController::class,'dokumen']);
    Route::get('frontpage/search-dokumen/{slug}', [SearchPeraturanController::class,'dokumen']);
    Route::get('berita/{slug}', [FrontPageController::class,'detailBerita'])->name('front.detailberita'); 
});

Route::get('integrasi.go', [App\Http\Controllers\api\ProdukHukumController::class, 'integrasi']);