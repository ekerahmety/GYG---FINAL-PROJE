
<?php
// Veritabanına bağlan
include '../config/unsafedb.php';
session_start();
    if(empty($_SESSION['username'])){ 
        header('Location: login.php');
        exit();
    }


// SQL sorgusu
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Sonuçları kontrol et
if (mysqli_num_rows($result) > 0) {
    // Sonuçları bir diziye al
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // foreach ile yazdır

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username']) && !empty($_POST['_POST'])) {
    // Form verilerini al
    $name = $_SESSION['username'];
    $post_ = $_POST['_POST'];

    // Hazırlıklı ifade (Prepared statement)
    $stmt = $conn->prepare("INSERT INTO posts (username, post) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $post_);

    // Sorguyu çalıştır
    if ($stmt->execute()) {
        header('Location:index.php');
    } else {
        echo "Hata: " . $stmt->error;
    }

    // Hazırlıklı ifadeyi kapat
    $stmt->close();
}

// Bağlantıyı kapat
mysqli_close($conn);
?>

<html lang="en">
<head>
    <style>
        *, *::before, *::after {
	margin:0;
	padding:0;
	box-sizing:border-box;
}
:root {
	--main-color:rgb(29, 161, 242);
	--border-color:rgb(56, 68, 77);
	--shadow-color:rgba(29, 161, 242, 0.1);
}
html {
	color:#fff;
	font-size:15px;
	font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}
body {
	background-color:#15202B;
}
a {
	text-decoration:none;
	color:#fff;
}
button {
	cursor:pointer;
}
input:focus {
	outline:none;
}
img {
	user-drag: none; 
	user-select: none;
	-moz-user-select: none;
	-webkit-user-drag: none;
	-webkit-user-select: none;
	-ms-user-select: none;
	cursor:pointer;
}
.container {
	display:grid;
	grid-template-columns:243px auto 350px;
	margin:0 auto;
	max-width:1200px;
}
.left-side {
	position:fixed;
	height:100vh;
	width:240px;
	padding:0 12px 0 12px;
	display:flex;
	flex-direction:column;
	align-items:flex-end;
}
.left-navbar {
	width:245px;
	height:100%;
	display:flex;
	flex-direction:column;
	justify-content:space-between;
}
.left-side svg, .content-header svg, .post-header svg, .trends svg {
	fill:#fff;
	height:1.75rem;
}
.left-navbar > div:not(.profile-btn) > div:nth-child(2) svg, .left-navbar > div:not(.profile-btn) > div:nth-child(2) span {
	fill:var(--main-color);
	color:var(--main-color);
}
.left-navbar > div:not(.profile-btn) > div:nth-child(1) {
	padding:12px;
}
.left-navbar a {
	display:flex;
	padding:4px 0;
}
.left-navbar a div {
	display:flex;
	padding:12px;
	align-items:center;
	border-radius:9999px;
}
.left-navbar a div:hover {
	background-color:var(--shadow-color);
}
.left-navbar a div:hover svg, .left-navbar a div:hover span {
	color:var(--main-color);
	fill:currentColor;
	
}
.left-navbar a span {
	font-size:20px;
	font-weight:bold;
	margin-left:20px;
	margin-right:16px;
}
.tweet-btn {
	font-family:var(--main-font);
	font-size:16px;
	width:90%;
	height:46px;
	font-weight:700;
	border:none;
	background-color:var(--main-color);
	border-radius:30px;
	color:inherit;
	margin:16px 0;
}
.left-side .right-column {
	display:flex;
	align-items:center;
}
.content {
	border:1px solid var(--border-color);
	border-top:none;
	border-bottom:none;
}
.content-header {
	padding:0 16px;
	max-width:1000px;
	display:flex;
	align-items:center;
	height:53px;
	justify-content:space-between;
	border-bottom:1px solid var(--border-color);
}
.content-header div, .trends-header div, .trends-item > div > div {
	display:flex;
	margin-right:-10px;
	border-radius:100%;
	align-items:center;
	justify-content:center;
	width:38px;
	height:38px;
	cursor:pointer;
}
.trends-header div{
	margin-right:0;
}
.trends-item > div {
	position:relative;
}
.trends-item > div > div {
	position:absolute;
	width:34.75px;
	height:34.75px;
	top:-7px;
	right:0px;
}
.content-header div:hover, .trends-header div:hover, .trends-item > div > div:hover {
	background-color:var(--shadow-color);
}
 .trends-item > div > div:hover svg {
	fill:var(--main-color);
 }
.content-header span {
	font-size:20px;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
	font-weight:900;
}
.content-header svg, .trends-header svg {
	fill:var(--main-color);
	width:22px;
	height:22px;
}
.content-header, .tweet, .post {
	padding:15px;
}
.tweet {
	display:flex;
	border-bottom:1px solid var(--border-color);
}
.post:hover {
	cursor:pointer;
	background-color:rgba(255,255,255, 0.07);
}
.profile-btn {
	display:flex;
	margin:12px 0;
	padding:12px;
	cursor:pointer;
	width:calc(100% + 12px);
	border-radius:9999px;
}
.profile-btn:hover {
	background-color:var(--shadow-color);
}
.profile-btn img {
	width:40px;
	height:40px;
}
.profile-btn strong {
	display:flex;
	align-items:center;
}
.profile-btn svg, .details svg, .search-bar svg{
	height:1.25em;
	margin-left:5px;
	vertical-align:bottom;
}
.tag, .time, .dot, .details svg{
	color:rgb(136, 153, 166);
	fill:rgb(136, 153, 166);
	display:block;
}
.right-column {
	margin-left:15px;
}
.right-column, .right-column form, .right-column input {
	width:100%;
}
.profile-image {
	border-radius:100%;
	width:48px;
	height:48px;
}
.right-column input {
	height:56px;
	background-color:transparent;
	border:none;
}
.right-column input::placeholder, .search::placeholder {
	font-size:20px;
	color:#8899A6;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}
.tweet .right-column .bottom-row {
	width:100%;
	display:flex;
	align-items:center;
	justify-content:space-between;
	margin-top:12px;
}
.tweet .right-column .bottom-row .buttons > div{
	width:38px;
	height:38px;
	border-radius:100%;
	cursor:pointer;
	display:flex;
	align-items:center;
	justify-content:center;
}
.tweet .right-column .bottom-row .buttons {
	display:flex;
}
.tweet .right-column .bottom-row .buttons > div:hover {
	background: var(--shadow-color);
}
.tweet .right-column .bottom-row svg{
	width:22px;
	height:22px;
	fill:var(--main-color);
}
.tweet .right-column .bottom-row .tweet-btn{
	width:90px;
	opacity:1;
	margin:0;
}
.space {
	width:100%;
	height:12px;
	background-color:rgb(25, 39, 52);
	border-bottom:1px solid var(--border-color);
}
.post {
	display:flex;
	border-bottom:1px solid var(--border-color);
}
.post-header {
	display:flex;
	justify-content:space-between;
}
.post-header > div{
	display:flex;
	align-items:center;
}
.dot {
	line-height:20px;
	font-size:15px;
	margin-top:-6px;
}
.details {
	cursor:pointer;
	padding:6px;
	border-radius:100%;
	justify-content:center !important;
}
.details svg {
	margin:0;
}
.details:hover {
	background-color:var(--shadow-color);
}
.details:hover svg {
	fill:var(--main-color);
}
.post-header .tag, .post-header .time, .dot {
	margin-left:4px;
}
.post .bottom-row {
	max-width:425px;
	margin-top:12px;
	justify-content:space-between;
}
.post .bottom-row, .post .bottom-row > div {
	display:flex;
	align-items:center;
	color:rgb(136, 153, 166);
	cursor:pointer;
}
.post .bottom-row > div {
	margin:-8px;
}
.post .bottom-row > div > div {
	border-radius:9999px;
	display:flex;
	align-items:center;
	justify-content:center;
}
.post .bottom-row > div:hover > div {
	background-color:var(--shadow-color);
}
 .bottom-row > div:hover > div svg, .post .bottom-row > div:hover > span {
	color:var(--main-color);
	fill:currentColor;
 }
 .post .bottom-row > div:nth-child(2):hover > div {
	background-color:rgba(23,191,99, 0.2);
}
 .bottom-row > div:nth-child(2):hover > div svg, .post .bottom-row > div:nth-child(2):hover > span {
	color:rgb(23, 191, 99);
	fill:currentColor;
 }
  .post .bottom-row > div:nth-child(3):hover > div {
	background-color:rgba(224,36,94, 0.2);
}
 .bottom-row > div:nth-child(3):hover > div svg, .post .bottom-row > div:nth-child(3):hover > span {
	color:rgb(224,36,94);
	fill:currentColor;
 }
.post .bottom-row span {
	font-size:13px;
}
.post .bottom-row span, .post .bottom-row svg {
	fill:rgb(136, 153, 166);
	color:inherit;
	font-family:inherit;
}
.post .bottom-row svg {
	margin:8px;
	width:1.25em;
	height:1.25em;
}
.post .bottom-row span {
	padding:0 12px;
	line-height:20px;
}
.right-side {
	padding:12px 0 64px 0;
	width:350px;
	margin-left:30px;
}
.search-bar {
	position:relative;
}
.search-bar svg {
	position:absolute;
	top:13px;
	left:12px;
	fill:#8899A6;
}
.search {
	border-radius:30px;
	border:none;
	width:350px;
	height:46px;
	background-color:rgb(37, 51, 65);
	padding-left:60px;
}
.search::placeholder {
	font-size:16px;
}
.trends, .who-to-follow {
	background-color:rgb(25, 39, 52);
	border-radius:15px;
	margin-top:12px;
}
.trends-header, .trends-item, .who-to-follow-header, .user {
	padding:12px 16px;
	border-bottom:1px solid var(--border-color);
}
.trends-header > h2 {
	display:flex;
	justify-content:space-between;
}
.trends-header svg {
	fill:var(--main-color);
}
.trends-item svg, .trends-header svg {
	vertical-align:text-bottom;
}
.trends-item {
	display:flex;
	flex-direction:column;
	cursor:pointer;
	transition-duration:background-color 0.2s;
}
.trends-item:hover, .more-btn:hover, .user:hover {
	background-color:rgba(255,255,255, 0.07);
}
.trends-item > div {
	display:flex;
	justify-content:space-between;
	align-items:center;
}
.trends-item span, .trends-item svg {
	font-size:13px;
	height:1.25rem;
	color:rgb(136, 153, 166);
	fill:rgb(136, 153, 166);
}
.trends-item > span {
	margin-top:4px;
}
.more-btn {
	padding:16px;
	color:var(--main-color);
	cursor:pointer;
	border-bottom-left-radius:15px;
	border-bottom-right-radius:15px;
}
.user {
	display:flex;
	align-items:center;
	cursor:pointer;
}
.user img {
	margin-right:12px;
}
.user > div {
	width:100%;
	display:flex;
	justify-content:space-between;
}
.follow-btn {
	min-height:32px;
	min-width:32px;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
	font-weight:bold;
	font-size:15px;
	padding:0 1em;
	color:var(--main-color);
	border:1px solid currentColor;
	border-radius:9999px;
	background-color:transparent;
}
.follow-btn:hover {
	background-color:var(--shadow-color);
}
.line {
	background-color:rgba(0, 0, 0, 0);
	height:1px;
	border:1px solid rgb(25, 39, 52); 
	margin:16px 0;
	border-radius:16px;
}
.right-side footer nav {
	padding:0 16px;
	display:flex;
	flex-wrap:wrap;
}
.right-side footer span, .right-side footer svg{
	height:1em;
	vertical-align:text-bottom;
	margin:2px 0;
	padding-right:12px;
	line-height:16px;
	color:rgb(136, 153, 166);
	fill:currentColor;
	font-size:13px;
}
.right-side footer svg {
	margin:0;
}
.right-side footer span:not(:last-child):hover {
	cursor:pointer;
	text-decoration:underline;
}
.search, .tweet input {
	color:#fff;
}
    </style>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
	@font-face {
  font-family: TwitterChirpExtendedHeavy;
  src: url(https://abs.twimg.com/fonts/chirp-extended-heavy-web.woff2) format('woff2');
  src: url(https://abs.twimg.com/fonts/chirp-extended-heavy-web.woff) format('woff');
  font-weight: 800;
  font-style: 'normal';
  font-display: 'swap';
}
@font-face {
  font-family: TwitterChirp;
  src: url(https://abs.twimg.com/fonts/chirp-regular-web.woff2) format('woff2');
  src: url(https://abs.twimg.com/fonts/chirp-regular-web.woff) format('woff');
  font-weight: 400;
  font-style: 'normal';
  font-display: 'swap';
}
@font-face {
  font-family: TwitterChirp;
  src: url(https://abs.twimg.com/fonts/chirp-medium-web.woff2) format('woff2');
  src: url(https://abs.twimg.com/fonts/chirp-medium-web.woff) format('woff');
  font-weight: 500;
  font-style: 'normal';
  font-display: 'swap';
}
@font-face {
  font-family: TwitterChirp;
  src: url(https://abs.twimg.com/fonts/chirp-bold-web.woff2) format('woff2');
  src: url(https://abs.twimg.com/fonts/chirp-bold-web.woff) format('woff');
  font-weight: 700;
  font-style: 'normal';
  font-display: 'swap';
}
@font-face {
  font-family: TwitterChirp;
  src: url(https://abs.twimg.com/fonts/chirp-heavy-web.woff2) format('woff2');
  src: url(https://abs.twimg.com/fonts/chirp-heavy-web.woff) format('woff');
  font-weight: 800;
  font-style: 'normal';
  font-display: 'swap';
}
	</style>
	<link rel="stylesheet" href="style.css"></link>
</head>
<body>
	<main class="container">
	<div>
	</div>
		<aside class="left-side">
			<nav class="left-navbar">
			<div>
			<div>
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<g>
						<path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z">
						</path>
					</g>
				</svg>
			</div>
			<div>
					<a href="">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M22.58 7.35L12.475 1.897c-.297-.16-.654-.16-.95 0L1.425 7.35c-.486.264-.667.87-.405 1.356.18.335.525.525.88.525.16 0 .324-.038.475-.12l.734-.396 1.59 11.25c.216 1.214 1.31 2.062 2.66 2.062h9.282c1.35 0 2.444-.848 2.662-2.088l1.588-11.225.737.398c.485.263 1.092.082 1.354-.404.263-.486.08-1.093-.404-1.355zM12 15.435c-1.795 0-3.25-1.455-3.25-3.25s1.455-3.25 3.25-3.25 3.25 1.455 3.25 3.25-1.455 3.25-3.25 3.25z">
								</path>
							</g>
						</svg>
						<span>Ana Sayfa</span>
					</div>
					</a>
			</div>
			
			<div>
					<a href="">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M20.585 9.468c.66 0 1.2-.538 1.2-1.2 0-.662-.54-1.2-1.2-1.2h-3.22l.31-3.547c.027-.318-.07-.63-.277-.875-.206-.245-.495-.396-.822-.425-.65-.035-1.235.432-1.293 1.093l-.326 3.754H9.9l.308-3.545c.06-.658-.43-1.242-1.097-1.302-.665-.05-1.235.43-1.293 1.092l-.325 3.754h-3.33c-.663 0-1.2.538-1.2 1.2 0 .662.538 1.2 1.2 1.2h3.122l-.44 5.064H3.416c-.662 0-1.2.54-1.2 1.2s.538 1.202 1.2 1.202h3.22l-.31 3.548c-.057.657.432 1.24 1.09 1.3l.106.005c.626 0 1.14-.472 1.195-1.098l.327-3.753H14.1l-.308 3.544c-.06.658.43 1.242 1.09 1.302l.106.005c.617 0 1.142-.482 1.195-1.098l.325-3.753h3.33c.66 0 1.2-.54 1.2-1.2s-.54-1.202-1.2-1.202h-3.122l.44-5.064h3.43zm-5.838 0l-.44 5.063H9.253l.44-5.062h5.055z">
								</path>
							</g>
						</svg>
						<span>Keşfet</span>
					</div>
					</a>
			</div>
			
			<div>
					<a href="">
						<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M21.697 16.468c-.02-.016-2.14-1.64-2.103-6.03.02-2.532-.812-4.782-2.347-6.335C15.872 2.71 14.01 1.94 12.005 1.93h-.013c-2.004.01-3.866.78-5.242 2.174-1.534 1.553-2.368 3.802-2.346 6.334.037 4.33-2.02 5.967-2.102 6.03-.26.193-.366.53-.265.838.102.308.39.515.712.515h4.92c.102 2.31 1.997 4.16 4.33 4.16s4.226-1.85 4.327-4.16h4.922c.322 0 .61-.206.71-.514.103-.307-.003-.645-.263-.838zM12 20.478c-1.505 0-2.73-1.177-2.828-2.658h5.656c-.1 1.48-1.323 2.66-2.828 2.66zM4.38 16.32c.74-1.132 1.548-3.028 1.524-5.896-.018-2.16.644-3.982 1.913-5.267C8.91 4.05 10.397 3.437 12 3.43c1.603.008 3.087.62 4.18 1.728 1.27 1.285 1.933 3.106 1.915 5.267-.024 2.868.785 4.765 1.525 5.896H4.38z">
								</path>
							</g>
						</svg>
						<span>Bildirimler</span>
						</div>
					</a>
			</div>
			
			<div>
					<a href="">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M19.25 3.018H4.75C3.233 3.018 2 4.252 2 5.77v12.495c0 1.518 1.233 2.753 2.75 2.753h14.5c1.517 0 2.75-1.235 2.75-2.753V5.77c0-1.518-1.233-2.752-2.75-2.752zm-14.5 1.5h14.5c.69 0 1.25.56 1.25 1.25v.714l-8.05 5.367c-.273.18-.626.182-.9-.002L3.5 6.482v-.714c0-.69.56-1.25 1.25-1.25zm14.5 14.998H4.75c-.69 0-1.25-.56-1.25-1.25V8.24l7.24 4.83c.383.256.822.384 1.26.384.44 0 .877-.128 1.26-.383l7.24-4.83v10.022c0 .69-.56 1.25-1.25 1.25z">
								</path>
							</g>
						</svg>
						<span>Mesajlar</span>
						</div>
					</a>
			</div>
			
			<div>
					<a href="">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M19.9 23.5c-.157 0-.312-.05-.442-.144L12 17.928l-7.458 5.43c-.228.164-.53.19-.782.06-.25-.127-.41-.385-.41-.667V5.6c0-1.24 1.01-2.25 2.25-2.25h12.798c1.24 0 2.25 1.01 2.25 2.25v17.15c0 .282-.158.54-.41.668-.106.055-.223.082-.34.082zM12 16.25c.155 0 .31.048.44.144l6.71 4.883V5.6c0-.412-.337-.75-.75-.75H5.6c-.413 0-.75.338-.75.75v15.677l6.71-4.883c.13-.096.285-.144.44-.144z">
								</path>
							</g>
						</svg>
						<span>Yer İşaretleri</span>
						</div>
					</a>
			</div>
			
			<div>
					<a href="">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M19.75 22H4.25C3.01 22 2 20.99 2 19.75V4.25C2 3.01 3.01 2 4.25 2h15.5C20.99 2 22 3.01 22 4.25v15.5c0 1.24-1.01 2.25-2.25 2.25zM4.25 3.5c-.414 0-.75.337-.75.75v15.5c0 .413.336.75.75.75h15.5c.414 0 .75-.337.75-.75V4.25c0-.413-.336-.75-.75-.75H4.25z">
								</path>
								<path d="M17 8.64H7c-.414 0-.75-.337-.75-.75s.336-.75.75-.75h10c.414 0 .75.335.75.75s-.336.75-.75.75zm0 4.11H7c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h10c.414 0 .75.336.75.75s-.336.75-.75.75zm-5 4.11H7c-.414 0-.75-.335-.75-.75s.336-.75.75-.75h5c.414 0 .75.337.75.75s-.336.75-.75.75z">
								</path>
							</g>
						</svg>
						<span>Listeler</span>
						</div>
					</a>
			</div>
			
			<div>
					<a href="">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<path d="M12 11.816c1.355 0 2.872-.15 3.84-1.256.814-.93 1.078-2.368.806-4.392-.38-2.825-2.117-4.512-4.646-4.512S7.734 3.343 7.354 6.17c-.272 2.022-.008 3.46.806 4.39.968 1.107 2.485 1.256 3.84 1.256zM8.84 6.368c.162-1.2.787-3.212 3.16-3.212s2.998 2.013 3.16 3.212c.207 1.55.057 2.627-.45 3.205-.455.52-1.266.743-2.71.743s-2.255-.223-2.71-.743c-.507-.578-.657-1.656-.45-3.205zm11.44 12.868c-.877-3.526-4.282-5.99-8.28-5.99s-7.403 2.464-8.28 5.99c-.172.692-.028 1.4.395 1.94.408.52 1.04.82 1.733.82h12.304c.693 0 1.325-.3 1.733-.82.424-.54.567-1.247.394-1.94zm-1.576 1.016c-.126.16-.316.246-.552.246H5.848c-.235 0-.426-.085-.552-.246-.137-.174-.18-.412-.12-.654.71-2.855 3.517-4.85 6.824-4.85s6.114 1.994 6.824 4.85c.06.242.017.48-.12.654z">
								</path>
							</g>
						</svg>
						<span>Profil</span>
					</div>
					</a>
			</div>
			
			<div>
					<a href="../logout.php">
					<div>
						<svg viewBox="0 0 24 24">
							<g>
								<circle cx="17" cy="12" r="1.5"></circle>
								<circle cx="12" cy="12" r="1.5"></circle>
								<circle cx="7" cy="12" r="1.5"></circle>
								<path d="M12 22.75C6.072 22.75 1.25 17.928 1.25 12S6.072 1.25 12 1.25 22.75 6.072 22.75 12 17.928 22.75 12 22.75zm0-20C6.9 2.75 2.75 6.9 2.75 12S6.9 21.25 12 21.25s9.25-4.15 9.25-9.25S17.1 2.75 12 2.75z">
								</path>
							</g>
						</svg>
						<span>Çıkış yap</span>
						</div>
					</a>
			</div>
			<button class="tweet-btn">Tweetle</button>
			</div>
			<div class="profile-btn">
				<div class="left-column">
					<img class="profile-image" src="https://pbs.twimg.com/profile_images/1412572443928109062/t83VHF1j_400x400.jpg">
				</div>
				<div class="right-column">
				<div>
					<strong>
					</strong>
				
					</div>
				</div>
			</div>
			</nav>
		</aside>
		<section class="content">
			<header class="content-header">
				<span>Ana Sayfa</span>
				<div>
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<g>
						<path d="M22.772 10.506l-5.618-2.192-2.16-6.5c-.102-.307-.39-.514-.712-.514s-.61.207-.712.513l-2.16 6.5-5.62 2.192c-.287.112-.477.39-.477.7s.19.585.478.698l5.62 2.192 2.16 6.5c.102.306.39.513.712.513s.61-.207.712-.513l2.16-6.5 5.62-2.192c.287-.112.477-.39.477-.7s-.19-.585-.478-.697zm-6.49 2.32c-.208.08-.37.25-.44.46l-1.56 4.695-1.56-4.693c-.07-.21-.23-.38-.438-.462l-4.155-1.62 4.154-1.622c.208-.08.37-.25.44-.462l1.56-4.693 1.56 4.694c.07.212.23.382.438.463l4.155 1.62-4.155 1.622zM6.663 3.812h-1.88V2.05c0-.414-.337-.75-.75-.75s-.75.336-.75.75v1.762H1.5c-.414 0-.75.336-.75.75s.336.75.75.75h1.782v1.762c0 .414.336.75.75.75s.75-.336.75-.75V5.312h1.88c.415 0 .75-.336.75-.75s-.335-.75-.75-.75zm2.535 15.622h-1.1v-1.016c0-.414-.335-.75-.75-.75s-.75.336-.75.75v1.016H5.57c-.414 0-.75.336-.75.75s.336.75.75.75H6.6v1.016c0 .414.335.75.75.75s.75-.336.75-.75v-1.016h1.098c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z">
						</path>
					</g>
				</svg>
				</div>
			</header>
			<div class="tweet">
				<div class="left-column">
					<img class="profile-image" src="https://pbs.twimg.com/profile_images/1412572443928109062/t83VHF1j_400x400.jpg">
				</div>
				<div class="right-column">
					<form class="top-row" method="POST">
					<input placeholder="Neler oluyor??" name="_POST">
				
					<div class="bottom-row">
					<div class="buttons">
					<!-- Picture File Icon -->
						<div>
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<g>
									<path d="M19.75 2H4.25C3.01 2 2 3.01 2 4.25v15.5C2 20.99 3.01 22 4.25 22h15.5c1.24 0 2.25-1.01 2.25-2.25V4.25C22 3.01 20.99 2 19.75 2zM4.25 3.5h15.5c.413 0 .75.337.75.75v9.676l-3.858-3.858c-.14-.14-.33-.22-.53-.22h-.003c-.2 0-.393.08-.532.224l-4.317 4.384-1.813-1.806c-.14-.14-.33-.22-.53-.22-.193-.03-.395.08-.535.227L3.5 17.642V4.25c0-.413.337-.75.75-.75zm-.744 16.28l5.418-5.534 6.282 6.254H4.25c-.402 0-.727-.322-.744-.72zm16.244.72h-2.42l-5.007-4.987 3.792-3.85 4.385 4.384v3.703c0 .413-.337.75-.75.75z"></path>
									<circle cx="8.868" cy="8.309" r="1.542"></circle>
								</g>
							</svg>
						</div>
					<!-- Gif File Icon -->
						<div>
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<g>
									<path d="M19 10.5V8.8h-4.4v6.4h1.7v-2h2v-1.7h-2v-1H19zm-7.3-1.7h1.7v6.4h-1.7V8.8zm-3.6 1.6c.4 0 .9.2 1.2.5l1.2-1C9.9 9.2 9 8.8 8.1 8.8c-1.8 0-3.2 1.4-3.2 3.2s1.4 3.2 3.2 3.2c1 0 1.8-.4 2.4-1.1v-2.5H7.7v1.2h1.2v.6c-.2.1-.5.2-.8.2-.9 0-1.6-.7-1.6-1.6 0-.8.7-1.6 1.6-1.6z"></path><path d="M20.5 2.02h-17c-1.24 0-2.25 1.007-2.25 2.247v15.507c0 1.238 1.01 2.246 2.25 2.246h17c1.24 0 2.25-1.008 2.25-2.246V4.267c0-1.24-1.01-2.247-2.25-2.247zm.75 17.754c0 .41-.336.746-.75.746h-17c-.414 0-.75-.336-.75-.746V4.267c0-.412.336-.747.75-.747h17c.414 0 .75.335.75.747v15.507z">
									</path>
								</g>
							</svg>
						</div>
					<!-- Question Create Icon -->
						<div>
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<g>
									<path d="M20.222 9.16h-1.334c.015-.09.028-.182.028-.277V6.57c0-.98-.797-1.777-1.778-1.777H3.5V3.358c0-.414-.336-.75-.75-.75s-.75.336-.75.75V20.83c0 .415.336.75.75.75s.75-.335.75-.75v-1.434h10.556c.98 0 1.778-.797 1.778-1.777v-2.313c0-.095-.014-.187-.028-.278h4.417c.98 0 1.778-.798 1.778-1.778v-2.31c0-.983-.797-1.78-1.778-1.78zM17.14 6.293c.152 0 .277.124.277.277v2.31c0 .154-.125.28-.278.28H3.5V6.29h13.64zm-2.807 9.014v2.312c0 .153-.125.277-.278.277H3.5v-2.868h10.556c.153 0 .277.126.277.28zM20.5 13.25c0 .153-.125.277-.278.277H3.5V10.66h16.722c.153 0 .278.124.278.277v2.313z">
									</path>
								</g>
							</svg>
						</div>
					<!-- Emoji Icon -->
						<div>
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<g>
									<path d="M12 22.75C6.072 22.75 1.25 17.928 1.25 12S6.072 1.25 12 1.25 22.75 6.072 22.75 12 17.928 22.75 12 22.75zm0-20C6.9 2.75 2.75 6.9 2.75 12S6.9 21.25 12 21.25s9.25-4.15 9.25-9.25S17.1 2.75 12 2.75z"></path><path d="M12 17.115c-1.892 0-3.633-.95-4.656-2.544-.224-.348-.123-.81.226-1.035.348-.226.812-.124 1.036.226.747 1.162 2.016 1.855 3.395 1.855s2.648-.693 3.396-1.854c.224-.35.688-.45 1.036-.225.35.224.45.688.226 1.036-1.025 1.594-2.766 2.545-4.658 2.545z">
									</path>
									<circle cx="14.738" cy="9.458" r="1.478"></circle><circle cx="9.262" cy="9.458" r="1.478">
									</circle>
								</g>
							</svg>
						</div>
					<!-- Plan Icon -->
							<div>
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<g>
									<path d="M-37.9 18c-.1-.1-.1-.1-.1-.2.1 0 .1.1.1.2z"></path>
									<path d="M-37.9 18c-.1-.1-.1-.1-.1-.2.1 0 .1.1.1.2zM18 2.2h-1.3v-.3c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8v.3H7.7v-.3c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8v.3H4.8c-1.4 0-2.5 1.1-2.5 2.5v13.1c0 1.4 1.1 2.5 2.5 2.5h2.9c.4 0 .8-.3.8-.8 0-.4-.3-.8-.8-.8H4.8c-.6 0-1-.5-1-1V7.9c0-.3.4-.7 1-.7H18c.6 0 1 .4 1 .7v1.8c0 .4.3.8.8.8.4 0 .8-.3.8-.8v-5c-.1-1.4-1.2-2.5-2.6-2.5zm1 3.7c-.3-.1-.7-.2-1-.2H4.8c-.4 0-.7.1-1 .2V4.7c0-.6.5-1 1-1h1.3v.5c0 .4.3.8.8.8.4 0 .8-.3.8-.8v-.5h7.5v.5c0 .4.3.8.8.8.4 0 .8-.3.8-.8v-.5H18c.6 0 1 .5 1 1v1.2z"></path>
									<path d="M15.5 10.4c-3.4 0-6.2 2.8-6.2 6.2 0 3.4 2.8 6.2 6.2 6.2 3.4 0 6.2-2.8 6.2-6.2 0-3.4-2.8-6.2-6.2-6.2zm0 11c-2.6 0-4.7-2.1-4.7-4.7s2.1-4.7 4.7-4.7 4.7 2.1 4.7 4.7c0 2.5-2.1 4.7-4.7 4.7z"></path><path d="M18.9 18.7c-.1.2-.4.4-.6.4-.1 0-.3 0-.4-.1l-3.1-2v-3c0-.4.3-.8.8-.8.4 0 .8.3.8.8v2.2l2.4 1.5c.2.2.3.6.1 1z"></path>
									</g>
								</svg>
							</div>
							</div>
					<!-- Tweet Button -->
					<button class="tweet-btn" type="submit">Tweetle</button>
					</div>
				</div></form>
				</div>
			<div class="space">
			</div>
			
						<!-- Retweet Button -->
						<?php foreach($posts as $post) { ?>
							<div class="post">
				<div class="right-column">
					<article class="top-row">
					<header class="post-header">
					<div>
						<strong>
							<span><?php echo $post['username'] ?></span>
						</strong>
							<span class="tag">@<?php echo $post['username'] ?></span>
							<span class="dot">.</span>
							<span class="time">New</span>
					</div>
						<div class="details">
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<g>
										<circle cx="5" cy="12" r="2"></circle>
										<circle cx="12" cy="12" r="2"></circle>
										<circle cx="19" cy="12" r="2"></circle>
									</g>
								</svg>
							</div>
					</header>
					<p><?php echo $post['post'] ?></p>
					</article>
					<div class="bottom-row">
						<!-- Comment Button -->
						<div>
							<div>
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<g>
										<path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z">
										</path>
									</g>
								</svg>
							</div>
							<span>0</span>
						</div>
						<!-- Retweet Button -->
						<div>
							<div>
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<g>
										<path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z">
										</path>
									</g>
								</svg>
							</div>
							<span>0</span>
						</div>
						<!-- Like Button -->
						<div>
							<div>
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<g>
										<path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z">
										</path>
									</g>
								</svg>
							</div>
							<span>0</span>
						</div>
						<!-- Share Button -->
						<div>
							<div>
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<g>
										<path d="M17.53 7.47l-5-5c-.293-.293-.768-.293-1.06 0l-5 5c-.294.293-.294.768 0 1.06s.767.294 1.06 0l3.72-3.72V15c0 .414.336.75.75.75s.75-.336.75-.75V4.81l3.72 3.72c.146.147.338.22.53.22s.384-.072.53-.22c.293-.293.293-.767 0-1.06z"></path><path d="M19.708 21.944H4.292C3.028 21.944 2 20.916 2 19.652V14c0-.414.336-.75.75-.75s.75.336.75.75v5.652c0 .437.355.792.792.792h15.416c.437 0 .792-.355.792-.792V14c0-.414.336-.75.75-.75s.75.336.75.75v5.652c0 1.264-1.028 2.292-2.292 2.292z">
										</path>
									</g>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>
						<?php
						}
						?>
		</section>
		<aside class="right-side">
			<div class="search-bar">
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<g>
						<path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
						</path>
					</g>
				</svg>
			<form method="POST">
				<input class="search" placeholder="Twitter'da Ara">
			</div>	
			<div class="trends">
				<header class="trends-header">
					<h2>
						<span>İlgini çekebilecek <br>gündemler</span>
						<div>
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<g>
									<path d="M12 8.21c-2.09 0-3.79 1.7-3.79 3.79s1.7 3.79 3.79 3.79 3.79-1.7 3.79-3.79-1.7-3.79-3.79-3.79zm0 6.08c-1.262 0-2.29-1.026-2.29-2.29S10.74 9.71 12 9.71s2.29 1.026 2.29 2.29-1.028 2.29-2.29 2.29z"></path><path d="M12.36 22.375h-.722c-1.183 0-2.154-.888-2.262-2.064l-.014-.147c-.025-.287-.207-.533-.472-.644-.286-.12-.582-.065-.798.115l-.116.097c-.868.725-2.253.663-3.06-.14l-.51-.51c-.836-.84-.896-2.154-.14-3.06l.098-.118c.186-.222.23-.523.122-.787-.11-.272-.358-.454-.646-.48l-.15-.014c-1.18-.107-2.067-1.08-2.067-2.262v-.722c0-1.183.888-2.154 2.064-2.262l.156-.014c.285-.025.53-.207.642-.473.11-.27.065-.573-.12-.795l-.094-.116c-.757-.908-.698-2.223.137-3.06l.512-.512c.804-.804 2.188-.865 3.06-.14l.116.098c.218.184.528.23.79.122.27-.112.452-.358.477-.643l.014-.153c.107-1.18 1.08-2.066 2.262-2.066h.722c1.183 0 2.154.888 2.262 2.064l.014.156c.025.285.206.53.472.64.277.117.58.062.794-.117l.12-.102c.867-.723 2.254-.662 3.06.14l.51.512c.836.838.896 2.153.14 3.06l-.1.118c-.188.22-.234.522-.123.788.112.27.36.45.646.478l.152.014c1.18.107 2.067 1.08 2.067 2.262v.723c0 1.183-.888 2.154-2.064 2.262l-.155.014c-.284.024-.53.205-.64.47-.113.272-.067.574.117.795l.1.12c.756.905.696 2.22-.14 3.06l-.51.51c-.807.804-2.19.864-3.06.14l-.115-.096c-.217-.183-.53-.23-.79-.122-.273.114-.455.36-.48.646l-.014.15c-.107 1.173-1.08 2.06-2.262 2.06zm-3.773-4.42c.3 0 .593.06.87.175.79.328 1.324 1.054 1.4 1.896l.014.147c.037.4.367.7.77.7h.722c.4 0 .73-.3.768-.7l.014-.148c.076-.842.61-1.567 1.392-1.892.793-.33 1.696-.182 2.333.35l.113.094c.178.148.366.18.493.18.206 0 .4-.08.546-.227l.51-.51c.284-.284.305-.73.048-1.038l-.1-.12c-.542-.65-.677-1.54-.352-2.323.326-.79 1.052-1.32 1.894-1.397l.155-.014c.397-.037.7-.367.7-.77v-.722c0-.4-.303-.73-.702-.768l-.152-.014c-.846-.078-1.57-.61-1.895-1.393-.326-.788-.19-1.678.353-2.327l.1-.118c.257-.31.236-.756-.048-1.04l-.51-.51c-.146-.147-.34-.227-.546-.227-.127 0-.315.032-.492.18l-.12.1c-.634.528-1.55.67-2.322.354-.788-.327-1.32-1.052-1.397-1.896l-.014-.155c-.035-.397-.365-.7-.767-.7h-.723c-.4 0-.73.303-.768.702l-.014.152c-.076.843-.608 1.568-1.39 1.893-.787.326-1.693.183-2.33-.35l-.118-.096c-.18-.15-.368-.18-.495-.18-.206 0-.4.08-.546.226l-.512.51c-.282.284-.303.73-.046 1.038l.1.118c.54.653.677 1.544.352 2.325-.327.788-1.052 1.32-1.895 1.397l-.156.014c-.397.037-.7.367-.7.77v.722c0 .4.303.73.702.768l.15.014c.848.078 1.573.612 1.897 1.396.325.786.19 1.675-.353 2.325l-.096.115c-.26.31-.238.756.046 1.04l.51.51c.146.147.34.227.546.227.127 0 .315-.03.492-.18l.116-.096c.406-.336.923-.524 1.453-.524z">
									</path>
								</g>
							</svg>
						</div>
						</h2>
					
				</header>
				<div class="trends-items">
					<!-- Trends Item Start -->
					<div class="trends-item">
							<div>
								<span>Politika Gündemler</span>
								<div>
									<svg viewBox="0 0 24 24" aria-hidden="true">
										<g>
											<circle cx="5" cy="12" r="2"></circle>
											<circle cx="12" cy="12" r="2"></circle>
											<circle cx="19" cy="12" r="2"></circle>
										</g>
									</svg>
								</div>
							</div>
						<strong class="hashtag">#Türkiye</strong>
						<span>42,2 B Tweet</span>
					</div>
				<!-- Trends Item End -->
				<!-- Trends Item Start -->
					<div class="trends-item">
							<div>
								<span>Türkiye konumunda gündemde</span>
								<div>
									<svg viewBox="0 0 24 24" aria-hidden="true">
										<g>
											<circle cx="5" cy="12" r="2"></circle>
											<circle cx="12" cy="12" r="2"></circle>
											<circle cx="19" cy="12" r="2"></circle>
										</g>
									</svg>
								</div>
							</div>
						<strong class="hashtag">#TusaşKazanMYO</strong>
						<span>32 B Tweet</span>
					</div>
				<!-- Trends Item End -->
				<!-- Trends Item Start -->
					<div class="trends-item">
							<div>
								<span>Türkiye konumunda gündemde</span>
								<div>
									<svg viewBox="0 0 24 24" aria-hidden="true">
										<g>
											<circle cx="5" cy="12" r="2"></circle>
											<circle cx="12" cy="12" r="2"></circle>
											<circle cx="19" cy="12" r="2"></circle>
										</g>
									</svg>
								</div>
							</div>
						<strong class="hashtag">#CyberSecurity</strong>
						<span>2.215 Tweet</span>
					</div>
				<!-- Trends Item End -->
				<!-- Trends Item Start -->
					<div class="trends-item">
							<div>
								<span>Türkiye konumunda gündemde</span>
								<div>
									<svg viewBox="0 0 24 24" aria-hidden="true">
										<g>
											<circle cx="5" cy="12" r="2"></circle>
											<circle cx="12" cy="12" r="2"></circle>
											<circle cx="19" cy="12" r="2"></circle>
										</g>
									</svg>
								</div>
							</div>
						<strong class="hashtag">#Elazığ</strong>
						<span>22,8 B Tweet</span>
					</div>
				<!-- Trends Item End -->
				<!-- Trends Item Start -->
					<div class="trends-item">
							<div>
								<span>Türkiye konumunda gündemde</span>
								<div>
									<svg viewBox="0 0 24 24" aria-hidden="true">
										<g>
											<circle cx="5" cy="12" r="2"></circle>
											<circle cx="12" cy="12" r="2"></circle>
											<circle cx="19" cy="12" r="2"></circle>
										</g>
									</svg>
								</div>
							</div>
						<strong class="hashtag">#GaziÜniversitesi</strong>
						<span>2.717 Tweet</span>
					</div>
				<!-- Trends Item End -->
				<div class="more-btn">
					<span>Daha Fazla Göster</span>
				</div>
				</div>
			</div>
			<div class="who-to-follow">
			<header class="who-to-follow-header">
			<h2>Kimi takip etmeli</h2>
			</header>
			<div class="users">
			<!-- User Item Start -->
				<div class="user">
					<img class="profile-image" src="https://pbs.twimg.com/profile_images/1219426477/mordecai_400x400.png">
					<div>
					<div>
						<strong class="user-name">JG Quintel</strong>
						<span class="tag">@JGQuintel</span>
					</div>
					<button class="follow-btn">Takip Et</button>
				</div>
				</div>
			<!-- User Item End -->
			<!-- User Item Start -->
				<div class="user">
					<img class="profile-image" src=
					<div>
					<div>
						<strong class="user-name">Ertuğrul Duman</strong>
						<span class="tag">@dumanertugrul</span>
					</div>
					<button class="follow-btn">Takip Et</button>
				</div>
				</div>
			<!-- User Item End -->
			<!-- User Item Start -->
				<div class="user">
					<img class="profile-image" src=
					<div>
					<div>
						<strong class="user-name">Ahmet Eker</strong>
						<span class="tag">@ahmeteker</span>
					</div>
					<button class="follow-btn">Takip Et</button>
				</div>
				</div>
			<!-- User Item End -->
				<div class="more-btn">
					<span>Daha Fazla Göster</span>
				</div>
			</div>
			</div>
			<hr class="line">
			<footer>
			<nav>
			<span>Hizmet Şartları</span>
			<span>Gizlilik Politikası</span>
			<span>Çerez Politikası</span>
			<span>İletişim Bilgileri</span>
			<span>Reklam Bilgisi</span>
			<span>Daha Fazla <svg viewBox="0 0 24 24" aria-hidden="true"><g><circle cx="5" cy="12" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle></g></svg></span>
			<span>© 2021 Twitter, Inc.</span>
			</nav>
			</footer>
		</aside>
	</main>
</body>
</html>