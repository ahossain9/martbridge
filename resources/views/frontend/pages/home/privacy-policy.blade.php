@extends('frontend.layouts.app')

@section('title', __('Privacy and Policy ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Privacy and Policy</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Privacy and Policy</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <h2 class="title text-center mb-3">Privacy Policy</h2>
            <h4>Effective Date: Jul 1, 2023</h4>
            <p>
                We at TechsTronix value and respect your privacy. This Privacy Policy outlines how we collect, use, disclose, and protect your personal information when you visit our website or make use of our services. By accessing or using our website, you consent to the terms of this Privacy Policy.
            </p>
            <div class="mb-4">
                <h4>1. Information We Collect </h4>
                <p>1.1 Personal Information: We may collect personal information such as your name, email address, phone number, shipping address, and payment information when you create an account, place an order, or communicate with us.</p>
                <p>1.2 Automatically Collected Information: When you visit our website, we may automatically collect certain information, including your IP address, browser type, operating system, referring URLs, and browsing behavior.</p>
            </div>

            <div class="mb-4">
                <h4>2. Use of Information </h4>
                <p>2.1 We use the collected information to provide and improve our services, process orders, respond to inquiries, personalize your experience, and communicate with you.</p>
                <p>2.2 We may also use your information to send promotional emails, newsletters, or marketing communications. You can opt out of receiving such communications at any time.</p>
                <p>2.3 We do not sell, trade, or rent your personal information to third parties without your consent, except as required to fulfill your orders or as legally required.</p>
            </div>

            <div class="mb-4">
                <h4>3. Data Security</h4>
                <p>3.1 We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>
                <p>3.2 However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee the absolute security of your information.</p>
            </div>

            <div class="mb-4">
                <h4>4. Cookies and Tracking Technologies </h4>
                <p>4.1 We use cookies and similar tracking technologies to enhance your experience, analyze website usage, and provide personalized content.</p>
                <p>4.2 You can manage your cookie preferences through your browser settings. However, disabling cookies may limit certain functionalities of our website.</p>
            </div>

            <div class="mb-4">
                <h4>5. Third-Party Services and Links</h4>
                <p>5.1 Our website may contain links to third-party websites or services that are not operated by us. We are not responsible for the privacy practices or content of such third parties. We encourage you to review their privacy policies.</p>
                <p>5.2 We may also use third-party services for analytics, advertising, and payment processing. These services may collect and process your information according to their own privacy policies.</p>
            </div>

            <div class="mb-4">
                <h4>6. Children's Privacy</h4>
                <p>6.1 Our website is not intended for children under the age of 13. We do not knowingly collect personal information from children. If you believe we have inadvertently collected information from a child, please contact us to have it removed.</p>
            </div>

            <div class="mb-4">
                <h4>7. Changes to this Privacy Policy</h4>
                <p>7.1 We may update this Privacy Policy from time to time. The updated version will be posted on our website with the effective date. Your continued use of our website after any changes to this Privacy Policy constitutes your acceptance of the revised terms.</p>
            </div>

            <div class="mb-4">
                <h4>8. Contact Us</h4>
                <p>8.1 If you have any questions, concerns, or requests regarding this Privacy Policy or the handling of your personal information, please contact us at [contact@softscholar.com] or [01688 034515].</p>
            </div>

            Please review this Privacy Policy regularly to stay informed about how we protect your personal information. This Privacy Policy is effective as of the date indicated and supersedes any prior versions.

            Last updated on Jul 1, 2023.
        </div>
    </div>

@endsection
