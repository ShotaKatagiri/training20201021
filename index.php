<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>KEIBA navi</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="KEIBA naviでは、様々な競馬サイト（ホームページ）に関してナビゲーションさせていただきます。ご興味のあるサイトがございましたら、ぜひ各リンクをクリックしてみてください。">
<meta name="keywords" content="KEIBA navi,競馬,ナビゲーション">
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="css/stylesheet.css">
<link rel="stylesheet" href="css/stylesheet-sp.css">
<link rel="stylesheet" href="css/flexslider.css" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="keibajou.ico">
<link rel="apple-touch-icon" href="images/home-icon.png">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script>
$(window).load(function() {
  $('.flexslider').flexslider();
});
</script>
<script type="text/javascript">
$(function() {
    var pageTop = $('.page-top');
    pageTop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            pageTop.fadeIn();
        } else {
            pageTop.fadeOut();
        }
    });
    pageTop.click(function () {
        $('body, html').animate({scrollTop:0}, 500, 'swing');
        return false;
    });
});
</script>
</head>
<body id="home" class="col2">
	<div id="wrapper">
		<!--▼ヘッダー-->
    <?php include("header.php")?>
		<!--▲ヘッダー-->


		<!--メインイメージ-->
		<div class="flexslider">
			<ul class="slides">
				<li><img src="images/slide01.jpg" alt="KEIBA navi"></li>
				<li><a href="http://umajo.jra.jp"><img src="images/slide02.jpg" alt="umajo"></a></li>
				<li><a href="http://www.tokyocitykeiba.com/"><img src="images/slide03.jpg" alt="tokyo-twinkle"></a></li>
			</ul>
		</div>

		<!--/メインイメージ-->


		<!--メイン-->
		<main>
		  <div class="news cf">
			<h2>KEIBA navi からのお知らせ</h2>
			<div class="newsbox">
			  <dl>
				<dt>2016.12.01</dt>
				  <dd>サイトをリニューアルしました。</dd>
				<dt>2016.10.20</dt>
				  <dd>競馬場情報を一部更新しました。</dd>
				<dt>2016.08.10</dt>
				  <dd>地方競馬に関するリンクを一部更新しました。</dd>
				<dt>2016.06.01</dt>
				  <dd>TOP ページのコンテンツを一部更新しました。</dd>
			  </dl>
			</div>
		  </div>
		  <div class="video">
			<h2><img src="images/hourse.png" alt="horse" class="horseimg">競馬に関する動画コンテンツ</h2>
			<div class="video-contents">
			 <div class="contentstop">
			  <div class="video-content1">
				<a href="https://www.youtube.com/user/jraofficial"><img src="images/jra_banner.jpg" alt="JRA"></a>
				<p>JRAのYOUTUBEチャンネルです。競馬初心者講座など、競馬に詳しくなくても楽しめるコンテンツが多数上がっています。</p>
			  </div>
			  <div class="video-content2">
				<a href="http://keiba.rakuten.co.jp/livemovie"><img src="images/rakuten_banner.jpg" alt="rakuten"></a>
				<p>楽天競馬の実況動画サイトです。競馬場を選択してライブと過去のレースを見れるので便利です。</p>
			  </div>
			 </div>
			 <div class="contentsbottom">
			  <div class="video-content3">
				<a href="http://keiba-lv-st.jp/"><img src="images/nra_banner.jpg" alt="localkyouba"></a>
				<p>地方競馬ライブの実況動画サイトです。見逃したレースも見れるので傾向と対策を練るのにオススメします。</p>
			  </div>
			  <div class="video-content4">
				<a href="https://www.youtube.com/user/netkeibaTV"><img src="images/nk_banner.jpg" alt="netkeiba"></a>
				 <p>netkeiba.comのYOUTUBEチャンネルです。有名な予想家さんが出ている動画がたくさん上がってますので参考になるかと思います。</p>
			  </div>
			</div>
		  </div>
		  </div>
		  <div class="site">
			<h2><img src="images/hourse.png" alt="horse">おすすめ競馬サイト</h2>
			<div class="site_inner">
				<div class="sites cf">
				  <div class="sitetop cf">
					<div class="site1">
					 <h3>楽天競馬</h3>
					 <a href="http://keiba.rakuten.co.jp"><img src="images/rakutenkeibatop.jpg" alt="rakutensite"></a>
					  <p>地方競馬全場（南関東4 競馬場、ばんえいを含む）のネット投票がPC・スマホ・携帯から、いつでも、どこでも気軽に投票するできるサイトです。出走馬情報以外にも、レース映像・予想コミュニティなど、予想や投票に役立つ情報も提供しています。</p>
					</div>
					<div class="site2">
					 <h3>ウマニティ</h3>
					 <a href="http://umanity.jp"><img src="images/umanity.jpg" alt="umanitysite"></a>
					 <p>スポ＆ニッポン放送も公認の競馬予想サイトで。スガダイほかプロ競馬予想家の競馬予想・オッズ・結果速報・競馬エイトの厩舎情報をはじめ、競馬予想大会、地方競馬まで競馬予想に役立つコンテンツが満載です。</p>
					</div>
				  </div>
				  <div class="sitebottom cf">
					<div class="site3">
					  <h3>オッズパーク</h3>
					  <a href="hhttp://oj.oddspark.com/keiba/p1"><img src="images/op.jpg" alt="oddspark"></a>
					  <p>オッズパークは、地方競馬、競輪、オートレースの投票が入会金、年会費無料で楽しめます。パソコン、スマートフォン、ケータイから簡単操作で投票が可能です。各レースの出走表、オッズ、結果はもちろん、専門紙記者による予想情報も満載です！</p>
					</div>
					<div class="site4">
					  <h3>netkeiba.com</h3>
					  <a href="http://www.netkeiba.com/"><img src="images/nk_top.jpg" alt="netkeiba.com"></a>
					  <p>netkeiba.com は国内最大級の競馬情報サイトです。JRA 全レースの出馬表やオッズ・予想、ニュース、コラム、競走馬50 万頭以上収録の競馬データベース、地方競馬、POG、予想大会、コミュニティなどがご利用いただけます。</p>
					</div>
				  </div>
				</div>
			</div>
		  </div>


		</main>
		<!--/conts-->




		<!--▼フッター-->
		<?php include("footer.php")?>
		<!--▲フッター-->


		<!--▼ページの先頭へ戻る-->
		<p class="page-top"><a href="#wrap"><img src="images/pagetop.png" alt="pagetop"></a></p>
		<!--▲ページの先頭へ戻る-->
	</div>
</body>
</html>
