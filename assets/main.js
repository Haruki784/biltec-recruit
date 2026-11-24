jQuery(function ($) {
    $('.menu').on('click', function () {
        $('.menu').toggleClass('active');
        $('.drawer').toggleClass('active');
    });

    /* 260724  ドロワー内のリンククリックでトロワ―閉じる */
    $('.drawer__link').on('click', function () {
        $('.menu').removeClass('active');
        $('.drawer').removeClass('active');
        $('.menu').attr('aria-expanded', false);
    });
    /* 260724  ドロワー内のリンククリックでトロワ―閉じる */



    // ヘッダー内の.toggleにhoverでactiveをつけ、同時に親gnav__itemにもactiveをつける
    // hover時: .toggle か .nav のどちらかにマウスが乗ってる間は .gnav__item.active をキープ
    $('#header .gnav__item').each(function () {
        var $item = $(this);
        var $toggle = $item.find('.toggle').first();
        var $nav = $item.find('.nav').first();

        $toggle.add($nav).on('mouseenter', function () {
            $toggle.addClass('active');
            $item.addClass('active');
        }).on('mouseleave', function () {
            // navにもtoggleにもフォーカスされていなければ外す
            setTimeout(function () {
                // どちらにもhoverしていないなら外す
                if (!($toggle.is(':hover') || $nav.is(':hover'))) {
                    $toggle.removeClass('active');
                    $item.removeClass('active');
                }
            }, 10);
        });
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() > 100) {
            $('#header').addClass('active');
        } else {
            $('#header').removeClass('active');
        }
    });

    // headerのgnav以外の.toggleはクリックでactiveを付け外し
    $('.toggle').not('#header .gnav__item .toggle').on('click', function (e) {
        // 空リンクの不要なページ遷移を防ぐ
        if (this.tagName === 'A') {
            e.preventDefault();
        }
        $(this).toggleClass('active');
    });

    document.querySelectorAll('.tab').forEach(function (root) {
        var list = root.querySelector(':scope > .tab__items');
        var box = root.querySelector(':scope > .local-navigation__panels');
        if (!list || !box) return;

        var tabs = list.querySelectorAll(':scope > .tab__item');
        var panels = box.children;

        function show(index) {
            tabs.forEach(function (li, i) {
                var label = li.querySelector('.local-navigation__text') || li.querySelector('span');
                if (label) label.classList.toggle('active', i === index);
            });

            Array.prototype.forEach.call(panels, function (panel, i) {
                var on = i === index;
                panel.classList.toggle('is-active', on);
                panel.hidden = !on;
            });
        }

        var initial = 0;
        Array.prototype.forEach.call(panels, function (panel, i) {
            if (panel.classList.contains('is-active')) initial = i;
        });

        tabs.forEach(function (li, i) {
            li.addEventListener('click', function () {
                show(i);
            });
        });

        show(initial);
    });

    // 目次を自動生成 & スクロールスパイ
    var $content = $('#js-article-content');
    var $indexList = $('.index__items');

    if ($content.length && $indexList.length) {
        var indexItems = '';
        $content.find('article.article[id]').each(function (i) {
            var uniqueId = 'section-' + (i + 1);
            $(this).attr('id', uniqueId);
            // article に data-index があれば目次の文言に使う（なければ h2 の文字）
            var title = ($(this).attr('data-index') || $(this).find('h2').first().text()).trim();
            if (title) {
                indexItems += '<li class="index__item pb-1"><a href="#' + uniqueId + '" class="index__link">' + title + '</a></li>';
            }
        });
        if (indexItems) {
            $indexList.html(indexItems);
        }

        // スクロールスパイ：現在表示中のセクションに active を付与
        var $sections = $content.find('article.article[id]');
        var $links = $indexList.find('.index__link');

        function updateActive() {
            var scrollTop = $(window).scrollTop();
            var offset = 120; // ヘッダー分のオフセット

            var currentId = '';
            $sections.each(function () {
                if ($(this).offset().top - offset <= scrollTop) {
                    currentId = $(this).attr('id');
                }
            });

            $links.each(function () {
                var href = $(this).attr('href').replace('#', '');
                $(this).toggleClass('active', href === currentId);
            });
        }

        $(window).on('scroll', updateActive);
        updateActive();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const chartsA = document.querySelectorAll('.chart-typeA');
    const chartsB = document.querySelectorAll('.chart-typeB');
    const chartsC = document.querySelectorAll('.chart-typeC');
    const chartsD = document.querySelectorAll('.chart-typeD');

    chartsA.forEach(chart => chart.style.setProperty('--percentage', '0'));
    chartsB.forEach(chart => {
        chart.style.setProperty('--percentage1', '0');
        chart.style.setProperty('--percentage2', '0');
        chart.style.setProperty('--percentage3', '0');
        chart.style.setProperty('--percentage4', '0');
    });
    chartsC.forEach(chart => chart.style.setProperty('--percentage', '0'));

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');

                if (entry.target.classList.contains('chart-typeA')) {
                    const targetValue = parseFloat(getComputedStyle(entry.target).getPropertyValue('--target')) || 50;
                    animateChartA(entry.target, targetValue);
                } else if (entry.target.classList.contains('chart-typeB')) {
                    const target1 = parseFloat(getComputedStyle(entry.target).getPropertyValue('--target1')) || 0;
                    const target2 = parseFloat(getComputedStyle(entry.target).getPropertyValue('--target2')) || 0;
                    const target3 = parseFloat(getComputedStyle(entry.target).getPropertyValue('--target3')) || 0;
                    const target4 = parseFloat(getComputedStyle(entry.target).getPropertyValue('--target4')) || 0;
                    animateChartB(entry.target, target1, target2, target3, target4);
                } else if (entry.target.classList.contains('chart-typeC')) {
                    const targetValue = parseFloat(getComputedStyle(entry.target).getPropertyValue('--target')) || 50;
                    animateChartA(entry.target, targetValue);
                }
            }
        });
    }, { threshold: 0.3 });

    chartsA.forEach(chart => observer.observe(chart));
    chartsB.forEach(chart => observer.observe(chart));
    chartsC.forEach(chart => observer.observe(chart));
    chartsD.forEach(chart => observer.observe(chart));

    // カウントアップ
    const countNumbers = document.querySelectorAll('.count__number');
    const countTitles = document.querySelectorAll('.count__title');
    const countItems = [...countNumbers, ...countTitles];

    const countObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                entry.target.classList.add('counted');
                const countValue = entry.target.getAttribute('data-count') || '0';
                const targetNumber = parseFloat(countValue.replace(/,/g, '')) || 0;
                const suffix = entry.target.getAttribute('data-suffix') || '';
                animateCount(entry.target, targetNumber, suffix);

                // data-count2 がある場合は2つ目の値もアニメーション
                const countValue2 = entry.target.getAttribute('data-count2');
                if (countValue2 !== null) {
                    const targetNumber2 = parseFloat(countValue2.replace(/,/g, '')) || 0;
                    const suffix2 = entry.target.getAttribute('data-suffix2') || '';
                    animateCount2(entry.target, targetNumber2, suffix2);
                }
            }
        });
    }, { threshold: 0.3 });

    countItems.forEach(item => countObserver.observe(item));

    // plain が true のときは 3桁区切りのカンマを付けない（西暦など。data-plain を付けた要素）
    function formatNumber(num, hasDecimal, plain) {
        const str = hasDecimal ? num.toFixed(1) : Math.floor(num).toString();
        return plain ? str : str.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // 小数点以下を <span class="count__decimal"> で囲んだ HTML 文字列を返す
    function formatNumberHTML(num, hasDecimal, suffix, appendSuffix, plain) {
        const formatted = formatNumber(num, hasDecimal, plain);
        const sfx = appendSuffix ? suffix : '';
        if (hasDecimal && formatted.includes('.')) {
            const [intPart, decPart] = formatted.split('.');
            return intPart + '<span class="count__decimal">.' + decPart + '</span>' + sfx;
        }
        return formatted + sfx;
    }

    function animateCount(element, targetNumber, suffix) {
        const valueEl = element.querySelector('.count__number-value');
        const targetEl = valueEl || element;
        const appendSuffix = !valueEl;
        const duration = 2000;
        const startTime = performance.now();
        const hasDecimal = targetNumber % 1 !== 0;
        const plain = element.hasAttribute('data-plain');

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const current = targetNumber * easeProgress;
            targetEl.innerHTML = formatNumberHTML(current, hasDecimal, suffix, appendSuffix, plain);
            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                targetEl.innerHTML = formatNumberHTML(targetNumber, hasDecimal, suffix, appendSuffix, plain);
            }
        }

        requestAnimationFrame(update);
    }

    function animateCount2(element, targetNumber, suffix) {
        const valueEl = element.querySelector('.count__number-value2');
        if (!valueEl) return;
        const duration = 2000;
        const startTime = performance.now();
        const hasDecimal = targetNumber % 1 !== 0;

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const current = targetNumber * easeProgress;
            valueEl.innerHTML = formatNumberHTML(current, hasDecimal, suffix, true);
            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                valueEl.innerHTML = formatNumberHTML(targetNumber, hasDecimal, suffix, true);
            }
        }

        requestAnimationFrame(update);
    }

    function animateChartA(element, targetPercentage) {
        const duration = 1500;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            element.style.setProperty('--percentage', targetPercentage * easeProgress);
            if (progress < 1) requestAnimationFrame(update);
        }

        requestAnimationFrame(update);
    }

    function animateChartB(element, target1, target2, target3, target4) {
        const duration = 1500;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            element.style.setProperty('--percentage1', target1 * easeProgress);
            element.style.setProperty('--percentage2', target2 * easeProgress);
            element.style.setProperty('--percentage3', target3 * easeProgress);
            element.style.setProperty('--percentage4', target4 * easeProgress);
            if (progress < 1) requestAnimationFrame(update);
        }

        requestAnimationFrame(update);
    }
});
