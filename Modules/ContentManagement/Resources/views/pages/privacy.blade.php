@section('page_title', 'Privacy Policy')
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="set-bg page-banner" data-setbg="{{ asset('img/background/header-bg.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center text-white text-uppercase"></div>
    </div>
  </div>
</section>

<div class="page-title mt-3" data-aos="fade">
  <div class="container">
    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Privacy Policy</li>
      </ol>
    </nav>
  </div>
</div>

<section id="service-details" class="service-details section">
  <div class="container">
    <div class="row gy-4">

      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        <h3>Privacy Policy</h3>
        <p><em>Last updated: 24 November 2026</em></p>

        <p>This policy explains what personal data MoneySwap collects when you use the MoneySwap mobile app and website, why we collect it, who we share it with, how long we keep it and the choices you have. MoneySwap is operated by MoneySwap LLC together with its Nigerian operating company, Moneyswap Nigeria Limited (RC1801258) ("MoneySwap", "we", "us"). We process personal data in line with the Nigeria Data Protection Act 2023 and other laws that apply to us.</p>

        <h4>1. Data we collect</h4>
        <p><strong>Account and contact details.</strong> Your name, email address, phone number, username, password (stored only in hashed form), transaction PIN (stored only in hashed form), gender and the address you give us.</p>
        <p><strong>Identity verification (KYC).</strong> To meet anti-money-laundering and know-your-customer rules we collect identity details such as your BVN or NIN, date of birth, photos of an identity document (for example a passport or driver's licence), a selfie or short liveness check, and, where required, proof of address and source of funds.</p>
        <p><strong>Financial and transaction data.</strong> Wallet balances, deposits, withdrawals, currency swaps and offers, conversions, bill payments, savings plans, Àjò group contributions and payouts, saved beneficiaries and bank account details you add for withdrawals, and the fees and rates applied.</p>
        <p><strong>Location.</strong> If you allow it, your device's precise location while you complete address verification. This is optional and only used for that step.</p>
        <p><strong>Device and usage data.</strong> A push-notification token, device model, operating-system and app version, IP address, and logs of sign-ins and errors that help us keep your account secure and fix problems.</p>
        <p><strong>Support and communications.</strong> Messages, tickets and attachments you send to our support team.</p>
        <p><strong>Games.</strong> Your game results, points and leaderboard position. Game points have no cash value.</p>
        <p>We do not use your data for third-party advertising and we do not track you across other companies' apps or websites.</p>

        <h4>2. How we use your data</h4>
        <ul>
          <li>To create and secure your account, verify your identity and prevent fraud.</li>
          <li>To provide our services: hold balances, process deposits, withdrawals, swaps, bill payments, savings and Àjò groups.</li>
          <li>To meet our legal duties, including anti-money-laundering, counter-terrorist-financing and tax rules, and to respond to lawful requests from regulators and law enforcement.</li>
          <li>To send you transaction alerts, security codes and service messages by email, SMS and push notification.</li>
          <li>To answer your support requests and resolve disputes.</li>
          <li>To keep the service working, measure performance and fix errors.</li>
        </ul>
        <p>Our legal bases are performing our contract with you, complying with legal obligations, our legitimate interest in running a secure service, and your consent where we ask for it (for example location access or push notifications). You can withdraw consent at any time in your device settings.</p>

        <h4>3. Who we share it with</h4>
        <p>We do not sell your personal data. We share it only with the service providers we need to run MoneySwap, under contracts that require them to protect it:</p>
        <ul>
          <li><strong>Payment processors and banks</strong>, such as Flutterwave and Nomba, to collect deposits, send withdrawals and process payments.</li>
          <li><strong>Bill-payment providers</strong>, such as VTpass, to deliver airtime, data, electricity, TV and exam-pin purchases.</li>
          <li><strong>Identity-verification providers</strong>, such as Sumsub, Dojah and Smile ID, to check your identity documents, BVN or NIN and selfie.</li>
          <li><strong>Messaging providers</strong>, such as Twilio (SMS), ZeptoMail (email) and Google Firebase Cloud Messaging (push notifications).</li>
          <li><strong>Hosting providers</strong>, such as Amazon Web Services, where our servers and databases run.</li>
          <li><strong>Other MoneySwap users</strong>, only as needed to complete a swap or Àjò group, for example your username and the details of the trade you agreed to.</li>
          <li><strong>Regulators, law enforcement and courts</strong>, when the law requires it.</li>
        </ul>
        <p>Some of these providers process data outside Nigeria. Where they do, we rely on safeguards allowed under the Nigeria Data Protection Act.</p>

        <h4>4. How long we keep it</h4>
        <p>We keep your data while your account is open. Financial laws require us to keep identity and transaction records for at least five years after the end of our relationship with you; we keep those records for that period and then delete them. Other data is deleted or anonymised once we no longer need it.</p>

        <h4>5. Deleting your account</h4>
        <p>You can delete your account in the app at any time under <strong>Settings &gt; Account deletion</strong>. Your sign-in sessions end straight away. After a 30-day grace period, during which you can cancel the request, we permanently anonymise your personal data. Transaction and identity records we must keep by law are retained in restricted form for the period described above. You can also ask for deletion by emailing <a href="mailto:info@moneyswap.africa">info@moneyswap.africa</a>.</p>

        <h4>6. Your rights</h4>
        <p>You can ask us to give you a copy of your data, correct it, delete it, restrict or object to how we use it, or move it to another provider. Email <a href="mailto:info@moneyswap.africa">info@moneyswap.africa</a> and we will reply within 30 days. You can also complain to the Nigeria Data Protection Commission.</p>

        <h4>7. Security</h4>
        <p>We encrypt data in transit with HTTPS, encrypt sensitive financial fields at rest, store passwords and PINs only in hashed form, and require your transaction PIN for every payment. No system is perfectly secure, so please keep your password and PIN private and tell us at once if you think your account has been accessed.</p>

        <h4>8. Children</h4>
        <p>MoneySwap is only for people aged 18 and over. We do not knowingly collect data from anyone younger; if we learn that we have, we delete it.</p>

        <h4>9. Changes to this policy</h4>
        <p>We will post any changes on this page and update the date at the top. If a change is significant we will also tell you in the app or by email.</p>

        <h4>10. Contact us</h4>
        <p>Email: <a href="mailto:info@moneyswap.africa">info@moneyswap.africa</a><br>
        Phone: +234 803 408 5355, +234 807 320 6871<br>
        Address: 5 Kikelomo Ayoola Crescent, Thomas Estate, Ajah, Lekki-Epe Expressway, Lagos, Nigeria</p>
      </div>

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="services-list">
          <a href="#" class="active">Legal</a>
          <a href="{{ url('page/terms') }}">Terms of Service</a>
          <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
          <a href="{{ url('page/complaint') }}">AML compliant</a>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
