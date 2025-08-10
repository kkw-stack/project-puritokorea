<?php
/* ************************************** *
 * Custom Image size
 * ************************************** */
function jt_custom_image_sizes() {

    // JT_Module
    add_image_size('jt_thumbnail_380x200', 380, 200, array('center', 'top')); // Grid
    add_image_size('jt_thumbnail_1192x1192', 1192, 1192, false); // Index, Product, Ingredient, header, search
    add_image_size('jt_thumbnail_596x840', 596, 840, false); // Index, Product, Ingredient, search
    add_image_size('jt_thumbnail_1820x1100', 1820, 1100, false); // Bestseller, Introduction, Contactus
    add_image_size('jt_thumbnail_358x550', 358, 550, false); // Bestseller, Introduction
    add_image_size('jt_thumbnail_780x1294', 780, 1294, false); // TopImage, BrandStory, Createme
    add_image_size('jt_thumbnail_902x902', 902, 902, false); // Ingredient, Product

    // Main
    add_image_size('jt_thumbnail_1903x1071', 1903, 1071, false); // Visual
    add_image_size('jt_thumbnail_780x1206', 780, 1206, false); // Visual
    add_image_size('jt_thumbnail_1820x980', 1820, 980, false); // NewArrival
    add_image_size('jt_thumbnail_716x1100', 716, 1100, false); // NewArrival
    add_image_size('jt_thumbnail_1208x780', 1208, 780, false); // Sensorial
    add_image_size('jt_thumbnail_716x716', 716, 716, false); // Sensorial
    add_image_size('jt_thumbnail_1903x980', 1903, 980, false); // TouchYourSeoul
    add_image_size('jt_thumbnail_443x443', 443, 443, false); // InstaFeed, News&Press
    
    // Ingredient
    add_image_size('jt_thumbnail_1903x660', 1903, 660, false); // TopImage
    add_image_size('jt_thumbnail_749x749', 749, 749, false); // Benefit
    add_image_size('jt_thumbnail_1238x912', 1238, 912, false); // Characteristic
    add_image_size('jt_thumbnail_804x804', 804, 804, false); // Characteristic
    add_image_size('jt_thumbnail_1346x1030', 1346, 1030, false); // Characteristic
    add_image_size('jt_thumbnail_990x760', 990, 760, false); // Characteristic
    add_image_size('jt_thumbnail_749x980', 749, 980, false); // Characteristic
    add_image_size('jt_thumbnail_556x556', 556, 556, false); // Procedure

    // BrandStory
    add_image_size('jt_thumbnail_1903x954', 1903, 954, false); // PC, Createme

    // Common
    add_image_size('jt_thumbnail_596x350', 596, 350, false); // Gnb
    add_image_size('jt_thumbnail_1820x600', 1820, 600, false); // banner
    add_image_size('jt_thumbnail_780x360', 780, 360, false); // banner

    // Product Single
    add_image_size('jt_thumbnail_480x480', 480, 480, false); // Routin
    add_image_size('jt_thumbnail_1820', 1820, 9999, false); // Photo
    add_image_size('jt_thumbnail_716', 716, 9999, false); // Photo, Benefit, proven
    add_image_size('jt_thumbnail_1320x1320', 1320, 1320, false); // Before & After
    add_image_size('jt_thumbnail_1400x1400', 1400, 1400, false); // Benefit
    add_image_size('jt_thumbnail_1208', 1208, 9999, false); // Benefit
    add_image_size('jt_thumbnail_2416', 2416, 9999, false); // proven
    add_image_size('jt_thumbnail_902', 902, 9999, false); // proven
    add_image_size('jt_thumbnail_1804x1804', 1804, 1804, false); // Options
    add_image_size('jt_thumbnail_902x784', 902, 784, false); // Options
    add_image_size('jt_thumbnail_120x120', 120, 120, false); // Icon

    // Product Single New
    add_image_size('jt_thumbnail_1740', 1740, 9999, false); // PhotoFrame
    add_image_size('jt_thumbnail_1208x700', 1208, 700, false); // PhotoExplanation
    add_image_size('jt_thumbnail_716x828', 716, 828, false); // PhotoExplanation
    add_image_size('jt_thumbnail_592', 592, 9999, false); // Before & After(Skin)
    add_image_size('jt_thumbnail_592x836', 592, 836, false); // Type_1ComparisonButton
    add_image_size('jt_thumbnail_580x430', 580, 430, false); // BannerImage
    add_image_size('jt_thumbnail_72x72', 72, 72, false); // BannerIcon

    // News & Press
    add_image_size('jt_thumbnail_1903x760', 1903, 760, false); // PhotoFrame

    // Series
    add_image_size('jt_thumbnail_780', 780, 9999, false);
}
add_action('after_setup_theme', 'jt_custom_image_sizes');
