<?php
get_header();
?>

<main>
    <section class="privacy py-9">
        <div class="container grid grid-1 gap-y-8">
            <?php get_template_part('snippet/breadcrumb'); ?>
            <h2 class="privacy__heading heading-3">
                採用活動におけるプライバシーポリシー
            </h2>
            <div class="privacy__head">
                <div class="privacy__description">
                    借り物(以下「当社」といいます。)は、採用活動において応募者の皆様からご提供いただく個人情報の重要性を認識し、<br>
                    個人情報の保護に関する法律その他関連法令を遵守するとともに、以下の方針に基づき個人情報を適切に取り扱い、保護に努めます。<br>
                </div>
                <div class="privacy__companyInfo mt-2">
                    借り物<br>代表取締役 山田太郎<br>東京都新宿区西新宿1-2-3
                </div>
            </div>
            <div class="privacy__body grid grid-1 gap-y-6">
                <div class="privacy__box grid grid-1 gap-y-2">
                    <h3 class="privacy__title heading-4">1. 個人情報の取得について</h3>
                    <p class="privacy__text">
                        当社は、採用活動において応募者の皆様からご提供いただく個人情報を、適法かつ公正な手段により取得いたします。取得する個人情報には、以下のものが含まれます。
                    </p>
                    <ul class="privacy__items flex flex-1 gap-y-1">
                        <li class="privacy__item col">
                            基本情報(氏名、生年月日、性別、住所、電話番号、メールアドレス等)基本情報(氏名、生年月日、性別、住所、電話番号、メールアドレス等)基本情報(氏名、生年月日、性別、住所、電話番号、メールアドレス等)基本情報(氏名、生年月日、性別、住所、電話番号、メールアドレス等)基本情報(氏名、生年月日、性別、住所、電話番号、メールアドレス等)基本情報(氏名、生年月日、性別、住所、電話番号、メールアドレス等)
                        </li>
                        <li class="privacy__item col">
                            学歴・職歴情報(最終学歴、学校名、卒業年月、職歴、勤務先名、勤務期間等)
                        </li>
                        <li class="privacy__item col">
                            資格・スキル情報(保有資格、語学力、PCスキル、その他の専門技能等)
                        </li>
                        <li class="privacy__item col">
                            その他採用選考に必要な情報(志望動機、自己PR、面接時の発言内容等)
                        </li>
                    </ul>
                </div>
                <div class="privacy__box grid grid-1 gap-y-1">
                    <h3 class="privacy__title heading-4">2.個人情報の利用目的</h3>
                    <p class="privacy__text">
                        当社は、取得した個人情報を以下の目的で利用いたします。<br>
                    </p>
                </div>
                <div class="privacy__box grid grid-1 gap-y-1">
                    <h3 class="privacy__title heading-4">3.個人情報の管理</h3>
                    <p class="privacy__text">
                        当社は、個人情報の漏洩、滅失、毀損の防止その他の安全管理のため、必要かつ適切な措置を講じます。<br>
                        また、個人情報を取り扱う従業員に対して、個人情報の保護に関する教育を実施し、適切な管理を行います。
                    </p>
                </div>
                <div class="privacy__box grid grid-1 gap-y-1">
                    <h3 class="privacy__title heading-4">4.個人情報の第三者提供</h3>
                    <p class="privacy__text">
                        当社は、法令に基づく場合を除き、ご本人の同意なく個人情報を第三者に提供することはありません。<br>
                        ただし、採用選考の過程で、選考に関わる当社の役員・従業員に情報を開示する場合があります。
                    </p>
                </div>
                <?php get_template_part('snippet/contact-address'); ?>
                <div class="privacy__box grid grid-1 gap-y-1">
                    <p class="privacy__text">
                        以附則<br>本ポリシーは、2026年3月1日より施行します。
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>