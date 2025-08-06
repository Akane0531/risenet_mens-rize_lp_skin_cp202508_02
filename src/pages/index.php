<?php
ini_set('display_errors', 0);
if(!isset($_COOKIE['mens_fpc'])) {
  $dir = '';
  $str = urldecode($url);
  $tmp_url = parse_url($str);
  $query = $tmp_url['query'];
  parse_str($query, $arr);
  setcookie('mens_fpc', $arr['fpc'], time()+86400, '/', '.mens-rize.com');
}

$current_url_without_query = "https://" . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
$title ='【オリジオハイフ】導入記念価格1回63,840円｜メンズリゼ';
$detection ='皮膚を引き締める効果が高いオリジオXと、皮膚の土台であるSMAS筋膜に作用し、下がった組織を内側から持ち上げるハイフを組み合わせた治療です。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>
  <meta name="robots" content="noindex">
  <link rel="canonical" href="<?= $current_url_without_query; ?>">
  <meta name="description" content="<?= $detection; ?>">
  <meta name="format-detection" content="email=no,telephone=no,address=no">
  <meta property="og:url" content="<?= $current_url_without_query; ?>">
  <meta property="og:title" content="<?= $title; ?>">
  <meta property="og:type" content="website">
  <meta property="og:description" content="<?= $detection; ?>">
  <meta property="og:site_name" content="<?= $title; ?>">
  <meta property="og:locale">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:description" content="<?= $detection; ?>">
  <!-- Ptengine Tag-->
  <script src="https://js.ptengine.jp/39jly80k.js"></script>
  <!-- End Ptengine Tag-->
  <!-- Google Tag Manager -->
  <script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-PBGL3ZJ');
  </script>
  <!-- End Google Tag Manager-->
  <!-- 各種stylesheet-->
  <link href="/img/common/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="./assets/css/vendor/destyle.css?<?= date('YmdHis'); ?>">
  <link rel="stylesheet" href="./assets/css/style.css?<?= date('YmdHis'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link href="./assets/img/home/fv.png" as="image" rel="preload">
</head>

<body class="home">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBGL3ZJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrapper">
    <main>
      <section id="fv" class="fv bg-bg2">
        <div class="fv__img"><img src="./assets/img/home/fv.png" alt=""></div>
      </section>

      <div class="cta bg-bg2 text-white">
        <div class="cta__inner">
          <p class="cta__lead text-accent">60秒で予約完了！相談だけでもOK</p>
          <a class="button" href="/skin/counseling/">
            <div class="button__icon button__icon--before"></div>
            <div class="button__inner">
              <div class="button__title">無料カウンセリング予約</div>
            </div>
            <div class="button__icon button__icon--after"></div>
          </a>
          <div class="cta__info">※表示価格はすべて税込です。<br>※保険適用外の自由診療です。<br>※一部の院で取り扱いが無い場合がございますので、取り扱い院一覧をご確認ください。</div>
        </div>
      </div>

      <section id="info" class="info bg-bg2">
        <img src="./assets/img/home/info_01.png" alt="">
        <img src="./assets/img/home/info_02.png" alt="">
        <img src="./assets/img/home/info_03.png" alt="">
        <img src="./assets/img/home/info_04.png" alt="">
      </section>


      <div class="cta bg-bg2 text-white">
        <div class="cta__inner">
          <p class="cta__lead text-accent">60秒で予約完了！相談だけでもOK</p>
          <a class="button" href="/skin/counseling/">
            <div class="button__icon button__icon--before"></div>
            <div class="button__inner">
              <div class="button__title">無料カウンセリング予約</div>
            </div>
            <div class="button__icon button__icon--after"></div>
          </a>
          <div class="cta__info">※表示価格はすべて税込です。<br>※保険適用外の自由診療です。<br>※一部の院で取り扱いが無い場合がございますので、取り扱い院一覧をご確認ください。</div>
        </div>
      </div>


      <section id="feature" class="feature bg-bg2">
        <img src="./assets/img/home/feature_01.png" alt="">
        <div class="accordion js-accordion bg-bg3">
          <button class="accordion__button" data-accordion-header>
            <div class="accordion__label accordion__label--open">施術の詳しい特徴</div>
            <div class="accordion__label accordion__label--close">閉じる</div>
            <div class="accordion__icon"></div>
          </button>
          <div data-accordion-content>
            <img src="./assets/img/home/feature_02.png" alt="">
            <div class="block">
              <div class="block__inner">
                <p>未承認医療機器について：未承認医療機器<br>入手経路：韓国WONTECH社製造機器をWONTECH Japan株式会社を輸入代行業として、医師が個人輸入<br>※承認を受けていない医薬品・医療機器については下記のページをご確認ください。<br><a href="https://www.yakubutsu.mhlw.go.jp/index.html" target="_blank" rel="noopener noreferrer">https://www.yakubutsu.mhlw.go.jp/index.html</a><br> 国内の承認医薬品等の有無の明示：なし<br>諸外国における安全性等に係る情報の明示：<br> FDA、CSA、MFDS、ANVISA</p>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section id="feature-hisio" class="feature-hisio bg-bg">
        <img src="./assets/img/home/feature-hisio_01.png" alt="">
        <div class="accordion js-accordion">
          <button class="accordion__button accordion__button--gold" data-accordion-header>
            <div class="accordion__label accordion__label--open">施術の詳しい特徴</div>
            <div class="accordion__label accordion__label--close">閉じる</div>
            <div class="accordion__icon"></div>
          </button>
          <div data-accordion-content>
            <img src="./assets/img/home/feature-hisio_02.png" alt="">
            <div class="block">
              <div class="block__inner">
                <p>未承認医療機器について：当製品は未承認医療機器です。<br>入手経路：韓国WONTECH社製造機器をWONTECH Japan株式会社を輸入代行業として、医師が個人輸入しております。<br>※承認を受けていない医薬品・医療機器については下記のページをご確認ください。<br><a href="https://www.yakubutsu.mhlw.go.jp/index.html" target="_blank" rel="noopener noreferrer">https://www.yakubutsu.mhlw.go.jp/index.html</a><br>国内の承認医薬品等の有無の明示：なし<br>諸外国における安全性等に係る情報の明示：韓国MFDS、ヨーロッパCE、ブラジルANVISA</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="cta bg-bg2 text-white">
        <img src="./assets/img/home/cta_01.png" alt="">
        <div class="cta__inner">
          <p class="cta__lead text-accent">60秒で予約完了！相談だけでもOK</p>
          <a class="button" href="/skin/counseling/">
            <div class="button__icon button__icon--before"></div>
            <div class="button__inner">
              <div class="button__title">無料カウンセリング予約</div>
            </div>
            <div class="button__icon button__icon--after"></div>
          </a>
          <div class="cta__info">※表示価格はすべて税込です。<br>※保険適用外の自由診療です。<br>※一部の院で取り扱いが無い場合がございますので、取り扱い院一覧をご確認ください。</div>
        </div>
      </div>

      <section id="detailed" class="detailed">
        <img src="./assets/img/home/detailed_01.png" alt="">
        <h2 class="heading">メンズリゼのこだわり</h2>
        <img src="./assets/img/home/detailed_02.png" alt="">
      </section>

      <div class="cta bg-bg2 text-white">
        <div class="cta__inner">
          <p class="cta__lead text-accent">60秒で予約完了！相談だけでもOK</p>
          <a class="button" href="/skin/counseling/">
            <div class="button__icon button__icon--before"></div>
            <div class="button__inner">
              <div class="button__title">無料カウンセリング予約</div>
            </div>
            <div class="button__icon button__icon--after"></div>
          </a>
          <div class="cta__info">※表示価格はすべて税込です。<br>※保険適用外の自由診療です。<br>※一部の院で取り扱いが無い場合がございますので、取り扱い院一覧をご確認ください。</div>
        </div>
      </div>


      <section class="payment" id="payment">
        <h2 class="heading">選べる豊富な支払方法</h2>
        <div class="payment__inner">
          <div class="payment__container-block">
            <div class="payment__block">
              <h3 class="payment__block-title">現金一括</h3>
            </div>
            <div class="payment__block">
              <h3 class="payment__block-title">各種クレジットカード</h3>
              <div class="payment__block-desc">
                <h4 class="payment__block-caption">Visa/MasterCard/JCB/AMEX/DINERS/Discover</h4>
                <div class="payment__block-img"><img src="./assets/img/home/payment_img-01.png" alt="" width="270.51" height="26.45"></div>
                <p>※一部の院ではご利用いただけるブランド、お支払方法が異なる場合があります。<br>詳しくはクリニックまでお問合せください。</p>
              </div>
            </div>
            <div class="payment__block">
              <h3 class="payment__block-title">各種デビットカード</h3>
              <div class="payment__block-desc">
                <h4 class="payment__block-caption">VISA／JCB／J-Debit</h4>
                <div class="payment__block-img"><img src="./assets/img/home/payment_img-02.png" alt="" width="129.71" height="26.45"></div>
                <p>※一部の院ではご利用いただけるブランド、お支払方法が異なる場合があります。<br>詳しくはクリニックまでお問合せください。</p>
              </div>
            </div>
            <div class="payment__block">
              <h3 class="payment__block-title">医療ローン</h3>
              <div class="payment__block-desc">
                <h4 class="payment__block-caption"><strong>3回〜84回払い<br>月々のご予算に合わせてお支払い回数を設定可能です。</strong></h4>
                <p>※お支払い回数によって分割手数料が発生します。<br>※別途信販会社の審査がございます。</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="flow" id="flow">
        <h2 class="heading">ご予約後の流れ</h2>
        <div class="flow__inner">
          <div class="flow__slider swiper">
            <div class="swiper-wrapper">
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">初回ご来院時</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-01.jpg" alt="初回ご来院時"></div>
                  <div class="flow__slide-desc">
                    <p>問診票をご記入いただき、カウンセリングルームへご案内いたします。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">コンシェルジュによる<br>カウンセリング</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-02.jpg" alt="コンシェルジュによるカウンセリング"></div>
                  <div class="flow__slide-desc">
                    <p>施術メニューを紹介し、お肌の悩みをお聞きして最適なメニューをご提案いたします。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">ドクターによる問診</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-03.jpg" alt="ドクターによる問診"></div>
                  <div class="flow__slide-desc">
                    <p>お肌やお体の状態を確認して施術の可否判断をし、リスクについて説明します。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">ご契約・お会計</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-04.jpg" alt="ご契約・お会計"></div>
                  <div class="flow__slide-desc">
                    <p>ご契約される場合は手続き・お会計に進みます。お悩みの場合は一旦持ち帰りになり、後日ご契約することも可能です。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">洗顔・クレンジング</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-05.jpg" alt="洗顔・クレンジング"></div>
                  <div class="flow__slide-desc">
                    <p>メイクを落とした状態で施術いたします。パウダールームのメイク落とし・洗顔フォームをご使用いただけます。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">写真撮影</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-06.jpg" alt="写真撮影"></div>
                  <div class="flow__slide-desc">
                    <p>施術前の写真撮影を行います。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">施術</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-07.jpg" alt="施術"></div>
                  <div class="flow__slide-desc">
                    <p>施術後は保湿をして終了いたします。</p>
                  </div>
                </div>
              </div>
              <div class="flow__slide swiper-slide">
                <div class="flow__slide-num">
                  <div class="flow__slide-num-label">Step</div>
                  <div class="flow__slide-num-number"></div>
                </div>
                <div class="flow__slide-inner">
                  <div class="flow__slide-title">施術終了</div>
                  <div class="flow__slide-img"><img src="./assets/img/home/flow_img-08.jpg" alt="施術終了"></div>
                  <div class="flow__slide-desc">
                    <p>お疲れさまでした。<br>身支度が整いましたら、ご退室いただきます。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="cta">
          <div class="cta__inner">
            <p class="cta__lead">60秒で予約完了！相談だけでもOK</p>
            <a class="button" href="/skin/counseling/">
              <div class="button__icon button__icon--before"></div>
              <div class="button__inner">
                <div class="button__title">無料カウンセリング予約</div>
              </div>
              <div class="button__icon button__icon--after"></div>
            </a>
            <div class="cta__info">※表示価格はすべて税込です。<br>※保険適用外の自由診療です。<br>※一部の院で取り扱いが無い場合がございますので、取り扱い院一覧をご確認ください。</div>
          </div>
        </div>
      </section>

      <section class="clinic" id="clinic">
        <h2 class="heading">オリジオハイフ取り扱い院</h2>
        <div class="inner">
          <div class="clinic__container-list">
            <div class="clinic__list">
              <h3 class="clinic__list-title">関東</h3>
              <div class="clinic__list-items clinic__list-items--center">
                <a class="clinic__button" href="/skin/counseling/#ikebukuro">池袋院</a>
                <a class="clinic__button" href="/skin/counseling/#shinjuku_higashi">新宿<br>東口院</a>
                <a class="clinic__button" href="/skin/counseling/#shibuya">渋谷院</a>
              </div>
            </div>
          </div>
          <div class="clinic__container-list">
            <div class="clinic__list">
              <h3 class="clinic__list-title">中部</h3>
              <div class="clinic__list-items clinic__list-items--center">
                <a class="clinic__button" href="/skin/counseling/#meieki">名古屋<br>駅前院</a>
              </div>
            </div>
          </div>
          <div class="clinic__container-list">
            <div class="clinic__list">
              <h3 class="clinic__list-title">近畿</h3>
              <div class="clinic__list-items clinic__list-items--center">
                <a class="clinic__button" href="/skin/counseling/#osaka">大阪梅田院</a>
                <a class="clinic__button" href="/skin/counseling/#kobe">神戸三宮院</a>
              </div>
            </div>
          </div>
        </div>

        <div class="cta">
          <div class="cta__inner">
            <p class="cta__lead">60秒で予約完了！相談だけでもOK</p>
            <a class="button" href="/skin/counseling/">
              <div class="button__icon button__icon--before"></div>
              <div class="button__inner">
                <div class="button__title">無料カウンセリング予約</div>
              </div>
              <div class="button__icon button__icon--after"></div>
            </a>
            <div class="cta__info">
              <p>※表示価格はすべて税込です。<br>※保険適用外の自由診療です。<br>※一部の院で取り扱いが無い場合がございますので、取り扱い院一覧をご確認ください。</p>
            </div>
          </div>
        </div>

      </section>

      <footer class="footer">
        <div class="footer__inner">
          <div class="footer__logo"><a class="footer__logo__icon" href="/"><img src="./assets/img/common/logo.png" alt="メンズリゼ" width="112" height="160" loading="lazy"></a></div>
          <div class="footer__info">
            <ul class="footer__list">
              <li class="footer__list-item"><a href="/policy.html" target="_blank">プライバシーポリシー</a></li>
              <li class="footer__list-item"><a href="/legalnotice.html" target="_blank">免責事項</a></li>
            </ul><small class="footer__copyright">Copyright © 2025 RIZE CLINIC All rights reserved.</small>
          </div>
        </div>
      </footer>
    </main>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/image-map-resizer@1.0.10/js/imageMapResizer.min.js"></script>
  <script>
  imageMapResize();
  window.addEventListener('resize', () => {
    imageMapResize();
  });
  </script>
  <script src="./assets/js/script.js?<?= date('YmdHis'); ?>"></script>
</body>

</html>