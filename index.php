<?php
session_start();
require_once('admin/Model.php');
require_once('util.inc.php');

try {
    $model = new Model();
    $model->connect();

    $stmt = $model->dbh->prepare('SELECT * FROM new_info WHERE release_date <= DATE(NOW()) AND delete_flg = 0 ORDER BY release_date DESC LIMIT 10');
    $stmt->execute();
    $new_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = 'システム上に問題が発生しました。<br>早急に対処いたしますので、下記システム管理者までご連絡ください。<br>090-0000-0000';
}

?>

<!--▼ヘッダー-->
<?php require_once('header.php');?>
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
                <?php if(!empty($error)):?>
                    <?=$error?>
                <?php else:?>
                    <?php foreach ($new_info as $key => $val) :?>
                        <dt class="index-updated_at"><?=date('Y-m-d', strtotime($val['updated_at']))?></dt>
                        <dd class="index-content"><?=$val['content']?></dd>
                    <?php endforeach;?>
                <?php endif;?>
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
<!--▼ページの先頭へ戻る-->
<p class="page-top"><a href="#wrap"><img src="images/pagetop.png" alt="pagetop"></a></p>
<!--▲ページの先頭へ戻る-->
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
<!--▼フッター-->
<?php require_once('footer.php')?>
<!--▲フッター-->
