<?php
/*
 * index3.php - Bootstrap 5 version of index.php
 *
 * Changes from the Bootstrap 3 original:
 *  - Bootstrap 5.3.3 (bundle incl. Popper), jQuery 3.7.1 kept only for footer.js / legacy scripts
 *  - BS3-only plugins removed (bootstrap-dropdownhover, bcSwipe, normalise-carousel-heights, YTPlayer);
 *    hover-to-open megamenu is done in CSS, swipe is built into the BS5 carousel (touch: true)
 *  - data-* attributes -> data-bs-*, .item -> .carousel-item, col-xs-* -> col-*, .close -> .btn-close
 *  - Sidebar affix (removed in BS4+) replaced with position: sticky
 *  - Galleries are generated from PHP arrays (same images/captions/order as index.php)
 *  - Each thumbnail is a <button> that opens the modal at the right slide (keyboard accessible)
 */

$captions = [
	'cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.',
	'Proin eget tortor risus. Nulla porttitor accumsan tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere ',
	'Slidecubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ac diam sit amet quam vehicula description.',
	'Donec tus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Doices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.ption.',
	'Slinsectetur adipiscing elit. Sed porttitor lectus nibh. Doices posuere cubilia Curae; Donec vescription.',
];
$defaultCaption = 'Slidt nisi, pretium ut lacinia in, elementum id enim. Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus..';

$baseImages = [
	'//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/studying/ug-home-930.jpg',
	'//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/studying/pgt-home.jpg',
	'//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/studying/img1b.jpg',
	'//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/studying/streatham_aerial_2016.jpg',
	'//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/studying/mitch-smith-930.jpg',
	'//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/studying/student-life930.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/computer-science/responsive/Computer_labs_930.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/banners/Geology_Field_Course_930x500.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/campusservices/accommodation/images/students/generic-grass-students-laptop.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/banners/PG_Comp_Sci_2_930x500.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/banners/Engineering_930x500.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/postgraduate/Postgraduate_Taught_2.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/computer-science/responsive/VR_Green_930.jpg',
	'https://emps.exeter.ac.uk/media/universityofexeter/emps/computer-science/responsive/Computer_lab_930.jpg',
];

$extraImages = [
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Alexis-Fernandez.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Syd-AndDana-Takeshta-1.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Ariana-Jordan-Maddox.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Brandon-Hesson.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Brittany-Hohenstein-1.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Camille-Girard.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Christina-Humphreys.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Diane-Villadsen1.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Emily-Kaar1.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Hayley-Dolson.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Jason-Cox.jpg',
	'https://www.lookslikefilm.com/wp-content/uploads/2019/02/Jennifer-Perkins.jpg',
];

function build_slides(array $srcs, array $captions, $defaultCaption) {
	$slides = [];
	foreach ($srcs as $i => $src) {
		$slides[] = ['src' => $src, 'caption' => isset($captions[$i]) ? $captions[$i] : $defaultCaption];
	}
	return $slides;
}

/**
 * Renders a thumbnail grid + modal carousel.
 * $colClass: Bootstrap 5 column classes for each thumbnail, e.g. 'col-4 col-sm-2'
 */
function render_gallery($n, $title, $colClass, array $slides) {
	$h = function ($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); };
	$modalId    = 'gallery-modal' . $n;
	$carouselId = 'gallery-carousel' . $n;
	$total      = count($slides);
	?>
<h2><?= $h($title) ?></h2>

<div class="gallery row g-2">
<?php foreach ($slides as $i => $slide): ?>
	<div class="<?= $h($colClass) ?>">
		<button type="button" class="hovereffect" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>" data-carousel="#<?= $carouselId ?>" data-slide-index="<?= $i ?>" aria-label="Open image <?= $i + 1 ?> of <?= $total ?>">
			<img src="<?= $h($slide['src']) ?>" alt="" loading="lazy">
			<span class="overlay"><span class="fas fa-search-plus" aria-hidden="true"></span></span>
		</button>
	</div>
<?php endforeach; ?>
</div>

<!-- modal window-->
<div class="gallery-modal modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>-title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="<?= $modalId ?>-title"><?= $h($title) ?></h4>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
			</div>
			<div class="modal-body">
				<!--begin carousel-->
				<div class="carousel slide" id="<?= $carouselId ?>" data-bs-interval="false" data-bs-touch="true">
					<div class="carousel-inner">
<?php foreach ($slides as $i => $slide): ?>
						<div class="carousel-item<?= $i === 0 ? ' active' : '' ?>">
							<img class="d-block w-100" alt="" src="<?= $h($slide['src']) ?>">
							<div class="carousel-caption">
								<p><?= $h($slide['caption']) ?></p>
							</div>
						</div>
<?php endforeach; ?>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="prev">
						<span class="fas fa-sign-out-alt fa-rotate-180 fa-lg" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="next">
						<span class="fas fa-sign-out-alt fa-lg" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /modal window-->
<?php
}

$slidesBase = build_slides($baseImages, $captions, $defaultCaption);
$slidesAll  = build_slides(array_merge($baseImages, $extraImages), $captions, $defaultCaption);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>Study | Study | University of Exeter</title>

<meta name="description" content="The University of Exeter in the south west UK offers undergraduate honours and postgraduate Masters and research degree courses in sciences, social sciences, law, business, humanities and arts." />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.5.0/css/all.css">

<link rel="stylesheet" href="//use.typekit.net/iuu1hnn.css">

<!-- styles.css --><link rel="stylesheet" href="https://www.exeter.ac.uk/media/universityofexeter/recruitmentsites/css/styles.css" type="text/css" media="screen" />
<!-- responsive.css --><link rel="stylesheet" href="https://www.exeter.ac.uk/media/universityofexeter/recruitmentsites/css/responsive.css" type="text/css" media="screen" />

<!-- jQuery kept for footer.js / legacy site scripts; Bootstrap 5 itself does not need it -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="//try.abtasty.com/25815a6dd8d07c10e8a6399806c4f922.js"></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K4NS9FB');</script>
<!-- End Google Tag Manager -->

<script>
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-7878092-1']);
	_gaq.push(['_setDomainName', 'exeter.ac.uk']);
	_gaq.push(['_trackPageview']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

	// detect if user prints page
	try{
	(function() {
	var afterPrint = function() {
	_gaq.push(['_trackEvent', 'Print Intent', document.location.pathname]); //for classic GA
	};
	if (window.matchMedia) {
	var mediaQueryList = window.matchMedia('print');
	mediaQueryList.addListener(function(mql) {
	if (!mql.matches)
	afterPrint();
	});
	}
	window.onafterprint = afterPrint;
	}());
	} catch(e) {}
</script>
<!-- Hotjar Tracking Code -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:981027,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<!-- get text/inhead from universal config --> <style type="text/css">#logo-text {display:none;}</style>

<link rel="stylesheet" type="text/css" href="//www.exeter.ac.uk/codebox/cookie-policy-notification/styles.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script src="//www.exeter.ac.uk/codebox/cookie-policy-notification/notification.js"></script>

<style>
/* ---------- Header / megamenu (BS5 replacements for BS3 + dropdownhover plugin) ---------- */
#header .navbar-nav .dropdown-megamenu { position: static; }
#header .dropdown-megamenu > .dropdown-menu {
	width: 100%;
	left: 0;
	right: 0;
	margin-top: 0;
	border-radius: 0;
	padding: 20px 0;
}
#header .dropdown-megamenu .dropdown-menu ul { list-style: none; padding-left: 0; }
#header .dropdown-megamenu .dropdown-menu img { max-width: 100%; height: auto; }
#header .navbar-toggler { border: 0; }

@media (min-width: 768px) {
	/* open megamenu on hover (replaces bootstrap-dropdownhover.js) */
	#header .dropdown-megamenu:hover > .dropdown-menu { display: block; }
}

/* Global map: neutralise BS5's default indicator bar styling */
#global-map .carousel-indicators {
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	list-style: none;
}
#global-map .carousel-indicators [data-bs-target] {
	box-sizing: border-box;
	flex: initial;
	width: auto;
	height: auto;
	margin: 0;
	padding: 0;
	text-indent: 0;
	background: none;
	border: 0;
	opacity: 1;
}
#global-map .carousel-item img { max-width: 100%; height: auto; }

/* Sidebar: position: sticky replaces the BS3 affix plugin */
@media (min-width: 768px) {
	#sidebar-navbar { position: sticky; top: 20px; }
}
#sidebar .nav-link { padding-left: 0; }

/* ---------- Gallery ---------- */
.gallery { margin-bottom: 20px; }

.gallery-modal .modal-header { background: linear-gradient(#3675A6, #266290); border-bottom: unset; }
.gallery-modal .modal-header h4 { margin-bottom: 0; color: #fff; }
.gallery-modal .modal-body { padding: 0; }
.gallery-modal .modal-content { background-color: unset; border: 0; }
.gallery-modal .carousel { margin-bottom: 0; }
.gallery-modal .carousel p { font-size: 16px; line-height: 1.4; }

.gallery-modal .carousel-control-prev,
.gallery-modal .carousel-control-next { color: #fff; }
.gallery-modal .carousel-control-prev:hover,
.gallery-modal .carousel-control-next:hover { opacity: .8; }
.gallery-modal .carousel-control-prev { justify-content: flex-start; padding-left: 20px; }
.gallery-modal .carousel-control-next { justify-content: flex-end; padding-right: 20px; }

.modal-backdrop.show { opacity: .8; }

@media (min-width: 768px) {
	.gallery-modal .modal-dialog {
		min-width: 530px;
		max-width: 930px;
	}
	.gallery .col-sm-1 .hovereffect { height: 42px; }
	.gallery .col-sm-1 .hovereffect img { height: 100%; object-fit: cover; }
}

@media only screen and (max-width: 768px) {
	.gallery-modal .carousel-caption {
		background: #000;
		color: #fff;
		padding: 10px;
	}
	.gallery-modal .carousel-caption p { margin-bottom: 0; }
}
@media only screen and (max-width: 320px) {
	.carousel-caption { display: none; }
}

/* thumbnail hover effect (thumbnail is now a <button>) */
.hovereffect {
	display: block;
	width: 100%;
	height: 100%;
	padding: 0;
	border: 0;
	background: none;
	overflow: hidden;
	position: relative;
	text-align: center;
	cursor: pointer;
}

.hovereffect .overlay {
	position: absolute;
	overflow: hidden;
	width: 80%;
	height: 80%;
	left: 10%;
	top: 10%;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #fff;
	border-bottom: 1px solid #FFF;
	border-top: 1px solid #FFF;
	transition: opacity 0.35s, transform 0.35s;
	transform: scale(0,1);
}

.hovereffect:hover .overlay,
.hovereffect:focus-visible .overlay { opacity: 1; transform: scale(1); }

.hovereffect img {
	display: block;
	width: 100%;
	position: relative;
	transition: all 0.35s;
}

.hovereffect:hover img,
.hovereffect:focus-visible img { filter: brightness(0.6); }

.hovereffect .overlay .fas {
	opacity: 0;
	transition: opacity 0.35s, transform 0.35s;
	transform: translate3d(0,100%,0);
}
.hovereffect:hover .overlay .fas,
.hovereffect:focus-visible .overlay .fas { opacity: 1; transform: translate3d(0,0,0); }

.col-sm-1 .hovereffect .overlay .fas { font-size: .75em; }
</style>

</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K4NS9FB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php // include 'unbranded-assets/globalnavv2/index.php' ?>

<section id="quick-links">
	<div id="quick-links-collapse" class="collapse container">
		<div class="row">
			<div class="col-6 col-sm-3">
				<p class="col-title">For students</p>
				<ul>
					<li><a href="//www.exeter.ac.uk/students/">Current Students website</a></li>
					<li><a href="//vle.exeter.ac.uk/">ELE</a></li>
					<li><a href="//email365.exeter.ac.uk/">Email web access</a></li>
					<li><a href="//www.exeter.ac.uk/students/finance/makeapayment/">Make a payment</a></li>
					<li><a href="//i.exeter.ac.uk/">iExeter (students)</a></li>
					<li><a href="//as.exeter.ac.uk/library/">Library</a></li>
					<li><a href="//sid.exeter.ac.uk/aspx_shared/login.aspx">SID</a></li>
					<li><a href="//mytimetable.exeter.ac.uk">Timetable</a></li>
				</ul>
			</div>
			<div class="col-6 col-sm-3">
				<p class="col-title">For staff</p>
				<ul>
					<li><a href="//www.exeter.ac.uk/staff/">Current staff website</a></li>
					<li><a href="//i.exeter.ac.uk/">iExeter (staff)</a></li>
					<li><a href="//sid.exeter.ac.uk/aspx_shared/login.aspx">SID</a></li>
					<li><a href="//email365.exeter.ac.uk/" target="_blank">Email web access</a></li>
					<li><a href="//admin.exeter.ac.uk/academic/timetable/rb/req09/">Room Bookings</a></li>
					<li><a href="//staff.exeter.ac.uk/">Trent</a></li>
					<li><a href="//www.exeter.ac.uk/finance/financehelpdesk/">Finance Helpdesk</a></li>
					<li><a href="//www.exeter.ac.uk/ithelpdesk/">IT Helpdesk</a></li>
				</ul>
			</div>
			<div class="col-6 col-sm-3">
				<p class="col-title">Popular links</p>
				<ul>
					<li><a href="//www.exeter.ac.uk/accommodation/">Accommodation</a></li>
					<li><a href="//www.exeter.ac.uk/alumnisupporters/">Alumni</a></li>
					<li><a href="//www.exeter.ac.uk/contact/">Contacts</a></li>
					<li><a href="//www.exeter.ac.uk/graduation/">Graduation</a></li>
					<li><a href="//jobs.exeter.ac.uk/">Job vacancies</a></li>
					<li><a href="//sport.exeter.ac.uk/">Sport</a></li>
					<li><a href="//www.exeter.ac.uk/undergraduate/study/termdates/">Term dates</a></li>
				</ul>
			</div>
			<div class="col-6 col-sm-3">
				<p class="col-title">Novel Coronavirus</p>
				<ul>
					<li><a href="//www.exeter.ac.uk/coronavirus/">Information and advice</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section id="site-search">
	<div id="site-search-collapse" class="collapse container">
		<div class="py-3">
			<form action="https://search.exeter.ac.uk/s/search.html" method="GET" autocomplete="off">
				<input type="hidden" name="collection" id="collection" value="all-exeter-uni">
				<input type="hidden" name="search_param" value="all" id="search_param">
				<div class="input-group input-group-lg">
					<input type="text" class="form-control" name="query" id="query" placeholder="Search the website" aria-label="Search the website">
					<button class="btn button" type="submit">Search all</button>
				</div>
			</form>
		</div>
	</div>
</section>

<nav id="header" class="navbar navbar-expand-md">
	<div class="container flex-wrap">

		<a href="//www.exeter.ac.uk" id="logo"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/logo.png" alt="University of Exeter" /></a>

		<div id="site-nav">
			<a class="fa fa-search" data-bs-toggle="collapse" href="#site-search-collapse" role="button" aria-expanded="false" aria-controls="site-search-collapse" aria-label="Search"></a><a data-bs-toggle="collapse" href="#quick-links-collapse" role="button" aria-expanded="false" aria-controls="quick-links-collapse">Quick links</a>
		</div>

		<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#header-navbar" aria-controls="header-navbar" aria-expanded="false" aria-label="Toggle global links">Global links <i class="fas fa-bars"></i></button>

		<div class="collapse navbar-collapse" id="header-navbar">
			<ul class="navbar-nav">

				<li class="nav-item dropdown dropdown-megamenu">
					<a href="#" class="nav-link dropdown-toggle" role="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside">Study</a>
					<div class="dropdown-container dropdown-menu">
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-2">
									<p class="col-title"><a href="//www.exeter.ac.uk/study/">Study <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/chooseexeter/">Choose Exeter</a></li>
										<li><a href="//www.exeter.ac.uk/study/campuses/">Our campuses</a></li>
										<li><a href="//www.exeter.ac.uk/study/life/">Student life</a></li>
										<li><a href="//www.exeter.ac.uk/study/careers/">Careers</a></li>
										<li><a href="//www.exeter.ac.uk/study/international/">International students</a></li>
										<li><a href="//www.exeter.ac.uk/study/life/ask-a-student/">Ask a current student</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-2">
									<p class="col-title"><a href="//www.exeter.ac.uk/undergraduate/">Undergraduate <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/undergraduate/courses/">Courses</a></li>
										<li><a href="//www.exeter.ac.uk/degreeapprenticeships/apprentices/">Degree Apprenticeships</a></li>
										<li><a href="//www.exeter.ac.uk/undergraduate/visit/">Open Days</a></li>
										<li><a href="//www.exeter.ac.uk/undergraduate/prospectus/">Prospectus</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-2">
									<p class="col-title"><a href="//www.exeter.ac.uk/postgraduate/">Masters <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/postgraduate/courses/">Courses</a></li>
										<li><a href="//online.exeter.ac.uk/">Online study</a></li>
										<li><a href="//www.exeter.ac.uk/degreeapprenticeships/apprentices/">Degree Apprenticeships</a></li>
										<li><a href="//www.exeter.ac.uk/postgraduate/visit/">Open Days</a></li>
										<li><a href="//www.exeter.ac.uk/postgraduate/prospectus/">Prospectus</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-2">
									<p class="col-title"><a href="//www.exeter.ac.uk/pg-research/">PhD <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/pg-research/degrees/">Research topics</a></li>
										<li><a href="//www.exeter.ac.uk/pg-research/money/">Fees and funding</a></li>
										<li><a href="//www.exeter.ac.uk/pg-research/apply/">How to apply</a></li>
										<li><a href="//www.exeter.ac.uk/pg-research/visit/">Open Days</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-2">
									<p class="col-title"><a href="//www.exeter.ac.uk/teachertraining/">Teacher training <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/teachertraining/primary/structure/">Primary PGCE</a></li>
										<li><a href="//www.exeter.ac.uk/teachertraining/secondary/structure/">Secondary PGCE</a></li>
										<li><a href="//www.exeter.ac.uk/teachertraining/schooldirect/">School Direct</a></li>
										<li><a href="//www.exeter.ac.uk/teachertraining/apply/opendays/">Open Days</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /dropdown-container -->
				</li>

				<li class="nav-item dropdown dropdown-megamenu">
					<a href="#" class="nav-link dropdown-toggle" role="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside">Research</a>
					<div class="dropdown-container dropdown-menu">
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-4">
									<p class="col-title"><a href="//www.exeter.ac.uk/research/">About research at Exeter <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="https://researchandinnovation.co.uk">Research and Innovation blog</a></li>
										<li><a href="//www.exeter.ac.uk/research/news/">Research news</a></li>
										<li><a href="//www.exeter.ac.uk/research/events/">Research events</a></li>
										<li><a href="//www.exeter.ac.uk/pg-research/">PhDs</a></li>
										<li><a href="//www.exeter.ac.uk/joinus/">Academic vacancies</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-4">
									<p class="col-title">Research in the...</p>
									<ul>
										<li><a href="//business-school.exeter.ac.uk/research/business_school/">Business School</a></li>
										<li><a href="//emps.exeter.ac.uk/research/ourresearch/">College of Engineering, Mathematics and Physical Sciences</a></li>
										<li><a href="//humanities.exeter.ac.uk/research/about/">College of Humanities</a></li>
										<li><a href="//lifesciences.exeter.ac.uk/research/">College of Life and Environmental Sciences</a></li>
										<li><a href="//socialsciences.exeter.ac.uk/research/about/">College of Social Sciences and International Studies</a></li>
										<li><a href="//medicine.exeter.ac.uk/research/ourresearch/">College of Medicine and Health</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-4">
									<a href="//www.exeter.ac.uk/business/">
										<p class="col-title">Working with business <i class="fas fa-chevron-right"></i></p>
										<p><img class="img-fluid" src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/biz-image.jpg" alt="Students chatting"></p>
										<p>We are a globally recognised centre of research excellence, with expertise, facilities and people who can make a real difference to your business</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- /dropdown-container -->
				</li>

				<li class="nav-item dropdown dropdown-megamenu">
					<a href="#" class="nav-link dropdown-toggle" role="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside">Global</a>
					<div class="dropdown-container dropdown-menu">
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<p class="col-title"><a href="//www.exeter.ac.uk/global/">Global Exeter</a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/departments/globalpartnerships/">Global partnerships</a></li>
										<li><a href="//www.exeter.ac.uk/study/international/">International students</a></li>
										<li><a href="//www.exeter.ac.uk/studyabroad/">Study abroad</a></li>
										<li><a href="//www.exeter.ac.uk/internationalsummerschool/">International Summer School</a></li>
										<li><a href="//www.exeter.ac.uk/preunisummerschool/">Pre-University Summer School</a></li>
										<li><a href="//www.exeter.ac.uk/alumnisupporters/networks/international/">International Alumni</a></li>
										<li><a href="//www.exeter.ac.uk/global/news/all">International News</a></li>
									</ul>
								</div>
								<section id="global-map" class="col-md-9">
									<div id="carousel-global-map" class="carousel slide" data-bs-ride="carousel">
										<div class="row">
											<div class="col-sm-4">
												<div class="carousel-inner">
													<div class="carousel-item"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-1.jpg" alt="University of British Columbia">
														<p class="location-title">The University of British Columbia</p>
														<p>Activities between the University of British Columbia and Exeter include a joint research symposium focused on Community, Culture, Creativity, and Wellbeing held at Exeter in May 2018 and a faculty-led, co-funded initiatives in Sport, Exercise and Health Sciences, Climate Change and Digital Humanities.</p>
													</div>
													<div class="carousel-item"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-2.jpg" alt="University of South Florida">
														<p class="location-title">University of South Florida</p>
														<p>University of South Florida and Exeter have entered into a 5 year student exchange between the two Universities. They launched the University of Exeter / University of South Florida Research Catalyst Fund to provide grants to support joint research initiatives between the two institutions.</p>
													</div>
													<div class="carousel-item"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-3.jpg" alt="Tsinghua University">
														<p class="location-title">Tsinghua University</p>
														<p>The University of Exeter and Tsinghua University have launched a jointly-awarded PhD degree programme in climate and environmental sciences which supports six students to be co-supervised between Tsinghua's Department of Earth System Science and Colleges at Exeter that conduct research on earth systems and environmental sciences. <strong><a href="//www.exeter.ac.uk/news/featurednews/title_623440_en.html">Read more</a></strong>.</p>
													</div>
													<div class="carousel-item"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-4.jpg" alt="Hong Kong University of Science and Technology (HKUST)">
														<p class="location-title">Hong Kong University of Science and Technology (HKUST)</p>
														<p>A partnership between Exeter and HKUST will enable students embarking on Engineering or Computer Science undergraduate degrees at HKUST to finish their degree at Exeter, before spending a fifth year at Exeter's Law School, completing either an LLM (Master of Laws) or a Juris Doctor (JD). <strong><a href="//socialsciences.exeter.ac.uk/law/newsandevents/news/articles/hongkonguniversityofscienc.php">Read more</a></strong>.</p>
													</div>
													<div class="carousel-item"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-5.jpg" alt="Nanyang Technological University">
														<p class="location-title">Nanyang Technological University</p>
														<p>NTU and Exeter are working in partnership to deliver six split-site Biomedical PhD studentships. If successful, you will benefit from expert supervision from researchers in both institutions and have the opportunity to research and live in two great locations, for up to eighteen months in each.</p>
													</div>
													<div class="carousel-item"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-8.jpg" alt="University of Geneva">
														<p class="location-title">University of Geneva</p>
														<p>To celebrate, and further extend, the strong relationship of staff within the University of Exeter and the University of Geneva, the two universities have launched a new seed fund to support developing research links.</p>
													</div>
													<div class="carousel-item active"><img src="//www.exeter.ac.uk/media/universityofexeter/recruitmentsites/images/global-map-thumb-9.jpg" alt="University of Queensland">
														<p class="location-title">University of Queensland</p>
														<p>The University of Exeter and The University of Queensland have partnered to establish the QUEX Institute, a new multi-million pound partnership designed to bolster their joint global research impact. <strong><a href="https://www.exeter.ac.uk/quex/">Read more.</a></strong></p>
													</div>
												</div>
											</div>
											<div class="col-sm-8">
												<div id="map-section">
													<ul class="carousel-indicators">
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="0"><a href="#" title="The University of British Columbia"><i class="far fa-dot-circle"></i><span>The University of British Columbia</span></a></li>
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="1"><a href="#" title="University of South Florida"><i class="far fa-dot-circle"></i><span>University of South Florida</span></a></li>
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="2"><a href="#" title="Tsinghua University"><i class="far fa-dot-circle"></i><span>Tsinghua University</span></a></li>
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="3"><a href="#" title="Hong Kong University of Science and Technology"><i class="far fa-dot-circle"></i><span>Hong Kong University of Science and Technology</span></a></li>
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="4"><a href="#" title="Nanyang Technological University"><i class="far fa-dot-circle"></i><span>Nanyang Technological University</span></a></li>
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="5"><a href="#" title="University of Geneva"><i class="far fa-dot-circle"></i><span>University of Geneva</span></a></li>
														<li data-bs-target="#carousel-global-map" data-bs-slide-to="6" class="active" aria-current="true"><a href="#" title="University of Queensland"><i class="far fa-dot-circle"></i><span>University of Queensland</span></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
					<!-- /dropdown-container -->
				</li>

				<li class="nav-item"><a class="nav-link" href="//www.exeter.ac.uk/departments/">Our departments</a></li>

				<li class="nav-item dropdown dropdown-megamenu">
					<a href="#" class="nav-link dropdown-toggle" role="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside">About us</a>
					<div class="dropdown-container dropdown-menu">
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<p class="col-title"><a href="//www.exeter.ac.uk/about/">About the University <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/about/organisation/overview/">Organisation</a></li>
										<li><a href="//www.exeter.ac.uk/about/vision/about/">Strategies</a></li>
										<li><a href="//www.exeter.ac.uk/about/community/uni/">Local community</a></li>
										<li><a href="//www.exeter.ac.uk/about/facts/termdates/">Term dates</a></li>
										<li><a href="//www.exeter.ac.uk/alumnisupporters/">Alumni and supporters</a></li>
										<li><a href="//www.exeter.ac.uk/business/">Working with Business</a></li>
										<li><a href="//www.exeter.ac.uk/exceptional/">Fundraising campaign</a></li>
										<li><a href="https://jobs.exeter.ac.uk/">Job vacancies</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-3">
									<p class="col-title"><a href="https://www.exeter.ac.uk/contact/">Contact us <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/contact/">General enquiries</a></li>
										<li><a href="//www.exeter.ac.uk/phone/">Phone directory</a></li>
										<li><a href="//www.exeter.ac.uk/socialmedia/">Social Media</a></li>
										<li><a href="//www.exeter.ac.uk/news/contact/">Press and media</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-3">
									<p class="col-title"><a href="//www.exeter.ac.uk/visit/">Campuses and visitors <i class="fas fa-chevron-right"></i></a></p>
									<ul>
										<li><a href="//www.exeter.ac.uk/visit/directions/">Maps and directions</a></li>
										<li><a href="//www.exeter.ac.uk/visit/campuses/">Our campuses</a></li>
										<li><a href="//www.exeter.ac.uk/visit/facilities/culture/">Arts and culture</a></li>
										<li><a href="//sport.exeter.ac.uk">Sports facilities</a></li>
										<li><a href="//www.exeter.ac.uk/visit/facilities/events/">Events and conferences</a></li>
										<li><a href="//www.exeter.ac.uk/visit/facilities/holidayaccommodation/">Holiday accommodation</a></li>
										<li><a href="//www.exeter.ac.uk/visit/facilities/shops/">Eat and shop</a></li>
									</ul>
								</div>
								<div class="col-sm-6 col-md-3" id="news">
									<p class="col-title"><a href="//www.exeter.ac.uk/news/">News and events <i class="fas fa-chevron-right"></i></a></p>
									<a href="//www.exeter.ac.uk/news/homepage/title_801911_en.html">
										<img class="img-fluid" src="//www.exeter.ac.uk/media/universityofexeter/newsarchive/people/splash/web_Liz_Trinder_splash_456x277.jpg" alt="">
										<h4 class="news-title">University of Exeter research leads to historic introduction of no fault divorce in England</h4>
									</a>
									<p>18 June 2020</p>
									<ul>
										<li><a href="//www.exeter.ac.uk/news/">View all news</a></li>
										<li><a href="//www.exeter.ac.uk/news/events/">View all events</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /dropdown-container -->
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
<!-- /header -->

<section id="section-title">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p>Study</p>
			</div>
		</div>
	</div>
</section>

<div class="container" id="main-container">
	<div class="row">

		<div class="col-md-12" id="breadcrumb-col">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Study</li>
				</ol>
			</nav>
		</div>

		<div class="col-md-3" id="side-nav-col">
			<div id="sidebar-navbar-toggle" class="d-md-none mb-2">
				<button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="collapse" data-bs-target="#sidebar-navbar" aria-controls="sidebar-navbar" aria-expanded="false">Menu <i class="fas fa-bars"></i></button>
			</div>
			<div class="collapse d-md-block" id="sidebar-navbar">
				<ul class="nav flex-column" id="sidebar">
					<li class="nav-item" id="top-section"><a class="nav-link" href="/undergraduate/">Undergraduate home</a></li>
					<li class="nav-item" id="section"><a class="nav-link" href="/undergraduate/study/">Academic study</a></li>
					<li class="nav-item"><a class="nav-link" href="/undergraduate/study/flexible/">Flexible study</a></li>
					<li class="nav-item"><a class="nav-link" href="/undergraduate/study/abroad/">Opportunities abroad</a></li>
					<li class="nav-item"><span class="currentbranch0"><a class="nav-link" href="/undergraduate/study/degree-apprenticeships/">Degree Apprenticeships</a></span></li>
					<li class="nav-item"><a class="nav-link" href="/undergraduate/study/resources/">Learning and studying resources</a></li>
					<li class="nav-item"><a class="nav-link" href="/undergraduate/study/universitylevel/">University level study</a></li>
					<li class="nav-item"><a class="nav-link" href="/undergraduate/study/dayinthelife/">A day in the life</a></li>
					<li class="nav-item"><a class="nav-link" href="/undergraduate/study/termdates/">Term dates</a></li>
				</ul>
			</div>
		</div>

		<div class="col-md-9" id="main-col">

			<h1>Gallery DEV</h1>

<?php
render_gallery(1, 'Gallery showing 6 columns', 'col-4 col-sm-2', $slidesBase);
render_gallery(2, 'Gallery showing 4 columns', 'col-4 col-sm-3', $slidesBase);
render_gallery(3, 'Gallery showing 12 columns and different image orientations', 'col-3 col-sm-1', $slidesAll);
?>

		</div>
		<!-- /#main-col -->
	</div>
</div>

<?php include 'https://www.exeter.ac.uk/unbranded-assets/globalfooterv2/index.php' ?>

<!-- footer.js -->
<script src="https://www.exeter.ac.uk/media/universityofexeter/recruitmentsites/js/footer.js"></script>

<!-- navigation object : Footer code -->

<!-- navigation object : Siteimprove deep linking nav object --><!-- 236 -->

<script>
/* Open each gallery modal on the clicked thumbnail's slide (instantly, no slide animation) */
document.querySelectorAll('.gallery .hovereffect').forEach(function (thumb) {
	thumb.addEventListener('click', function () {
		var carousel = document.querySelector(thumb.dataset.carousel);
		var index = parseInt(thumb.dataset.slideIndex, 10);
		carousel.querySelectorAll('.carousel-item').forEach(function (item, i) {
			item.classList.toggle('active', i === index);
		});
	});
});
</script>

</body>
</html>
