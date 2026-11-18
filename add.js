/**
 * 案件で追加するJS
 * 機能ごとに initXxx() を作り、対象要素がなければ何もしない。
 */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /**
     * career-typeC：社員キャリア事例のスライダー（Splide）
     * .career__lists-slider を1枚ずつ切り替え、#career-lists-prev / #career-lists-next で操作する。
     */
    function initCareerSlider() {
        if (typeof Splide === 'undefined') return;

        document.querySelectorAll('.career-typeC').forEach(function (section) {
            var root = section.querySelector('.career__lists-slider');
            if (!root) return;

            var slider = new Splide(root, {
                type: 'slide',
                rewind: true,
                perPage: 1,
                gap: '3.2rem',
                arrows: false,
                pagination: false
            }).mount();

            var prev = section.querySelector('#career-lists-prev');
            var next = section.querySelector('#career-lists-next');
            if (prev) prev.addEventListener('click', function () { slider.go('<'); });
            if (next) next.addEventListener('click', function () { slider.go('>'); });
        });
    }

    /**
     * js-lines：<br> で区切られた行を span.js-lines__line で包み、1行ずつ時間差で出す
     */
    function initLines() {
        document.querySelectorAll('.js-lines').forEach(function (el) {
            var parts = el.innerHTML.split(/(<br[^>]*>)/i);
            var index = 0;
            el.innerHTML = parts.map(function (part) {
                if (/^<br/i.test(part) || part.trim() === '') return part;
                var html = '<span class="js-lines__line" style="transition-delay:' + (index * 0.15) + 's">' + part.trim() + '</span>';
                index++;
                return html;
            }).join('');
        });
    }

    /**
     * 画面に入ったら .is-inview を付ける（js-lines / js-fade / js-slide）
     */
    function initInview() {
        var targets = document.querySelectorAll('.js-lines, .js-fade, .js-slide');
        if (!targets.length) return;

        if (!('IntersectionObserver' in window) || reduceMotion) {
            targets.forEach(function (el) { el.classList.add('is-inview'); });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-inview');
                observer.unobserve(entry.target);
            });
        }, { rootMargin: '0px 0px -12% 0px', threshold: 0.15 });

        targets.forEach(function (el) { observer.observe(el); });
    }

    /**
     * TOP：オープニング → MV のキャッチを表示
     * 同じタブで2回目以降に TOP を開いたときはオープニングを飛ばす。
     */
    function initOpening(onFinish) {
        var opening = document.getElementById('opening');
        if (!opening) {
            onFinish();
            return;
        }

        var seen = false;
        try { seen = sessionStorage.getItem('biltec_opening') === '1'; } catch (e) { /* 使えない環境は毎回出す */ }

        if (seen || reduceMotion) {
            opening.classList.add('is-skip');
            onFinish();
            return;
        }

        try { sessionStorage.setItem('biltec_opening', '1'); } catch (e) { /* noop */ }

        var minTime = new Promise(function (resolve) { setTimeout(resolve, 2000); });
        var loaded = new Promise(function (resolve) {
            if (document.readyState === 'complete') resolve();
            else window.addEventListener('load', resolve);
        });
        // 読み込みが遅くても 4 秒で必ず抜ける
        var timeout = new Promise(function (resolve) { setTimeout(resolve, 4000); });

        Promise.race([Promise.all([minTime, loaded]), timeout]).then(function () {
            opening.classList.add('is-done');
            setTimeout(onFinish, 700);
            setTimeout(function () { opening.classList.add('is-skip'); }, 1400);
        });
    }

    /**
     * TOP：MV の背景フェードスライダー＋右下のバー
     */
    function initTopMv() {
        var mv = document.getElementById('top-mv');
        if (!mv) return;

        mv.querySelectorAll('.top-mv__line').forEach(function (line, i) {
            line.style.setProperty('--i', i);
        });

        var interval = 6000;
        mv.style.setProperty('--mv-interval', interval + 'ms');
        var bars = mv.querySelectorAll('.top-mv__bar');
        var slider = null;

        function setBar(index) {
            bars.forEach(function (bar, i) {
                bar.classList.remove('is-active');
                if (i === index) {
                    void bar.offsetWidth; // アニメーションを最初から
                    bar.classList.add('is-active');
                }
            });
        }

        if (typeof Splide !== 'undefined') {
            slider = new Splide(mv.querySelector('.top-mv__slider'), {
                type: 'fade',
                rewind: true,
                speed: 2000,
                interval: interval,
                autoplay: false,
                arrows: false,
                pagination: false,
                drag: false,
                pauseOnHover: false,
                pauseOnFocus: false
            });
            slider.on('move', function (index) { setBar(index); });
            slider.mount();
        }

        initOpening(function () {
            mv.classList.add('is-start');
            setBar(0);
            if (slider) slider.Components.Autoplay.play();
        });
    }

    /**
     * ビルテックの強み：中央が明るく両サイドが暗いループスライダー
     */
    function initStrengthSlider() {
        if (typeof Splide === 'undefined') return;
        var root = document.querySelector('.strength__slider');
        if (!root) return;

        new Splide(root, {
            type: 'loop',
            focus: 'center',
            perPage: 3,
            perMove: 1,
            gap: '6rem',
            speed: 1000,
            autoplay: true,
            interval: 3000,
            pauseOnHover: false,
            pauseOnFocus: false,
            pagination: false,
            breakpoints: {
                768: { perPage: 1.5, gap: '3rem' }
            }
        }).mount();
    }

    /**
     * 先輩インタビュー：自動で右から左へ流れるループスライダー＋「1 ── N」の進み具合
     */
    function initInterviewSlider() {
        if (typeof Splide === 'undefined') return;
        var section = document.querySelector('.interview-typeF');
        if (!section) return;
        var root = section.querySelector('.interview__slider');
        if (!root) return;

        // 左の「1」は固定、右は総数。間の線が進み具合に合わせて伸びる
        var bar = section.querySelector('.interview__progress-bar');

        var slider = new Splide(root, {
            type: 'loop',
            perPage: 2.5,
            perMove: 1,
            gap: 0,
            speed: 1000,
            autoplay: true,
            interval: 3000,
            pauseOnHover: false,
            pauseOnFocus: false,
            arrows: false,
            pagination: false,
            breakpoints: {
                768: { perPage: 1.3 }
            }
        });

        slider.on('mounted move', function () {
            var total = slider.length;
            var index = slider.index;
            if (bar) bar.style.width = (100 * (index + 1) / total) + '%';
        });

        slider.mount();
    }

    /**
     * SP：画面下の追従ボタン（MV を過ぎたら出す）とメニューの aria
     */
    function initSpFixedCta() {
        var cta = document.querySelector('.sp-fixed-cta');
        if (cta) {
            var onScroll = function () {
                cta.classList.toggle('is-show', window.scrollY > 300);
            };
            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        }

        var menu = document.querySelector('.header__menu-typeD');
        if (menu) {
            menu.addEventListener('click', function () {
                // main.js が .active を付け外しした後に aria を合わせる
                setTimeout(function () {
                    var open = menu.classList.contains('active');
                    menu.setAttribute('aria-expanded', open ? 'true' : 'false');
                    menu.setAttribute('aria-label', open ? 'メニューを閉じる' : 'メニューを開く');
                }, 0);
            });
        }

        document.querySelectorAll('.drawer__toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                // main.js が .active を付け外しした後に aria を合わせる
                setTimeout(function () {
                    btn.setAttribute('aria-expanded', btn.classList.contains('active') ? 'true' : 'false');
                }, 0);
            });
        });

        // PC：ヘッダーのドロップダウンをキーボードでも開けるように
        document.querySelectorAll('#header .gnav__item').forEach(function (item) {
            item.addEventListener('focusin', function () { item.classList.add('active'); });
            item.addEventListener('focusout', function (e) {
                if (!item.contains(e.relatedTarget)) item.classList.remove('active');
            });
        });
    }

    /**
     * TOP：MV の上にいる間はヘッダーを透明（.is-clear）にする。SPメニューを開いている間は白に戻す。
     */
    function initHeaderState() {
        var header = document.getElementById('header');
        var mv = document.getElementById('top-mv');
        if (!header || !mv) return;

        var update = function () {
            var menuOpen = !!document.querySelector('.drawer.active');
            var overMv = window.scrollY < mv.offsetHeight - header.offsetHeight;
            header.classList.toggle('is-clear', overMv && !menuOpen);
        };
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
        document.querySelectorAll('.menu').forEach(function (btn) {
            btn.addEventListener('click', function () { setTimeout(update, 0); });
        });
        update();
    }

    document.addEventListener('DOMContentLoaded', function () {
        initHeaderState();
        initCareerSlider();
        initLines();
        initInview();
        initTopMv();
        initStrengthSlider();
        initInterviewSlider();
        initSpFixedCta();
    });
})();
